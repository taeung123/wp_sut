<?php

namespace Vicoders\Input\Inputs;

use Vicoders\Input\Abstracts\Input;
use NightFury\Form\Facades\Form;

class Date extends Input
{
    /**
     * {@inheritDoc}
     */
    public $type = Input::DATE;

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
    public $required = false;
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
<div class="form-group group-date group-date-{$this->name}">
    <div class="group-wrap">
        <label>{$this->label}</label>
        <input data-inputmask="'alias': 'date'"  class="form-control" name="{$this->name}" value="{$value}" placeholder="{$this->attributes['placeholder']}" required>
    </div>
</div>
EOF;
        } else {
            $html = <<<EOF
<div class="form-group group-date group-date-{$this->name}">
    <div class="group-wrap">
        <label>{$this->label}</label>
        <input data-inputmask="'alias': 'date'" class="form-control" name="{$this->name}" value="{$value}" placeholder="{$this->attributes['placeholder']}">
    </div>
</div>
EOF;
        }
        return $html;
    }
    public function renderMetaField()
    {
        $html = <<<EOF
<div class="form-group group-date group-date-{$this->name}">
    <label>{$this->label}</label>
    <input data-inputmask="'alias': 'date'" class="form-control meta" name="{$this->name}">
</div>
EOF;
        return $html;
    }
}
