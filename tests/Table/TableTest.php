<?php

declare(strict_types = 1);

namespace Foo\Grid\Table;

use Foo\Grid\Cell\ICell;
use Foo\Grid\Collection\Cells;
use Foo\Grid\Collection\Rows;
use Foo\Grid\Row\IRow;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use PHPUnit\Framework\TestCase;

class TableTest extends TestCase
{
    /** @var Table */
    protected $sut;

    /** @var Rows|MockObject */
    protected $rows;

    /** @var Cells|MockObject */
    protected $header;

    public function setUp()
    {
        $methods = ['__toString', 'valid', 'rewind', 'current', 'setIndentation'];

        $this->rows = $this->getMockBuilder(Rows::class)
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();

        $this->header = $this->getMockBuilder(Cells::class)
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();

        $this->sut = new Table($this->rows, $this->header);
    }

    public function testToStringContainsHeaders()
    {
        $this->rows->expects($this->any())->method('__toString')->willReturn('A');
        $this->header->expects($this->any())->method('__toString')->willReturn('B');

        $this->assertContains((string)$this->header, (string)$this->sut);
    }

    public function testToStringContainsRows()
    {
        $this->rows->expects($this->any())->method('__toString')->willReturn('A');
        $this->header->expects($this->any())->method('__toString')->willReturn('B');

        $this->assertContains((string)$this->rows, (string)$this->sut);
    }

    public function testIndentationSetsIndentationOfHeadersAndRows()
    {
        $head1 = $this->getMockForAbstractClass(ICell::class);
        $head2 = $this->getMockForAbstractClass(ICell::class);

        $head1->expects($this->atLeastOnce())->method('setIndentation');
        $head2->expects($this->atLeastOnce())->method('setIndentation');

        $row1 = $this->getMockForAbstractClass(IRow::class);
        $row2 = $this->getMockForAbstractClass(IRow::class);

        $row1->expects($this->atLeastOnce())->method('setIndentation');
        $row2->expects($this->atLeastOnce())->method('setIndentation');

        $this->rows
            ->expects($this->any())
            ->method('valid')
            ->willReturnOnConsecutiveCalls(true, true, false);
        $this->rows
            ->expects($this->any())
            ->method('current')
            ->willReturnOnConsecutiveCalls($head1, $head2);

        $this->header
            ->expects($this->any())
            ->method('valid')
            ->willReturnOnConsecutiveCalls(true, true, false);
        $this->header
            ->expects($this->any())
            ->method('current')
            ->willReturnOnConsecutiveCalls($row1, $row2);

        $this->sut->setIndentation(4, "\t");
    }
}

