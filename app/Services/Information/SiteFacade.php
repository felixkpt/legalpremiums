<?php 
namespace App\Services\Information;

use Illuminate\Support\Facades\Facade;

class SiteFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        // The Site is our service container key
        return \App\Services\Information\Site::class;
    }
}