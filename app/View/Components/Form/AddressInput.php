<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class AddressInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string|null $address,
        public float|null  $lat,
        public float|null  $lng
    )
    {
        //
    }

    public function render()
    {
        return view('components.form.address-input');
    }
}
