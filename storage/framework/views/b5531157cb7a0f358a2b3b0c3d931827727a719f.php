<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
     <?php $__env->endSlot(); ?>

    <div class="p-6">
        <div class="flex w-full mb-10 font-bold">
            <h1 class="text-3xl text-[#673B8c] drop-shadow-lg">
                <a href="<?php echo e(route('organization_projects.show', $area->project)); ?>"
                    class="text-gray-600 hover:text-[#FCB634]"><?php echo e($area->project->name); ?> /</a>
                <?php echo e($area->area->name); ?>

            </h1>
            <hr class="flex-grow my-auto mr-5 border-[#FCB634] border-2 shadow-xl">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 w-full gap-10">
            <?php $__currentLoopData = $area->cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <form action="<?php echo e(route('show_projects')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="area_id" value="<?php echo e($area->id); ?>">
                    <input type="hidden" name="city_id" value="<?php echo e($city->id); ?>">
                    <button type="submit"
                        class="p-5 border-4 max-h-[150px] min-h-[150px] rounded cursor-pointer bg-[#F0F0F7] flex justify-center hover:scale-105 hover:shadow-2xl transition duration-150 relative w-full">
                        <span class="my-auto mx-auto text-gray-800 font-bold text-2xl flex">
                            <?php echo e($city->name); ?>

                        </span>
                        <?php if($city->projects->where('status', '!=', 'done_5')->count() > 0): ?>
                            <span
                                class="absolute -top-5 -left-5 rounded-full bg-[#673B8c] text-white w-10 h-10 flex justify-center text-center">
                                <span
                                    class="my-auto"><?php echo e($city->projects->where('status', '!=', 'done_5')->count()); ?></span>
                                <span
                                    class="bg-[#673B8C] rounded-full animate-ping w-2/3 h-2/3 my-auto mx-auto top-0 bottom-0 left-0 right-0 absolute z-0"></span>
                            </span>
                        <?php endif; ?>
                    </button>
                </form>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(auth()->user()->role_id == \App\Models\Role::IS_ADMIN || auth()->user()->role_id == \App\Models\Role::IS_PROJECT_MANAGER || auth()->user()->role_id == \App\Models\Role::IS_DEPUTY_PROJECT_MANAGER): ?>
                <div id="showAddCity"
                    class="border-4 p-5 border-dashed max-h-[150px] min-h-[150px] rounded cursor-pointer bg-[#F0F0F7] flex justify-center transition-all duration-150 hover:shadow-xl hover:scale-105">
                    <span class="my-auto mx-auto text-green-500 font-bold text-2xl flex">
                        <span class="material-icons my-auto scale-110">add</span>
                        <span>إضافة مدينة</span>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php echo $__env->make('org_project.modals.addCity', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/area/show.blade.php ENDPATH**/ ?>