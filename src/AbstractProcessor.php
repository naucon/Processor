<?php
/*
 * Copyright 2008 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Processor;

/**
 * Abstract Processor
 *
 * @abstract
 * @package     Processor
 * @author      Sven Sanzenbacher
 */
abstract class AbstractProcessor implements ProcessorInterface, SupportAwareInterface
{
    /**
     * @var     string          model class name
     */
    protected $modelClass;


    /**
     * Constructor
     *
     * @param   string      $modelClass      model class name
     */
    public function __construct($modelClass)
    {
        $this->modelClass = $modelClass;
    }


    /**
     * @inheritdoc
     */
    public function support($model)
    {
        return $model instanceof $this->modelClass;
    }
}