<?php

declare(strict_types = 1);

namespace Foo\Grid\Action;

use Foo\Grid\Component\ComponentTest;

require_once __DIR__ . '/../Component/ComponentTest.php';

class ButtonTest extends ComponentTest
{
    const DEFAULT_TEMPLATE = '<button foo="foo2" bar="bar baz">Test</button>';

    const TAG = 'button';

    /** @var Button */
    protected $sut;

    public function setUp()
    {
        $fooer = function() {
            return 'foo2';
        };
        $attributeCallbacks = [
            static::ATTRIBUTE_FOO => $fooer
        ];

        $this->sut = new Button(
            static::LABEL,
            static::TAG,
            $this->getDefaultAttributes(),
            $attributeCallbacks
        );
    }

    public function tearDown()
    {
        unset($this->sut);

        parent::tearDown();
    }

    public function testToStringWillCallCallbacksOnAttributesIfDefined()
    {
        $actualResult = $this->sut->__toString();

        $this->assertContains('foo2', $actualResult);
    }

    public function testDuplicateDuplicatesButDoesNotClone()
    {
        $actualResult = $this->sut->duplicate();

        $this->assertEquals($this->sut, $actualResult);
        $this->assertNotSame($this->sut, $actualResult);
    }
}

