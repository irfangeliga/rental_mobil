<?php 
echo "ok";

$buyut = ['kakek','nenek'];
$ortu   = ['ibu','bapak'];
$anak   = ['anak 1','anak 2','anak 3'];

$gen1   = ['buyut' => $buyut,];
$gen2   = ['ortu' => $ortu];
$gen3   = ['anak' => $anak];

$keluarga1   =[
    'gen1' => $anak
];

$keluarga2 = [
    'gen2'  => $keluarga1
];

$keluarga2 = [
    'gen2'  => $keluarga1
];


dd($keluarga2);