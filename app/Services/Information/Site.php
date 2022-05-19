<?php
namespace App\Services\Information;
use Illuminate\Support\Facades\Config;
class Site {

    protected $config;

    public function __construct()
    {
        $this->config = Config::get('siteinfo');
    }

    public function name() {
        return $this->config['name'];
    }
    public function title() {
        return $this->config['title'];
    }
    public function description() {
        return $this->config['description'];
    }
    
}