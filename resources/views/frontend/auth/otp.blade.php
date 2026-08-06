<div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 40px; background-color: #f4f7f6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; border: 1px solid #e0e0e0;">
        <h2 style="color: #003b7a; text-align: center;">Bhaiya Housing</h2>
        <p>হ্যালো,</p>
        <p>
            @if($purpose === 'register')
                Bhaiya Housing-এ রেজিস্ট্রেশন করার জন্য আপনাকে ধন্যবাদ। আপনার একাউন্ট ভেরিফাই করতে নিচের ওটিপি কোডটি ব্যবহার করুন:
            @else
                আপনার পাসওয়ার্ড রিসেট করার জন্য একটি অনুরোধ পাওয়া গেছে। আপনার সিকিউরিটি কোডটি নিচে দেওয়া হলো:
            @endif
        </p>

        <div style="text-align: center; margin: 30px 0;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 10px; color: #C9A227; background-color: #fffcf0; padding: 15px 25px; border: 1px dashed #C9A227; border-radius: 4px;">
                {{ $otp }}
            </span>
        </div>

        <p style="font-size: 13px; color: #777;">এই কোডটি আগামী ১০ মিনিটের জন্য কার্যকর থাকবে। আপনি যদি এই অনুরোধ না করে থাকেন, তবে এই ইমেইলটি ইগনোর করুন।</p>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 11px; color: #aaa; text-align: center;">© 2026 Bhaiya Group. All rights reserved.</p>
    </div>
</div>
