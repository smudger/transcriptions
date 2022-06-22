<?php

namespace Smudger\Transcriptions;

class Lines extends Collection
{
    public function asHtml(): string
    {
        return $this->map(fn (Line $line) => $line->toAnchorTag())->__toString();
    }

    public function __toString(): string
    {
        return implode("\n", $this->items);
    }
}
