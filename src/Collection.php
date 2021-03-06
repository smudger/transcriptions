<?php

namespace Smudger\Transcriptions;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;

class Collection implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
{
    public function __construct(
        protected array $items,
    ) {
    }

    public function map(callable $fn): self
    {
        return new static(array_map($fn, $this->items));
    }

    public function offsetUnset($key): void
    {
        unset($this->items[$key]);
    }

    public function offsetGet($key): mixed
    {
        return $this->items[$key];
    }

    public function offsetExists($key): bool
    {
        return isset($this->items[$key]);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function offsetSet($key, $value): void
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function jsonSerialize(): mixed
    {
        return $this->items;
    }
}
