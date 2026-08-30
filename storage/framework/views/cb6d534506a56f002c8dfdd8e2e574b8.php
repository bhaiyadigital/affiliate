<?php
    $keywords = $pageMeta->meta_keywords ?? 'blog, affiliated , real estate news';
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }

    $breadcrumb = [['name' => 'Home', 'url' => route('home.index')], ['name' => 'Blog', 'url' => route('blog.index')]];
?>

<?php if (isset($component)) { $__componentOriginal2002f29bdc0e84b65295553259536881 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2002f29bdc0e84b65295553259536881 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.meta-info.meta','data' => ['setup' => $setup,'type' => 'CollectionPage','title' => $pageMeta->meta_title ?? 'Our Official Blog','description' => $pageMeta->meta_description ?? 'Read the latest insights and updates from Bhaiya Housing.','keywords' => $keywords,'image' => $setup->meta_image ? asset('storage/' . $setup->meta_image) : $setup->logo_url ?? null,'canonical' => url()->current(),'breadcrumb' => $breadcrumb]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('meta-info.meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['setup' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($setup),'type' => 'CollectionPage','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageMeta->meta_title ?? 'Our Official Blog'),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageMeta->meta_description ?? 'Read the latest insights and updates from Bhaiya Housing.'),'keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($keywords),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($setup->meta_image ? asset('storage/' . $setup->meta_image) : $setup->logo_url ?? null),'canonical' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url()->current()),'breadcrumb' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($breadcrumb)]); ?>
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
<?php /**PATH C:\laragon\www\affiliate\resources\views\components\meta-info\add-meta\blog-meta.blade.php ENDPATH**/ ?>