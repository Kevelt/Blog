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
     * Show object values.
     *
     * @var object
     */
    public $values;

    /**
     * Show text in option.
     *
     * @var string
     */
    public $text;

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
     * Show id in option.
     *
     * @var string
     */
    public $id;

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
     * @param  object  $values
     * @param  string  $text
     * @param  bool  $required default:false
     * @param  mixed  $selected default:false
     * @param  bool  $multiple default:false
     * @param  string  $id default:id
     * @return void
     */
    public function __construct($name, $values, $text, $required = false, $selected = null, $multiple = false, $id = 'id')
    {
        $this->name = $name;
        $this->values = $values;
        $this->text = $text;
        $this->required = $required;
        $this->selected = $selected;
        $this->multiple = $multiple;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <select {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}" id="{{ $name }}" {{ $multiple ? 'multiple' : '' }} {{ $required ? 'required' : '' }}>
                @foreach ($values as $value)
                    <option {{ $isSelected($value[$id]) ? 'selected' : '' }} value="{{ $value[$id] }}">
                        {{ $value[$text] }}
                    </option>
                @endforeach
            </select>
        blade;
    }
}
