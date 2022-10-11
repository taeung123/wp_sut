<?php

namespace Vicoders\Input\Inputs;

use Vicoders\Input\Abstracts\Input;
use NightFury\Form\Facades\Form;

class Email extends Input
{
    /**
     * {@inheritDoc}
     */
    public $type = Input::EMAIL;

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
        if ($this->required) {
            $html  = <<<EOF
            <div class="form-group group-email group-email-{$this->name}">
                <div class="group-wrap">
                    <label>{$this->label}</label>
                    <input type="email" class="form-control input-value" name="{$this->name}" value="{$value}" required>
                </div>
            </div>
EOF;
        }
        else {
             $html  = <<<EOF
            <div class="form-group group-email group-email-{$this->name}">
                <div class="group-wrap">
                    <label>{$this->label}</label>
                    <input type="email" class="form-control input-value" name="{$this->name}" value="{$value}">
                </div>
            </div>
EOF;
        }
        return $html;
    }

    public function renderMetaField()
    {
        $html = <<<EOF
<div class="form-group group-email group-email-{$this->name}">
    <div class="group-wrap">
        <label>{$this->label}</label>
        <input type="email" class="form-control" name="{$this->name}">
    </div>
</div>

EOF;
        return $html;
    }
}
