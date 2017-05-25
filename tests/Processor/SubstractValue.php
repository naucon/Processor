<?php
/*
 * Copyright 2008 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Processor\Tests\Processor;

use Naucon\Processor\AbstractProcessor;

class SubstractValue extends AbstractProcessor
{
    /**
     * @var bool    process return value
     */
    protected $value;

    /**
     * Constructor
     *
     * @param   string      $modelClass      model class name
     * @param   string      $value           value to substract from model
     */
    public function __construct($modelClass, $value)
    {
        $this->value = $value;

        parent::__construct($modelClass);
    }

    /**
     * @inheritdoc
     */
    public function process($model)
    {
        $oldValue = $model->getValue();
        $newValue = $oldValue - $this->value;
        $model->setValue($newValue);

        return true;
    }
}