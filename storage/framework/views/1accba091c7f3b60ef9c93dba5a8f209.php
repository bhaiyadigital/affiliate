<?php echo $__env->make('components.meta-info.meta', [
    'setup' => $setup,

    'type' => 'BlogPosting',

    'title' => ($blog->meta_title ?: $blog->title) . ' | ' . ($setup->site_name ?? 'Affiliate'),

    'description' => $blog->meta_description ?: Str::limit(strip_tags($blog->short), 160),

    'keywords' => is_array($blog->meta_keywords)
        ? implode(', ', $blog->meta_keywords)
        : $blog->meta_keywords ?? 'blog, news, bhaiya housing',

    'image' => $blog->imageUrl ?: $setup->logo_url ?? asset('images/header/logo.png'),

    'canonical' => url()->current(),

    'breadcrumb' => [
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Blog', 'url' => route('blog.index')],
        ['name' => $blog->title, 'url' => url()->current()],
    ],

    'schema' => [
        'headline' => $blog->title,
        'author' => $setup->founder_name ?? ($setup->site_name ?? 'Admin'),
        'published' => $blog->created_at,
        'updated' => $blog->updated_at,
    ],
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\laragon\www\affiliate\resources\views\components\meta-info\add-meta\blog-details-meta.blade.php ENDPATH**/ ?>