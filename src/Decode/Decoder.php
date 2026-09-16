<?php declare(strict_types=1);

namespace Dyljyn\Json\Decode;

/**
 * @template T
 */
final class Decoder {

    /**
     * @var Closure(mixed, array): T
     */
    private \Closure $decode;

    public function __construct(callable $decode) {
        $this->decode = $decode(...);
    }

    /**
     * @param mixed $value
     * @param list<string> $path
     * @return T
     */
    public function decode(
        mixed $value,
        array $path = [],
    ): mixed {
        return ($this->decode)($value, $path);
    }
}