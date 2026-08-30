<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Frontend\BookmarkController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriveUploadController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Frontend\FrontendAuthController;
use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Frontend\TicketController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DownloadLogController;
use App\Http\Controllers\Frontend\LeadController;
use App\Http\Controllers\WebController;
use Google\Service\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage as FacadesStorage;

// dashboard pages

Route::get('/test-drive', function () {
    FacadesStorage::disk('google_drive')->write('test.txt', 'Hello from Laravel!');
    return 'Upload success!';
});

Route::get('/create-storage-link', function () {

    $target = storage_path('app/public');
    $link = public_path('storage');

    if (file_exists($link)) {
        return "Storage link already exists.";
    }

    File::link($target, $link);

    return "Storage link created successfully.";
});
Route::middleware('guest')->group(function () {
    Route::get('/admin-login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/admin-login', [AuthController::class, 'login']);
});
Route::get('/fix-media-paths', function () {
    $medias = \App\Models\AssetMedia::where('file_path', 'not like', 'drive:%')
        ->where('file_path', 'not like', 'http%')
        ->get();

    foreach ($medias as $media) {
        $mime    = $media->mime_type ?? '';
        $isLocal = str_starts_with($mime, 'image');

        // Video হলে drive: prefix যোগ করো
        if (!$isLocal) {
            $media->update(['file_path' => 'drive:' . $media->file_path]);
            echo "Fixed: {$media->id} → drive:{$media->file_path} <br>";
        }
    }

    return 'Done!';
})->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ── Admin ────────────────────────────────────────────────────────────
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware([
        'index'   => 'permission:dashboard.view',
    ]);

    Route::prefix('contents/{module}')->name('contents.')->group(function () {
        Route::post('/bulk',                    [ContentController::class, 'bulk'])->name('bulk');
        Route::get('/',                         [ContentController::class, 'index'])->name('index');
        Route::get('/create',                   [ContentController::class, 'create'])->name('create');
        Route::post('/',                        [ContentController::class, 'store'])->name('store');
        Route::post('/upload-image',            [ContentController::class, 'uploadImage'])->name('upload-image');
        Route::get('/{id}/edit',                [ContentController::class, 'edit'])->name('edit');
        Route::put('/{id}',                     [ContentController::class, 'update'])->name('update');
        Route::patch('/{id}/restore',           [ContentController::class, 'restore'])->name('restore');
        Route::patch('/{id}/toggle-status',     [ContentController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/reorder',                 [ContentController::class, 'reorder'])->name('reorder');
        Route::delete('/{id}/remove-image',     [ContentController::class, 'removeImage'])->name('remove-image');
        Route::patch('/{id}/trash',             [ContentController::class, 'trash'])->name('trash');
        Route::delete('/{id}',                  [ContentController::class, 'destroy'])->name('destroy');
    });

    Route::post('contents/generate-slug', [ContentController::class, 'generateSlug'])->name('contents.generate-slug');

    Route::prefix('leads')->name('admin.leads.')->group(function () {
        Route::get('/',                 [LeadController::class, 'index'])->name('index');
        Route::get('/{id}/edit',        [LeadController::class, 'edit'])->name('edit');
        Route::put('/{id}',             [LeadController::class, 'update'])->name('update');
        Route::patch('/{id}/status',    [LeadController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{id}',          [LeadController::class, 'destroy'])->name('destroy');
    });
    Route::post('leads/{lead}/commission', [LeadController::class, 'addCommission'])->name('admin.leads.commission.store');
    Route::resource('asset-types', AssetTypeController::class)
        ->middleware([
            'index'   => 'permission:asset-types.view',
            'create'  => 'permission:asset-types.create',
            'store'   => 'permission:asset-types.create',
            'edit'    => 'permission:asset-types.edit',
            'update'  => 'permission:asset-types.edit',
            'destroy' => 'permission:asset-types.delete',
        ]);
    Route::resource('campaigns', CampaignController::class)
        ->middleware([
            'index'   => 'permission:campaigns.view',
            'create'  => 'permission:campaigns.create',
            'store'   => 'permission:campaigns.create',
            'edit'    => 'permission:campaigns.edit',
            'update'  => 'permission:campaigns.edit',
            'destroy' => 'permission:campaigns.delete',
        ]);

    Route::resource('assets', AssetController::class)
        ->middleware([
            'index'   => 'permission:assets.view',
            'create'  => 'permission:assets.create',
            'store'   => 'permission:assets.create',
            'edit'    => 'permission:assets.edit',
            'update'  => 'permission:assets.edit',
            'destroy' => 'permission:assets.delete',
        ]);
    Route::post('/assets/sort', [AssetController::class, 'sort'])->name('assets.sort');

    Route::delete('asset-media/{media}', [AssetController::class, 'destroyMedia'])
        ->name('asset-media.destroy')
        ->middleware('permission:assets.edit');
    Route::delete('asset/delete-media/{media}', [AssetController::class, 'destroyAsssetMedia'])
        ->name('asset.delete.media.destroy')
        ->middleware('permission:assets.edit');
    Route::post('/assets/media/upload-image', [AssetController::class, 'uploadImageImmediate'])
        ->name('assets.media.upload-image');
    Route::post('/assets/media/delete-temp-image', [AssetController::class, 'deleteTempImage'])
        ->name('assets.media.delete-temp-image')
        ->middleware('auth');

    Route::resource('roles', RoleController::class)->except(['show'])
        ->middleware([
            'index'   => 'permission:roles.view',
            'create'  => 'permission:roles.create',
            'store'   => 'permission:roles.create',
            'edit'    => 'permission:roles.edit',
            'update'  => 'permission:roles.edit',
            'destroy' => 'permission:roles.delete',
        ]);
    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::resource('users', UserController::class)
        ->middleware([
            'index'   => 'permission:users.view',
            'show'    => 'permission:users.view',
            'create'  => 'permission:users.create',
            'store'   => 'permission:users.create',
            'edit'    => 'permission:users.edit',
            'update'  => 'permission:users.edit',
            'destroy' => 'permission:users.delete',
        ]);

    Route::get('activity-logs', [ActivityLogController::class, 'index'])
        ->name('activity-logs.index')
        ->middleware('permission:activity_logs.view');

    Route::get('tickets', [TicketController::class, 'list'])->name('ticket.admin');
    Route::get('tickets/{ticket}', [TicketController::class, 'showAdmin'])->name('admin.tickets.show');
    Route::post('tickets/{ticket}/reply', [TicketController::class, 'adminReply'])->name('admin.tickets.reply');
    Route::delete('tickets/{ticket}', [TicketController::class, 'destroy'])->name('admin.tickets.destroy');
});
Route::prefix('')->group(function () {

    Route::get('/affiliated/login', [HomeController::class, 'showLoginForm'])->name('affiliated.login.page');
    Route::get('/affiliated/register', [HomeController::class, 'showRegisterForm'])->name('affiliated.register.page');
    Route::get('/', [HomeController::class, 'landing'])->name('landing.index');
    Route::get('/home', [HomeController::class, 'landing'])->name('home.index');



    Route::get('/register', [FrontendAuthController::class, 'showSignin'])->name('signin');
    Route::post('/register', [FrontendAuthController::class, 'register'])->name('affiliated.register');
    Route::get('/forgot-password', [FrontendAuthController::class, 'sendReset'])->name('password.request');
    Route::post('/forgot-password', [FrontendAuthController::class, 'sendResetOtp'])->name('password.sendOtp');
    Route::get('/resend-otp', [FrontendAuthController::class, 'resendOtp'])->name('otp.resend');
    Route::get('/cancel-auth', [FrontendAuthController::class, 'cancelAuth'])->name('otp.cancel');
    Route::get('/verify-otp', [FrontendAuthController::class, 'verifyOtpForm'])->name('verify.otp');
    Route::post('/verify-otp-unified', [FrontendAuthController::class, 'verifyOtp'])->name('otp.verify.submit');
    Route::post('/update-password-final', [FrontendAuthController::class, 'finalPasswordUpdate'])->name('password.update.final');
    Route::post('/affiliated-login', [FrontendAuthController::class, 'affiliatedLogin'])->name('affiliated.login');
    Route::post('/lead-store', [LeadController::class, 'storeLead'])->name('lead.store');
    Route::get('/projects', [WebController::class, 'project'])->name('affiliated.project');
    Route::get('/project/{slug}', [WebController::class, 'details'])->name('affiliated.project.details');
    Route::post('/coupon/check', [WebController::class, 'check'])->name('coupon.check');

    Route::middleware('auth')->group(function () {
        Route::get('/go-to-portal', [FrontendAuthController::class, 'portalRedirect'])->name('portal.redirect');
        Route::post('/contact-store', [WebController::class, 'contactStore'])->name('contact.store');
        Route::put('/leads/{lead}', [LeadController::class, 'updateLead'])->name('lead.update');
        Route::delete('/leads/{lead}', [LeadController::class, 'destroyLead'])->name('lead.destroy');
        Route::post('/coupons/store', [LeadController::class, 'storeCoupon'])->name('coupons.store');
        Route::put('/coupons/update/{id}', [LeadController::class, 'updateCoupon'])->name('coupons.update');
        Route::delete('/coupons/delete/{slug}', [LeadController::class, 'destroyCoupon'])->name('coupons.destroy');
        Route::put('/team/update/{id}', [FrontendAuthController::class, 'updateMember'])->name('team.member.update');

        Route::get('/profile/{tab?}', [FrontendAuthController::class, 'index'])->where('tab', 'dashboard|profile|leads|team|coupons|history')->name('profile.index');
        Route::put('/profile/update', [FrontendAuthController::class, 'update'])->name('profile.update');
        Route::get('/assets/{asset:slug}/edit-content', [AssetController::class, 'editContent'])
            ->name('assets.edit-content');
        Route::get('/drive/media/{media}/base64', [FileController::class, 'base64Image'])
            ->name('drive.media.base64');





        Route::get('/campaign/{slug}', [HomeController::class, 'campaignDetails'])->name('campaign.details');
        Route::get('/asset/{slug}', [HomeController::class, 'assetdetails'])->name('asset.details');
        Route::get('/assets', [HomeController::class, 'filter'])->name('home.filter');
        Route::post('frontend/logout', [FrontendAuthController::class, 'logout'])->name('frontend.logout');
        Route::get('/drive/file/{type}/{id}', [FileController::class, 'stream'])
            ->name('drive.file.stream');
        Route::get('/drive/media/{media}', [FileController::class, 'streamMedia'])
            ->name('drive.media.stream');
        Route::post('/assets/media/{media}/process-video', [FileController::class, 'processVideo'])
            ->name('assets.media.process-video')
            ->middleware('auth');



        Route::get('/download-logs', [DownloadLogController::class, 'index'])->name('download-logs.index');

        Route::post('/drive/bulk-download', [FileController::class, 'bulkDownload'])->name('drive.bulkDownload');
        Route::get('/brand', [HomeController::class, 'brand'])->name('brand.index');
        Route::post('/bookmark', [BookmarkController::class, 'toggle'])->name('bookmark.toggle');
        Route::get('/bookmark-list', [BookmarkController::class, 'list'])->name('bookmark.list');
        Route::post('/notification/{notification}/read', [NotificationController::class, 'markRead'])->name('notification.read');
        Route::post('/notification/read-all', [NotificationController::class, 'markAllRead'])->name('notification.readAll');

        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
        Route::post('/tickets/{ticket}/reply', [TicketController::class, 'reply'])->name('tickets.reply');
        Route::post('/tickets/{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');
    });

    Route::get('settings', [SiteSettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');


    Route::post('/drive/upload/session', [DriveUploadController::class, 'createUploadSession'])
        ->name('drive.upload.session');

    Route::post('/drive/upload/complete', [DriveUploadController::class, 'completeUpload'])
        ->name('drive.upload.complete');
    Route::post('/drive/upload/resolve', [DriveUploadController::class, 'resolveFileId'])
        ->name('drive.upload.resolve');

    Route::get('/assets/{asset}/video/{media}/download', [FileController::class, 'downloadVideo'])
        ->name('assets.video.download')
        ->middleware('auth');
});
Route::fallback(function () {
    return redirect()->route('landing.index');
});
