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

    'title' => 'Actuaries',

    'title_postfix' => '',

    'title_prefix' => 'AO',

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

    'logo' => 'Actuaries Online',

    'logo_mini' => 'AO',

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
            'text' => 'Admin Home',
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


        /**
        * Sections.
        */
        [
          'header' => 'Sections',
          'can' => 'sections',
        ],
        [
            'text' => 'Manage Sections',
            'url'  => 'ops/sections',
            'icon'  => 'users',
            'can'   => 'sections'
        ],
        [
            'text' => 'Manage Sidebars',
            'url'  => 'ops/sidebars',
            'icon'  => 'users',
            'can'   => 'sections'
        ],

        /**
        * Pages.
        */
        [
          'header' => 'Pages',
          'can' => 'pages',
        ],
        [
            'text' => 'Manage Pages',
            'url'  => 'ops/pages',
            'icon'  => 'users',
            'can'   => 'pages'
        ],

        /**
        * Box Groups.
        */
        [
          'header' => 'Box Groups',
        ],
        [
            'text' => 'Manage Box Groups',
            'url'  => 'ops/box-groups',
            'icon'  => 'users',
        ],


        /**
        * Discussions.
        */
        [
          'header' => 'Discussions',
          'can' => 'discussions',
        ],
        [
            'text' => 'Manage Discussion Categories',
            'url'  => 'ops/discussion-categories',
            'icon'  => 'users',
            'can'   => 'discussions'
        ],


        /**
        * Jobs.
        */
        [
          'header' => 'Jobs',
          'can' => 'jobs',
        ],
        [
            'text' => 'Manage Jobs',
            'url'  => 'ops/jobs',
            'icon'  => 'users',
            'can'   => 'jobs'
        ],
        [
            'text' => 'Manage Companies / Recruiters',
            'url'  => 'ops/job-companies',
            'icon'  => 'users',
            'can'   => 'jobs'
        ],
        [
          'text' => 'Manage Locations',
          'url'  => 'ops/job-locations',
          'icon'  => 'users',
          'can'   => 'jobs'
      ],


        /**
        * Exams.
        */
        [
          'header' => 'Exams',
          'can' => 'exams',
        ],
        [
          'text' => 'Manage Exams',
          'url'  => 'ops/exam-categories',
          'icon'  => 'users',
          'can'   => 'exams'
        ],
        [
          'text' => 'Manage Resources',
          'url'  => 'ops/exam-resources',
          'icon'  => 'users',
          'can'   => 'exams'
        ],
        [
          'text' => 'Manage Useful Links',
          'url'  => 'ops/exam-links',
          'icon'  => 'users',
          'can'   => 'exams'
        ],


        /**
        * CPD.
        */
        [
          'header' => 'CPD',
          'can' => 'cpd',
        ],
        [
          'text' => 'Manage Resources',
          'url'  => 'ops/cpd-resources',
          'icon'  => 'users',
          'can'   => 'cpd'
        ],
        [
          'text' => 'Manage Publications',
          'url'  => 'ops/cpd-publications',
          'icon'  => 'users',
          'can'   => 'cpd'
        ],
        [
          'text' => 'Manage Verifiable Links',
          'url'  => 'ops/cpd-links',
          'icon'  => 'users',
          'can'   => 'cpd'
        ],


        /**
        * Adverts.
        */
        [
          'header' => 'Adverts',
          'can' => 'adverts',
        ],
        [
          'text' => 'Manage Adverts',
          'url'  => 'ops/adverts',
          'icon'  => 'users',
          'can'   => 'adverts'
        ],


        /**
        * Slides.
        */
        [
          'header' => 'Slides',
        ],
        [
          'text' => 'Manage Slides',
          'url'  => 'ops/slides',
          'icon'  => 'users',
        ],


        /**
        * Employers.
        */
        [
          'header' => 'Employers',
        ],
        [
          'text' => 'Manage Employers',
          'url'  => 'ops/employers',
          'icon'  => 'users',
        ],


        /**
        * Societies.
        */
        [
          'header' => 'Societies',
        ],
        [
          'text' => 'Manage Societies',
          'url'  => 'ops/societies',
          'icon'  => 'users',
        ],


        /**
        * Actuarial Courses.
        */
        [
          'header' => 'Actuarial Courses',
        ],
        [
          'text' => 'Manage Courses',
          'url'  => 'ops/courses',
          'icon'  => 'users',
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
