<nav x-data="{ open: false }"
    class=" sm:relative absolute left-0 right-0 top-0 bottom-0 w-full md:w-[380px] h-screen border-l border-[#E9EAEB] bg-[#f0f4fb] z-10">
    <!-- Primary Navigation Menu -->
    <div class="w-full flex justify-center p-5">
        <img src="<?php echo e(asset('images/logos.png')); ?>" alt="" srcset="">
    </div>

    <div class="flex w-full px-4 py-4">
        <div
            class="text-white bg-[#72559D] h-10 w-10 place-content-center place-items-center rounded-full grid md:hidden">
            <span class="material-icons" id="hide_sidebar">
                menu_open
            </span>
        </div>
        <div
            class="text-gray-400 h-10 w-10 grid place-content-center place-items-center relative justify-self-end self-end mr-auto">
            <span
                class="animate-ping absolute inline-flex h-3 w-3 top-1 right-1 rounded-full bg-purple-400 opacity-75 notif-ping hidden"></span>
            <span class="absolute inline-flex rounded-full h-3 w-3 top-1 right-1 bg-purple-500 notif-ping hidden"></span>
            <span class="material-icons relative cursor-pointer" id="notification_button">
                notifications
            </span>
            <div class="w-[350px] bg-white border-2 shadow-xl absolute top-10 left-0 hidden p-5" id="notifications">

            </div>
        </div>

    </div>
    <div class="flex flex-col w-full gap-1 p-4 justify-center items-center text-center">
        <div
            class="rounded-full h-[120px] shadow-xl w-[120px] border-2 border-[#71579A] grid place-items-center place-content-center text-4xl font-black text-[#71579A]">
            <div
                class="rounded-full h-[75px] w-[75px] bg-[#F6F8FC] shadow grid place-items-center place-content-center text-3xl font-black text-[#71579A]">
                <?php
                    $words = explode(' ', auth()->user()->name);
                ?>
                <?php echo e(Str::substr($words[0], 0, 1)); ?>

            </div>
        </div>

        <div class="text-2xl font-bold text-[#71579A] mt-5"><?php echo e(auth()->user()->name); ?> </div>
        <span class="text-red-600 text-xl capitalize font-bold "><?php echo e(__(auth()->user()->role->name)); ?></span>
        <?php if(auth()->user()->specialization): ?>
            <span class="text-gray-400 text-xl capitalize font-normal mb-6">
                ( <?php echo e(__(auth()->user()->specialization)); ?> )
            </span>
        <?php endif; ?>
    </div>
    <div class="___class_+?15___">
        <div class="flex flex-col">
            <!-- Navigation Links -->

            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.nav-link','data' => ['href' => ''.e(route('dashboard')).'','active' => request()->routeIs('dashboard')]]); ?>
<?php $component->withName('jet-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['href' => ''.e(route('dashboard')).'','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
                <span class="material-icons ml-6">
                    dashboard
                </span>
                <?php echo e(__('لوحة المعلومات')); ?>

             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\User::class)): ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.nav-link','data' => ['href' => ''.e(route('users.index')).'','active' => request()->routeIs('users.index')]]); ?>
<?php $component->withName('jet-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['href' => ''.e(route('users.index')).'','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('users.index'))]); ?>
                    <span class="material-icons ml-6">
                        people
                    </span>
                    <?php echo e(__('الفريق')); ?>

                 <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            <?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.nav-link','data' => ['href' => ''.e(route('profile.show')).'','active' => request()->routeIs('profile.show')]]); ?>
<?php $component->withName('jet-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['href' => ''.e(route('profile.show')).'','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('profile.show'))]); ?>
                <span class="material-icons ml-6">
                    settings
                </span>
                <?php echo e(__('اعدادات حسابي')); ?>

             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit"
                    class="inline-flex items-center py-6 px-10 text-lg font-bold leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition">
                    <span class="material-icons ml-6">
                        logout
                    </span>
                    <?php echo e(__('تسجيل الخروج')); ?>

                </button>
            </form>
        </div>
    </div>

    <?php $__env->startSection('footerScripts2'); ?>
        <script>
            let isShown = false;
            $('#notification_button').focusout(function(e) {
                $('#notifications').fadeOut();
            });
            $('#notification_button').click(function(e) {
                isShown = !isShown;
                $('#notifications').html('');

                if (isShown) {
                    $('#notifications').fadeIn();
                    get_notifications();
                } else
                    $('#notifications').fadeOut();
            });

            function get_notifications() {
                $.ajax({
                    type: "GET",
                    url: "<?php echo e(route('notifications')); ?>",
                    success: function(notifications) {
                        if (Object.values(notifications).length > 0) {
                            $('.notif-ping').fadeIn();
                        }
                        if (Object.values(notifications).length == 0) {
                            $('#notifications').html('لا يوجد اشعارات');
                        }
                        // console.log(Object.values(notifications));
                        $('#notifications').html('');
                        Object.values(notifications).forEach(notification => {
                            let notiHtml =
                                `<div class="grid grid-cols-6 w-full place-items-center">
                                    <a href="${notification.link}" class="col-span-5">
                                        <p class=" text-black">${notification.body}</p>
                                    </a>
                                    <form class="notif_read_button" data-id="${notification.id}">

                                        <input type="hidden" name="notification_id" value="${notification.id}"/>
                                        <button type="submit"><span class="material-icons">visibility</span></button>
                                    </form>
                                </div>`;
                            $('#notifications').append(notiHtml);
                        });

                    },
                    complete: function() {
                        $('.notif_read_button').submit(function(event) {

                            event.preventDefault();
                            var fd = new FormData();
                            fd.append('notification_id', event.target.notification_id.value);
                            fd.append("_token", "<?php echo e(csrf_token()); ?>");
                            $.ajax({
                                type: "POST",
                                url: "<?php echo e(route('notifications.read')); ?>",
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    console.log('read notification successfuly');
                                }
                            });

                        });
                    }
                });
            }
            get_notifications();
            setInterval(() => {
                get_notifications();
            }, 500);
        </script>
    <?php $__env->stopSection(); ?>
</nav>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/navigation-menu.blade.php ENDPATH**/ ?>