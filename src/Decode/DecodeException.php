<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;

final class DecodeException extends \RuntimeException
{
    public function __construct(
        public readonly array $path,
        string $message,
    ) {
        $pathString = implode('.', $path);

        if ($pathString === '') {
            parent::__construct("Expected {$message}");
        } else {
            parent::__construct("{$pathString}: Expected {$message}");
        }
    }
}