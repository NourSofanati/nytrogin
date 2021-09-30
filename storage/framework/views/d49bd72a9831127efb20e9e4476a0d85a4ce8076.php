<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Create a new user')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="p-12">
        <div class="gap-4 grid grid-cols-3">
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $role)): ?>
                    <div class="text-lg bg-white border-2 rounded-xl p-5 text-gray-700  font-semibold">
                        <h1 class="text-xl font-bold text-[#673B8C]">
                            <?php echo e(__($role->name)); ?>

                        </h1>
                        <?php $__currentLoopData = $role->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $user)): ?>
                                <a href="<?php echo e(route('users.edit', $user)); ?>">
                                    <li><?php echo e($user->name); ?></li>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php if(auth()->user()->role_id == \App\Models\Role::IS_ADMIN || auth()->user()->role_id == \App\Models\Role::IS_PROJECT_MANAGER || auth()->user()->role_id == \App\Models\Role::IS_DEPUTY_PROJECT_MANAGER): ?>
            <div class="flex mt-5">
                <a href="<?php echo e(route('users.create')); ?>"
                    class="bg-[#673B8C] rounded-xl shadow-md text-xl flex py-2 px-4 text-white font-bold mb-4">إنشاء حساب
                    جديد</a>
            </div>
        <?php endif; ?>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/users/index.blade.php ENDPATH**/ ?>