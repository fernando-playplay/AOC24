<?php

declare(strict_types=1);

namespace App\Utils;

final class DataReader
{
    public static function readChar(int $day, bool $isExample): \Generator
    {
        $fp = fopen(self::filePath($day, $isExample), 'rb');

        while (($char = fgetc($fp)) !== false) {
            yield $char;
        }

        fclose($fp);
    }

    public static function readLine(int $day, bool $isExample): \Generator
    {
        $fp = fopen(self::filePath($day, $isExample), 'rb');

        while (($line = fgets($fp)) !== false) {
            yield trim($line, "\r\n");
        }

        fclose($fp);
    }

    public static function readWholeFile(int $day, bool $isExample): string
    {
        return trim(file_get_contents(self::filePath($day, $isExample)));
    }

    private static function filePath(int $day, bool $isExample): string
    {
        if ($isExample) {
            return __DIR__ . '/../data/' . "day$day/$day.example.txt";
        }

        return __DIR__ . '/../data/' . "day$day/$day.txt";
    }
}
