<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Brand;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    // Settings Tabs
    public $activeTab = 'general';

    // Config Values
    public $adminFee;
    public $techCommission;
    public $techTarget;
    
    // Logo
    public $logo;
    public $currentLogo;

    // User Management
    public $users;
    public $name, $email, $role = 'teknisi', $password;
    public $showUserModal = false;
    public $isEdit = false;
    public $editUserId;

    // Brand Management
    public $brands;
    public $brandName = '';
    public $editBrandId = null;
    public $showBrandModal = false;

    protected $rules = [
        'adminFee' => 'required|numeric|min:0',
        'techCommission' => 'required|numeric|min:0|max:100',
        'techTarget' => 'required|numeric|min:0',
        'logo' => 'nullable|image|max:1024',
    ];

    public function mount()
    {
        $this->loadSettings();
        $this->loadUsers();
        $this->loadBrands();
    }

    public function loadSettings()
    {
        $this->adminFee = Setting::where('key', 'admin_fee_per_invoice')->value('value') ?? 20000;
        $this->techCommission = Setting::where('key', 'technician_commission_percent')->value('value') ?? 50;
        $this->techTarget = Setting::where('key', 'technician_monthly_target')->value('value') ?? 3000000;
        $this->currentLogo = Setting::where('key', 'app_logo')->value('value') ?? null;
    }

    public function loadUsers()
    {
        $this->users = User::whereIn('role', ['teknisi', 'admin'])
            ->orderBy('is_active', 'desc')
            ->orderBy('name')
            ->get();
    }

    public function saveSettings()
    {
        $this->validate();

        Setting::updateOrCreate(['key' => 'admin_fee_per_invoice'], ['value' => $this->adminFee]);
        Setting::updateOrCreate(['key' => 'technician_commission_percent'], ['value' => $this->techCommission]);
        Setting::updateOrCreate(['key' => 'technician_monthly_target'], ['value' => $this->techTarget]);

        if ($this->logo) {
            $path = $this->logo->store('logos', 'public');
            Setting::updateOrCreate(['key' => 'app_logo'], ['value' => $path]);
            $this->currentLogo = $path;
            $this->logo = null;
        }

        session()->flash('message', 'Pengaturan global berhasil disimpan.');
    }

    // User Management Functions
    public function openUserModal()
    {
        $this->reset(['name', 'email', 'role', 'password', 'isEdit', 'editUserId']);
        $this->showUserModal = true;
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $this->editUserId = $user->id;
        $this->name = $user->name;
        $this->email = $user->role === 'teknisi' ? '' : $user->email;
        $this->role = $user->role;
        $this->isEdit = true;
        $this->showUserModal = true;
    }

    public function saveUser()
    {
        $isTechnician = $this->role === 'teknisi';

        $rules = [
            'name' => 'required|string',
            'role' => 'required|in:teknisi,admin',
        ];

        if (!$isTechnician) {
            $rules['email'] = 'required|email|unique:users,email,' . ($this->editUserId ?? 'null');
            if (!$this->isEdit) {
                $rules['password'] = 'required|min:6';
            }
        }

        $this->validate($rules);

        if ($this->isEdit) {
            $user = User::find($this->editUserId);
            $data = ['name' => $this->name, 'role' => $this->role];

            if (!$isTechnician) {
                $data['email'] = $this->email;
                if ($this->password) {
                    $data['password'] = Hash::make($this->password);
                }
            }

            // If role changed TO teknisi, nullify login ability
            if ($isTechnician && $user->role !== 'teknisi') {
                $data['email'] = Str::slug($this->name) . '.' . time() . '@teknisi.local';
                $data['password'] = Hash::make(Str::random(32));
            }

            $user->update($data);
            session()->flash('user_message', 'Data diperbarui.');
        } else {
            if ($isTechnician) {
                // Teknisi: no login needed, auto-generate credentials
                User::create([
                    'name'               => $this->name,
                    'email'              => Str::slug($this->name) . '.' . time() . '@teknisi.local',
                    'role'               => 'teknisi',
                    'password'           => Hash::make(Str::random(32)),
                    'email_verified_at'  => now(),
                ]);
            } else {
                User::create([
                    'name'               => $this->name,
                    'email'              => $this->email,
                    'role'               => $this->role,
                    'password'           => Hash::make($this->password),
                    'email_verified_at'  => now(),
                ]);
            }
            session()->flash('user_message', 'Anggota baru ditambahkan.');
        }

        $this->showUserModal = false;
        $this->loadUsers();
    }

    public function toggleStatus($id)
    {
        $user = User::find($id);
        if ($user->id === auth()->id()) {
            return; // Prevent self-deactivation
        }
        $user->is_active = !$user->is_active;
        $user->save();
        $this->loadUsers();
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
             // Opsional: Cek jika user punya relasi service, sebaiknya soft delete atau prevent
             // Untuk sekarang kita set isActive false saja agar aman
             $user->delete();
             $this->loadUsers();
             session()->flash('user_message', 'Pengguna dihapus.');
        }
    }

    public function render()
    {
        return view('livewire.settings');
    }

    // ======== Brand Management ========
    public function loadBrands()
    {
        $this->brands = Brand::orderBy('name')->get();
    }

    public function openBrandModal($id = null)
    {
        $this->editBrandId = $id;
        $this->brandName   = $id ? Brand::find($id)->name : '';
        $this->showBrandModal = true;
    }

    public function saveBrand()
    {
        $this->validate(['brandName' => 'required|string|max:100']);

        if ($this->editBrandId) {
            Brand::find($this->editBrandId)->update(['name' => $this->brandName]);
            session()->flash('brand_message', 'Brand diperbarui.');
        } else {
            Brand::create(['name' => $this->brandName]);
            session()->flash('brand_message', 'Brand ditambahkan.');
        }
        $this->showBrandModal = false;
        $this->brandName = '';
        $this->editBrandId = null;
        $this->loadBrands();
    }

    public function toggleBrand($id)
    {
        $brand = Brand::find($id);
        $brand->is_active = !$brand->is_active;
        $brand->save();
        $this->loadBrands();
    }

    public function deleteBrand($id)
    {
        Brand::find($id)?->delete();
        $this->loadBrands();
        session()->flash('brand_message', 'Brand dihapus.');
    }
}
