<?php $__env->startSection('content'); ?>
    <div class="p-4 mx-auto w-full md:p-6">
        
        <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-6">
            <a href="<?php echo e(route('contents.index', $module)); ?>" class="hover:text-gray-700 capitalize"><?php echo e($module); ?>

                List</a>
            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
            </svg>
            <span class="text-gray-700 dark:text-gray-300 font-medium"><?php echo e(isset($content) ? 'Edit' : 'Create'); ?>

                <?php echo e(ucfirst($module)); ?></span>
        </nav>

        <form
            action="<?php echo e(isset($content) ? route('contents.update', [$module, $content->id]) : route('contents.store', $module)); ?>"
            method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php if(isset($content)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- ── LEFT SIDE: Main Content (Col 8) ── -->
                <div class="lg:col-span-8 space-y-6">
                    <div
                        class="rounded-xl border-t-4 border-t-green-500 border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-white/[0.03]">
                        <h3 class="text-lg font-bold mb-5 text-gray-800 dark:text-white capitalize"><?php echo e($module); ?>

                            Details</h3>

                        
                        <?php echo $__env->make('contents._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>

                <!-- ── RIGHT SIDE: Sidebar (Col 4) ── -->
                <div class="lg:col-span-4">
                    <div class="sticky top-24 space-y-6">
                        <div
                            class="rounded-xl border-t-4 border-t-blue-500 border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-white/[0.03]">
                            <h3 class="text-md font-bold mb-4 text-gray-800 dark:text-white">Settings & SEO</h3>

                            
                            <?php echo $__env->yieldContent('form_sidebar'); ?>

                            <div class="mt-6 space-y-3">
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-green-600 px-5 py-3 text-sm font-bold text-white hover:bg-green-700 transition-colors shadow-md">
                                    <i class="fas fa-save"></i> <?php echo e(isset($content) ? 'UPDATE' : 'SAVE'); ?> RECORD
                                </button>
                                <a href="<?php echo e(route('contents.index', $module)); ?>"
                                    class="w-full inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <!-- ১. Summernote Lite CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <style>
        /* --- ১. Tailwind Fix: Heading & Lists --- */
        .note-editable h1 {
            font-size: 2.25rem !important;
            font-weight: 800 !important;
            display: block !important;
        }

        .note-editable h2 {
            font-size: 1.875rem !important;
            font-weight: 700 !important;
            display: block !important;
        }

        .note-editable ul {
            list-style-type: disc !important;
            padding-left: 2rem !important;
            display: block !important;
        }

        .note-editable ol {
            list-style-type: decimal !important;
            padding-left: 2rem !important;
            display: block !important;
        }

        .note-editable li {
            display: list-item !important;
        }

        /* --- ২. কালার প্যালেট ফিক্স (পাওয়ারফুল সিএসএস) --- */
        .note-color-btn {
            width: 20px !important;
            height: 20px !important;
            display: inline-block !important;
            border: 1px solid #ddd !important;
            margin: 1px !important;
            background-image: none !important;
            /* Tailwind Gradient ফিক্স */
        }

        /* ড্রপডাউন মেনু ব্যাকগ্রাউন্ড */
        .note-color-all .note-dropdown-menu {
            min-width: 345px !important;
            background-color: #ffffff !important;
            padding: 12px !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3) !important;
            border: 1px solid #ddd !important;
        }

        /* প্রিভিউ বার (আইকনের নিচে যে বার থাকে) */
        .note-recent-color {
            width: 100% !important;
            height: 3px !important;
            background-color: inherit !important;
            border: 1px solid #ddd !important;
        }

        .note-color-row {
            display: flex !important;
            height: 22px !important;
        }

        #tag-tooltip {
            position: fixed;
            background: #1e293b;
            color: #fff;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-family: monospace;
            pointer-events: none;
            z-index: 999999;
            display: none;
        }
    </style>

    <script>
        $(document).ready(function() {
            // ১. স্ল্যাগ জেনারেটর
            function slugify(text) {
        return text.toString().toLowerCase().trim()
            .replace(/&/g, '-and-')         // & কে -and- করবে
            .replace(/[\s\W-]+/g, '-')      // স্পেস এবং স্পেশাল ক্যারেক্টারকে - করবে
            .replace(/^-+|-+$/g, '');       // শুরুতে বা শেষে - থাকলে ফেলে দিবে
    }

    // টাইটেল লিখলে স্ল্যাগ ফিল্ডে অটো ফিল হবে
    $(document).on('keyup', '#title', function() {
        // শুধুমাত্র তখনই স্ল্যাগ অটো হবে যখন স্লাগ ফিল্ডটি আগে থেকে এডিট করা হয়নি (Optional logic)
        $('#slug').val(slugify($(this).val()));
    });

            // ২. Summernote Initialize
            $('.editor').summernote({
                height: 300,
                tabsize: 2,
                dialogsInBody: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'fontname', 'fontsize', 'color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                styleTags: ['p', 'blockquote', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6']
            });


            $(document).on('click', '.note-btn', function() {
                var $this = $(this);

                // একটু অপেক্ষা করে যাতে ড্রপডাউন লোড হয়
                setTimeout(function() {
                    // প্রতিটি কালার বাটন খুঁজে বের করা
                    $('.note-color-btn').each(function() {
                        var color = $(this).attr(
                        'data-value'); // এখানে কালার কোড থাকে (যেমন #ff0000)
                        if (color) {
                            // সরাসরি ইনলাইন স্টাইলে জোর করে কালার বসানো (এটি Tailwind আটকাতে পারবে না)
                            this.style.setProperty('background-color', color, 'important');
                        }
                    });

                    // আইকনের নিচের বারটি রঙিন করা
                    $('.note-recent-color').each(function() {
                        var recentColor = $(this).parent().parent().attr(
                            'data-backcolor') ||
                            $(this).parent().parent().attr('data-forecolor') ||
                            '#000';
                        this.style.setProperty('background-color', recentColor,
                        'important');
                    });
                }, 50);
            });

            // ৪. Floating Tag Tooltip
            const $tooltip = $('<div id="tag-tooltip"></div>');
            $('body').append($tooltip);

            $('.editor').on('summernote.keyup summernote.mouseup', function() {
                updateFloatingTag();
            });

            function updateFloatingTag() {
                const selection = window.getSelection();
                if (!selection || selection.rangeCount === 0) return;
                let node = selection.anchorNode;
                if (node.nodeType === 3) node = node.parentNode;
                let tagName = "";
                let current = node;
                while (current && !$(current).hasClass('note-editable')) {
                    const tag = current.tagName ? current.tagName.toLowerCase() : '';
                    if (['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'li', 'blockquote', 'strong', 'span'].includes(
                            tag)) {
                        tagName = tag.toUpperCase();
                        break;
                    }
                    current = current.parentNode;
                }
                if (tagName) {
                    $tooltip.html(`&lt;${tagName}&gt;`).css({
                        display: 'block',
                        position: 'fixed',
                        left: (window.event ? window.event.clientX + 15 : 100) + 'px',
                        top: (window.event ? window.event.clientY - 30 : 100) + 'px'
                    });
                } else {
                    $tooltip.hide();
                }
                clearTimeout(window._tTimer);
                window._tTimer = setTimeout(() => $tooltip.fadeOut(), 1500);
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\affiliate-project\resources\views/contents/create.blade.php ENDPATH**/ ?>