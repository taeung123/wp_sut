<?php

namespace Vicoders\Input\Inputs;

use Vicoders\Input\Abstracts\Input;
use NightFury\Form\Facades\Form;

class Number extends Input
{
    /**
     * {@inheritDoc}
     */
    public $type = Input::NUMBER;

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
     * @var array
     */
    public $attributes = [];

    public function render()
    {
        $value = get_option($this->name, '');
        $visiable_number = ($this->attributes['visiable-type']) ? 'type="number"' : '';
        if ($this->required) {
            $html = <<<EOF
<div class="form-group group-number group-number-{$this->name}">
    <div class="group-wrap">
        <label>{$this->label}</label>
        <input {$visiable_number} class="form-control {$this->attributes['class']}" name="{$this->name}" value="{$value}" min="{$this->attributes['min']}" max="{$this->attributes['max']}" step="1" placeholder="{$this->attributes['placeholder']}" required>
    </div>
    
</div>
EOF;
        } else {
            $html = <<<EOF
<div class="form-group group-number group-number-{$this->name}">
    <div class="group-wrap">
        <label>{$this->label}</label>
        <input {$visiable_number} class="form-control" name="{$this->name}" value="{$value}" min="{$this->attributes['min']}" max="{$this->attributes['max']}" step="1" placeholder="{$this->attributes['placeholder']}"  >
    </div>
</div>
EOF;
        }
        return $html;

    }

    public function renderMetaField()
    {
        $value = get_option($this->name, '');
               $html = <<<EOF
<div class="form-group {$this->name}">
    <label>{$this->label}</label>
    <input type="number" class="form-control" name="{$this->name}" value="{$value}" min="{$this->attributes['min']}" max="{$this->attributes['max']}" step="1" placeholder="{$this->attributes['placeholder']}" >
</div>
EOF;
        return $html;
    }
}
