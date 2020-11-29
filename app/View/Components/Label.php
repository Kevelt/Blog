<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Label extends Component
{
    /**
     * Name associated with the label.
     *
     * @var string
     */
    public $name;

    /**
     * Create the component instance.
     *
     * @param  string  $title
     * @param  string  $name default:null
     * @return void
     */
    public function __construct($name = null)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <label {{ $attributes->merge(['class' => '']) }} {{ $name ? "for=$name" : '' }}>{{ $slot }}</label>
        blade;
    }
}
