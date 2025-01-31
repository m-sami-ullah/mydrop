<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TrustedClients extends Component
{
    public $clients;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($clients)
    {
        $this->clients = $clients;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.trusted-clients');
    }
}
