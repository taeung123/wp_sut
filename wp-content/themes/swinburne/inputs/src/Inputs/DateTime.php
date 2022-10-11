<?php

namespace Vicoders\Input\Inputs;

use Vicoders\Input\Abstracts\Input;
use NightFury\Form\Facades\Form;

class DateTime extends Input
{
    /**
     * {@inheritDoc}
     */
    public $type = Input::DATETIME;

    /**
     * {@inheritDoc}
     */
    public $label = '';

    /**
     * {@inheritDoc}
     */
    public $name = '';

    /**
     * {@inheritDoc}
     */
    public $description = '';

    /**
     * {@inheritDoc}
     */
    public $format = 'd-m-Y';

    /**
     * {@inheritDoc}
     * @var array
     */
    public $attributes = [];

    public function render()
    {
        $value = get_option($this->name, '');
        if ($this->required) {
            $html = <<<EOF
<div class="form-group group-datetime-{$this->name}">
    <label>{$this->label}</label>
    <input data-inputmask="'alias': 'datetime'"  class="form-control" name="{$this->name}" value="{$value}" required>
</div>
EOF;
        } else {
            $html = <<<EOF
<div class="form-group group-datetime-{$this->name}">
    <label>{$this->label}</label>
    <input data-inputmask="'alias': 'datetime'" class="form-control" name="{$this->name}" value="{$value}">
</div>
EOF;
        }
        return $html;
    }
    public function renderMetaField()
    {
        $html = <<<EOF
<div class="form-group group-datetime-{$this->name}">
    <label>{$this->label}</label>
    <input data-inputmask="'alias': 'datetime'" class="form-control meta" name="{$this->name}">
</div>
EOF;
        return $html;
    }
}
