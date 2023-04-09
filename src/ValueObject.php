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
 * Interface ValueObject
 *
 * @package Phayne\ValueObject
 * @author Julien Guittard <julien@phayne.com>
 */
interface ValueObject
{
    public function isNull(): bool;

    public function isSame(ValueObject $valueObject): bool;

    public static function fromNative(mixed $native): static;

    public function toNative(): mixed;
}
