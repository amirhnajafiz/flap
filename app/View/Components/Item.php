<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Item extends Component
{
    public $title;
    public $content;
    public $more;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $content
     * @param string $more
     */
    public function __construct($title, $content, $more = "")
    {
        $this->title = $title;
        $this->content = $content;
        $this->more = $more;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item')
            ->with('title', $this->title)
            ->with('content', $this->content)
            ->with('more', $this->more);
    }
}
