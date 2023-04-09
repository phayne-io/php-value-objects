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

use ChrisHarrison\ArrayOf\ImmutableArrayOf;
use Phayne\Exception\UnexpectedValueException;
use Phayne\ValueObject\Set;
use Phayne\ValueObject\ValueObject;

/**
 * Class NonNullSet
 *
 * @package Phayne\ValueObject\Set
 * @author Julien Guittard <julien@phayne.com>
 */
abstract class NonNullSet extends ImmutableArrayOf implements Set
{
    abstract public static function valuesShouldBeUnique(): bool;

    private static function uniqueInput(array $input): array
    {
        $unique = [];

        /** @var ValueObject $object */
        foreach ($input as $object) {
            $match = false;
            /** @var ValueObject $compare */
            foreach ($unique as $compare) {
                if ($object->isSame($compare)) {
                    $match = true;
                }
            }

            if (! $match) {
                $unique[] = $object;
            }
        }

        return $unique;
    }

    public function __construct(array $input = [])
    {
        if (! is_a($this->typeToEnforce(), ValueObject::class, true)) {
            throw new UnexpectedValueException('Set can only contain value objects');
        }

        if (static::valuesShouldBeUnique()) {
            $input = static::uniqueInput($input);
        }

        parent::__construct($input);
    }

    public function add(Set $set): static
    {
        return new static(array_merge($this->toArray(), $set->toArray()));
    }

    public function remove(Set $set): static
    {
        $output = $this;

        foreach ($set->toArray() as $item) {
            $output = $output->removeByValue($item);
        }

        return $output;
    }

    public function contains(ValueObject $valueObject): bool
    {
        /** @var ValueObject $item */
        foreach ($this->toArray() as $item) {
            if ($item->isSame($valueObject)) {
                return true;
            }
        }

        return false;
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    public function nonNullValues(): static
    {
        return new static(array_values(array_filter($this->toArray(), fn(ValueObject $value) => ! $value->isNull())));
    }

    public function isNull(): bool
    {
        return false;
    }

    public function isSame(ValueObject $valueObject): bool
    {
        $compare1 = $this->toNative();
        $compare2 = $valueObject->toNative();

        if (! is_array($compare2)) {
            return false;
        }

        sort($compare1);
        sort($compare2);

        return ($compare1 === $compare2);
    }

    public static function fromNative(mixed $native): static
    {
        return new static(array_map(
            fn(mixed $item) => call_user_func((new static())->typeToEnforce() . '::fromNative', $item),
            $native
        ));
    }

    public function toNative(): array
    {
        return array_map(fn(ValueObject $valueObject) => $valueObject->toNative(), $this->toArray());
    }

    private function removeByValue(ValueObject $valueObject): static
    {
        return new static(array_values(array_filter(
            $this->toArray(),
            function (ValueObject $compare) use ($valueObject) {
                return (! $compare->isSame($valueObject));
            }
        )));
    }
}
