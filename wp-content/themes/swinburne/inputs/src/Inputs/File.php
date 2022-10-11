<?php

namespace Vicoders\Input\Inputs;

use Vicoders\Input\Abstracts\Input;

class File extends Input
{
    /**
     * {@inheritDoc}
     */
    public $type = Input::FILE;

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

    public $attributes = [];

    public function render()
    {
        $value       = get_option($this->name);
        if(!empty($value)) {
            $hidden = '';
        } else {
            $hidden = 'hidden';
        }
        $label = !empty($this->label)? '<h4 class="card-title">'.$this->label.'</h4>': '';
        $output_id = 'output_'.$this->name;
        $input_id = 'input_'.$this->name;
        if ($this->required) {
            $html        = <<<EOF
            <div class="form-group form-card nto-image-{$this->name}" id="nto-image-{$this->name}">
                <div class="card-body">
                    {$label}
                    <img id="{$output_id}" />
                    <input type="file" id="{$input_id}" class="input-file input-value btn btn-primary" name="{$this->name}"  value="" required multiple>
                    
                </div>
                <div class="text">{$this->attributes['text']}</div>
            </div>

EOF;
        }
        else {
            $html        = <<<EOF
            <div class="form-group form-card nto-image-{$this->name}" id="nto-image-{$this->name}">
                <div class="card-body">
                    {$label}
                    <img id="{$output_id}" />
                    <input type="file" id="{$input_id}" class="input-file input-value btn btn-primary" name="{$this->name}" multiple>
                    
                </div>
                <div class="text">{$this->attributes['text']}</div>
            </div>

EOF;
        }
        return $html;
    }
}
