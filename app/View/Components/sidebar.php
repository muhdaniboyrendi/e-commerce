<?php

namespace App\View\Components;

use Closure;
use App\Models\Order;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $warning = Order::where('status_id', 1)->count();
        $info = Order::where('status_id', 2)->count();
        $primary = Order::where('status_id', 3)->count();
        $success = Order::where('status_id', 4)->count();

        return view('components.sidebar',compact('warning', 'info', 'primary', 'success'));
    }
}
