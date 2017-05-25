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
 * Processor Queue
 *
 * @package     Processor
 * @author      Sven Sanzenbacher
 */
class ProcessorQueue extends \SplPriorityQueue
{
    /**
     * @var int
     */
    protected $serial = PHP_INT_MAX;

    /**
     * @inheritdoc
     */
    public function insert($value, $priority)
    {
        parent::insert($value, array($priority, $this->serial--));
    }
}