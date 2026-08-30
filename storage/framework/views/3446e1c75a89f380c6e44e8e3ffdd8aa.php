<?php
    $keywords = $pageMeta->meta_keywords ?? 'campaigns, real estate offers, bhaiya housing promotions';
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }

    $breadcrumb = [
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Campaigns', 'url' => route('home.filter', ['section' => 'campaigns'])],
    ];
?>

<?php if (isset($component)) { $__componentOriginal2002f29bdc0e84b65295553259536881 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2002f29bdc0e84b65295553259536881 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.meta-info.meta','data' => ['setup' => $setup,'type' => 'CollectionPage','title' => $pageMeta->meta_title ?? 'Active Campaigns & Special Offers','description' => $pageMeta->meta_description ??
    'Stay updated with the latest housing offers, events and campaigns from Bhaiya Group.','keywords' => $keywords,'image' => $pageMeta->imageUrl ?? ($setup->logo_url ?? null),'canonical' => url()->current(),'breadcrumb' => $breadcrumb]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('meta-info.meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['setup' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($setup),'type' => 'CollectionPage','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageMeta->meta_title ?? 'Active Campaigns & Special Offers'),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageMeta->meta_description ??
    'Stay updated with the latest housing offers, events and campaigns from Bhaiya Group.'),'keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($keywords),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageMeta->imageUrl ?? ($setup->logo_url ?? null)),'canonical' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url()->current()),'breadcrumb' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($breadcrumb)]); ?>
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
<?php /**PATH C:\laragon\www\affiliate\resources\views\components\meta-info\add-meta\campaign-meta.blade.php ENDPATH**/ ?>