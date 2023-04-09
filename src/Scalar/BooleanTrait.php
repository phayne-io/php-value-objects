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

namespace Phayne\ValueObject\Scalar;

use Phayne\Exception\InvalidArgumentException;
use Phayne\ValueObject\ValueObject;

/**
 * Trait BooleanTrait
 *
 * @package Phayne\ValueObject\Scalar
 * @author Julien Guittard <julien@phayne.com>
 */
trait BooleanTrait
{
    public function __construct(protected readonly bool $bool)
    {
    }

    public function isNull(): bool
    {
        return false;
    }

    public function isSame(ValueObject $valueObject): bool
    {
        return ($this->toNative() === $valueObject->toNative());
    }

    public static function fromNative(mixed $native): static
    {
        if (! is_bool($native)) {
            throw new InvalidArgumentException('Can only instantiate this object with a boolean');
        }

        return new static($native);
    }

    public function toNative(): bool
    {
        return $this->bool;
    }

    public static function true(): static
    {
        return new static(true);
    }

    public static function false(): static
    {
        return new static(false);
    }

    public function isTrue(): bool
    {
        return ($this->toNative());
    }

    public function isFalse(): bool
    {
        return (! $this->toNative());
    }
}
