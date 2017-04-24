<?php

declare(strict_types = 1);

namespace Foo\Grid;

use Foo\Grid\Collection\Actions;
use Foo\Grid\Collection\Filters;
use Foo\Grid\Table\Table;
use Foo\Translate\ITranslator;

class GridTest extends \PHPUnit\Framework\TestCase
{
    public function testToStringContainsTable()
    {
        $table = $this->getMockBuilder(Table::class)
            ->disableOriginalConstructor()
            ->setMethods(['__toString'])
            ->getMock();

        $table->method('__toString')->willReturn('ABC');

        $sut = new Grid($table);

        $this->assertContains('ABC', (string)$sut);
    }

    public function testToStringContainsFilters()
    {
        $table = $this->getMockBuilder(Table::class)
            ->disableOriginalConstructor()
            ->setMethods(['__toString'])
            ->getMock();

        $table->method('__toString')->willReturn('ABC');

        $sut = new Grid($table);

        $this->assertContains('ABC', (string)$sut);
    }

    public function testToStringContainsActions()
    {
        $table = $this->getMockBuilder(Table::class)
            ->disableOriginalConstructor()
            ->setMethods(['__toString'])
            ->getMock();

        $table->method('__toString')->willReturn('ABC');

        $sut = new Grid($table);

        $this->assertContains('ABC', (string)$sut);
    }

    public function testToStringCanWrapContentInForm()
    {
        $table = $this->getMockBuilder(Table::class)
            ->disableOriginalConstructor()
            ->setMethods(['__toString'])
            ->getMock();

        $filters = $this->getMockBuilder(Filters::class)
            ->disableOriginalConstructor()
            ->setMethods(['__toString'])
            ->getMock();

        $table->method('__toString')->willReturn('A');
        $filters->method('__toString')->willReturn('B');

        $sut = new Grid($table, $filters);

        $this->assertContains(Grid::TAG_FORM, (string)$sut);
    }

    public function testSetTranslatorSetsTheTranslatorOfTheFiltersToo()
    {
        $table = $this->getMockBuilder(Table::class)
            ->disableOriginalConstructor()
            ->getMock();

        $filters = $this->getMockBuilder(Filters::class)
            ->disableOriginalConstructor()
            ->setMethods(['setTranslator'])
            ->getMock();

        $actions = $this->getMockBuilder(Actions::class)
            ->disableOriginalConstructor()
            ->getMock();

        $translator = $this->getMockBuilder(ITranslator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $filters->expects($this->once())->method('setTranslator')->with($translator);

        $sut = new Grid($table, $filters, $actions);

        $sut->setTranslator($translator);
    }

    public function testSetTranslatorWorksWithoutFilters()
    {
        $table = $this->getMockBuilder(Table::class)
            ->disableOriginalConstructor()
            ->getMock();

        $translator = $this->getMockBuilder(ITranslator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $sut = new Grid($table);

        $sut->setTranslator($translator);

        $this->assertTrue(true, 'Setting the translator did not throw an error or exception');
    }

    public function testSetIntentationSetsIndentationOfTheFiltersToo()
    {
        $table = $this->getMockBuilder(Table::class)
            ->disableOriginalConstructor()
            ->getMock();

        $filters = $this->getMockBuilder(Filters::class)
            ->disableOriginalConstructor()
            ->setMethods(['setIndentation'])
            ->getMock();

        $actions = $this->getMockBuilder(Actions::class)
            ->disableOriginalConstructor()
            ->getMock();

        $filters->expects($this->once())->method('setIndentation')->with(6, "\t");

        $sut = new Grid($table, $filters, $actions);

        $sut->setIndentation(4, "\t");
    }

    public function testSetIntentationSetsIndentationOfTheTableToo()
    {
        $table = $this->getMockBuilder(Table::class)
            ->disableOriginalConstructor()
            ->setMethods(['setIndentation'])
            ->getMock();

        $filters = $this->getMockBuilder(Filters::class)
            ->disableOriginalConstructor()
            ->getMock();

        $actions = $this->getMockBuilder(Actions::class)
            ->disableOriginalConstructor()
            ->getMock();

        $table->expects($this->once())->method('setIndentation')->with(6, "\t");

        $sut = new Grid($table, $filters, $actions);

        $sut->setIndentation(4, "\t");
    }
}

