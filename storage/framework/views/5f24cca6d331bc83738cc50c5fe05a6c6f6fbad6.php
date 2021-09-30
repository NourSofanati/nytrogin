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

                <a href="<?php echo e(route('area.show', $area)); ?>"
                    class="text-gray-600 hover:text-[#FCB634]"><?php echo e($area->area->name); ?> /</a>
                <?php echo e($city->name); ?>

            </h1>
            <hr class="flex-grow my-auto mr-5 border-[#FCB634] border-2 shadow-xl">
        </div>
        <div class="border-2 my-5 border-dashed p-5">
            <header class="flex">
                <div class="justify-start">
                    <h1 class="text-3xl text-gray-700 border-b-2 pb-2 border-dashed  border-gray-400 pl-[3.2rem] mr-2">
                        المهام</h1>
                </div>
            </header>
            <section id="tasks" class="mt-5 px-2 flex flex-wrap gap-10">
                <button id="showAddTask"
                    class="max-h-[15rem] max-w-[10rem] min-h-[15rem] min-w-[10rem] border-2 bg-gray-50 rounded p-2 flex hover:border-dashed hover:shadow-xl  transition-all duration-150 hover:scale-105">
                    <div class="mx-auto my-auto h-full w-full">
                        <span class="mx-auto my-auto text-lg font-bold text-gray-800 flex justify-center h-full w-full">
                            <span class="my-auto">إنشاء مهمة</span>
                            <span class="material-icons my-auto">add</span>
                        </span>
                    </div>
                </button>
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('projects.show', $project)); ?>"
                        class="max-h-[15rem] max-w-[10rem] min-h-[15rem] min-w-[10rem] border-2 bg-gray-50 rounded p-4 border-dashed hover:shadow-xl  transition-all duration-150 hover:scale-105">
                        <header class="flex w-full justify-center text-gray-600 pb-2 border-gray-300 border-b">
                            <h2 class="text-lg font-bold"><?php echo e($project->name); ?></h2>
                        </header>
                        <section class="text-center text-gray-500 py-2 border-b-2">
                            <p>التسليم:</p>
                            <p
                                class="<?php echo e(\Carbon\Carbon::parse($project->deadline) > now() ? 'text-green-500 ' : 'text-red-500'); ?> font-bold">
                                <?php if(\Carbon\Carbon::parse($project->deadline) < now()): ?>
                                    <span class="material-icons">warning</span>
                                    <br>
                                <?php endif; ?>
                                <?php echo e(\Carbon\Carbon::parse($project->deadline)->diffForHumans()); ?></p>
                        </section>
                        <p class="text-center text-gray-500 py-2">
                            عدد المراقبين:
                            <?php echo e($project->inspectors->count()); ?>

                        </p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </section>
        </div>
    </div>
    <?php echo $__env->make('org_project.modals.createProject', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/area/projects.blade.php ENDPATH**/ ?>