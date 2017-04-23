<?php

declare(strict_types = 1);

namespace Foo\Grid\Collection;

use Foo\Grid\Pagination\IPage;

require_once __DIR__ . '/BaseCollectionTest.php';

class PagesTest extends BaseCollectionTest
{
    const SUT_CLASS_NAME = Pages::class;

    public function setUp()
    {
        $this->element1 = $this->getMockForAbstractClass(IPage::class);
        $this->element2 = $this->getMockForAbstractClass(IPage::class);

        $this->element1->expects($this->any())->method('__toString')->willReturn('A');
        $this->element2->expects($this->any())->method('__toString')->willReturn('B');
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
