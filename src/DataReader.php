<?php

declare(strict_types=1);

namespace App;

final class DataReader
{
    public static function readLine(int $day, int $part): \Generator
    {
        $file = __DIR__ . '/data/' . "$day.$part.txt";
        $fp = fopen($file, 'rb');

        while (($line = fgets($fp)) !== false) {
            yield trim($line, "\r\n");
        }

        fclose($fp);
    }
}
