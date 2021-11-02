<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubPage extends Component
{
	public $url = "";
	public $props = [];
	public $values = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url = null, $props = [], $values = [])
    {
		$this->url = $url;
		$this->props = $props;
		$this->values = $values;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sub-page');
    }
}
