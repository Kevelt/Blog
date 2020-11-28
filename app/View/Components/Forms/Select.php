<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * The component name.
     *
     * @var string
     */
    public $name;

    /**
     * Show array values.
     *
     * @var array
     */
    public $values;

    /**
     * Is required.
     *
     * @var bool
     */
    public $required;

    /**
     * Value selected.
     *
     * @var mixed
     */
    public $selected;

    /**
     * Is multiple select.
     *
     * @var bool
     */
    public $multiple;

    /**
     * Determine if the given option is the current selected option.
     *
     * @param  string  $option
     * @return bool
     */
    public function isSelected($option)
    {
        return $option === $this->selected;
    }

    /**
     * Create the component instance.
     *
     * @param  string  $name
     * @param  string  $title
     * @param  bool  $required default:false
     * @param  bool  $multiple default:false
     * @param  mixed  $selected default:false
     * @return void
     */
    public function __construct($name, $values = [], $required = false, $selected = null, $multiple = false)
    {
        $this->name = $name;
        $this->values = $values;
        $this->required = $required;
        $this->selected = $selected;
        $this->multiple = $multiple;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <select {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}" {{ $multiple ? 'multiple' : '' }} {{ $required ? 'required' : '' }}>
                @foreach ($values as $value => $label)
                    <option {{ $isSelected($value) ? 'selected' : '' }} value="{{ $value }}">
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        blade;
    }
}
