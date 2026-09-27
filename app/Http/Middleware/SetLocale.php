<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | Set Application Language
        |--------------------------------------------------------------------------
        */

        $locale = session('locale', config('app.locale', 'en'));

        if (!in_array($locale, ['en', 'ar'])) {
            $locale = 'en';
        }

        app()->setLocale($locale);
        view()->share('direction', $locale === 'ar' ? 'rtl' : 'ltr');

        /*
        |--------------------------------------------------------------------------
        | Set AdminLTE Sidebar Language
        |--------------------------------------------------------------------------
        */

        if ($locale === 'ar') {

            config([
                'adminlte.menu' => [

                    [
                        'text' => 'اللغة',
                        'icon' => 'fas fa-language',
                        'topnav_right' => true,

                        'submenu' => [

                            [
                                'text' => 'الإنجليزية',
                                'route' => [
                                    'language.switch',
                                    ['locale' => 'en'],
                                ],
                            ],

                            [
                                'text' => 'العربية',
                                'route' => [
                                    'language.switch',
                                    ['locale' => 'ar'],
                                ],
                            ],

                        ],
                    ],

                    [
                        'text' => 'لوحة التحكم',
                        'route' => 'dashboard',
                        'icon' => 'fas fa-home',
                    ],

                    [
                        'header' => 'الإدارة',
                    ],

                    [
                        'text' => 'العملاء',
                        'route' => 'clients.index',
                        'icon' => 'fas fa-users',
                    ],

                    [
                        'text' => 'السائقون',
                        'route' => 'drivers.index',
                        'icon' => 'fas fa-truck',
                    ],

                    [
                        'text' => 'الفواتير',
                        'icon' => 'fas fa-file-invoice',

                        'submenu' => [

                            [
                                'text' => 'كل الفواتير',
                                'route' => 'invoices.index',
                            ],

                            [
                                'text' => 'معلق',
                                'route' => 'invoices.pending',
                            ],

                            [
                                'text' => 'منجز',
                                'route' => 'invoices.done',
                            ],

                            [
                                'text' => 'مرفوض',
                                'route' => 'invoices.rejected',
                            ],

                            [
                                'text' => 'متأخر',
                                'route' => 'invoices.delayed',
                            ],

                        ],
                    ],

                    [
                        'text' => 'التقارير',
                        'url' => 'reports',
                        'icon' => 'fas fa-chart-line',
                    ],

                    [
                        'text' => 'الإعدادات',
                        'url' => 'settings',
                        'icon' => 'fas fa-cog',
                    ],

                ],
            ]);

        } else {

            config([
                'adminlte.menu' => [

                    [
                        'text' => 'Language',
                        'icon' => 'fas fa-language',
                        'topnav_right' => true,

                        'submenu' => [

                            [
                                'text' => 'English',
                                'route' => [
                                    'language.switch',
                                    ['locale' => 'en'],
                                ],
                            ],

                            [
                                'text' => 'Arabic',
                                'route' => [
                                    'language.switch',
                                    ['locale' => 'ar'],
                                ],
                            ],

                        ],
                    ],

                    [
                        'text' => 'Dashboard',
                        'route' => 'dashboard',
                        'icon' => 'fas fa-home',
                    ],

                    [
                        'header' => 'Management',
                    ],

                    [
                        'text' => 'Clients',
                        'route' => 'clients.index',
                        'icon' => 'fas fa-users',
                    ],

                    [
                        'text' => 'Drivers',
                        'route' => 'drivers.index',
                        'icon' => 'fas fa-truck',
                    ],

                    [
                        'text' => 'Invoices',
                        'icon' => 'fas fa-file-invoice',

                        'submenu' => [

                            [
                                'text' => 'All Invoices',
                                'route' => 'invoices.index',
                            ],

                            [
                                'text' => 'Pending',
                                'route' => 'invoices.pending',
                            ],

                            [
                                'text' => 'Done',
                                'route' => 'invoices.done',
                            ],

                            [
                                'text' => 'Rejected',
                                'route' => 'invoices.rejected',
                            ],

                            [
                                'text' => 'Delayed',
                                'route' => 'invoices.delayed',
                            ],

                        ],
                    ],

                    [
                        'text' => 'Reports',
                        'url' => 'reports',
                        'icon' => 'fas fa-chart-line',
                    ],

                    [
                        'text' => 'Settings',
                        'url' => 'settings',
                        'icon' => 'fas fa-cog',
                    ],

                ],
            ]);
        }

        return $next($request);
    }
}