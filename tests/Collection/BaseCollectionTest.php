<?php

declare(strict_types = 1);

namespace Foo\Grid\Collection;

class BaseCollectionTest extends \PHPUnit\Framework\TestCase
{
    const SUT_CLASS_NAME = BaseCollection::class;

    protected $element1 = 'A';

    protected $element2 = 'B';

    /**
     * @param string|null $tag
     * @param array       $attributes
     *
     * @return BaseCollection
     */
    protected function createSut(string $tag = null, $attributes = [])
    {
        $className = static::SUT_CLASS_NAME;

        return new $className($tag, $attributes);
    }

    /**
     * @return array|BaseCollection
     */
    protected function createDefaultSut()
    {
        $sut = $this->createSut('C', ['foo' => 'baz']);

        $sut[] = $this->element1;
        $sut[] = $this->element2;

        return $sut;
    }

    public function testToStringContainsListElements()
    {
        $sut = $this->createDefaultSut();

        $actualResult = (string)$sut;

        $this->assertContains((string)$this->element1, $actualResult);
        $this->assertContains((string)$this->element2, $actualResult);
    }

    public function testToStringCanWrapList()
    {
        $sut = $this->createDefaultSut();

        $actualResult = (string)$sut;

        $this->assertContains("<C foo=\"baz\">", $actualResult);
    }

    public function testCountElements()
    {
        $sut = $this->createDefaultSut();

        $this->assertSame(2, $sut->count());
    }

    public function testCurrentRemainsUnchanged()
    {
        $sut = $this->createDefaultSut();

        $this->assertSame($this->element1, $sut->current());
        $this->assertSame($this->element1, $sut->current());
    }

    public function testNextChangesTheElementCurrentReturns()
    {
        $sut = $this->createDefaultSut();

        $this->assertSame($this->element1, $sut->current());
        $sut->next();
        $this->assertSame($this->element2, $sut->current());
    }

    public function testOffsetSetCanReplaceElements()
    {
        $sut = $this->createDefaultSut();

        $sut[0] = $this->element2;
        $sut[1] = $this->element1;

        $this->assertSame($this->element2, $sut->current());
        $sut->next();
        $this->assertSame($this->element1, $sut->current());
    }

    public function testCurrentReturnsNullWhenInternalCounterIsLargerThanTheNumberOfElements()
    {
        $sut = $this->createDefaultSut();

        $this->assertSame($this->element1, $sut->current());
        $sut->next();
        $this->assertSame($this->element2, $sut->current());
        $sut->next();
        $this->assertSame(null, $sut->current());
    }

    public function testOffsetGetReturnsTheProperElement()
    {
        $sut = $this->createDefaultSut();

        $this->assertSame($this->element1, $sut[0]);
        $this->assertSame($this->element2, $sut[1]);
    }

    public function testRewindsSetsTheInternalCounterBackToDefault()
    {
        $sut = $this->createDefaultSut();

        $this->assertSame($this->element1, $sut->current());
        $sut->next();
        $this->assertSame($this->element2, $sut->current());
        $sut->rewind();
        $this->assertSame($this->element1, $sut->current());
    }
}

