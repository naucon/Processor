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
 * Processor Aware Interface
 *
 * @package     Processor
 * @author      Sven Sanzenbacher
 */
interface ProcessorAwareInterface
{
    /**
     * @param   ProcessorInterface      $processor
     */
    public function setProcessor(ProcessorInterface $processor);
}