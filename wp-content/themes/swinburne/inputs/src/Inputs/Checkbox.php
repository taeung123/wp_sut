<?php
namespace Vicoders\Input\Inputs;

use Vicoders\Input\Abstracts\Input;
//use NightFury\Form\Facades\Form;

class Checkbox extends Input
{
    
    /**
     * {@inheritDoc}
     */
    public $type = Input::CHECKBOX;

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
    public $value = '';

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
        $checked = $this->attributes['checked'] ? 'checked="checked"' : '';
        if ($this->required) {
            $html = <<<EOF
<div class="form-group group-checkbox group-checkbox-{$this->name} checkbox-{$this->attributes['class']}">
    <label>{$this->label}</label>
    <div class="group-type">
        <input id="{$this->attributes['id']}" type="checkbox" class="form-control" name="{$this->name}" value="{$this->attributes['value']}" required {$checked} ><span class="bg"></span><span class="text">{$this->attributes['text']}</span>
    </div>
</div>
EOF;
        } else {
            $html = <<<EOF
<div class="form-group group-checkbox group-checkbox-{$this->name} checkbox-{$this->attributes['class']}">
    <label>{$this->label}</label>
    <div class="group-type">
        <input id="{$this->attributes['id']}" type="checkbox" class="form-control" name="{$this->name}" value="{$this->attributes['value']}" {$checked} ><span class="bg"></span><span class="text">{$this->attributes['text']}</span>
    </div>
</div>
EOF;
        }
        return $html;
    }

    public function renderMetaField()
    {
        $html = <<<EOF
<div class="form-group group-checkbox group-checkbox-{$this->name} checkbox-{$this->attributes['class']}">
    <label>{$this->label}</label>
    <input type="checkbox" class="form-control meta" name="{$this->name}" value="{$this->value}" {$checked}>
</div>
EOF;
        return $html;
    }
}
