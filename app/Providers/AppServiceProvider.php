<?php

namespace App\Providers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Setting;
use App\UrlMenu;
use App\Content\Navigation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (! $this->app->runningInConsole()) {
            View::share([ 
                'facebook' => Setting::get('facebook'),
                'twitter' => Setting::get('twitter'),
                'linkedin' => Setting::get('linkedin'),
                'footer_menu' => UrlMenu::getMenu('Footer'),
                'footer_sub_menu' => UrlMenu::getMenu('Footer Submenu'),
                'r_sticky_button' => Setting::get('r_sticky_button'),
                'l_sticky_button' => Setting::get('l_sticky_button'),
                'navigation_items' => (new Navigation)->mainMenu()
            ]);
        }

        Blade::directive('rgba', function ($hex, $alpha = false) {
            $hex = str_replace('#', '', $hex);
            $length = strlen($hex);
            $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
            $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
            $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
            if ($alpha) {
                $rgb['a'] = $alpha;
                return "<?php echo 'rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},{$rgb['a']});'; ?>";
            }
            return "<?php echo 'rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},1);'; ?>";
        });

        \Shortcode::add('button', function ($atts, $content, $name) {
            $content = \Shortcode::compile($content);

            if (isset($atts["link"]) && isset($atts["text"])) {
                if (isset($atts["new_tab"]) && strtolower($atts["new_tab"]) == "yes") {
                    $target = "target='_blank'";
                } else {
                    $target = "";
                }
                return "<a class='button button--dark-blue' href='".$atts["link"]."' ".$target.">".$atts["text"]."</a>";
            }
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator($this->forPage($page, $perPage), $total ?: $this->count(), $perPage, $page, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]);
        });
    }
}
