<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class TextArea extends Component
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
     * Placeholder.
     *
     * @var string
     */
    public $placeholder;

    /**
     * Create the component instance.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  bool  $required default:false
     * @param  string  $placeholder default:null
     * @return void
     */
    public function __construct($name, $value, $required = false, $placeholder = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->required = $required;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <textarea {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }}>{{ $value }}</textarea>
            <script>
                CKEDITOR.replace( '{{ $name }}' );
            </script>
        blade;
    }
}
