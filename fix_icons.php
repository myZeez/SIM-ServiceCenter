<?php
$f = file_get_contents('e:\SKRIP v2\AdministrasiCellcom\app\Livewire\DiagnosisChat.php');
$f = preg_replace("/'hardware' => \[\s*'label' => 'Paket Hardware',\s*'icon' => '[^']+',/u", "'hardware' => [\n            'label' => 'Paket Hardware',\n            'icon' => '\u{1F6E0}',", $f);
$f = preg_replace("/'software' => \[\s*'label' => 'Paket Software',\s*'icon' => '[^']+',/u", "'software' => [\n            'label' => 'Paket Software',\n            'icon' => '\u{1F4BB}',", $f);
$f = preg_replace("/'upgrade' => \[\s*'label' => 'Upgrade Part',\s*'icon' => '[^']+',/u", "'upgrade' => [\n            'label' => 'Upgrade Part',\n            'icon' => '\u{1F680}',", $f);
$f = preg_replace("/'lainnya' => \[\s*'label' => 'Biaya Lainnya',\s*'icon' => '[^']+',/u", "'lainnya' => [\n            'label' => 'Biaya Lainnya',\n            'icon' => '\u{1F9FE}',", $f);
file_put_contents('e:\SKRIP v2\AdministrasiCellcom\app\Livewire\DiagnosisChat.php', $f);
echo "Fixed icons!\n";
