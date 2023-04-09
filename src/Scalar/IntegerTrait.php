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
 * Trait IntegerTrait
 *
 * @package Phayne\ValueObject\Scalar
 * @author Julien Guittard <julien@phayne.com>
 */
trait IntegerTrait
{
    public function __construct(protected readonly int $int)
    {
    }

    public function isNull(): bool
    {
        return false;
    }

    public function isSame(ValueObject $valueObject): bool
    {
        return ($this->toNative() == $valueObject->toNative());
    }

    public static function fromNative(mixed $native): static
    {
        if (! is_int($native)) {
            throw new InvalidArgumentException('Can only instantiate this object with an integer');
        }

        return new static($native);
    }

    public function toNative(): int
    {
        return $this->int;
    }
}
