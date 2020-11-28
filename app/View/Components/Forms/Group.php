<?php

namespace App\View\Components\Forms;

use App\View\Components\Label;

class Group extends Label
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <div class="form-group">
                <x-label :name="$name" :title="$title" />
                {{ $slot }}
                <span class="invalid-feedback" role="alert"></span>
            </div>
        blade;
    }
}
