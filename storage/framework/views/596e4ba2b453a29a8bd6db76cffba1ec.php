<?php
    $keywords = $asset->meta_keywords;
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }

    $breadcrumb = [
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Asset Library', 'url' => route('home.filter', ['section' => 'assets'])],
        ['name' => $asset->title, 'url' => url()->current()],
    ];
?>

<?php if (isset($component)) { $__componentOriginal2002f29bdc0e84b65295553259536881 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2002f29bdc0e84b65295553259536881 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.meta-info.meta','data' => ['setup' => $setup,'type' => 'ItemPage','title' => ($asset->meta_title ?: $asset->title) . ' | ' . ($setup->site_name ?? 'Affiliate'),'description' => $asset->meta_description ?: Str::limit(strip_tags($asset->description), 160),'keywords' => $keywords ?: $asset->title . ', download, bhaiya housing assets','image' => $asset->imageUrl ?: $setup->logo_url ?? asset('images/header/logo.png'),'canonical' => url()->current(),'breadcrumb' => $breadcrumb,'schema' => [
        'headline' => $asset->title,
        'published' => $asset->created_at,
        'updated' => $asset->updated_at,
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('meta-info.meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['setup' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($setup),'type' => 'ItemPage','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($asset->meta_title ?: $asset->title) . ' | ' . ($setup->site_name ?? 'Affiliate')),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($asset->meta_description ?: Str::limit(strip_tags($asset->description), 160)),'keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($keywords ?: $asset->title . ', download, bhaiya housing assets'),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($asset->imageUrl ?: $setup->logo_url ?? asset('images/header/logo.png')),'canonical' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url()->current()),'breadcrumb' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($breadcrumb),'schema' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        'headline' => $asset->title,
        'published' => $asset->created_at,
        'updated' => $asset->updated_at,
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2002f29bdc0e84b65295553259536881)): ?>
<?php $attributes = $__attributesOriginal2002f29bdc0e84b65295553259536881; ?>
<?php unset($__attributesOriginal2002f29bdc0e84b65295553259536881); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2002f29bdc0e84b65295553259536881)): ?>
<?php $component = $__componentOriginal2002f29bdc0e84b65295553259536881; ?>
<?php unset($__componentOriginal2002f29bdc0e84b65295553259536881); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\affiliate\resources\views\components\meta-info\add-meta\asset-details-meta.blade.php ENDPATH**/ ?>