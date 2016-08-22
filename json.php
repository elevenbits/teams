<?php
/**
 * Author: Murat Erkenov
 * Date/Time: 8/22/16/1:22 PM
 *
 */
$teamsFolderPath = __DIR__ . '/teams/php';

$teams = [];

$dir = dir($teamsFolderPath);
while ($fileName = $dir->read()) {
    if (in_array($fileName, ['.', '..'])) {
        continue;
    }
    $filePath = $teamsFolderPath . '/' . $fileName;

    list($filePrefix) = explode('.', $fileName);

    foreach (include $filePath as $teamId => $teamItem) {
        if (!isset($teams[$filePrefix])) {
            $teams[$filePrefix] = [];
        }
        $teams[$filePrefix][$teamId] = $teamItem;
    }
}
ksort($teams);
$json = json_encode($teams, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

file_put_contents(__DIR__ . '/teams/teams.json', $json);