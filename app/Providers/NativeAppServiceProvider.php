<?php

namespace App\Providers;

use Native\Desktop\Facades\Window;
use Native\Desktop\Contracts\ProvidesPhpIni;
use Native\Desktop\Facades\Menu;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {

        

        Menu::create(
            Menu::view(),
            Menu::make(
               
                // Menu::route('database.manager', 'Datatbase Manager'),
                Menu::route('login', 'Login'),
                Menu::route('dashboard', 'Dashboard'),
            )->label('Navigation'),
            Menu::make(
                Menu::route('setup', 'Setup'),
                Menu::route('license.manager','License Manager'),
                Menu::route('database.manager', 'Database Manager'),
                Menu::route('about', 'About'),
            )->label('Help')

            
        );

        $window = Window::open();
        


        // $window->icon('')
        $window->webPreferences([
            // 'javascript'=> false,
            'spellcheck' => true,
            'backgroundThrottling' => true,
        ]);
        $window->minWidth(400);
        $window->minHeight(400);
        $window->maximized();
        
        
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [];
    }
}
