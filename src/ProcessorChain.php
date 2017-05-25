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
 * Processor Chain
 *
 * @package     Processor
 * @author      Sven Sanzenbacher
 */
class ProcessorChain implements ProcessorInterface
{
    /**
     * @var ProcessorQueue
     */
    protected $queue;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->queue = new ProcessorQueue();
    }

    /**
     * @param   ProcessorInterface      $processor
     * @param   int                     $priority
     */
    public function addProcessor(ProcessorInterface $processor, $priority=0)
    {
        $this->queue->insert($processor, $priority);
    }

    /**
     * @inheritdoc
     */
    public function process($model)
    {
        $tmpQueue = clone $this->queue;

        /**
         * @var ProcessorInterface $processor
         */
        foreach ($tmpQueue as $processor) {
            if ($processor instanceof SupportAwareInterface) {
                if (false == $processor->support($model)) {
                    continue;
                }
            }

            if ($processor->process($model) === false) {
                return false;
            }
        }

        return true;
    }
}