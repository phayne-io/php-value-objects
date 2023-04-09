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

use ArrayAccess;
use Countable;
use IteratorAggregate;

/**
 * Interface Set
 *
 * @package Phayne\ValueObject
 * @author Julien Guittard <julien@phayne.com>
 */
interface Set extends ValueObject, IteratorAggregate, ArrayAccess, Countable
{
    public function add(Set $set): static;

    public function remove(Set $set): static;

    public function contains(ValueObject $valueObject): bool;

    public function toArray(): array;

    public function nonNullValues(): static;
}
