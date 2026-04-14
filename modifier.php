<?php
$file = 'app/Livewire/ServiceProgress.php';
$content = file_get_contents($file);

// Add properties
$content = str_replace(
    'public $totalCost = 0;',
    "public \$totalCost = 0;\n\n    // Service Packages fields\n    public \$selectedServiceCategoryId = null;\n    public \$selectedServiceItems = [];\n    public \$availableCategories = [];\n    public \$availableServicesData = [];",
    $content
);

// Add imports
if (!str_contains($content, 'use App\Models\ServiceCategory;')) {
    $content = str_replace(
        'use App\Models\Sparepart;',
        "use App\Models\Sparepart;\nuse App\Models\ServiceCategory;",
        $content
    );
}

// In mount
$mountOld = "\$this->rmaNumber       = \$this->selectedService->rma_number;\n            \$this->estimatedCost   = \$this->selectedService->estimated_cost;\n            \$this->totalCost       = \$this->selectedService->total_cost;\n            \$this->selectedSpareparts = \$this->selectedService->serviceSpareparts->toArray();";
$mountNew = "\$this->rmaNumber       = \$this->selectedService->rma_number;\n            \$this->estimatedCost   = \$this->selectedService->estimated_cost;\n            \$this->selectedServiceItems = \$this->selectedService->service_items ?? [];\n            \$this->availableCategories = ServiceCategory::where('is_active', true)->orderBy('order_column')->get();\n            \$this->totalCost       = \$this->selectedService->total_cost;\n            \$this->selectedSpareparts = \$this->selectedService->serviceSpareparts->toArray();";
$content = str_replace($mountOld, $mountNew, $content);

// Add calculated method and update hooks
$methodsToAdd = <<<'PHP'
    public function updatedSelectedServiceCategoryId($value)
    {
        if ($value) {
            $category = $this->availableCategories->firstWhere('id', $value);
            if ($category && $category->services_data) {
                $this->availableServicesData = is_string($category->services_data) ? json_decode($category->services_data, true) : $category->services_data;
            } else {
                $this->availableServicesData = [];
            }
        } else {
            $this->availableServicesData = [];
        }
    }

    public function updatedSelectedServiceItems()
    {
        $this->calculateServiceCost();
    }

    public function calculateServiceCost()
    {
        $cost = 0;
        foreach ($this->selectedServiceItems as $itemStr) {
            if (preg_match('/^(.*?)\s*\((.*)\)$/', $itemStr, $matches)) {
                $price = (int)preg_replace('/[^0-9]/', '', $matches[2]);
                $cost += $price;
            }
        }
        $this->estimatedCost = $cost;
        $this->calculateTotalCost();
        
        // Save automatically back to service cost
        if ($this->selectedService) {
            $this->selectedService->update([
                'service_items' => $this->selectedServiceItems,
                'service_cost'  => $cost
            ]);
            $this->calculateTotalCost(); // to trigger total_cost update in DB
        }
    }
PHP;

$content = str_replace(
    'public function updatedEstimatedCost()',
    $methodsToAdd . "\n\n    public function updatedEstimatedCost()",
    $content
);

file_put_contents($file, $content);
echo "Modification complete.";
