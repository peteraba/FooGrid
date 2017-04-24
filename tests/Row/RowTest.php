<?php

declare(strict_types = 1);

namespace Foo\Grid\Row;

use Foo\Grid\Action\IAction;
use Foo\Grid\Collection\Actions;
use Foo\Grid\Collection\Cells;
use Foo\Grid\Component\ComponentTest;
use Opulence\Orm\IEntity;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

require_once __DIR__ . '/../Component/ComponentTest.php';

class RowTest extends ComponentTest
{
    const DEFAULT_TEMPLATE = '<div foo="foo baz" bar="bar baz" class="div">Test2<td class="td-actions">Test</td></div>';
    const TRANSLATED_HTML = '<div foo="foo baz" bar="bar baz" class="div">Translated</div>';

    /** @var Row */
    protected $sut;

    /** @var Cells|MockObject */
    protected $cellsMock;

    /** @var Actions|MockObject */
    protected $actionsMock;

    public function setUp()
    {
        $this->cellsMock = $this->getMockBuilder(Cells::class)
            ->setMethods(['__toString'])
            ->getMock();

        $this->cellsMock
            ->expects($this->any())
            ->method('__toString')
            ->willReturn('Test2');

        $this->actionsMock = $this->getMockBuilder(Actions::class)
            ->setMethods(['__toString', 'current', 'rewind', 'valid'])
            ->getMock();

        $this->actionsMock
            ->expects($this->any())
            ->method('__toString')
            ->willReturn('Test');

        $this->sut = new Row($this->cellsMock, $this->actionsMock, $this->getDefaultAttributes(), static::TAG);
    }

    public function testSetEntitySetsTheEntityOfActionsToo()
    {
        /** @var MockObject|IEntity $entityStub */
        $entityStub = $this->getMockForAbstractClass(IEntity::class);
        $actionMock = $this->getMockForAbstractClass(IAction::class);

        $actionMock
            ->expects($this->atLeastOnce())
            ->method('setEntity')
            ->with($entityStub);

        $this->actionsMock
            ->expects($this->at(1))
            ->method('valid')
            ->willReturn(true);

        $this->actionsMock
            ->expects($this->at(2))
            ->method('current')
            ->willReturn($actionMock);

        $this->sut->setEntity($entityStub);
    }
}
