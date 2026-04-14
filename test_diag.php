<?php use App\Models\Service;
$s = Service::whereNotNull('diagnosis_result')->first();
echo json_encode($s ? $s->diagnosis_result : null);
