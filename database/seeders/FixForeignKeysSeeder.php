<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeviceType;
use App\Models\DeviceComponent;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\CategoryQuestion;

class FixForeignKeysSeeder extends Seeder
{
    /**
     * Tautkan data Expert System dengan ID relasi baru (Device Component & Type)
     */
    public function run(): void
    {
        $deviceTypes = collect(DeviceType::all())->keyBy('slug');

        $this->updateModel(Symptom::class, $deviceTypes);
        $this->updateModel(Disease::class, $deviceTypes);
        $this->updateModel(CategoryQuestion::class, $deviceTypes);
    }

    private function updateModel($modelClass, $deviceTypes)
    {
        foreach ($modelClass::all() as $item) {
            if (!$item->device_type_id || !$item->device_component_id) {
                $dt = $deviceTypes->get($item->device_type);
                if ($dt) {
                    $item->device_type_id = $dt->id;
                    $component = DeviceComponent::where('device_type_id', $dt->id)
                        ->where('engine_category', $item->category)
                        ->first();

                    if ($component) {
                        $item->device_component_id = $component->id;
                    }
                    $item->save();
                }
            }
        }
    }
}
