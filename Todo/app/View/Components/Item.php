<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Item extends Component
{
    public $title;
    public $content;
    public $more;
    public $link;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $content
     * @param string $more
     * @param string $link
     */
    public function __construct($title, $content, $more = "", $link = "")
    {
        $this->title = $title;
        $this->content = $content;
        $this->more = $more;
        $this->link = $link;
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
            ->with('more', $this->more)
            ->with('link', $this->link);
    }
}
