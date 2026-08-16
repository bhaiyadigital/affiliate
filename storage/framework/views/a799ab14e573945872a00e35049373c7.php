<?php $__env->startSection('content'); ?>

    <style>
        .auth-page {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .auth-shell {
            max-width: 420px;
            width: 100%;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: var(--shadow);
        }
    </style>

    <div class="auth-page">
        <div class="auth-shell">
            <div style="text-align: center; margin-bottom: 25px;">
                <h3 style="font-family: var(--serif); font-size: 22px; color: var(--gold-light); margin-bottom: 10px;">
                    <?php echo e(session('can_reset_password') ? 'নতুন পাসওয়ার্ড' : 'ভেরিফিকেশন'); ?>

                </h3>
                <p style="font-size: 13px; color: var(--muted);">
                    <b><?php echo e(session('verify_email')); ?></b> ঠিকানায় কোড পাঠানো হয়েছে।
                </p>
            </div>

            <?php if(session('success')): ?>
                <div
                    style="background:rgba(143,224,166,0.1); border:1px solid #8FE0A6; color:#8FE0A6; padding:10px; border-radius:8px; margin-bottom:15px; font-size:13px; text-align:center;">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div
                    style="background:rgba(255,132,132,0.1); border:1px solid #ff8484; color:#ff8484; padding:10px; border-radius:8px; margin-bottom:15px; font-size:13px; text-align:center;">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('can_reset_password')): ?>
                
                <form action="<?php echo e(route('password.update.final')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="auth-field" style="margin-bottom:15px;">
                        <label style="font-size:12px; color:var(--muted); display:block; margin-bottom:5px;">নতুন
                            পাসওয়ার্ড</label>
                        <input name="password" type="password" placeholder="সর্বনিম্ন ৬ ডিজিট" required
                            style="width:100%; background:var(--bg-alt); border:1px solid var(--line); padding:12px; border-radius:9px; color:var(--cream); outline:none;">
                    </div>
                    <div class="auth-field" style="margin-bottom:20px;">
                        <label style="font-size:12px; color:var(--muted); display:block; margin-bottom:5px;">পাসওয়ার্ড
                            নিশ্চিত করুন</label>
                        <input name="password_confirmation" type="password" placeholder="আবার লিখুন" required
                            style="width:100%; background:var(--bg-alt); border:1px solid var(--line); padding:12px; border-radius:9px; color:var(--cream); outline:none;">
                    </div>
                    <button type="submit" class="auth-submit"
                        style="width:100%; background: var(--gold); border:none; padding:14px; border-radius:9px; font-weight:700; cursor:pointer; color:#17281f;">পাসওয়ার্ড
                        আপডেট করুন</button>
                </form>
            <?php else: ?>
                
                <form action="<?php echo e(route('otp.verify.submit')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="auth-field" style="margin-bottom:15px;">
                        <input name="otp" type="text" placeholder="------" maxlength="6" required autofocus
                            style="text-align:center; letter-spacing:10px; font-size:32px; font-weight:900; background:var(--bg-alt); color:var(--gold-light); border:1px solid var(--line); width:100%; padding:15px; border-radius:9px; outline:none;">
                    </div>

                    
                    <div id="otp-timer-container"
                        style="text-align: center; margin-bottom: 20px; font-size: 14px; color: var(--gold-light);">
                        কোডটির মেয়াদ আছে: <span id="countdown"
                            style="font-weight: bold; font-family: monospace;">--:--</span>
                    </div>

                    <button type="submit" class="auth-submit"
                        style="width:100%; background: var(--gold); border:none; padding:14px; border-radius:9px; font-weight:700; cursor:pointer; color:#17281f;">ভেরিফাই
                        করুন</button>

                    <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                        <a href="<?php echo e(route('otp.resend')); ?>"
                            style="font-size: 13px; color: var(--muted); text-decoration: none;">আবার পাঠান</a>
                        <a href="<?php echo e(route('otp.cancel')); ?>"
                            style="font-size: 13px; color: #ff8484; text-decoration: none;">বাতিল করুন</a>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const expiresAtStr = "<?php echo e($expiresAt); ?>";
            if (!expiresAtStr || document.getElementById('countdown') === null) return;

            const countdownElement = document.getElementById('countdown');
            const timerContainer = document.getElementById('otp-timer-container');
            const expiryTime = new Date(expiresAtStr).getTime();

            const englishToBangla = { '0': '০', '1': '১', '2': '২', '3': '৩', '4': '৪', '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯' };

            function formatToBangla(input) {
                return input.toString().replace(/\d/g, m => englishToBangla[m]);
            }

            const timer = setInterval(function () {
                const now = new Date().getTime();
                const distance = expiryTime - now;

                if (distance < 0) {
                    clearInterval(timer);
                    countdownElement.innerHTML = "মেয়াদ শেষ";
                    countdownElement.style.color = "#ff8484";
                    return;
                }

                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                const minStr = minutes < 10 ? "0" + minutes : minutes;
                const secStr = seconds < 10 ? "0" + seconds : seconds;

                countdownElement.innerHTML = formatToBangla(minStr) + ":" + formatToBangla(secStr);
            }, 1000);
        });
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.layouts.landingFront', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate-project\resources\views/frontend/landing/verifyOtp.blade.php ENDPATH**/ ?>