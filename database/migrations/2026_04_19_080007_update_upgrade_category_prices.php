<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $category = DB::table('service_categories')->where('slug', 'upgrade')->first();
        if ($category) {
            $data = json_decode($category->services_data, true);
            
            $data['upgrade_ram']['price'] = 'Rp 200.000';
            $data['upgrade_ram']['desc'] = 'Jasa tambah atau ganti RAM laptop/PC/AIO';
            $data['upgrade_ram']['note'] = 'Hanya biaya jasa pasang. Pembelian part dihitung terpisah atau bawa sendiri.';
            
            $data['upgrade_ssd']['price'] = 'Rp 200.000';
            $data['upgrade_ssd']['desc'] = 'Jasa ganti HDD ke SSD atau upgrade kapasitas';
            $data['upgrade_ssd']['note'] = 'Hanya biaya jasa pasang (termasuk cloning data). Pembelian part dihitung terpisah.';
            
            $data['rakit_pc'] = [
                'label' => 'Jasa Rakit PC',
                'desc' => 'Jasa perakitan PC Custom (Gaming/Office)',
                'price' => 'Rp 300.000',
                'note' => 'Hanya biaya jasa rakit. Komponen bisa beli dari kami atau bawa sendiri.'
            ];

            DB::table('service_categories')
                ->where('slug', 'upgrade')
                ->update(['services_data' => json_encode($data)]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original if needed
    }
};
