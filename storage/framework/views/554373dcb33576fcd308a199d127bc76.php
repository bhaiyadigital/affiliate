<!-- HEADER BADGE -->
<div
    style="position:fixed;top:0;left:0;right:0;z-index:9999;background:var(--primary-gradient);color:#FFFFFF;text-align:center;font-size:12px;font-weight:800;letter-spacing:1.5px;padding:7px;text-transform:uppercase;">
    ✨ RECREATED AIWAVE CTA &amp; SERVICE CARD CONCEPT · DESIGN REVIEW
</div>

<header class="nav" id="mainNav" style="margin-top:30px;">
    <div class="wrap nav-inner">

        <!-- 🏠 Left: Brand (Dynamic Home Link) -->
        <a href="<?php echo e(route('landing.index')); ?>" class="brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18M6 21V9l6-5 6 5v12M9 21v-6h6v6" />
                </svg>
            </div>
            <div>
                <div class="brand-title">Bhaiya Housing</div>
                <div class="brand-subtitle">Refer &amp; Earn</div>
            </div>
        </a>

        <!-- 💊 Center: Pill Menu (Dynamic Routes) -->
        <nav class="nav-menu">
            
            <a href="<?php echo e(route('affiliated.project')); ?>" class="nav-item">প্রোজেক্ট</a>

            <?php if(auth()->guard()->check()): ?>
                
                <a href="<?php echo e(route('landing.index')); ?>#refer" class="nav-item">রেফার জমা</a>
                <a href="<?php echo e(route('profile.index')); ?>" class="nav-item">ড্যাশবোর্ড</a>
            <?php else: ?>
                
                <a href="<?php echo e(route('landing.index')); ?>#features" class="nav-item">কেন আমরা</a>
                <a href="<?php echo e(route('landing.index')); ?>#cta" class="nav-item">অভিজ্ঞতা</a>
                <a href="<?php echo e(route('landing.index')); ?>#refer" class="nav-item">রেফার জমা</a>
                <a href="<?php echo e(route('landing.index')); ?>#faq" class="nav-item">FAQ</a>
            <?php endif; ?>
        </nav>

        <!-- 🚀 Right: Buttons (Dynamic Login/Logout) -->
        <div class="nav-btns">
            <?php if(auth()->guard()->check()): ?>
                
                <div style="display: flex; align-items: center; gap: 15px;">
                    <a href="<?php echo e(route('profile.index')); ?>"
                        style="font-size:14.5px; font-weight:700; color:#0F172A;">প্রোফাইল</a>
                    <form action="<?php echo e(route('frontend.logout')); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            style="font-size:13px; font-weight:700; color:#ef4444; cursor: pointer;">লগআউট</button>
                    </form>
                </div>
            <?php else: ?>
                
                <a href="<?php echo e(route('landing.index')); ?>#dashboard"
                    style="font-size:14.5px; font-weight:700; color:#0F172A; padding:10px 20px;">লগইন</a>
                <a href="<?php echo e(route('landing.index')); ?>#refer" class="btn-aiwave-primary">
                    যোগ দিন
                    <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="3" fill="none">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/landing/front/landingNav.blade.php ENDPATH**/ ?>