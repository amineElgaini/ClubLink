<?php

class Logger
{
    private static string $logFile = __DIR__ . '/../storage/logs/app.log';

    public static function error(string $message): void
    {
        $dir = dirname(self::$logFile);

        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        // file_put_contents(
        //     self::$logFile,
        //     '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL,
        //     FILE_APPEND
        // );
        // file_put_contents(self::$logFile, $log, FILE_APPEND);
    }
}
