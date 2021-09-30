<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
     <?php $__env->endSlot(); ?>

    <div class="py-12 px-6">
        <div>
            <div class="grid grid-cols-1 xl:w-1/2 gap-8 mx-auto">
                <form action="<?php echo e(route('organization_projects.update', ['organization_project' => $orgProject])); ?>"
                    class="text-xl text-[#673B8C]" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="bg-[#E5E6E7] mt-3 rounded-xl shadow">
                        <input type="text" name="name" id="name" required
                            class="border-none px-4 py-2  focus:outline-none active:border-none w-full h-full bg-transparent "
                            placeholder="اسم المشروع" value="<?php echo e($orgProject->name); ?>">
                    </div>
                    <?php if(auth()->user()->role->name === 'admin'): ?>
                        <div class="px-4 py-4 bg-[#E5E6E7] rounded-xl mt-3 shadow">
                            <label for="pm_id" class="block mb-3">
                                <?php echo e(__('Project Manager')); ?> <span class="text-red-500">*</span>
                            </label>
                            <select name="pm_id" id="pm_id" class=" border rounded w-full border-gray-400 bg-gray-50"
                                required>
                                <?php $__currentLoopData = \App\Models\User::all()->where('role_id', \App\Models\Role::IS_PROJECT_MANAGER); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php elseif(auth()->user()->role->name==="project_manager"): ?>
                        <div class="px-4 py-4 bg-[#E5E6E7] rounded-xl mt-3 shadow">
                            <label for="pm_id" class="block mb-3">
                                <?php echo e(__('Project Manager')); ?> <span class="text-red-500">*</span>
                            </label>
                            <select name="pm_id" id="pm_id" class=" border rounded w-full border-gray-400 bg-gray-50"
                                required disabled>
                                <?php $__currentLoopData = \App\Models\User::all()->where('role_id', \App\Models\Role::IS_PROJECT_MANAGER); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"
                                        <?php echo e($item->id === auth()->user()->id ? ' selected="selected"' : ''); ?>>
                                        <?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <input type="hidden" name="pm_id" value=<?php echo e(auth()->user()->id); ?> />
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="text-white bg-[#673B8C] mt-5 shadow-xl py-2 px-4 font-bold rounded-xl">
                        تعديل المشروع
                    </button>
                </form>
            </div>
        </div>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/org_project/edit.blade.php ENDPATH**/ ?>