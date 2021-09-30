<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'relative']); ?>
     <?php $__env->slot('header'); ?> 
     <?php $__env->endSlot(); ?>

    <div class="py-12 px-6">
        <div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8 mb-8   ">
                <div class="overflow-hidden bg-white border-2 p-4 rounded-2xl">
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
                <div class="overflow-hidden lg:col-span-2 col-span-full bg-white border-2 p-4 rounded-2xl">
                    <canvas id="reportsChart" width="400" height=""></canvas>
                </div>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">
                

                
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\OrgProject::class)): ?>
                    <a href="<?php echo e(route('organization_projects.create')); ?>"
                        class="bg-[#673B8C] py-12 px-4 text-center relative font-bold text-2xl border text-white rounded-[50px] flex justify-center">
                        <span class="material-icons my-auto">add</span> <span
                            class="my-auto"><?php echo e(__('Create a new project')); ?></span>
                    </a>
                <?php endif; ?>
                <?php $__currentLoopData = \App\Models\OrgProject::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $project)): ?>
                        <a href="<?php echo e(route('organization_projects.show', $project)); ?>"
                            class="bg-[#E5E6E7] py-12 px-4 text-center relative font-bold text-2xl border border-[#673B8C] text-[#673B8C] rounded-[50px] ">
                            <?php echo e($project->name); ?>

                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div class="absolute top-0 left-0 right-0 bottom-0 lg:right-[380px] bg-black/20  backdrop-blur-md grid place-content-center place-items-center overflow-hidden hidden"
        id="projectsModal">
        <div class="bg-white shadow-xl rounded p-2">

            <div class="py-4 px-8 ">
                <div class="flex justify-between">
                    <h1 class="text-xl font-bold text-[#673B8c] my-auto tracking-tight" id="modalTitle">
                        المشاريع الجديدة
                    </h1>
                    <div id="exit_button"
                        class="text-[#673B8c] my-auto text-3xl cursor-pointer hover:text-red-500 transition duration-75">
                        &times;</div>
                </div>
                <div class="flex flex-col gap-4 mt-5 max-h-[500px] overflow-y-auto">

                    <?php $__currentLoopData = $newProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="w-full flex justify-between py-4 px-8 gap-20 font-medium text-lg rounded-full bg-[#E8E3F0] hover:bg-[#683b8c3d] transition duration-75"
                            href="<?php echo e(route('projects.show', $item)); ?>" data-state="new">
                            <span><?php echo e($item->name); ?></span>
                            <span>موعد التسليم:
                                <?php echo e(\Carbon\Carbon::parse($item->deadline)->diffForHumans()); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php $__currentLoopData = $completedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="w-full flex justify-between py-4 px-8 gap-20 font-medium text-lg rounded-full bg-[#E8E3F0] hover:bg-[#683b8c3d] transition duration-75"
                            href="<?php echo e(route('projects.show', $item)); ?>" data-state="completed">
                            <span><?php echo e($item->name); ?></span>
                            <span>موعد التسليم:
                                <?php echo e(\Carbon\Carbon::parse($item->deadline)->diffForHumans()); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php $__currentLoopData = $inProgressProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="w-full flex justify-between py-4 px-8 gap-20 font-medium text-lg rounded-full bg-[#E8E3F0] hover:bg-[#683b8c3d] transition duration-75"
                            href="<?php echo e(route('projects.show', $item)); ?>" data-state="inProgress">
                            <span><?php echo e($item->name); ?></span>
                            <span>موعد التسليم:
                                <?php echo e(\Carbon\Carbon::parse($item->deadline)->diffForHumans()); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>
    <?php $__env->startPush('custom-scripts'); ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"
                integrity="sha256-bC3LCZCwKeehY6T4fFi9VfOU0gztUa+S4cnkIhVPZ5E=" crossorigin="anonymous"></script>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var reportsCtx = document.getElementById('reportsChart').getContext('2d');

            $.ajax({
                type: "GET",
                url: "<?php echo e(route('projects_chart')); ?>",
                success: function(response) {
                    console.log(response);
                    var myChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: Object.keys(response),
                            datasets: [{
                                label: '# of projects',
                                data: Object.values(response),
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                ]
                            }]
                        },
                    });
                }
            });
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('reports_chart')); ?>",
                success: function(response) {
                    console.log(response);
                    var myChart = new Chart(reportsCtx, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(response),
                            datasets: [{
                                label: 'عدد التقارير',
                                data: Object.values(response),
                                backgroundColor: [
                                    '#FCB634',
                                ]
                            }]
                        }
                    });
                }
            });
        </script>

    <?php $__env->stopPush(); ?>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/dashboard.blade.php ENDPATH**/ ?>