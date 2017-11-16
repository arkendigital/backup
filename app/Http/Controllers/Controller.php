<?php

namespace App\Http\Controllers;

use Setting;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, SEOToolsTrait;

    public function __construct()
    {
        $this->seo()->setTitle(Setting::get('site_title'));
        $this->seo()->setDescription(Setting::get('site_description'));
        $this->seo()->opengraph()->setUrl(app()->make('url')->to('/'));
        $this->seo()->opengraph()->addProperty('type', 'website');
        $this->seo()->twitter()->setSite(Setting::get('social_twitter'));
    }
}
