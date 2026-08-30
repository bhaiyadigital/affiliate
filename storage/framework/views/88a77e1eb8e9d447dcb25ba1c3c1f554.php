<?php
    $keywords = $project->meta_keywords;
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }

    $breadcrumb = [
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Projects', 'url' => route('affiliated.project')],
        ['name' => $project->title, 'url' => url()->current()],
    ];
?>

<?php if (isset($component)) { $__componentOriginal2002f29bdc0e84b65295553259536881 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2002f29bdc0e84b65295553259536881 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.meta-info.meta','data' => ['setup' => $setup,'type' => 'RealEstateListing','title' => ($project->meta_title ?: $project->title) . ' | ' . ($setup->site_name ?? 'Affiliate'),'description' => $project->meta_description ?: Str::limit(strip_tags($project->description), 160),'keywords' => $keywords ?: $project->title . ', real estate project, bhaiya housing','image' => $project->imageUrl ?: $setup->logo_url ?? asset('images/header/logo.png'),'canonical' => url()->current(),'breadcrumb' => $breadcrumb,'schema' => [
        'headline' => $project->title,
        'published' => $project->created_at,
        'updated' => $project->updated_at,
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('meta-info.meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['setup' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($setup),'type' => 'RealEstateListing','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($project->meta_title ?: $project->title) . ' | ' . ($setup->site_name ?? 'Affiliate')),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($project->meta_description ?: Str::limit(strip_tags($project->description), 160)),'keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($keywords ?: $project->title . ', real estate project, bhaiya housing'),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($project->imageUrl ?: $setup->logo_url ?? asset('images/header/logo.png')),'canonical' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url()->current()),'breadcrumb' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($breadcrumb),'schema' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        'headline' => $project->title,
        'published' => $project->created_at,
        'updated' => $project->updated_at,
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
<?php /**PATH C:\laragon\www\affiliate\resources\views/components/meta-info/add-meta/project-details-meta.blade.php ENDPATH**/ ?>