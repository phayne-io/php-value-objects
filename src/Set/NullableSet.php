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

use Phayne\ValueObject\Nullable;
use Phayne\ValueObject\Set;
use Phayne\ValueObject\ValueObject;
use Traversable;

/**
 * Class NullableSet
 *
 * @package Phayne\ValueObject\Set
 * @author Julien Guittard <julien@phayne.com>
 */
abstract class NullableSet extends Nullable implements Set
{
    /** @var Set */
    protected $value;

    public function __construct(Set $set)
    {
        parent::__construct($set);
    }

    public function getIterator(): Traversable
    {
        return $this->value->getIterator();
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->value->offsetExists($offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->value->offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->value->offsetSet($offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->value->offsetUnset($offset);
    }

    public function add(Set $set): static
    {
        return new static($this->value->add($set));
    }

    public function remove(Set $set): static
    {
        return new static($this->value->remove($set));
    }

    public function contains(ValueObject $valueObject): bool
    {
        return $this->value->contains($valueObject);
    }

    public function toArray(): array
    {
        return $this->value->toArray();
    }

    public function nonNullValues(): static
    {
        return new static($this->value->nonNullValues());
    }

    public function count(): int
    {
        return $this->value->count();
    }
}
