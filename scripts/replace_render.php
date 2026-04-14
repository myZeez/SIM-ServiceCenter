<?php
$file = 'E:/SKRIP v2/AdministrasiCellcom/app/Livewire/DiagnosisChat.php';
$content = file_get_contents($file);

// Replace render()
$oldRender = <<<PHP
    public function render()
    {
        \$categories = \$this->getCategories();

        return view('livewire.diagnosis-chat', [
            'deviceTypes' => self::DEVICE_TYPES,
            'selectedDeviceType' => \$this->selectedDeviceType,
            'categories' => \$categories,
            'selectedCategoryData' => \$this->selectedCategoryKey
                ? (\$categories[\$this->selectedCategoryKey] ?? null)
                : null,
            'serviceMenu' => self::SERVICE_MENU,
        ])->layout('layouts.diagnosis', ['title' => 'Sistem Pakar Diagnosis - Cellcom']);
    }
PHP;

$newRender = <<<PHP
    public function render()
    {
        \$deviceTypes = \App\Models\DeviceType::where('is_active', true)->orderBy('order_column')->get();
        \$categories = \$this->selectedDeviceType
            ? \App\Models\DeviceComponent::where('device_type_id', \$this->selectedDeviceType)->where('is_active', true)->orderBy('order_column')->get()
            : collect();
        \$selectedCategoryObj = \$this->selectedCategoryKey
            ? \App\Models\DeviceComponent::find(\$this->selectedCategoryKey)
            : null;
        \$problems = \$selectedCategoryObj
            ? \App\Models\Symptom::where('device_component_id', \$selectedCategoryObj->id)->get()
            : collect();
        \$serviceMenu = \App\Models\ServiceCategory::where('is_active', true)->orderBy('order_column')->get();

        return view('livewire.diagnosis-chat', [
            'dbDeviceTypes' => \$deviceTypes,
            'selectedDeviceType' => \$this->selectedDeviceType,
            'dbCategories' => \$categories,
            'selectedCategoryData' => \$selectedCategoryObj,
            'dbProblems' => \$problems,
            'dbServiceMenu' => \$serviceMenu,
        ])->layout('layouts.diagnosis', ['title' => 'Sistem Pakar Diagnosis - Cellcom']);
    }
PHP;

$content = str_replace($oldRender, $newRender, $content);

file_put_contents($file, $content);
echo "Replaced Render";
