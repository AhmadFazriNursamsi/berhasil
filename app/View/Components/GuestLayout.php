<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *Blade::component('Blade::directive('datetime', function ($expression) {
         return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
     });', PackageNameComponent::class);
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.guest');
    }
}
