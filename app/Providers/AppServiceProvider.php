<?php

namespace Muserpol\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;
use Muserpol\EconomicComplement;
use Muserpol\WorkflowRecord;
use Muserpol\EconomicComplementObservation;
use Muserpol\Observers\EcoComObservationObserver;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        EconomicComplement::created(function ($economic_complement)
        {
            WorkflowRecord::creatingEconomicComplement($economic_complement);
        });
        EconomicComplement::updating(function ($economic_complement)
        {
            WorkflowRecord::updatedEconomicComplement($economic_complement);
        });
        Validator::extend('not_zero', function($attribute, $value, $parameters, $validator) {
            
            return !($value=="0.00" || $value=='0' || $value=='');
        });
        Validator::extend('number_comma_dot', function($attribute, $value, $parameters, $validator) {
            return  preg_match('/(?=.)^\$?(([1-9][0-9]{0,2}(,[0-9]{3})*)|0)?(\.[0-9]{1,2})?$/', $value);
        });

        EconomicComplementObservation::observe(EcoComObservationObserver::class);
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
