<?php
$file = 'E:/SKRIP v2/AdministrasiCellcom/app/Livewire/DiagnosisChat.php';
$content = file_get_contents($file);

$oldGetEngine = <<<PHP
    private function getEngineDeviceType(): string
    {
        return \$this->selectedDeviceType ?? 'laptop';
    }
PHP;

$newGetEngine = <<<PHP
    private function getEngineDeviceType(): string
    {
        // Try getting the slug to maintain backwards compatibility
        // with ForwardChainingEngine which expects strings like 'laptop', 'pc'
        if (\$this->selectedDeviceType) {
            \$device = \App\Models\DeviceType::find(\$this->selectedDeviceType);
            if (\$device && \$device->slug) return \$device->slug;
        }
        return 'laptop';
    }
PHP;
$content = str_replace($oldGetEngine, $newGetEngine, $content);
file_put_contents($file, $content);
echo "Replaced getEngine\n";
