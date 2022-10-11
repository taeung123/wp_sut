<?php

namespace Vicoders\Input\Constracts;

interface InputInterface
{
    public function render();

    /**
     * Determine the type of input
     *
     * @var string
     * @return boolean
     */
    public function is($type);

    /**
     * Save to data
     *
     * @return boolean
     */
    public function save();
}
