<?php
$file = 'E:/SKRIP v2/AdministrasiCellcom/app/Livewire/DiagnosisChat.php';
$content = file_get_contents($file);

// 1. selectDevice
$oldSelectDevice = <<<PHP
    public function selectDevice(string \$type): void
    {
        if (!isset(self::DEVICE_TYPES[\$type])) return;

        \$this->selectedDeviceType = \$type;
        \$this->state = 'select_category';
    }
PHP;

$newSelectDevice = <<<PHP
    public function selectDevice(\$type): void
    {
        \$device = \App\Models\DeviceType::find(\$type);
        if (!\$device) return;

        \$this->selectedDeviceType = \$type;
        \$this->state = 'select_category';
    }
PHP;
$content = str_replace($oldSelectDevice, $newSelectDevice, $content);

// 2. selectCategory
$oldSelectCategory = <<<PHP
    public function selectCategory(string \$key): void
    {
        \$categories = \$this->getCategories();
        if (!isset(\$categories[\$key])) return;

        \$this->selectedCategoryKey = \$key;
        \$this->state = 'select_problem';
    }
PHP;

$newSelectCategory = <<<PHP
    public function selectCategory(\$key): void
    {
        \$component = \App\Models\DeviceComponent::find(\$key);
        if (!\$component) return;

        \$this->selectedCategoryKey = \$key;
        \$this->state = 'select_problem';
    }
PHP;
$content = str_replace($oldSelectCategory, $newSelectCategory, $content);

// 3. Service inquiries
$oldService1 = <<<PHP
    public function selectServiceCategory(string \$cat): void
    {
        if (!isset(self::SERVICE_MENU[\$cat])) return;
        \$this->selectedServiceCategory = \$cat;
        \$this->state = 'service_detail';
    }
PHP;

$newService1 = <<<PHP
    public function selectServiceCategory(\$id): void
    {
        \$category = \App\Models\ServiceCategory::find(\$id);
        if (!\$category) return;

        \$this->selectedServiceCategory = \$id;
        \$this->selectedServiceData = [
            'label' => \$category->name,
            'desc'  => \$category->description,
            'price' => \$category->estimated_cost_range,
        ];
        \$this->state = 'service_booking';
    }
PHP;
$content = str_replace($oldService1, $newService1, $content);

$oldServiceBooking = <<<PHP
    public function saveServiceBooking(): void
    {
        \$this->validate([
            'bookingForm.name' => 'required|string|max:100',
            'bookingForm.phone' => 'required|string|max:20',
            'bookingForm.notes' => 'nullable|string|max:500',
        ]);

        \$catLabel = self::SERVICE_MENU[\$this->selectedServiceCategory]['label'] ?? '';
        \$serviceLabel = \$this->selectedServiceData['label'] ?? '';
        \$servicePrice = \$this->selectedServiceData['price'] ?? '';

        \$complaint = "[Tanya Dulu] {\$catLabel} - {\$serviceLabel} ({\$servicePrice})";
        if (!empty(\$this->bookingForm['notes'])) {
            \$complaint .= "\\nCatatan: " . \$this->bookingForm['notes'];
        }
PHP;

$newServiceBooking = <<<PHP
    public function saveServiceBooking(): void
    {
        \$this->validate([
            'bookingForm.name' => 'required|string|max:100',
            'bookingForm.phone' => 'required|string|max:20',
            'bookingForm.notes' => 'nullable|string|max:500',
        ]);

        \$serviceLabel = \$this->selectedServiceData['label'] ?? '';
        \$servicePrice = \$this->selectedServiceData['price'] ?? '';

        \$complaint = "[Tanya Dulu] {\$serviceLabel} ({\$servicePrice})";
        if (!empty(\$this->bookingForm['notes'])) {
            \$complaint .= "\\nCatatan: " . \$this->bookingForm['notes'];
        }
PHP;
$content = str_replace($oldServiceBooking, $newServiceBooking, $content);

file_put_contents($file, $content);
echo "Replaced Selections";
