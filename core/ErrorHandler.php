<?php

class ErrorHandler
{
    public static function register(): void
    {
        error_reporting(E_ALL);

        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
        register_shutdown_function([self::class, 'handleShutdown']);
    }

    /* =====================
     |  EXCEPTIONS
     ===================== */
    public static function handleException(Throwable $e, int $httpCode = 500): void
    {
        if ($e instanceof AppException) {
            $httpCode = $e->getStatusCode();
        }

        Logger::error("{$e->getMessage()} in {$e->getFile()}:{$e->getLine()}");

        http_response_code($httpCode);

        self::render($e);
        exit;
    }

    /* =====================
     |  PHP ERRORS
     ===================== */
    public static function handleError(
        int $severity,
        string $message,
        string $file,
        int $line
    ): bool {
        throw new ErrorException($message, 0, $severity, $file, $line);
    }

    /* =====================
     |  FATAL ERRORS
     ===================== */
    public static function handleShutdown(): void
    {
        $error = error_get_last();
        if (!$error || !self::isFatal($error['type'])) {
            return;
        }

        $e = new ErrorException(
            $error['message'],
            0,
            $error['type'],
            $error['file'],
            $error['line']
        );

        Logger::error("FATAL: {$e->getMessage()} in {$e->getFile()}:{$e->getLine()}");

        http_response_code(500);
        self::render($e);
    }

    /* =====================
     |  RENDER
     ===================== */
    private static function render(Throwable $e): void
    {
        if (php_sapi_name() === 'cli') {
            echo "[ERROR] {$e->getMessage()} in {$e->getFile()}:{$e->getLine()}\n";
            return;
        }

        if (self::wantsJson()) {
            header('Content-Type: application/json');
            echo json_encode(
                self::isDebug()
                    ? [
                        'error' => get_class($e),
                        'message' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine()
                      ]
                    : ['error' => 'Server Error', 'message' => 'Something went wrong.']
            );
        } else {
            if (self::isDebug()) {
                echo "<pre>";
                echo get_class($e) . "\n";
                echo $e->getMessage() . "\n";
                echo $e->getFile() . ":" . $e->getLine();
                echo "</pre>";
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }
    }

    /* =====================
     |  HELPERS
     ===================== */
    private static function wantsJson(): bool
    {
        return isset($_SERVER['HTTP_ACCEPT']) &&
               str_contains($_SERVER['HTTP_ACCEPT'], 'application/json');
    }

    private static function isFatal(int $type): bool
    {
        return in_array($type, [
            E_ERROR,
            E_PARSE,
            E_CORE_ERROR,
            E_COMPILE_ERROR,
            E_USER_ERROR
        ], true);
    }

    private static function isDebug(): bool
    {
        return isset($_ENV['APP_DEBUG']) &&
               strtolower($_ENV['APP_DEBUG']) === 'true';
    }
}
