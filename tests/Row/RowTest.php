<?php

declare(strict_types = 1);

namespace Foo\Grid\Row;

use Foo\Grid\Collection\Actions;
use Foo\Grid\Collection\Cells;
use Foo\Grid\Component\ComponentTest;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

require_once __DIR__ . '/../Component/ComponentTest.php';

class RowTest extends ComponentTest
{
    const DEFAULT_TEMPLATE = '<div foo="foo baz" bar="bar baz" class="div"><td class="td-actions">Test</td></div>';

    /** @var Cells */
    protected $sut;

    /** @var Cells|MockObject */
    protected $cellsMock;

    /** @var Actions|MockObject */
    protected $actionsMock;

    public function setUp()
    {
        $this->cellsMock = $this->getMockBuilder(Cells::class)
            ->setMethods([])
            ->getMock();

        $this->actionsMock = $this->getMockBuilder(Actions::class)
            ->setMethods(['__toString'])
            ->getMock();

        $this->actionsMock
            ->expects($this->any())
            ->method('__toString')
            ->willReturn('Test');

        $this->sut = new Row($this->cellsMock, $this->actionsMock, $this->getDefaultAttributes(), static::TAG);
    }
}

