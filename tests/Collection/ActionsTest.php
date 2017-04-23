<?php

declare(strict_types = 1);

namespace Foo\Grid\Collection;

use Foo\Grid\Action\IAction;

require_once __DIR__ . '/BaseCollectionTest.php';

class ActionsTest extends BaseCollectionTest
{
    const SUT_CLASS_NAME = Actions::class;

    public function setUp()
    {
        $this->element1 = $this->getMockForAbstractClass(IAction::class);
        $this->element2 = $this->getMockForAbstractClass(IAction::class);

        $this->element1->expects($this->any())->method('__toString')->willReturn('A');
        $this->element2->expects($this->any())->method('__toString')->willReturn('B');
    }

    public function testDuplicateDuplicatesButDoesNotClone()
    {
        $sut = new Actions('A', ['foo' => 'baz']);

        $actualResult = $sut->duplicate();

        $this->assertEquals($sut, $actualResult);
        $this->assertNotSame($sut, $actualResult);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testOffsetSetThrowsExceptionIfWrongTypeIsAddedToCollection()
    {
        $sut = $this->createSut('C', ['foo' => 'baz']);

        $sut[] = 'C';
    }
}

