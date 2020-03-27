<?php
$dataName = 'liczby.txt';
$resultName = 'wynik.txt';
$sortName = 'sort.txt';

$dataHandle = fopen($dataName, 'r');
$content = fread($dataHandle, filesize($dataName));
$rawData = explode("\n", $content);
$data = array_map(function ($v) {
	$vv = str_replace(',', '.', $v);
    return floatval($vv);
}, $rawData);

echo '<br>Najmniejsza liczba: '.min($data);
echo '<br>Największa liczba: '.max($data);
echo '<br>Średnia: '.(array_sum($data) / count($data));

$filteredData = array_filter($data, function ($v) {
    $twoDigits = strlen(strval($v)) === 2;
    $dividable = $v % 3 == 0;
    return $twoDigits && $dividable;
});
$filteredString = implode(PHP_EOL, $filteredData);
$resultHandle = fopen($resultName, 'w');
fwrite($resultHandle, $filteredString);

sort($data);
$sortString = implode(PHP_EOL, $data);
$sortHandle = fopen($sortName, 'w');
fwrite($sortHandle, $sortString);

fclose($dataHandle);
fclose($resultHandle);
fclose($sortHandle);
