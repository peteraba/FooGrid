<?php

declare(strict_types = 1);

namespace Foo\Grid\Component;

use Foo\Translate\ITranslator;
use Foo\Grid\IStringer;

interface IComponent extends IStringer
{
    /**
     * @param int    $num
     * @param string $whitespace
     */
    public function setIndentation(int $num, string $whitespace = ' ');

    /**
     * @param ITranslator $translator
     */
    public function setTranslator(ITranslator $translator);
}
