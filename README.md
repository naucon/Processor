naucon Processor Package
========================

About
-----

This package provides a generic processor chain to process a given object with processors/task (kind of a pipline, command chain pattern).
The goal is to split large processing code into multiple smaller task which are loosely decoupled, more readable, easy to maintain and quick to replace.

### Features

* process object by processors/tasks
* chained processing with ProcessorChain
* processors/tasks in chain can be prioritized
* processor/tasks can be restricted to a specific class or interface (SupportAwareInterface)


### Compatibility

* PHP5.3


Installation
------------

install the latest version via composer

    composer require naucon/processor


Usage
-----

create ProcessorChain instance

    $chain = new ProcessorChain();

register processors/tasks to the chain

    $chain->addProcessor(new AddValue(Foo::class, 15));
    $chain->addProcessor(new AddValue(Bar::class, 5));
    $chain->addProcessor(new SubstractValue(Foo::class, 5));

process object

    $model = new Foo();

    if ($chain->process($model)) {
        echo $fooModel->getValue(); // 0 + 15 - 5 = 10
    }

create a processor

    use Naucon\Processor\ProcessorInterface;

    class MyProcessor implements ProcessorInterface
    {
        /**
         * @inheritdoc
         */
        public function process($model)
        {
            // processing the model ...


            // return false;  // terminates processor chain
            // or
            return true; // continue with next processor in chain
        }
    }

if the `process()` method returns `true` the processor chain will continue with the next processor in chain.
if it returns `false` the processor chain will be terminated.

add a SupportAwareInterface

    use SupportAwareInterface

    class MyProcessor implements ProcessorInterface, SupportAwareInterface
    {
        /**
         * @inheritdoc
         */
        public function process($model)
        {
            ...
        }

        /**
         * @inheritdoc
         */
        public function support($model)
        {
            return $model instanceof FooInterface;
        }
    }

or you can use the AbstractProcessor

    use Naucon\Processor\AbstractProcessor;

    class MyProcessor extends AbstractProcessor
    {
        /**
         * Constructor
         *
         * @param   string      $modelClass      model class name
         */
        public function __construct($modelClass, $value)
        {
            parent::__construct($modelClass);
        }

        /**
         * @inheritdoc
         */
        public function process($model)
        {
            ...
        }
    }



Example
-------

Execution:

    cd examples
    php ProcessorExample.php

Output:

    FOO: 10
    BAR: 10


## License

The MIT License (MIT)

Copyright (c) 2015 Sven Sanzenbacher

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.