<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Filament\Navigation\NavigationGroup;

class ExempleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/example/translations' =>
            resource_path('vendor/filament/filament/ressources')
        ], 'filament');

        Filament::registerNavigationGroups([
            NavigationGroup::make()
                 ->label('Organisation')
                 ->icon('heroicon-s-shopping-cart'),
            NavigationGroup::make()
                ->label('Formation')
                ->icon('heroicon-s-pencil'),
            ]);

            }
            
            
};
