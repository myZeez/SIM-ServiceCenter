<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\DeviceType;
use App\Models\DeviceComponent;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\CategoryQuestion;

$deviceTypes = collect(DeviceType::all())->keyBy('slug');

function updateModel($modelClass, $deviceTypes) {
    echo "Updating " . class_basename($modelClass) . "...\n";
    $updated = 0;
    foreach ($modelClass::all() as $item) {
        if (!$item->device_type_id || (!$item->device_component_id && in_array('device_component_id', $item->getFillable()))) {
            $dt = $deviceTypes->get($item->device_type);
            if ($dt) {
                $item->device_type_id = $dt->id;

                $component = DeviceComponent::where('device_type_id', $dt->id)
                    ->where('engine_category', $item->category)
                    ->first();

                if ($component) {
                    $item->device_component_id = $component->id;
                    $item->save();
                    $updated++;
                } else {
                    // Save the device_type_id at least, even if component doesn't match perfectly
                    // Some models like CategoryQuestion might still benefit from device_type_id
                    $item->save();
                    $updated++;
                }
            }
        }
    }
    echo "Done. Updated: $updated\n";
}

updateModel(Symptom::class, $deviceTypes);
updateModel(CategoryQuestion::class, $deviceTypes);
