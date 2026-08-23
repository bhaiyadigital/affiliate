<?php $__env->startSection('content'); ?>
<section class="dashboard-section" style="padding: 60px 0; background-color: #F6F9FD;">
    <div class="wrap">
        <div class="auth-shell" style="margin: 0 auto; background: #fff; border-radius: 35px; padding: 40px; box-shadow: 0 30px 60px rgba(0,0,0,0.05); max-width: 500px;">
            <h2 style="text-align: center; font-family: 'Noto Serif Bengali', serif; margin-bottom: 10px; color: #052e24;">রেজিস্ট্রেশন</h2>
            <p style="text-align: center; color: #64748B; font-size: 14px; margin-bottom: 30px;">ভাইয়া হাউজিং অ্যাফিলিয়েট প্রোগ্রামে যোগ দিন</p>

            <form action="<?php echo e(route('affiliated.register')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="auth-field" style="margin-bottom: 15px;">
                    <label style="font-weight: 700; display: block; margin-bottom: 5px;">পূর্ণ নাম</label>
                    <input name="name" type="text" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #E2E8F0;" required>
                </div>

                <div class="auth-field" style="margin-bottom: 15px;">
                    <label style="font-weight: 700; display: block; margin-bottom: 5px;">ইমেইল এড্রেস</label>
                    <input name="email" type="email" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #E2E8F0;" required>
                </div>

                <div class="auth-field" style="margin-bottom: 15px;">
                    <label style="font-weight: 700; display: block; margin-bottom: 5px;">মোবাইল নম্বর</label>
                    <input name="phone" type="tel" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #E2E8F0;" required>
                </div>

                <div class="auth-field" style="margin-bottom: 20px;">
                    <label style="font-weight: 700; display: block; margin-bottom: 5px;">পাসওয়ার্ড</label>
                    <input name="password" type="password" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #E2E8F0;" placeholder="সর্বনিম্ন ৬ ডিজিট" required>
                </div>

                <button type="submit" class="auth-submit" style="width: 100%; padding: 16px; background: #007D4F; color: #fff; border-radius: 12px; font-weight: 800; border: none; cursor: pointer;">অ্যাকাউন্ট তৈরি করুন</button>
            </form>

            <div style="text-align: center; margin-top: 25px; font-size: 14px;">
                ইতিমধ্যে অ্যাকাউন্ট আছে? <a href="<?php echo e(route('affiliated.login.page')); ?>" style="color: #007D4F; font-weight: 700;">লগইন করুন</a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.landingFront', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/auth/register.blade.php ENDPATH**/ ?>