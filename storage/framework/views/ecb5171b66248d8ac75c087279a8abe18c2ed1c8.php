<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'relative']); ?>
     <?php $__env->slot('header'); ?> 
     <?php $__env->endSlot(); ?>

    <div class="py-6 px-6">

        <div class="flex w-full mb-10 font-bold">
            <h1 class="text-3xl text-[#673B8c] drop-shadow-lg"><?php echo e($orgProject->name); ?>

                <?php if(auth()->user()->role->name == 'admin'): ?>
                    <a href="<?php echo e(route('organization_projects.edit', $orgProject)); ?>"><span
                            class="material-icons">edit</span></a>
                <?php endif; ?>
            </h1>
            <hr class="flex-grow my-auto mr-5 border-[#FCB634] border-2 shadow-xl">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 w-full gap-10">
            <div class="bg-[#683b8c] px-5 py-8 text-white text-2xl rounded-lg border-[#FCB634] shadow-lg hover:scale-105 hover:shadow-2xl transition duration-150 cursor-pointer"
                id="showNewProjects">
                <div class="flex">
                    <span class="material-icons my-auto ml-2 text-[#FCB634] scale-110 ">post_add</span>
                    <span class="font-bold my-auto">المهام الجديدة : <?php echo e($newProjects->count()); ?></span>
                </div>
                <div class="flex">

                </div>
            </div>
            <div class="bg-[#683b8c] px-5 py-8 text-white text-2xl rounded-lg border-[#FCB634] shadow-lg hover:scale-105 hover:shadow-2xl transition duration-150 cursor-pointer"
                id="showInProgressProjects">
                <div class="flex">
                    <span class="material-icons my-auto ml-2 text-[#FCB634] scale-110 ">alarm</span>
                    <span class="font-bold">مهام قيد الإنجاز : <?php echo e($inProgressProjects->count()); ?></span>
                </div>
                <div class="flex">

                </div>
            </div>
            <div class="bg-[#683b8c] px-5 py-8 text-white text-2xl rounded-lg border-[#FCB634] shadow-lg hover:scale-105 hover:shadow-2xl transition duration-150 cursor-pointer"
                id="showCompletedProjects">
                <div class="flex">
                    <span class="material-icons my-auto ml-2 text-[#FCB634] scale-110 ">verified</span>
                    <span class="font-bold">المهام المنجزة : <?php echo e($completedProjects->count()); ?></span>
                </div>
                <div class="flex">

                </div>
            </div>
        </div>

        <div class="flex gap-4 flex-col mt-8  text-xl font-bold">
            <div class="bg-[#673e890a] p-5 flex border-2 rounded-md shadow-inner">
                <span class="material-icons my-auto ml-2 text-green-500 scale-110">person</span>
                <span>مدير المشروع: <?php echo e($orgProject->manager->name); ?></span>
                <?php if(auth()->user()->role->name == 'admin'): ?>
                    ,&nbsp;<a href=""
                        class="text-green-500 hover:text-green-600 hover:drop-shadow-xl transition-all duration-100 ">إعادة
                        تعيين مدير مشروع</a>
                <?php endif; ?>
            </div>
            <div class="bg-[#673e890a] p-5 flex border-2 rounded-md shadow-inner">
                <?php if($orgProject->deputyManager): ?>
                    <span class="material-icons my-auto ml-2 text-green-500 scale-110">person</span>
                    <span>نائب مدير المشروع: <?php echo e($orgProject->deputyManager->name); ?></span>
                    <?php if(auth()->user()->role->name == 'admin' || $orgProject->manager->id == auth()->user()->id): ?>
                        &nbsp;, <span id="showAssignDeputy"
                            class="text-green-500 hover:text-green-600 cursor-pointer hover:drop-shadow-xl transition-all duration-100 ">إعادة
                            تعيين
                            نائب مدير مشروع</span>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="material-icons text-[#ff611d] my-auto ml-2">warning</span>
                    <span>لا يوجد نائب مدير للمشروع
                        <?php if(auth()->user()->role->name == 'admin' || $orgProject->manager->id == auth()->user()->id): ?>
                            , <span id="showAssignDeputy"
                                class="text-green-500 hover:text-green-600 cursor-pointer hover:drop-shadow-xl transition-all duration-100 ">تعيين
                                نائب مدير مشروع</span>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <hr class="my-10">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 w-full gap-10">
            <?php $__empty_1 = true; $__currentLoopData = $orgProject->areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $area)): ?>
                    <a href="<?php echo e(route('area.show', $area)); ?>"
                        class="p-5 relative border-4 max-h-[150px] min-h-[150px] rounded cursor-pointer bg-[#F0F0F7] flex justify-center hover:scale-105 hover:shadow-2xl transition duration-150">
                        <span class="my-auto mx-auto text-gray-800 font-bold text-2xl flex">
                            <span><?php echo e($area->area->name); ?></span>
                        </span>
                        <?php if($area->projects->where('status', '!=', 'done_5')->count() > 0): ?>
                            <span
                                class="absolute -top-5 -left-5 rounded-full bg-[#673B8c] text-white w-10 h-10 flex justify-center text-center">
                                <span class="my-auto z-10"
                                    tooltip="عدد المهام الجديدة"><?php echo e($area->projects->where('status', '!=', 'done_5')->count()); ?></span>
                                <span
                                    class="bg-[#673B8C] rounded-full animate-ping w-2/3 h-2/3 my-auto mx-auto top-0 bottom-0 left-0 right-0 absolute z-0"></span>
                            </span>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
            <?php if(\App\Models\Area::all()->count() > $orgProject->areas->count()): ?>
                <div id="showAddArea"
                    class="border-4 p-5 border-dashed max-h-[150px] min-h-[150px] rounded cursor-pointer bg-[#F0F0F7] flex justify-center transition-all duration-150 hover:shadow-xl hover:scale-105">
                    <span class="my-auto mx-auto text-green-500 font-bold text-2xl flex">
                        <span class="material-icons my-auto scale-110">add</span>
                        <span>إضافة منطقة</span>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php echo $__env->make('org_project.modals.projectsModals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('org_project.modals.assignDeputyModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('org_project.modals.addArea', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php $__env->startPush('custom-scripts'); ?>
        
        <script>


        </script>
    <?php $__env->stopPush(); ?>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/org_project/show.blade.php ENDPATH**/ ?>