<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Bookmark;
use App\Models\Content;
use App\Models\Notification;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        Paginator::useTailwind();
        Blade::directive('permission', function ($expression) {
            return "<?php if(auth()->check() && auth()->user()->hasPermission({$expression})): ?>";
        });

        Blade::directive('endpermission', function () {
            return "<?php endif; ?>";
        });
        View::composer('frontend.partials.header', function ($view) {
            $bookmarkCount = 0;
            $notifications = collect();
            $unreadCount   = 0;

            if (auth()->check()) {
                $userId = auth()->id();
                $bookmarkCount = Bookmark::where('user_id', $userId)->count();

                $notifications = Notification::latest()->take(10)->get();
                $unreadCount   = $notifications->filter(fn($n) => !$n->isReadBy($userId))->count();
            }

            $view->with(compact('bookmarkCount', 'notifications', 'unreadCount'));
        });
        $contents = [
            'destination' => [
                'module_name' => ['label' => 'Destinations', 'icon' => 'bi bi-geo-alt'],
                'title'       => ['label' => 'Location Name (e.g. Coxs Bazar)', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'slug'        => ['label' => 'Slug', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'img_path'    => ['label' => 'Tab Icon / Image', 'required' => false, 'show_in_table' => true, 'type' => 'image'],
                'video_path'  => ['label' => 'Link URL (Optional)', 'required' => false, 'show_in_table' => false, 'type' => 'url'],
                'meta_title'       => ['label' => 'Meta Title', 'required' => false, 'show_in_table' => false, 'type' => 'text'],
                'meta_description' => ['label' => 'Meta Description', 'required' => false, 'show_in_table' => false, 'type' => 'textarea'],
                'meta_keywords' => ['label' => 'Meta Keywords', 'required' => false, 'show_in_table' => false, 'type' => 'text'],
                'status'      => ['label' => 'Status', 'required' => true, 'show_in_table' => true, 'type' => 'select'],
            ],
            // ─── Concern ───
            'concern' => [
                'module_name' => ['label' => 'Concerns (Groups)', 'icon' => 'bi bi-building'],
                'title'       => ['label' => 'Concern Name', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'slug'           => ['label' => 'Slug', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'img_path'    => ['label' => 'Concern Logo', 'required' => false, 'show_in_table' => true, 'type' => 'image'],
                'meta_title'       => ['label' => 'Meta Title', 'required' => false, 'show_in_table' => false, 'type' => 'text'],
                'meta_description' => ['label' => 'Meta Description', 'required' => false, 'show_in_table' => false, 'type' => 'textarea'],
                'meta_keywords' => ['label' => 'Meta Keywords', 'required' => false, 'show_in_table' => false, 'type' => 'text'],
                'status'      => ['label' => 'Status', 'required' => true, 'show_in_table' => true, 'type' => 'select'],
            ],

            // ─── Project Glance ───
            'project_glance' => [
                'module_name' => ['label' => 'Project Glance', 'icon' => 'bi bi-grid'],
                'parent_id'      => ['label' => 'Select Concern', 'required' => true, 'show_in_table' => true, 'type' => 'select', 'options' => 'concerns'],
                'title'       => ['label' => 'Label (e.g. Total Units)', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'name'        => ['label' => 'Icon Class (FontAwesome)', 'required' => false, 'show_in_table' => true, 'type' => 'text'],
                'short'       => ['label' => 'Value (e.g. 500+)', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'status'      => ['label' => 'Status', 'required' => true, 'show_in_table' => true, 'type' => 'select'],
            ],

            // ─── Features ───
            'features' => [
                'module_name' => ['label' => 'Features', 'icon' => 'bi bi-star'],
                'parent_id'      => ['label' => 'Select Concern', 'required' => true, 'show_in_table' => true, 'type' => 'select', 'options' => 'concerns'],
                'title'       => ['label' => 'Feature Name', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'name'        => ['label' => 'Icon Class (FontAwesome)', 'required' => false, 'show_in_table' => true, 'type' => 'text'],
                'img_path'    => ['label' => 'Alternative Icon Image', 'required' => false, 'show_in_table' => false, 'type' => 'image'],
                'status'      => ['label' => 'Status', 'required' => true, 'show_in_table' => true, 'type' => 'select'],
            ],

            // ─── Projects ───
            'project' => [
                'module_name'    => ['label' => 'Projects', 'icon' => 'bi bi-house-door'],
                'parent_id'      => ['label' => 'Select Concern', 'required' => true, 'show_in_table' => true, 'type' => 'select', 'options' => 'concerns'],
                'destination_id' => ['label' => 'Select Destination', 'required' => false, 'show_in_table' => true, 'type' => 'select', 'options' => 'shared_destinations'],
                'title'          => ['label' => 'Project Name (Heading)', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'slug'           => ['label' => 'Slug', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'location'       => ['label' => 'Location (e.g. Banani)', 'required' => false, 'show_in_table' => true, 'type' => 'text'],
                'start_date'     => ['label' => 'Publish Date', 'required' => false, 'show_in_table' => false, 'type' => 'datetime'],
                'description'    => ['label' => 'Description 1', 'required' => false, 'show_in_table' => false, 'type' => 'editor'],
                'description_1'  => ['label' => 'Description 2', 'required' => false, 'show_in_table' => false, 'type' => 'editor'],
                'description_2'  => ['label' => 'Description 3', 'required' => false, 'show_in_table' => false, 'type' => 'editor'],
                'description_3'  => ['label' => 'Description 4', 'required' => false, 'show_in_table' => false, 'type' => 'editor'],
                'img_path'       => ['label' => 'Thumbnail Image', 'required' => true, 'show_in_table' => true, 'type' => 'image'],
                'img_paths'      => ['label' => 'Gallery Images', 'required' => false, 'show_in_table' => false, 'type' => 'image_multiple'],
                'video_path'     => ['label' => 'Video File', 'required' => false, 'show_in_table' => false, 'type' => 'video'],
                'url'            => ['label' => 'Brochure Link', 'required' => false, 'show_in_table' => false, 'type' => 'url'],
                'meta_title'       => ['label' => 'Meta Title', 'required' => false, 'show_in_table' => false, 'type' => 'text'],
                'meta_description' => ['label' => 'Meta Description', 'required' => false, 'show_in_table' => false, 'type' => 'textarea'],
                'meta_keywords' => ['label' => 'Meta Keywords', 'required' => false, 'show_in_table' => false, 'type' => 'text'],
                'status'         => ['label' => 'Status', 'required' => true, 'show_in_table' => true, 'type' => 'select'],
            ],

            // ─── Blogs ───
            'blogs' => [
                'module_name'      => ['label' => 'Blogs', 'icon' => 'bi bi-pencil-square'],
                'parent_id'        => ['label' => 'Select Project', 'required' => true, 'show_in_table' => true, 'type' => 'select', 'options' => 'shared_projects'],
                'title'            => ['label' => 'Blog Title', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'slug'             => ['label' => 'Slug', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'short'            => ['label' => 'Short Description', 'required' => true, 'show_in_table' => false, 'type' => 'textarea'],
                'description'    => ['label' => 'Description 1', 'required' => false, 'show_in_table' => false, 'type' => 'editor'],
                'description_1'  => ['label' => 'Description 2', 'required' => false, 'show_in_table' => false, 'type' => 'editor'],
                'description_2'  => ['label' => 'Description 3', 'required' => false, 'show_in_table' => false, 'type' => 'editor'],
                'description_3'  => ['label' => 'Description 4', 'required' => false, 'show_in_table' => false, 'type' => 'editor'],
                'img_path'         => ['label' => 'Featured Image', 'required' => true, 'show_in_table' => true, 'type' => 'image'],
                'meta_title'       => ['label' => 'Meta Title', 'required' => false, 'show_in_table' => false, 'type' => 'text'],
                'meta_description' => ['label' => 'Meta Description', 'required' => false, 'show_in_table' => false, 'type' => 'textarea'],
                'meta_keywords' => ['label' => 'Meta Keywords', 'required' => false, 'show_in_table' => false, 'type' => 'text'],
                'status'           => ['label' => 'Status', 'required' => true, 'show_in_table' => true, 'type' => 'select'],
            ],
            'pages' => [
                'module_name'      => ['label' => 'Static Pages (Meta)', 'icon' => 'bi bi-file-earmark-code'],
                'title'            => ['label' => 'Page Name (e.g. Projects)', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'slug'             => ['label' => 'Page Slug ', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'img_path'         => ['label' => 'Meta Image', 'required' => true, 'show_in_table' => true, 'type' => 'image'],
                'meta_title'       => ['label' => 'Meta Title', 'required' => false, 'show_in_table' => false, 'type' => 'text'],
                'meta_description' => ['label' => 'Meta Description', 'required' => false, 'show_in_table' => false, 'type' => 'textarea'],
                'meta_keywords'    => ['label' => 'Meta Keywords', 'required' => false, 'show_in_table' => false, 'type' => 'text'],
                'status'           => ['label' => 'Status', 'required' => true, 'show_in_table' => true, 'type' => 'select'],
            ],
            'social' => [
                'module_name' => ['label' => 'Social', 'icon' => 'bi bi-share'],
                'title'       => ['label' => 'Platform Name', 'required' => true,  'show_in_table' => true,  'type' => 'text'],
                'url'         => ['label' => 'Profile URL',   'required' => true,  'show_in_table' => true,  'type' => 'url'],
                'img_path'    => ['label' => 'Icon / Logo',   'required' => false, 'show_in_table' => true,  'type' => 'image'],
                'sort_order'  => ['label' => 'Sort Order',    'required' => false, 'show_in_table' => true,  'type' => 'number'],
                'status'      => ['label' => 'Status',        'required' => true,  'show_in_table' => true,  'type' => 'select'],
            ],
            'coupons' => [
                'module_name'      => ['label' => 'Coupons', 'icon' => 'bi bi-ticket-perforated'],
                'title'            => ['label' => 'Coupon Title', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'slug'             => ['label' => 'Coupon Code', 'required' => true, 'show_in_table' => true, 'type' => 'text'],
                'short'            => ['label' => 'Discount Amount', 'required' => false, 'show_in_table' => false, 'type' => 'text'],
                'start_date'       => ['label' => 'Start Date', 'required' => true, 'show_in_table' => true, 'type' => 'datetime'],
                'end_date'         => ['label' => 'End Date', 'required' => true, 'show_in_table' => true, 'type' => 'datetime'],
                'used_count'  => ['label' => 'Total Used', 'show_in_table' => true],
                'name'             => ['label' => 'Usage Limit Per User', 'required' => true, 'show_in_table' => false, 'type' => 'number'],
                'views'            => ['label' => 'Usage Limit (0 for unlimited)', 'required' => true, 'show_in_table' => true, 'type' => 'number'],
                'status'           => ['label' => 'Status', 'required' => true, 'show_in_table' => true, 'type' => 'select'],
            ],

        ];

        View::share('modules', $contents);

        if (Schema::hasTable('contents')) {
            $concerns    = Content::where('module', 'concern')->where('status', 1)->get(['id', 'title']);
            $projects    = Content::where('module', 'project')->where('status', 1)->orderBy('sort_order', 'asc')->get(['id', 'title']);
            $pages       = Content::where('module', 'pages')->where('status', 1)->get();
            $destination = Content::where('module', 'destination')->where('status', 1)->orderBy('sort_order', 'asc')->get();
            $setup = SiteSetting::first();
            $socials = Content::where('module', 'social')->where('status', 1)->orderBy('sort_order')->get();
            View::share('socials', $socials);
            View::share('setup', $setup);
            View::share('concerns', $concerns);
            View::share('shared_projects', $projects);
            View::share('shared_pages', $pages);
            View::share('shared_destinations', $destination);
        }
    }
}
