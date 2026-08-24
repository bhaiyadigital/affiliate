 
<?php
    use App\Helpers\MenuHelper;

    $menuGroups = MenuHelper::getMenuGroups();

    // Get current path
    $currentPath = '/' . request()->path();
    $siteSetting = \App\Models\SiteSetting::first();
?>

<aside id="sidebar"
    class="fixed flex flex-col mt-0 top-0 px-5 left-0 bg-white dark:bg-gray-900 dark:border-gray-800 text-gray-900 h-screen transition-all duration-300 ease-in-out z-99999 border-r border-gray-200">

    <!-- Logo Section -->
    <div class="pt-8 pb-7 flex"
        :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen)
            ? 'xl:justify-center'
            : 'justify-start'">

        <a href="<?php echo e(route('dashboard')); ?>">

            
            <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                class="flex items-center gap-2">

                <img src="/logo.png"
                    alt="<?php echo e($siteSetting->site_name); ?>"
                    class="h-[50px]" />

            </span>

            
            <span x-show="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen">

                <img src="/favicon.ico"
                    alt="<?php echo e($siteSetting->site_name); ?>"
                    class="w-8 h-8 object-contain" />

            </span>

        </a>
    </div>

    <!-- Navigation Menu -->
    <div class="flex flex-col overflow-y-auto duration-300">

        <nav class="mb-6">
            <div class="flex flex-col gap-4">

              <?php $__currentLoopData = $menuGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupIndex => $menuGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div
        x-data="{ open: true }"
        class="mb-3"
    >

        
        <button
            @click="open = !open"
            class="w-full flex items-center justify-between px-2 mb-2 group"
        >
            <span
                x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500"
            >
                <?php echo e($menuGroup['title']); ?>

            </span>

            <svg
                x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                class="w-4 h-4 text-gray-400 transition-transform duration-200"
                :class="open ? 'rotate-180' : ''"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7"
                />
            </svg>
        </button>


        
        <ul
            x-show="open"
            x-collapse
            class="flex flex-col gap-1"
        >

            <?php $__currentLoopData = $menuGroup['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
                    $itemPath = $item['path'] ?? '';

                    $isItemActive =
                        MenuHelper::isActive($itemPath);
                ?>

                <li>

                    <a
                        href="<?php echo e($itemPath); ?>"
                        class="menu-item group
                            <?php echo e($isItemActive
                                ? 'menu-item-active'
                                : 'menu-item-inactive'); ?>"

                        :class="[
                            (!$store.sidebar.isExpanded &&
                            !$store.sidebar.isHovered &&
                            !$store.sidebar.isMobileOpen)
                                ? 'xl:justify-center'
                                : 'justify-start'
                        ]"
                    >

                        
                        <span
                            class="menu-item-icon
                                <?php echo e($isItemActive
                                    ? 'menu-item-icon-active'
                                    : 'menu-item-icon-inactive'); ?>"
                        >
                            <?php echo MenuHelper::getIconSvg($item['icon']); ?>

                        </span>


                        
                        <span
                            x-show="$store.sidebar.isExpanded ||
                                    $store.sidebar.isHovered ||
                                    $store.sidebar.isMobileOpen"
                            class="menu-item-text"
                        >
                            <?php echo e($item['name']); ?>

                        </span>

                    </a>

                </li>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>

    </div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </nav>

        <!-- Sidebar Widget -->
        <div
            x-data
            x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
            x-transition
            class="mt-auto">

            <?php echo $__env->make('layouts.sidebar-widget', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        </div>

    </div>

</aside>

<!-- Mobile Overlay -->
<div
    x-show="$store.sidebar.isMobileOpen"
    @click="$store.sidebar.setMobileOpen(false)"
    class="fixed z-50 h-screen w-full bg-gray-900/50">
</div>
 
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>