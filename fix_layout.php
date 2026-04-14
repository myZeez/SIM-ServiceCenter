<?php
$dir = new RecursiveDirectoryIterator(__DIR__ . '/resources/views');
$iter = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($iter, '/^.+\.blade\.php$/i', RecursiveRegexIterator::GET_MATCH);

foreach ($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    $original = $content;

    $content = str_replace('max-w-7xl mx-auto sm:px-6 lg:px-8', 'w-full mx-auto', $content);
    $content = str_replace('max-w-7xl mx-auto px-4 sm:px-6 lg:px-8', 'w-full mx-auto px-4 sm:px-6 lg:px-8', $content);
    $content = str_replace('max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8', 'w-full mx-auto py-4 px-4 sm:px-6 lg:px-8', $content);
    $content = preg_replace('/class="py-12"/', 'class="py-4"', $content);
    $content = preg_replace('/class="py-6"/', 'class="py-4"', $content);

    if ($content !== $original) {
        file_put_contents($path, $content);
        echo "Updated: $path\n";
    }
}
