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
                <a href="<?php echo e(route('organization_projects.show', $project->orgProject)); ?>"
                    class="text-gray-600 hover:text-[#FCB634]"><?php echo e($project->orgProject->name); ?> /</a>

                <a href="<?php echo e(route('area.show', $project->city->area)); ?>"
                    class="text-gray-600 hover:text-[#FCB634]"><?php echo e($project->city->area->area->name); ?> /</a>

                <a href="<?php echo e(route('area.show', $project->city->area)); ?>"
                    class="text-gray-600 hover:text-[#FCB634]"><?php echo e($project->city->name); ?> /</a>
                <?php echo e($project->name); ?>

            </h1>
            <hr class="flex-grow my-auto mr-5 border-[#FCB634] border-2 shadow-xl">
        </div>
        <div class="border-2 my-5 border-dashed p-5">
            <header class="flex">
                <div class="justify-start">
                    <h1 class="text-3xl text-gray-700 border-b-2 pb-2 border-dashed  border-gray-400 pl-[3.2rem] mr-2">
                        التفاصيل</h1>
                </div>
            </header>
            <section class="mt-5 flex flex-col gap-5">
                <div class="bg-[#673e890a] p-5 flex border-2 rounded-md shadow-inner">
                    <span class="material-icons my-auto ml-2 text-green-500 scale-110">task</span>
                    <span>اسم المهمة: <?php echo e($project->name); ?></span>
                </div>
                <div class="bg-[#673e890a] p-5 flex border-2 rounded-md shadow-inner">
                    <span class="material-icons my-auto ml-2 text-green-500 scale-110">supervisor_account</span>
                    <span>المشرف: <?php echo e($project->orgProject->manager->name); ?></span>
                </div>
                <div class="bg-[#673e890a] p-5 flex border-2 rounded-md shadow-inner">
                    <span class="material-icons my-auto ml-2 text-green-500 scale-110">alarm</span>
                    <span>تسليم المهمة:
                        <?php echo e(\Carbon\Carbon::parse($project->deadline)->diffForHumans()); ?>

                        <br>
                        <bdi class="ml-5 text-gray-400">
                            (<?php echo e($project->deadline); ?>)
                        </bdi>
                    </span>
                </div>
            </section>
        </div>
        <div class="border-2 border-dashed mb-5 p-5">
            <header class="flex">
                <div class="justify-start">
                    <h1 class="text-3xl text-gray-700 border-b-2 pb-2 border-dashed  border-gray-400 pl-[3.2rem] mr-2">
                        التقارير</h1>
                </div>
            </header>
            <section class="mt-5 flex gap-10 flex-wrap items-center justify-center  md:justify-start">
                <form action="<?php echo e(route('create_inspection_report')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>">
                    <button type="submit"
                        class="max-h-[15rem] max-w-[10rem] min-h-[15rem] flex flex-col min-w-[10rem] border-2 shadow-inner bg-gray-50 rounded-xl border-gray-400 hover:border-gray-500 p-4 cursor-pointer hover:shadow-xl transition-all duration-150 hover:scale-105 relative items-center border-dashed">
                        <header
                            class="flex justify-center flex-col items-center font-bold text-xl text-center gap-3 border-b-2 border-dashed border-gray-400 hover:border-gray-500 pb-3">
                            <p class="text-gray-400 hover:border-gray-500">
                                <span>كتابة تقرير</span>
                            </p>
                        </header>
                        <section class="flex-grow flex">
                            <span class="material-icons md-48 mx-auto my-auto text-gray-400 hover:border-gray-500">
                                edit
                            </span>
                        </section>
                    </button>
                </form>
                <?php $__currentLoopData = $project->reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inspection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('reports.show', $inspection)); ?>"
                        class="max-h-[15rem] max-w-[10rem] min-h-[15rem] flex flex-col min-w-[10rem] border-2 shadow-inner bg-gray-50 rounded-xl border-[#66368eb6] p-4 cursor-pointer hover:shadow-xl transition-all duration-150 hover:scale-105 relative">
                        <div class="absolute -top-1 right-0 left-0 w-1/3 bg-[#66368E] shadow rounded-full h-3 mx-auto ">
                        </div>
                        <header
                            class="flex justify-center flex-col items-center font-bold text-xl text-center gap-3 border-b-2 border-dashed border-[#66368eb6] pb-3">
                            <img src="<?php echo e($inspection->user->profile_photo_url); ?>"
                                class="w-10 h-10 rounded-full ring-2 ring-[#66368eb6]" alt="">
                            <p class="text-[#66368ed0]">
                                <span><?php echo e($inspection->user->name); ?></span>
                            </p>
                        </header>
                        <section class="flex-grow flex">
                            <span class="material-icons md-48 mx-auto my-auto text-[#66368eb6]">
                                checklist
                            </span>
                        </section>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </section>
        </div>

        <?php echo $__env->make('project.project_status',['project'=>$project], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div>
            <div class="hidden lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">

                <div
                    class="bg-[#E5E6E7] text-[#673B8C] border border-[#673B8C] px-4 py-3 mt-3 text-2xl rounded-3xl col-span-2 relative">
                    <span class="font-bold ">التقارير:
                    </span>
                    <div class="flex flex-col gap-2">
                        <?php $__empty_1 = true; $__currentLoopData = $project->reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inspection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e(route('reports.show', $inspection)); ?>"
                                class="w-full bg-white py-2 px-4 flex  rounded-xl shadow-lg my-2">
                                <img src="<?php echo e($inspection->user->profile_photo_url); ?>"
                                    alt="<?php echo e(auth()->user()->name); ?>"
                                    class="rounded-full h-10 w-10 object-cover ml-5">
                                <p class="my-auto">تقرير <?php echo e($inspection->user->name); ?></p>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <h1 class="text-xl">
                                لا يوجد تقارير مدخلة حاليا.
                            </h1>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\ProjectInspection::class)): ?>
                            <form action="<?php echo e(route('create_inspection_report')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>">
                                <button type="submit"
                                    class="w-full bg-white p-2 flex justify-center rounded-xl shadow-lg my-5">
                                    <p>
                                        إنشاء تقرير جديد
                                    </p>
                                    <span class="material-icons my-auto">
                                        add
                                    </span>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/project/show.blade.php ENDPATH**/ ?>