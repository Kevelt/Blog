<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Label extends Component
{
    /**
     * The label title.
     *
     * @var string
     */
    public $title;

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
    public function __construct($title, $name = null)
    {
        $this->name = $name;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <label{{ $name ? " for=$name" : '' }}>{{ $title }}</label>
        blade;
    }
}
