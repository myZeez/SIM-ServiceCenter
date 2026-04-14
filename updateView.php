<?php
$file = 'resources/views/livewire/service-progress.blade.php';
$content = file_get_contents($file);

$replacementOld = <<<'HTML'
                                </div>
                                <div class="flex items-center justify-between mb-4 text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">Biaya Jasa Servis</span>
                                    <div class="flex w-40 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 bg-white dark:bg-gray-800 focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary-500 overflow-hidden">
                                        <span class="flex select-none items-center pl-2 text-gray-500 text-xs bg-gray-50 dark:bg-gray-700/50 px-2 border-r border-gray-300 dark:border-gray-600">Rp</span>
                                        <input type="text" wire:model.blur="estimatedCost" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-right text-sm font-semibold text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-0" placeholder="0">
                                    </div>
                                </div>
HTML;

$replacementNew = <<<'HTML'
                                </div>
                                
                                {{-- Service Packages Selection --}}
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Paket Layanan / Biaya Jasa
                                    </label>
                                    <select wire:model.live="selectedServiceCategoryId" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all mb-3">
                                        <option value="">-- Pilih Kategori Layanan --</option>
                                        @foreach($availableCategories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>

                                    @if(!empty($availableServicesData))
                                    <div class="grid grid-cols-1 gap-2 mb-3">
                                        @foreach($availableServicesData as $sKey => $svc)
                                        <label class="flex items-start gap-3 p-2 rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 cursor-pointer hover:bg-gray-100 transition">
                                            <input type="checkbox" wire:model.live="selectedServiceItems" value="{{ $svc['label'] ?? '' }} ({{ $svc['price'] ?? '' }})" class="mt-1 w-4 h-4 text-primary-600 bg-white border-gray-300 rounded focus:ring-primary-500">
                                            <div class="flex-1">
                                                <div class="text-sm font-medium text-gray-900">{{ $svc['label'] ?? '' }}</div>
                                                <div class="text-xs text-primary-600 font-semibold">{{ $svc['price'] ?? '' }}</div>
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>
                                    @endif

                                    {{-- Display Selected Items cleanly --}}
                                    @if(!empty($selectedServiceItems))
                                    <div class="mt-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg p-3 border border-blue-100 dark:border-blue-800">
                                        <p class="text-xs font-bold text-blue-800 dark:text-blue-300 mb-1">Layanan Terpilih:</p>
                                        <ul class="list-disc list-inside text-xs text-blue-700 dark:text-blue-400 space-y-1">
                                            @foreach($selectedServiceItems as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between mb-4 text-sm mt-4 pt-4 border-t border-gray-200">
                                    <span class="text-gray-600 dark:text-gray-400 font-semibold">Total Biaya Jasa Servis</span>
                                    <div class="flex w-40 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 bg-gray-100 dark:bg-gray-800 overflow-hidden cursor-not-allowed">
                                        <span class="flex select-none items-center pl-2 text-gray-500 text-xs bg-gray-200 dark:bg-gray-700 px-2 border-r border-gray-300 dark:border-gray-600">Rp</span>
                                        <input type="text" value="{{ number_format((float)($estimatedCost ?? 0), 0, ',', '.') }}" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-right text-sm font-bold text-gray-700 dark:text-gray-300 focus:ring-0" disabled>
                                    </div>
                                </div>
HTML;

$content = str_replace($replacementOld, $replacementNew, $content);
file_put_contents($file, $content);
echo "View update OK";
