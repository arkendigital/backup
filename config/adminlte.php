<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Example.com',

    'title_postfix' => '',

    'title_prefix' => 'OPS &mdash; ',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>O</b>PS',

    'logo_mini' => '<b>OPS</b>',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'admin',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MAIN NAVIGATION',
        [
            'text' => 'Site Home',
            'url'  => '/',
            'icon'  => 'home',
            'active' => [],
        ],
        [
            'text' => 'OPS Home',
            'url'  => 'ops',
            'icon'  => 'home',
            'active' => ['ops'],
        ],
        [
            'text' => 'Site Settings',
            'url'  => 'ops/settings',
            'icon'  => 'cog',
            'can'   => 'view settings'
        ],
        [
            'text' => 'My Account',
            'url'  => 'ops/me',
            'icon' => 'lock'
        ],
        [
            'header' => 'Reports',
            'can' => 'view report',
        ],
        [
            'text' => 'View Reported Content',
            'url'  => 'ops/reports',
            'icon'  => 'warning',
            'can'   => 'view report'
        ],
        [
            'header' => 'Users',
            'can' => 'edit user',
        ],
        [
            'text' => 'All Users',
            'url'  => 'ops/users',
            'icon'  => 'users',
            'can'   => 'edit user'
        ],
        [
            'text' => 'Add User',
            'url'  => 'ops/users/create',
            'icon'  => 'user',
            'can'   => 'create user'
        ],
        [
            'text' => 'User Roles &amp; Permissions',
            'url'  => 'ops/roles',
            'icon'  => 'key',
            'can'   => 'edit role'
        ],
        [
            'text' => 'View Permissions',
            'url'  => 'ops/permissions',
            'icon'  => 'key',
            'can'   => 'edit role'
        ],
        [
            'header' => 'Articles',
            'can' => 'edit article',
        ],
        [
            'text' => 'All Articles',
            'url'  => 'ops/articles',
            'icon'  => 'newspaper-o',
            'can'   => 'edit article'
        ],
        [
            'text' => 'Add Article',
            'url'  => 'ops/articles/create',
            'icon'  => 'pencil',
            'can'   => 'create article'
        ],
        [
            'header' => 'Pages',
            'can' => 'edit page',
        ],
        [
            'text' => 'All Pages',
            'url'  => 'ops/pages',
            'icon'  => 'file-text-o',
            'can'   => 'edit page'
        ],
        [
            'text' => 'Add Page',
            'url'  => 'ops/pages/create',
            'icon'  => 'plus-circle',
            'can'   => 'create page'
        ],
        [
            'header' => 'Forums',
            'can' => 'edit forum',
        ],
        [
            'text' => 'All Forums',
            'url'  => 'ops/forums',
            'icon'  => 'comments',
            'can' => 'edit forum'
        ],
        [
            'text' => 'Add Forum Category',
            'url'  => 'ops/forums/categories/create',
            'icon'  => 'comment',
            'can' => 'create forum category'
        ],
        [
            'text' => 'Add Forum',
            'url'  => 'ops/forums/create',
            'icon'  => 'comment',
            'can' => 'create forum'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
    ],
];
