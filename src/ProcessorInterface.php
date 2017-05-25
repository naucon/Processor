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
 * Processor Interface
 *
 * @package     Processor
 * @author      Sven Sanzenbacher
 */
interface ProcessorInterface
{
    /**
     * process cart
     *
     * @param   object   $model       model to be processed
     * @return  bool        process result
     */
    public function process($model);
}