<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>DATAMUNI </b>Tambito',
    'logo_img' => 'vendor/adminlte/dist/img/escudo-el-tambo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/escudo-el-tambo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/escudo-el-tambo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Asset Bundling option for the admin panel.
    | Currently, the next modes are supported: 'mix', 'vite' and 'vite_js_only'.
    | When using 'vite_js_only', it's expected that your CSS is imported using
    | JavaScript. Typically, in your application's 'resources/js/app.js' file.
    | If you are not using any of these, leave it as 'false'.
    |
    | For detailed instructions you can look the asset bundling section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'search',
            'topnav_right' => true,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],
        [
            'text' => '111'
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],
        [
            'text' => 'pages',
            'url' => 'admin/pages',
            'icon' => 'far fa-fw fa-file',
            'label' => 4,
            'label_color' => 'success',
        ],
        ['header' => 'account_settings'],
        [
            'text' => 'profile',
            'url' => 'admin/settings',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'url' => 'admin/settings',
            'icon' => 'fas fa-fw fa-lock',
        ],
        [
            'text' => 'multilevel',
            'icon' => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url' => '#',
                ],
                [
                    'text' => 'level_one',
                    'url' => '#',
                    'submenu' => [
                        [
                            'text' => 'level_two',
                            'url' => '#',
                        ],
                        [
                            'text' => 'level_two',
                            'url' => '#',
                            'submenu' => [
                                [
                                    'text' => 'level_three',
                                    'url' => '#',
                                ],
                                [
                                    'text' => 'level_three',
                                    'url' => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'level_one',
                    'url' => '#',
                ],
            ],
        ],

        ['header' => 'Gestión de Areas'],

        /*Área de la Mujer*/
        [
            'text' => 'Area de la Mujer',
            'icon' => 'fas fa-fw fa-female',
            'submenu' => [
                [
                    'text' => 'Menu Principal',
                    'url' => 'am_dashboard', // Ruta hacia el menú principal
                    'icon' => 'fas fa-fw fa-home', // Icono de inicio
                    'icon_color' => 'pink',
                ],
                [
                    'text' => 'Gestión de Casos',
                    'url' => '#',
                    'icon' => 'fas fa-user-shield',
                    'submenu' => [
                        [
                            'text' => 'Personas',
                            'url' => 'am_people',
                            'icon' => 'fas fa-users',
                            'icon_color' => 'red',
                        ],
                        [
                            'text' => 'Violencias',
                            'url' => 'violences',
                            'icon' => 'fas fa-exclamation-triangle',
                            'icon_color' => 'cyan',
                        ],
                        [
                            'text' => 'Casos de Persona',
                            'url' => 'am_person_violences',
                            'icon' => 'fas fa-user-injured',
                            'icon_color' => 'orange',
                        ],
                    ],
                ],
                [
                    'text' => 'Gestión para Intervenciones',
                    'url' => '#',
                    'icon' => 'fas fa-hand-holding-heart',
                    'submenu' => [
                        [
                            'text' => 'Intervenciones',
                            'url' => 'interventions',
                            'icon' => 'fas fa-hands-helping',
                            'icon_color' => 'yellow',
                        ],
                        [
                            'text' => 'Intervenciones por Persona',
                            'url' => 'am_person_interventions',
                            'icon' => 'fas fa-user-cog',
                            'icon_color' => 'purple',
                        ],
                    ],
                ],
                [
                    'text' => 'Gestión de Programas y Eventos',
                    'url' => '#',
                    'icon' => 'fas fa-calendar-alt',
                    'submenu' => [
                        [
                            'text' => 'Programas',
                            'url' => 'programs',
                            'icon' => 'fas fa-project-diagram',
                            'icon_color' => 'green',
                        ],
                        [
                            'text' => 'Eventos',
                            'url' => 'events',
                            'icon' => 'fas fa-calendar-check',
                            'icon_color' => 'blue',
                        ],

                        [
                            'text' => 'Eventos por Persona',
                            'url' => 'am_person_events',
                            'icon' => 'fas fa-user-clock',
                            'icon_color' => 'pink',
                        ],
                    ],
                ],
            ]
        ],

        /*Vaso de Leche*/
        [
            'text' => 'Vaso de Leche',
            'icon' => 'fas fa-fw fa-child', // Icono de vaso de leche, usando fa-child
            'submenu' => [
                [
                    'text' => 'Menu Principal',
                    'url' => 'vaso-de-leche', // Ruta hacia el menú principal
                    'icon' => 'fas fa-fw fa-home', // Icono de inicio
                ],
                [
                    'text' => 'Configurar',
                    'url' => '#', // Ruta para configuración
                    'icon' => 'fas fa-fw fa-cogs', // Icono de configuración
                    'submenu' => [
                        [
                            'text' => 'Productos',
                            'url' => 'products', // Ruta para productos
                            'icon' => 'fas fa-fw fa-box', // Icono de productos
                        ],
                        [
                            'text' => 'Sectores',
                            'url' => 'sectors', // Ruta para sectores
                            'icon' => 'fas fa-fw fa-bullseye', // Icono de sectores
                        ],
                        [
                            'text' => 'Comités',
                            'url' => 'committees', // Ruta para comités
                            'icon' => 'fas fa-fw fa-flag', // Icono de comités
                        ],
                        [
                            'text' => 'Familiares',
                            'url' => 'vl_family_members', // Ruta para familiares
                            'icon' => 'fas fa-fw fa-users', // Icono de familiares
                        ],
                        [
                            'text' => 'Menores de Edad',
                            'url' => 'vl_minors', // Ruta para menores de edad
                            'icon' => 'fas fa-fw fa-child', // Icono de menores de edad
                        ],
                    ],
                ],
                [
                    'text' => 'Estadísticas',
                    'url' => 'statistics', // Ruta para estadísticas
                    'icon' => 'fas fa-fw fa-chart-line', // Icono de estadísticas
                ],
                [
                    'text' => 'Exportar',
                    'url' => 'export', // Ruta para exportar
                    'icon' => 'fas fa-fw fa-file-export', // Icono de exportar
                ],
            ],
        ],

        /*OMAPED*/
        [
            'text' => 'OMAPED',
            'icon' => 'fas fa-fw fa-wheelchair',
            'submenu' => [
                [
                    'text' => 'Panel OMAPED',
                    'url' => 'om_dashboard',
                    'icon' => 'fas fa-tachometer-alt',
                    'icon_color' => 'blue',
                ],
                [
                    'text' => 'Gestión Principal',
                    'url' => '#',
                    'icon' => 'fas fa-cogs',
                    'submenu' => [
                        [
                            'text' => 'Cuidadores',
                            'url' => 'caregivers',
                            'icon' => 'fas fa-user-nurse',
                            'icon_color' => 'green',
                        ],
                        [
                            'text' => 'Viviendas',
                            'url' => 'om-dwellings',
                            'icon' => 'fas fa-home',
                            'icon_color' => 'orange',
                        ],
                        [
                            'text' => 'Discapacidades',
                            'url' => 'disabilities',
                            'icon' => 'fas fa-universal-access',
                            'icon_color' => 'purple',
                        ],
                        [
                            'text' => 'Personas',
                            'url' => 'om-people',
                            'icon' => 'fas fa-users',
                            'icon_color' => 'pink',
                        ]
                    ],
                ],
            ],
        ],

        /*SISFOH*/
        [
            'text' => 'SISFOH',
            'icon' => 'fas fa-fw fa-users',
            'submenu' => [
                [
                    'text' => 'Panel SISFOH',
                    'url' => 'sisfoh_dashboard',
                    'icon' => 'fas fa-chart-line',
                    'icon_color' => 'orange',
                ],
                [
                    'text' => 'Gestión Principal',
                    'url' => '#',
                    'icon' => 'fas fa-cogs',
                    'submenu' => [
                        [
                            'text' => 'Personas',
                            'url' => 'sfh_people',
                            'icon' => 'fas fa-user-friends',
                            'icon_color' => 'pink',
                        ],
                        [
                            'text' => 'Viviendas',
                            'url' => 'sfh_dwelling',
                            'icon' => 'fas fa-home',
                            'icon_color' => 'orange',
                        ],
                        [
                            'text' => 'Encuestadores',
                            'url' => 'enumerators',
                            'icon' => 'fas fa-user-tie',
                            'icon_color' => 'green',
                        ],
                        [
                            'text' => 'Solicitudes',
                            'url' => 'sfh_requests',
                            'icon' => 'fas fa-folder-open',
                            'icon_color' => 'blue',
                        ],
                        [
                            'text' => 'Visitas',
                            'url' => 'visits',
                            'icon' => 'fas fa-walking',
                            'icon_color' => 'red',
                        ],
                        [
                            'text' => 'Instrumentos',
                            'url' => 'instruments',
                            'icon' => 'fas fa-clipboard-list',
                            'icon_color' => 'yellow',
                        ],
                    ],
                ],
            ],
        ],


        /* Área CIAM */
        [
            'text' => 'Área CIAM',
            'icon' => 'fas fa-blind', // Persona con bastón (disponible en FontAwesome 5)
            'submenu' => [
                [
                    'text' => 'Menú Principal',
                    'url' => 'ciam_home',
                    'icon' => 'fas fa-fw fa-home',
                ],
                [
                    'text' => 'Gestión',
                    'icon' => 'fas fa-fw fa-cogs',
                    'submenu' => [
                        [
                            'text' => 'Adultos Mayores',
                            'url' => 'elderly_adults',
                            'icon' => 'fas fa-fw fa-user-plus',
                        ],
                        [
                            'text' => 'Guardianes',
                            'url' => 'guardians',
                            'icon' => 'fas fa-fw fa-user-shield',
                        ],
                    ],
                ],
                [
                    'text' => 'Dashboard',
                    'url' => 'ciam_dashboard',
                    'icon' => 'fas fa-fw fa-chart-line',
                ],
            ],
        ],


    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
