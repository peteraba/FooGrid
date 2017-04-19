<?php

declare(strict_types = 1);

namespace Foo\Grid\Cell;

use Foo\Grid\Component\IComponent;

interface ICell extends IComponent
{
    public function getGroup(): string;

    public function getContent(): string;
}
