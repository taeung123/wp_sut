<?php
namespace Vicoders\Input\Inputs;

use Vicoders\Input\Abstracts\Input;
use NightFury\Form\Facades\Form;

class Text extends Input
{
    
    /**
     * {@inheritDoc}
     */
    public $type = Input::TEXT;

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
        $image = $this->attributes['image'] ?'<div class="image-text"><img src="'. get_stylesheet_directory_uri().'/'.$this->attributes['image'].'" alt="image"></div>' : '';
        
        if ($this->required) {
            $html = <<<EOF
<div class="form-group group-text group-text-{$this->name} text-{$this->attributes['class']}">
    <div class="group-wrap">
        <div class="text-wrap">
            <label>{$this->label}</label>
            <input type="text" class="form-control" name="{$this->name}" value="{$value}" required>     
        </div>
        <span class="text">{$this->attributes['text']}</span>
        {$image}
    </div>
    
</div>
EOF;
        } else {
            $html = <<<EOF
<div class="form-group group-text group-text-{$this->name} text-{$this->attributes['class']}">
    <div class="group-wrap">
        <div class="text-wrap">
            <label>{$this->label}</label>
            <input type="text" class="form-control" name="{$this->name}" value="{$value}">
        </div>
        <span class="text">{$this->attributes['text']}</span>
        {$image}
            
    </div>
</div>
EOF;
        }
        return $html;
    }

    public function renderMetaField()
    {
        $html = <<<EOF
<div class="form-group group-text group-text-{$this->name} text-{$this->attributes['class']}">
    <label>{$this->label}</label>
    <input type="text" class="form-control meta" name="{$this->name}">
</div>
EOF;
        return $html;
    }
}
