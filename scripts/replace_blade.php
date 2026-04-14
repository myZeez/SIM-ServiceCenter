<?php
$file = 'E:/SKRIP v2/AdministrasiCellcom/resources/views/livewire/diagnosis-chat.blade.php';
$content = file_get_contents($file);

// Replace Device grid:
$content = preg_replace(
    '/\@foreach\(\$deviceTypes as \$key => \$device\)(.*?)\@endforeach/s',
    '@foreach($dbDeviceTypes as $device)
                <button wire:click="selectDevice({{ $device->id }})" class="cat-card">
                    <span class="cat-icon">{{ $device->icon }}</span>
                    <span class="cat-label">{{ $device->name }}</span>
                    <span class="cat-desc">{{ $device->description }}</span>
                </button>
                @endforeach',
    $content,
    1 // Only the first match which is the device selection grid
);

// Replace $deviceLabel uses and related mapping arrays.
// Because we have multiple occurrences of `$deviceTypes[$selectedDeviceType]['label'] ?? 'Perangkat'`
$content = str_replace(
    '$deviceLabel = $deviceTypes[$selectedDeviceType][\'label\'] ?? \'Perangkat\';',
    '$deviceLabel = $dbDeviceTypes->firstWhere(\'id\', $selectedDeviceType)->name ?? \'Perangkat\';',
    $content
);

$content = str_replace(
    'strtolower($deviceTypes[$selectedDeviceType][\'label\'] ?? \'perangkat\')',
    'strtolower($dbDeviceTypes->firstWhere(\'id\', $selectedDeviceType)->name ?? \'perangkat\')',
    $content
);

$content = str_replace(
    '$devLabel = $deviceTypes[$selectedDeviceType][\'label\'] ?? \'Perangkat\';',
    '$devLabel = $dbDeviceTypes->firstWhere(\'id\', $selectedDeviceType)->name ?? \'Perangkat\';',
    $content
);

// Update match statements that used 'pc', 'aio', 'printer' mapping (since selectedDeviceType is now an ID, we'll try to find the slug)
// Wait, $slug is better:
$matchFix = <<<PHP
\$devSlug = \$dbDeviceTypes->firstWhere('id', \$selectedDeviceType)->slug ?? 'laptop';
                                \$brandOptions = match(\$devSlug) {
                                    'pc-desktop' => ['Asus','Acer','Lenovo','HP','Dell','MSI','Gigabyte','ASRock','Lainnya'],
                                    'all-in-one-aio' => ['Asus','Acer','Lenovo','HP','Dell','MSI','Apple (iMac)','Samsung','Lainnya'],
                                    'printer' => ['HP','Canon','Epson','Brother','Samsung','Xerox','Fuji Xerox','Kyocera','Ricoh','Lainnya'],
                                    default => ['Asus','Acer','Lenovo','HP','Dell','MSI','Apple (MacBook)','Toshiba','Samsung','Axioo','Zyrex','Lainnya'],
                                };
                                \$typePlaceholder = match(\$devSlug) {
                                    'pc-desktop' => 'Contoh: ROG G21 / OptiPlex',
                                    'all-in-one-aio' => 'Contoh: Vivo AiO / IdeaCentre AIO',
                                    'printer' => 'Contoh: L3210 / LaserJet Pro',
                                    default => 'Contoh: ROG Strix G15',
                                };
PHP;

$content = preg_replace(
    '/\$brandOptions = match\(\$selectedDeviceType\).*?\$typePlaceholder = match\(\$selectedDeviceType\) \{.*?\};/s',
    $matchFix,
    $content
);


// Replace Categories/Problems Grid
$catGrid = <<<PHP
              <div class="cat-grid">
                  @foreach(\$dbCategories as \$cat)
                  <button wire:click="selectCategory({{ \$cat->id }})" class="cat-card">
                      <span class="cat-icon">{{ \$cat->icon ?? '⚙️' }}</span>
                      <span class="cat-label">{{ \$cat->name }}</span>
                      <span class="cat-desc">{{ \$cat->description ?? 'Pilih untuk melihat detail keluhan' }}</span>
                  </button>
                  @endforeach
              </div>
PHP;
$content = preg_replace('/<div class="cat-grid">\s*\@foreach\(\$categories as \$key => \$cat\).*?\@endforeach\s*<\/div>/s', $catGrid, $content);

// Replace Problems Grid
$probGrid = <<<PHP
              <div class="section-head">
                  <span class="section-emoji">{{ \$selectedCategoryData->icon ?? '⚠️' }}</span>
                  <h2 class="section-title">{{ \$selectedCategoryData->name }}</h2>
                  <p class="section-sub">Apa keluhan utama yang paling terasa?</p>
              </div>

              <div class="problem-list">
                  @foreach(\$dbProblems as \$prob)
                  <button wire:click="selectProblem({{ \$prob->id }})" class="problem-card">
                      <div class="problem-text">
                          <span class="problem-label">{{ \$prob->name }}</span>
                          <span class="problem-desc">{{ \$prob->follow_up_question ?? 'Terdapat gejala ini' }}</span>
                      </div>
                      <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
                  </button>
                  @endforeach
              </div>
PHP;
$content = preg_replace('/<div class="section-head">.*?<\/div>\s*<div class="problem-list">\s*\@foreach.*?<\/div>/s', $probGrid, $content, 1);

// Replace Service menu parent
$serviceMenuGrid = <<<PHP
              <div class="cat-grid" style="max-width:600px;margin:0 auto;">
                  @foreach(\$dbServiceMenu as \$cat)
                  <button wire:click="selectServiceCategory({{ \$cat->id }})" class="cat-card">
                      <span class="cat-icon">{{ \$cat->icon ?? '🛠️' }}</span>
                      <span class="cat-label">{{ \$cat->name }}</span>
                      <span class="cat-desc">{{ \$cat->description ?? 'Lihat harga & booking layanan ini' }}</span>
                  </button>
                  @endforeach
              </div>
PHP;
// We actually have to replace the exact `@foreach($serviceMenu as $key => $cat)` area
$content = preg_replace('/<div class="cat-grid" style="max-width:600px;margin:0 auto;">\s*\@foreach\(\$serviceMenu as \$key => \$cat\).*?\@endforeach\s*<\/div>/s', $serviceMenuGrid, $content);

// Remove the `service_detail` section entirely, as we are skipping it
$content = preg_replace('/\{\{-- ==================== TANYA DULU: DAFTAR LAYANAN \+ HARGA ==================== --\}\}.*?\{\{-- ==================== TANYA DULU: BOOKING FORM ==================== --\}\}/s', "{{-- ==================== TANYA DULU: BOOKING FORM ==================== --}}\n", $content);


file_put_contents($file, $content);
echo "Replaced blade";
