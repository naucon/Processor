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
 * Support Aware Interface
 *
 * @package     Processor
 * @author      Sven Sanzenbacher
 */
interface SupportAwareInterface
{
    /**
     * @param   object      $model      model
     * @return  bool        return true if model is supported
     */
    public function support($model);
}