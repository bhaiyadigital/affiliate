<?php $__env->startSection('content'); ?>
<section class="forgot-section" style="padding: 100px 0; background-color: #F6F9FD;">
    <div class="wrap">
        <div class="section-head" style="text-align: center; margin-bottom: 30px;">
            <div class="eyebrow" style="color: #059669; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px;">অ্যাকাউন্ট রিকভারি</div>
            <h2 style="font-size: 32px; font-weight: 900; color: #101B37;">পাসওয়ার্ড রিসেট করুন</h2>
            <p style="color: #64748B; font-size: 14px;">আপনার অ্যাকাউন্টের ইমেইল এড্রেসটি লিখুন, আমরা একটি ওটিপি পাঠাবো।</p>
        </div>

        <div class="auth-shell" style="max-width: 450px; margin: 0 auto; background: #fff; border-radius: 35px; padding: 45px 40px; border: 1px solid #E9F0F8; box-shadow: 0 30px 60px rgba(0, 0, 0, 0.05);">

            <?php if(session('error')): ?>
                <div style="background: #FEF2F2; color: #DC2626; padding: 14px; border-radius: 12px; margin-bottom: 20px; font-size: 13px; font-weight: 600; border: 1px solid #FEE2E2; text-align: center;">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('password.sendOtp')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="auth-field" style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #101B37; margin-bottom: 8px;">ইমেইল এড্রেস</label>
                    <input name="email" type="email" value="<?php echo e(old('email')); ?>" placeholder="example@mail.com"
                           style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> #EF4444 <?php else: ?> #E2E8F0 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>; background: #F8FBFF;" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #EF4444; font-size: 12px; margin-top: 5px; display: block; font-weight: 600;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="auth-submit" style="width: 100%; padding: 16px; background: #007D4F; color: #fff; border-radius: 12px; font-weight: 800; cursor: pointer; border: none; font-size: 16px;">ওটিপি পাঠান</button>
            </form>

            <div style="text-align: center; margin-top: 25px; font-size: 14px; color: #64748B;">
                পাসওয়ার্ড মনে পড়েছে? <a href="<?php echo e(route('affiliated.login.page')); ?>" style="color: #007D4F; font-weight: 700; text-decoration: none;">লগইন করুন</a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.landingFront', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate\resources\views/frontend/auth/forgot-password.blade.php ENDPATH**/ ?>