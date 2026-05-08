<?php

// 1. What is Component in Laravel?
// A Component is a reusable piece of code that can be used to create dynamic and interactive user

// how to create a Component in Laravel?
// php artisan make:component Alert

// app/View/Components/Alert.php
// resources/views/components/alert.blade.php



namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;  //by developer
    public $message;//by developer
    public function __construct($type, $message)//by developer
    {
        $this->type = $type;//by developer
        $this->message = $message;//by developer
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
