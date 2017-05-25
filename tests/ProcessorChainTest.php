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
use Naucon\Processor\ProcessorChain;
use Naucon\Processor\Tests\Model\Foo;
use Naucon\Processor\Tests\Model\Bar;
use Naucon\Processor\Tests\Processor\AddValue;
use Naucon\Processor\Tests\Processor\SubstractValue;

class ProcessorChainTest extends \PHPUnit_Framework_TestCase
{
    public function testProcess()
    {
        $processor = new ProcessorChain();
        $processor->addProcessor(new NullProcessor(Foo::class));
        $processor->addProcessor(new NullProcessor(Foo::class));
        $processor->addProcessor(new NullProcessor(Foo::class));

        $model = new Foo();

        $processor->process($model);
    }

    public function testProcessWithPriority()
    {
        $processor = new ProcessorChain();
        $processor->addProcessor(new NullProcessor(Foo::class), 0);
        $processor->addProcessor(new NullProcessor(Foo::class), 5);
        $processor->addProcessor(new NullProcessor(Foo::class), 10);

        $model = new Foo();

        $processor->process($model);
    }

    public function testProcessWithStop()
    {
        $processor = new ProcessorChain();
        $processor->addProcessor(new NullProcessor(Foo::class));
        $processor->addProcessor(new NullProcessor(Foo::class, false));
        $processor->addProcessor(new NullProcessor(Foo::class));

        $model = new Foo();

        $this->assertFalse($processor->process($model));
    }

    public function testProcessWithUnsupportedModel()
    {
        $processor = new ProcessorChain();
        $processor->addProcessor(new NullProcessor(Foo::class));
        $processor->addProcessor(new NullProcessor(Bar::class, false));
        $processor->addProcessor(new NullProcessor(Foo::class));

        $model = new Foo();

        $this->assertTrue($processor->process($model));
    }

    public function testProcessExample()
    {
        $fooModel = new Foo(0);
        $barModel = new Bar(5);

        $processor = new ProcessorChain();
        $processor->addProcessor(new AddValue(Foo::class, 15));
        $processor->addProcessor(new AddValue(Bar::class, 5));
        $processor->addProcessor(new SubstractValue(Foo::class, 5));

        $this->assertTrue($processor->process($fooModel));
        $this->assertEquals(10, $fooModel->getValue()); // 0 + 15 - 5 = 10

        $this->assertTrue($processor->process($barModel));
        $this->assertEquals(10, $barModel->getValue()); // 5 + 5 = 10
    }
}
