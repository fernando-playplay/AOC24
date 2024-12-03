<?php

declare(strict_types=1);

namespace App\Utils;

final class DataReader
{
    public static function readLine(int $day, bool $isExample): \Generator
    {
        if ($isExample) {
            $file = __DIR__ . '/../data/' . "$day.example.txt";
        } else {
            $file = __DIR__ . '/../data/' . "$day.txt";
        }
        $fp = fopen($file, 'rb');

        while (($line = fgets($fp)) !== false) {
            yield trim($line, "\r\n");
        }

        fclose($fp);
    }

    public static function readWholeFile(int $day, bool $isExample): string
    {
        if ($isExample) {
            $file = __DIR__ . '/../data/' . "$day.example.txt";
        } else {
            $file = __DIR__ . '/../data/' . "$day.txt";
        }

        return trim(file_get_contents($file));
    }
}
