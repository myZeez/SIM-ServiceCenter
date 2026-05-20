<?php

namespace App\Livewire\ExpertSystem;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\DeviceType;
use App\Models\DeviceComponent;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\CategoryQuestion;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class DeviceTypeManager extends Component
{
    public $deviceTypes;
    public $showModal = false;
    public $isEdit = false;

    // Form fields
    public $editId;
    public $name;
    public $icon;
    public $description;

    protected $rules = [
        'name' => 'required|string|max:255',
        'icon' => 'nullable|string|max:255',
        'description' => 'nullable|string',
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->deviceTypes = DeviceType::withCount(['components', 'diseases', 'symptoms'])
            ->orderBy('order_column')
            ->get();
    }

    public function openModal()
    {
        $this->resetInput();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetInput();
        $this->isEdit = true;
        $this->editId = $id;

        $type = DeviceType::findOrFail($id);
        $this->name = $type->name;
        $this->icon = $type->icon;
        $this->description = $type->description;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'icon' => $this->icon,
            'description' => $this->description,
        ];

        if ($this->isEdit) {
            DeviceType::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Tipe Perangkat berhasil diperbarui.');
        } else {
            $data['order_column'] = DeviceType::max('order_column') + 1;
            DeviceType::create($data);
            session()->flash('message', 'Tipe Perangkat berhasil ditambahkan.');
        }

        $this->closeModal();
        $this->loadData();
    }

    public function delete($id)
    {
        $type = DeviceType::findOrFail($id);
        if ($type->components()->exists() || $type->diseases()->exists() || $type->symptoms()->exists()) {
            session()->flash('error', 'Unit tidak bisa dihapus karena masih memiliki komponen, kerusakan, atau gejala.');
            return;
        }

        $type->delete();
        session()->flash('message', 'Tipe Perangkat berhasil dihapus.');
        $this->loadData();
    }

    public function toggleStatus($id)
    {
        $type = DeviceType::findOrFail($id);
        $type->is_active = !$type->is_active;
        $type->save();
        $this->loadData();
    }

    public function syncLegacyData($id)
    {
        $type = DeviceType::with('components')->findOrFail($id);
        $updated = 0;

        foreach ($type->components as $component) {
            $updated += $this->syncByComponentCategory($type, $component);
            $updated += $this->syncByProblemData($type, $component);
        }

        $updated += $this->syncDiseasesFromSymptoms($type);
        $updated += $this->syncQuestionsFromSymptoms($type);

        session()->flash('message', "Sinkronisasi dataset {$type->name} selesai. {$updated} data diperbarui.");
        $this->loadData();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->editId = null;
        $this->name = '';
        $this->icon = '';
        $this->description = '';
    }

    private function syncByComponentCategory(DeviceType $type, DeviceComponent $component): int
    {
        $categories = collect([$component->engine_category, $component->slug])
            ->filter()
            ->unique()
            ->values()
            ->all();

        if (empty($categories)) {
            return 0;
        }

        $payload = [
            'device_type_id' => $type->id,
            'device_component_id' => $component->id,
        ];

        $updated = Symptom::where('device_type', $type->slug)
            ->whereIn('category', $categories)
            ->whereNull('device_component_id')
            ->update($payload);

        $updated += Disease::where('device_type', $type->slug)
            ->whereIn('category', $categories)
            ->whereNull('device_component_id')
            ->update($payload);

        $updated += CategoryQuestion::where('device_type', $type->slug)
            ->whereIn('category', $categories)
            ->whereNull('device_component_id')
            ->update($payload);

        return $updated;
    }

    private function syncByProblemData(DeviceType $type, DeviceComponent $component): int
    {
        $updated = 0;
        $problems = $component->problems_data ?: [];

        foreach ($problems as $problem) {
            $codes = $problem['symptoms'] ?? [];
            if (empty($codes)) {
                continue;
            }

            $category = $problem['engine_category'] ?? $component->engine_category ?? $component->slug;
            $updated += Symptom::where('device_type', $type->slug)
                ->whereIn('code', $codes)
                ->update([
                    'device_type_id' => $type->id,
                    'device_component_id' => $component->id,
                    'category' => $category,
                ]);
        }

        return $updated;
    }

    private function syncDiseasesFromSymptoms(DeviceType $type): int
    {
        $updated = 0;
        $diseases = Disease::where('device_type', $type->slug)
            ->whereNull('device_component_id')
            ->with('symptoms')
            ->get();

        foreach ($diseases as $disease) {
            $componentId = $disease->symptoms
                ->pluck('device_component_id')
                ->filter()
                ->countBy()
                ->sortDesc()
                ->keys()
                ->first();

            if (!$componentId) {
                continue;
            }

            $component = DeviceComponent::find($componentId);
            if (!$component) {
                continue;
            }

            $disease->update([
                'device_type_id' => $type->id,
                'device_component_id' => $component->id,
                'category' => $component->engine_category ?: $disease->category,
            ]);
            $updated++;
        }

        return $updated;
    }

    private function syncQuestionsFromSymptoms(DeviceType $type): int
    {
        $updated = 0;
        $questions = CategoryQuestion::where('device_type', $type->slug)
            ->whereNull('device_component_id')
            ->whereNotNull('leads_to_symptom_id')
            ->with('symptom')
            ->get();

        foreach ($questions as $question) {
            $symptom = $question->symptom;
            if (!$symptom || !$symptom->device_component_id) {
                continue;
            }

            $question->update([
                'device_type_id' => $type->id,
                'device_component_id' => $symptom->device_component_id,
                'category' => $symptom->category,
            ]);
            $updated++;
        }

        return $updated;
    }

    public function render()
    {
        return view('livewire.expert-system.device-type-manager');
    }
}
