<?php $__env->startSection('content'); ?>
<section class="dashboard-section" style="min-height: 80vh; display: flex; align-items: center; background-color: #F6F9FD;">
    <div class="wrap">
        <div class="auth-shell" style="margin: 0 auto; background: #fff; border-radius: 35px; padding: 40px; box-shadow: 0 30px 60px rgba(0,0,0,0.05); max-width: 450px;">
            <h2 style="text-align: center; margin-bottom: 10px; color: #052e24;">লগইন করুন</h2>
            <p style="text-align: center; color: #64748B; font-size: 14px; margin-bottom: 30px;">আপনার অ্যাফিলিয়েট অ্যাকাউন্টে প্রবেশ করুন</p>

            <form action="<?php echo e(route('affiliated.login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php if($errors->any()): ?>
                    <div style="background: #FEF2F2; color: #DC2626; padding: 12px; border-radius: 10px; margin-bottom: 20px; font-size: 13px;">
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                <div class="auth-field" style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 700; margin-bottom: 8px;">ইমেইল এড্রেস</label>
                    <input name="email" type="email" style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #E2E8F0; background: #F8FAFC;" placeholder="example@mail.com" required>
                </div>

                <div class="auth-field" style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 700; margin-bottom: 8px;">পাসওয়ার্ড</label>
                    <input name="password" type="password" style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #E2E8F0; background: #F8FAFC;" placeholder="••••••••" required>
                </div>

                <button type="submit" class="auth-submit" style="width: 100%; padding: 16px; background: #007D4F; color: #fff; border-radius: 12px; font-weight: 800; border: none; cursor: pointer;">লগইন করুন</button>
            </form>

            <div style="text-align: center; margin-top: 25px; font-size: 14px;">
                নতুন সদস্য? <a href="<?php echo e(route('affiliated.register.page')); ?>" style="color: #007D4F; font-weight: 700;">রেজিস্ট্রেশন করুন</a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.landingFront', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/auth/login.blade.php ENDPATH**/ ?>