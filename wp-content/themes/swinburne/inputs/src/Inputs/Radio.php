<?php
namespace Vicoders\Input\Inputs;

use Vicoders\Input\Abstracts\Input;
//use NightFury\Form\Facades\Form;

class Radio extends Input
{
    
    /**
     * {@inheritDoc}
     */
    public $type = Input::RADIO;

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
            if ($this->attributes['rtl']) {
                $html = <<<EOF
<div class="form-group group-radio group-radio-{$this->name} radio-{$this->attributes['class']}">
    <label>{$this->label}</label>
    <span class="group-type">
        <span class="text">{$this->attributes['text']}</span>
        <input type="radio" class="form-control" name="{$this->name}" value="{$this->attributes['value']}" required {$checked} ><span class="bg"></span>
    </span>
</div>
EOF;
            }
        else {
            $html = <<<EOF
<div class="form-group group-radio group-radio-{$this->name} radio-{$this->attributes['class']}">
    <label>{$this->label}</label>
    <span class="group-type">
        
        <input type="radio" class="form-control" name="{$this->name}" value="{$this->attributes['value']}" required {$checked} ><span class="bg"></span><span class="text">{$this->attributes['text']}</span>
    </span>
</div>
EOF;
        }
            
        } else {

            if ($this->attributes['rtl']) {
                $html = <<<EOF
<div class="form-group group-radio group-radio-{$this->name} radio-{$this->attributes['class']}">
    <label>{$this->label}</label>
    <span class="group-type">
        <span class="text">{$this->attributes['text']}</span>
        <input type="radio" class="form-control" name="{$this->name}" value="{$this->attributes['value']}" {$checked}><span class="bg"></span>
    </span>
</div>
EOF;
            }
        else {
            $html = <<<EOF
<div class="form-group group-radio group-radio-{$this->name} radio-{$this->attributes['class']}">
    <label>{$this->label}</label>
    <span class="group-type">
        
        <input type="radio" class="form-control" name="{$this->name}" value="{$this->attributes['value']}" {$checked}><span class="bg"></span><span class="text">{$this->attributes['text']}</span>
    </span>
</div>
EOF;
        }
        }
        return $html;
    }

    public function renderMetaField()
    {
        $html = <<<EOF
<div class="form-group group-radio group-radio-{$this->name} radio-{$this->attributes['class']}">
    <label>{$this->label}</label>
    <input type="radio" class="form-control meta" name="{$this->name}" value="{$this->value}" {$checked}>
</div>
EOF;
        return $html;
    }
}
