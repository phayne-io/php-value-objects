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
 * Trait NullTrait
 *
 * @package Phayne\ValueObject
 * @author Julien Guittard <julien@phayne.com>
 */
trait NullTrait
{
    public function isNull(): bool
    {
        return true;
    }

    public function isSame(ValueObject $valueObject): bool
    {
        return (null === $valueObject->toNative());
    }

    public static function fromNative(mixed $native): static
    {
        return new static();
    }

    public function toNative(): mixed
    {
        return null;
    }
}
