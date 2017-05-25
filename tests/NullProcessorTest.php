<?php
/*
 * Copyright 2008 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Processor\Tests;

use Naucon\Processor\NullProcessor;
use Naucon\Processor\ProcessorInterface;
use Naucon\Processor\Tests\Model\Foo;
use Naucon\Processor\Tests\Model\Bar;

class NullProcessorTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $processor = new NullProcessor(Foo::class);

        $this->assertInstanceOf(ProcessorInterface::class, $processor);
    }

    public function testProcess()
    {
        $processor = new NullProcessor(Foo::class);

        $model = new Foo();
        $expectedModel = clone $model;
        $processor->process($model);

        $this->assertEquals($expectedModel, $model);
    }

    public function testProcessWithReturnValue()
    {
        $model = new Foo();

        $processor = new NullProcessor(Foo::class);
        $this->assertNull($processor->process($model));

        $processor = new NullProcessor(Foo::class, true);
        $this->assertTrue($processor->process($model));

        $processor = new NullProcessor(Foo::class, false);
        $this->assertFalse($processor->process($model));
    }

    public function testProcessWithUnsupportedModel()
    {
        $model = new Bar();

        $processor = new NullProcessor(Foo::class);
        $this->assertNull($processor->process($model));

        $processor = new NullProcessor(Foo::class, true);
        $this->assertTrue($processor->process($model));

        $processor = new NullProcessor(Foo::class, false);
        $this->assertFalse($processor->process($model));
    }
}
