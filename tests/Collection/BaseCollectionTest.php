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
    public function createSut(string $tag = null, $attributes = [])
    {
        $className = static::SUT_CLASS_NAME;

        return new $className($tag, $attributes);
    }

    public function testToStringContainsList()
    {
        $sut = $this->createSut();

        $sut[] = $this->element1;
        $sut[] = $this->element2;

        $actualResult = (string)$sut;

        $this->assertContains((string)$this->element1, $actualResult);
        $this->assertContains((string)$this->element2, $actualResult);
    }

    public function testToStringCanWrapList()
    {
        $sut = $this->createSut('C', ['foo' => 'baz']);

        $sut[] = $this->element1;
        $sut[] = $this->element2;

        $actualResult = (string)$sut;

        $this->assertContains("<C foo=\"baz\">", $actualResult);
    }
}

