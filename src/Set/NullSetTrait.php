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

namespace Phayne\ValueObject\Set;

use Iterator;
use Phayne\ValueObject\NullTrait;
use Phayne\ValueObject\Set;
use Phayne\ValueObject\ValueObject;

/**
 * Trait NullSetTrait
 *
 * @package Phayne\ValueObject\Set
 * @author Julien Guittard <julien@phayne.com>
 */
trait NullSetTrait
{
    use NullTrait;

    public function add(Set $set): static
    {
        return $this;
    }

    public function remove(Set $set): static
    {
        return $this;
    }

    public function contains(ValueObject $valueObject): bool
    {
        return false;
    }

    public function toArray(): array
    {
        return [];
    }

    public function nonNullValues(): static
    {
        return $this;
    }

    public function getIterator(): Iterator
    {
        return new NullSetIterator();
    }

    public function offsetExists($offset): bool
    {
        return false;
    }

    public function offsetGet($offset): mixed
    {
        return null;
    }

    public function offsetSet($offset, mixed $value): void
    {
    }

    public function offsetUnset($offset): void
    {
    }

    public function count(): int
    {
        return 0;
    }
}
