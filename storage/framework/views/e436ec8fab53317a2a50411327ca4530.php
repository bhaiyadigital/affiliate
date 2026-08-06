<?php
    $keywords = $pageMeta->meta_keywords ?? ($setup->meta_keywords ?? '');
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }
?>

<?php if (isset($component)) { $__componentOriginal2002f29bdc0e84b65295553259536881 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2002f29bdc0e84b65295553259536881 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.meta-info.meta','data' => ['setup' => $setup,'type' => 'WebPage','title' => $pageMeta->meta_title ?? ($setup->meta_title ?? ($setup->site_name ?? 'Bhaiya Housing')),'description' => $pageMeta->meta_description ?? ($setup->meta_description ?? 'Explore exclusive brand assets and real estate marketing materials.'),'keywords' => $keywords,'image' => $pageMeta->imageUrl ?? ($setup->meta_image ? asset('storage/'.$setup->meta_image) : ($setup->logo_url ?? null)),'canonical' => url()->current(),'breadcrumb' => [
        [
            'name' => 'Home',
            'url'  => url('/')
        ]
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('meta-info.meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['setup' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($setup),'type' => 'WebPage','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageMeta->meta_title ?? ($setup->meta_title ?? ($setup->site_name ?? 'Bhaiya Housing'))),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageMeta->meta_description ?? ($setup->meta_description ?? 'Explore exclusive brand assets and real estate marketing materials.')),'keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($keywords),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageMeta->imageUrl ?? ($setup->meta_image ? asset('storage/'.$setup->meta_image) : ($setup->logo_url ?? null))),'canonical' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url()->current()),'breadcrumb' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        [
            'name' => 'Home',
            'url'  => url('/')
        ]
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
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/components/meta-info/add-meta/index-meta.blade.php ENDPATH**/ ?>