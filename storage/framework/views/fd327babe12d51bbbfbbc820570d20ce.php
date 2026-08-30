<?php if (isset($component)) { $__componentOriginal2002f29bdc0e84b65295553259536881 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2002f29bdc0e84b65295553259536881 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.meta-info.meta','data' => ['setup' => $setup,'type' => 'WebPage','title' => 'Create an Account | ' . ($setup->site_name ?? 'Bhaiya Housing'),'description' => 'Register as an affiliate member at ' .
    ($setup->site_name ?? 'Bhaiya Housing') .
    '. Start referring customers, tracking leads, and earning rewards in real-time.','keywords' => 'register, bhaiya housing affiliate, sign up, referral program, join now','image' => $setup->logo_url ?? asset('images/header/logo.png'),'canonical' => url()->current(),'robots' => 'noindex, nofollow','breadcrumb' => [
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Create Account', 'url' => url()->current()],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('meta-info.meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['setup' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($setup),'type' => 'WebPage','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Create an Account | ' . ($setup->site_name ?? 'Bhaiya Housing')),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Register as an affiliate member at ' .
    ($setup->site_name ?? 'Bhaiya Housing') .
    '. Start referring customers, tracking leads, and earning rewards in real-time.'),'keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('register, bhaiya housing affiliate, sign up, referral program, join now'),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($setup->logo_url ?? asset('images/header/logo.png')),'canonical' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url()->current()),'robots' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('noindex, nofollow'),'breadcrumb' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Create Account', 'url' => url()->current()],
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
<?php /**PATH C:\laragon\www\affiliate\resources\views\components\meta-info\add-meta\register-meta.blade.php ENDPATH**/ ?>