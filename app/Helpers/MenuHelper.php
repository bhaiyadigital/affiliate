<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class MenuHelper
{
    public static function getMenuGroups(): array
    {
        return [
            [
                'title' => 'Overview',
                'items' => [
                    [
                        'icon' => 'dashboard',
                        'name' => 'Dashboard',
                        'path' => route('dashboard'),
                        'permission' => 'dashboard.view',
                    ],
                ],
            ],

            [
                'title' => 'Website',
                'items' => [
                    [
                        'icon' => 'concern',
                        'name' => 'Concerns',
                        'path' => route('contents.index', ['module' => 'concern']),
                        'permission' => 'concern.view',
                    ],
                    [
                        'icon' => 'destination',
                        'name' => 'Destinations',
                        'path' => route('contents.index', ['module' => 'destination']),
                        'permission' => 'destination.view',
                    ],
                    [
                        'icon' => 'project_glance',
                        'name' => 'Project Glance',
                        'path' => route('contents.index', ['module' => 'project_glance']),
                        'permission' => 'project_glance.view',
                    ],
                    [
                        'icon' => 'features',
                        'name' => 'Features',
                        'path' => route('contents.index', ['module' => 'features']),
                        'permission' => 'features.view',
                    ],
                    [
                        'icon' => 'project',
                        'name' => 'Projects',
                        'path' => route('contents.index', ['module' => 'project']),
                        'permission' => 'project.view',
                    ],
                    [
                        'icon' => 'coupons',
                        'name' => 'Coupons',
                        'path' => route('contents.index', ['module' => 'coupons']),
                        'permission' => 'coupons.view',
                    ],
                    // [
                    //     'icon' => 'blogs',
                    //     'name' => 'Blogs',
                    //     'path' => route('contents.index', ['module' => 'blogs']),
                    //     'permission' => 'blogs.view',
                    // ],
                    // [
                    //     'icon' => 'pages',
                    //     'name' => 'Static Pages',
                    //     'path' => route('contents.index', ['module' => 'pages']),
                    //     'permission' => 'pages.view',
                    // ],
                    // [
                    //     'icon' => 'social-links',
                    //     'name' => 'Social Links',
                    //     'path' => route('contents.index', ['module' => 'social']),
                    //     'permission' => 'settings.manage',
                    // ],
                ],
            ],

            [
                'title' => 'Marketing',
                'items' => [
                    [
                        'icon' => 'lead-list',
                        'name' => 'Lead List',
                        'path' => route('admin.leads.index'),
                        'permission' => 'leads.view',
                    ],
                    // [
                    //     'icon' => 'campaign',
                    //     'name' => 'Campaigns',
                    //     'path' => route('campaigns.index'),
                    //     'permission' => 'campaigns.view',
                    // ],
                    // [
                    //     'icon' => 'asset',
                    //     'name' => 'Assets',
                    //     'path' => route('assets.index'),
                    //     'permission' => 'assets.view',
                    // ],
                    // [
                    //     'icon' => 'asset-type',
                    //     'name' => 'Asset Types',
                    //     'path' => route('asset-types.index'),
                    //     'permission' => 'asset_types.view',
                    // ],
                ],
            ],

            [
                'title' => 'Administration',
                'items' => [
                    [
                        'icon' => 'user-profile',
                        'name' => 'Users',
                        'path' => route('users.index'),
                        'permission' => 'users.view',
                    ],
                    [
                        'icon' => 'roles',
                        'name' => 'Roles & Permissions',
                        'path' => route('roles.index'),
                        'permission' => 'roles.view',
                    ],
                    [
                        'icon' => 'activity-log',
                        'name' => 'Activity Logs',
                        'path' => route('activity-logs.index'),
                        'permission' => 'activity_logs.view',
                    ],
                    // [
                    //     'icon' => 'download-logs',
                    //     'name' => 'Download Logs',
                    //     'path' => route('download-logs.index'),
                    //     'permission' => 'activity_logs.view',
                    // ],
                ],
            ],

            [
                'title' => 'System',
                'items' => [
                    [
                        'icon' => 'settings',
                        'name' => 'Site Settings',
                        'path' => route('settings.index'),
                        'permission' => 'settings.manage',
                    ],
                    [
                        'icon' => 'support',
                        'name' => 'Support Ticket',
                        'path' => route('ticket.admin'),
                        'permission' => 'settings.manage',
                    ],
                ],
            ],
        ];
    }

    public static function getFilteredMenuGroups(): array
    {
        $user = Auth::user();

        if (!$user) {
            return [];
        }

        $groups = [];

        foreach (self::getMenuGroups() as $group) {

            $items = array_filter(
                $group['items'],
                function ($item) use ($user) {
                    return empty($item['permission'])
                        || $user->hasPermission($item['permission']);
                }
            );

            if (!empty($items)) {
                $group['items'] = array_values($items);
                $groups[] = $group;
            }
        }

        return $groups;
    }

    public static function isActive(string $path): bool
    {
        $current = request()->url();
        $path = rtrim($path, '/');

        return $current === $path
            || str_starts_with($current, $path . '/');
    }

    public static function getIconSvg($iconName)
    {
        $icons = [

            'dashboard' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>',

            'concern' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 21h18M3 7v14M21 7v14M9 3h6l2 4H7l2-4zm1 14h2v4h-2v-4z"/></svg>',

            'destination' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>',

            'project_glance' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M3 15h18M9 3v18M15 3v18"/></svg>',

            'features' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',

            'project' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 7h18M3 12h18M3 17h18"/></svg>',

            'coupons' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 9a3 3 0 010 6v2a2 2 0 002 2h10a2 2 0 002-2v-2a3 3 0 010-6V7a2 2 0 00-2-2H4a2 2 0 00-2 2v2Z"/><path d="M9 5v14"/></svg>',

            'blogs' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>',

            'pages' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>',

            'social-links' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="M8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98"/></svg>',

            'lead-list' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>',

            'campaign' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>',

            'asset' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>',

            'asset-type' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 6h16M4 10h16M4 14h10M4 18h6"/><circle cx="19" cy="16" r="3"/><path d="M21.5 18.5L23 20"/></svg>',

            'user-profile' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',

            'roles' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>',

            'activity-log' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8zM14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>',

            'download-logs' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><path d="M7 10l5 5 5-5M12 15V3"/></svg>',

            'settings' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15 1.65 1.65 0 003.17 14H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>',

            'support' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 12a8 8 0 0116 0"/><path d="M4 12v4a2 2 0 002 2h1a1 1 0 001-1v-4a1 1 0 00-1-1H4zM20 12v4a2 2 0 01-2 2h-1a1 1 0 01-1-1v-4a1 1 0 011-1h3zM12 18h4"/></svg>',
        ];

        return $icons[$iconName] ?? '';
    }
}