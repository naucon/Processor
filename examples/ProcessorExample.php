<?php

require realpath(__DIR__ . '/../') . '/vendor/autoload.php';

use Naucon\Processor\ProcessorChain;
use Naucon\Processor\Tests\Model\Foo;
use Naucon\Processor\Tests\Model\Bar;
use Naucon\Processor\Tests\Processor\AddValue;
use Naucon\Processor\Tests\Processor\SubstractValue;

$fooModel = new Foo(0);
$barModel = new Bar(5);

// processor definition
$processorChain = new ProcessorChain();
$processorChain->addProcessor(new AddValue(Foo::class, 15));
$processorChain->addProcessor(new AddValue(Bar::class, 5));
$processorChain->addProcessor(new SubstractValue(Foo::class, 5));

if ($processorChain->process($fooModel)) {
    echo 'FOO: ';
    echo $fooModel->getValue(); // 0 + 15 - 5 = 10
    echo PHP_EOL;
}

if ($processorChain->process($barModel)) {
    echo 'BAR: ';
    echo $barModel->getValue(); // 5 + 5 = 10
    echo PHP_EOL;
}
