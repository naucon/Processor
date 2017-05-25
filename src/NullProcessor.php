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
 * Null Processor
 *
 * @package     Processor
 * @author      Sven Sanzenbacher
 */
class NullProcessor extends AbstractProcessor
{
    /**
     * @var bool    process return value
     */
    protected $return;

    /**
     * Constructor
     *
     * @param   string      $modelClass      model class name
     * @param   bool        $return          optional process return value
     */
    public function __construct($modelClass, $return = null)
    {
        $this->return = $return;

        parent::__construct($modelClass);
    }

    /**
     * @inheritdoc
     */
    public function process($model)
    {
        // do nothing

        return $this->return;
    }
}