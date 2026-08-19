<header class="nav">
    <div class="nav-inner">
        <div class="brand">
            <span class="name">Bhaiya Housing</span>
            <span class="tag">Refer &amp; Earn</span>
        </div>
        <div style="display:flex; align-items:center; gap:18px;">
            <?php if(auth()->guard()->check()): ?>
                <a href="#refer" class="nav-link" style="display: inline;">রেফার করুন</a>
                <a href="<?php echo e(route('profile.index')); ?>" class="nav-cta">প্রোফাইল</a>
            <?php else: ?>
                <a href="<?php echo e(route('affiliated.project')); ?>" class="nav-link" style="display: inline;">প্রোজেক </a>
                <a href="#dashboard" class="nav-link">অ্যাফিলিয়েট লগইন</a>
                <a href="#refer" class="nav-cta">যোগ দিন</a>
            <?php endif; ?>
        </div>
    </div>
</header>
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/landing/front/landingNav.blade.php ENDPATH**/ ?>