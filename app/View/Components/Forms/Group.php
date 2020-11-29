<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Group extends Component
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
    public function __construct($title = null, $name = null)
    {
        $this->title = $title;
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
            <div {{ $attributes->merge(['class' => 'form-group']) }}>
                <x-label :name="$name">{{ $title }}</x-label>
                {{ $slot }}
                <span class="invalid-feedback" role="alert"></span>
            </div>
        blade;
    }
}
