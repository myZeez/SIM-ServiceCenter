<?php
$file = 'E:/SKRIP v2/AdministrasiCellcom/resources/views/layouts/app.blade.php';
$content = file_get_contents($file);

// Desktop Replace
$oldDesktopSistem = <<<HTML
                    {{-- Section: Sistem --}}
                    <div x-show="!sidebarCollapsed" class="px-3 pt-5 pb-1.5">
                        <span class="text-[10px] font-bold text-gray-400 dark:text-gray-600 uppercase tracking-widest">Sistem</span>
                    </div>
HTML;

$newDesktopSistem = <<<HTML
                    {{-- Section: Knowledge Base --}}
                    <div x-show="!sidebarCollapsed" class="px-3 pt-5 pb-1.5">
                        <span class="text-[10px] font-bold text-gray-400 dark:text-gray-600 uppercase tracking-widest">Knowledge Base</span>
                    </div>
                    <div x-show="sidebarCollapsed" class="my-3 mx-1 border-t border-gray-100 dark:border-gray-800"></div>

                    <a href="{{ route('expert-system.devices') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group relative
                            {{ request()->routeIs('expert-system.devices') || request()->routeIs('expert-system.components') || request()->routeIs('expert-system.diseases') || request()->routeIs('expert-system.rules')
                                ? 'bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400'
                                : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('expert-system.devices') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="whitespace-nowrap">Atur Unit & Gejala</span>
                        <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2 py-1 bg-gray-900 text-white text-xs rounded-lg opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-150 whitespace-nowrap z-50 shadow-lg">Atur Unit & Gejala</span>
                    </a>

                    <a href="{{ route('expert-system.services') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group relative
                            {{ request()->routeIs('expert-system.services')
                                ? 'bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400'
                                : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('expert-system.services') ? 'text-primary-600 dark:text-primary-400' : 'text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="whitespace-nowrap">Atur Tanya Dulu</span>
                        <span x-show="sidebarCollapsed" class="absolute left-full ml-3 px-2 py-1 bg-gray-900 text-white text-xs rounded-lg opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-150 whitespace-nowrap z-50 shadow-lg">Atur Tanya Dulu</span>
                    </a>

                    {{-- Section: Sistem --}}
                    <div x-show="!sidebarCollapsed" class="px-3 pt-5 pb-1.5">
                        <span class="text-[10px] font-bold text-gray-400 dark:text-gray-600 uppercase tracking-widest">Sistem</span>
                    </div>
HTML;
$content = str_replace($oldDesktopSistem, $newDesktopSistem, $content);

// Mobile Replace
$oldMobileSistem = <<<HTML
                    <div class="px-3 pt-4 pb-1"><span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sistem</span></div>
HTML;

$newMobileSistem = <<<HTML
                    <div class="px-3 pt-4 pb-1"><span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Knowledge Base</span></div>
                    <a href="{{ route('expert-system.devices') }}" @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('expert-system.*') && !request()->routeIs('expert-system.services') ? 'bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        Atur Unit & Gejala
                    </a>
                    <a href="{{ route('expert-system.services') }}" @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('expert-system.services') ? 'bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Atur Tanya Dulu
                    </a>

                    <div class="px-3 pt-4 pb-1"><span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sistem</span></div>
HTML;
$content = str_replace($oldMobileSistem, $newMobileSistem, $content);

file_put_contents($file, $content);
echo "Replaced Menu Sidebar\n";
