<?php

/**
 * This file is part of phayne-io/php-value-objects package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see       https://github.com/phayne-io/php-value-objects for the canonical source repository
 * @copyright Copyright (c) 2023 Phayne. (https://phayne.io)
 */

declare(strict_types=1);

namespace Phayne\ValueObject;

/**
 * Class Nullable
 *
 * @package Phayne\ValueObject
 * @author Julien Guittard <julien@phayne.com>
 */
abstract class Nullable implements ValueObject
{
    public static function fromNative(mixed $native): static
    {
        $nonNullImplementation = static::nonNullImplementation();
        $nullImplementation = static::nullImplementation();

        if (null === $native) {
            $nullObject = call_user_func($nullImplementation . '::fromNative', $native);
            return new static($nullObject);
        } else {
            $nonNullObject = call_user_func($nonNullImplementation . '::fromNative', $native);
            return new static($nonNullObject);
        }
    }

    public static function null(): static
    {
        return static::fromNative(null);
    }

    public function __construct(protected $value)
    {
    }

    public function isNull(): bool
    {
        return $this->value->isNull();
    }

    public function isSame(ValueObject $valueObject): bool
    {
        return $this->value->isSame($valueObject);
    }

    public function toNative(): mixed
    {
        return $this->value->toNative();
    }

    abstract protected static function nonNullImplementation(): string;

    abstract protected static function nullImplementation(): string;
}
