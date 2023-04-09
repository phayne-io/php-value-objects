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
 * Trait CompositeTrait
 *
 * @package Phayne\ValueObject
 * @author Julien Guittard <julien@phayne.com>
 */
trait CompositeTrait
{
    public function isNull(): bool
    {
        $subValues = $this->propertiesToArray();

        foreach ($subValues as $value) {
            if (! $value->isNull()) {
                return false;
            }
        }

        return true;
    }

    public function isSame(ValueObject $valueObject): bool
    {
        return ($this->toNative() == $valueObject->toNative());
    }

    public function toNative(): array
    {
        return array_map(fn(ValueObject $valueObject) => $valueObject->toNative(), $this->propertiesToArray());
    }

    private function propertiesToArray(): array
    {
        return get_object_vars($this);
    }
}
