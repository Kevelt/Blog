<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * The component name.
     *
     * @var string
     */
    public $name;

    /**
     * Current value.
     *
     * @var string
     */
    public $value;

    /**
     * Is required.
     *
     * @var bool
     */
    public $required;

    /**
     * Type component.
     *
     * @var string
     */
    public $type;

    /**
     * Placeholder.
     *
     * @var string
     */
    public $placeholder;

    /**
     * Image source.
     *
     * @var string
     */
    public $src;

    /**
     * Create the component instance.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  bool  $required default:false
     * @param  string  $type default:text
     * @param  string  $placeholder default:null
     * @param  string  $src default:null
     * @return void
     */
    public function __construct($name, $value, $required = false, $type = 'text', $placeholder = null, $src = 'src')
    {
        $this->name = $name;
        $this->value = $value;
        $this->required = $required;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->src = $src;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            @if($type==='img')
                <div class="input-group">
                    <div class="custom-file">
                        <input {{ $attributes->merge(['class' => 'custom-file-input custom-file-input--img custom-file-input--img-preview']) }} name="{{ $name }}" id="{{ $name }}" type="file" value="{{ $value }}" {{ $required ? 'required' : '' }} />
                        <label class="custom-file-label" for="image_url">Choose file</label>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="image_url">
                            <img id="{{ $name }}_img" src="{{ $src }}" width="100" height="100" />
                        </label>
                    </div>
                </div>
            @else
                <input {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}" id="{{ $name }}" type="{{ $type }}" value="{{ $value }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} />
            @endif
        blade;
    }
}
