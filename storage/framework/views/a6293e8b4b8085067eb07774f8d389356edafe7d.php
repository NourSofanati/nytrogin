<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'relative']); ?>
     <?php $__env->slot('header'); ?> 
     <?php $__env->endSlot(); ?>

    <div class="p-6">
        <div class="flex w-full mb-10 font-bold">
            <h1 class="text-3xl text-[#673B8c] drop-shadow-lg">
                <span class="material-icons">
                    dashboard
                </span>
                لوحة المعلومات
            </h1>
            <hr class="flex-grow my-auto mr-5 border-[#FCB634] border-2 shadow-xl">
        </div>
        <div class="border-2 p-4 border-dashed w-full my-5">
            <div class="flex  w-full font-bold mb-4">
                <h1 class="text-2xl text-gray-600 border-gray-600  pb-2 border-b-2 border-dashed pl-4 drop-shadow-lg">
                    المشاريع
                </h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 w-full gap-10">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\OrgProject::class)): ?>
                    <a href="<?php echo e(route('organization_projects.create')); ?>"
                        class="border-4 p-5 border-dashed max-h-[110px] min-h-[110px] rounded cursor-pointer bg-[#F0F0F7] flex justify-center transition-all duration-150 hover:shadow-xl hover:scale-105 relative">
                        <span class="my-auto mx-auto text-green-500 font-bold text-2xl flex">
                            <span class="material-icons my-auto">add</span>
                            <span class="my-auto"><?php echo e(__('Create a new project')); ?></span>
                        </span>
                    </a>
                <?php endif; ?>
                <?php $__currentLoopData = \App\Models\OrgProject::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $project)): ?>
                        <a href="<?php echo e(route('organization_projects.show', $project)); ?>"
                            class="p-5 relative border-4 max-h-[110px] min-h-[110px] rounded cursor-pointer bg-[#F0F0F7] flex justify-center hover:scale-105 hover:shadow-2xl transition duration-150">
                            <span class="my-auto mx-auto text-gray-800 font-bold text-2xl flex">
                                <span><?php echo e($project->name); ?></span>
                            </span>
                            <?php if($project->newReports() > 0): ?>
                                <span
                                    class="absolute -top-5 -left-5 rounded-full bg-[#673B8c] text-white w-10 h-10 flex justify-center text-center">
                                    <span class="my-auto z-10"><?php echo e($project->newReports()); ?></span>
                                    <span
                                        class="bg-[#673B8C] rounded-full animate-ping w-2/3 h-2/3 my-auto mx-auto top-0 bottom-0 left-0 right-0 absolute z-0"></span>
                                </span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php if(auth()->user()->role->name == 'admin' || auth()->user()->role->name == 'project_manager' || auth()->user()->role->name == 'deputy_project_manager' || auth()->user()->role->name == 'organization'): ?>

            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8 mb-8 mt-14">
                <div
                    class="overflow-hidden border-dashed border-2 p-4 rounded-2xl hover:scale-105 hover:shadow-xl transition-all duration-150">
                    <div class="flex w-full font-bold mb-2">
                        <h1 class="text-xl text-[#673B8c] drop-shadow-lg">
                            <span class="material-icons">
                                analytics
                            </span>
                            تقسيم التقارير
                        </h1>
                        <hr class="flex-grow my-auto mr-5 border-[#673B8c] border-2 shadow-xl">
                    </div>
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
                <div
                    class="overflow-hidden lg:col-span-2 col-span-full border-dashed border-2 p-4 rounded-2xl hover:scale-105 hover:shadow-xl transition-all duration-150">
                    <div class="flex w-full font-bold mb-2">
                        <h1 class="text-xl text-[#673B8c] drop-shadow-lg">
                            <span class="material-icons">
                                analytics
                            </span>
                            التقارير المضافة آخر 7 ايام
                        </h1>
                        <hr class="flex-grow my-auto mr-5 border-[#673B8c] border-2 shadow-xl">
                    </div>
                    <canvas id="reportsChart" width="400" height=""></canvas>
                </div>
            </div>
        <?php endif; ?>
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
    <?php echo $__env->make('org_project.modals.projectsModals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->startPush('custom-scripts'); ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"
                integrity="sha256-bC3LCZCwKeehY6T4fFi9VfOU0gztUa+S4cnkIhVPZ5E=" crossorigin="anonymous"></script>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var reportsCtx = document.getElementById('reportsChart').getContext('2d');
            var myChart = document.getElementById('myChart');
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('projects_chart')); ?>",
                success: function(response) {
                    console.log(response);
                    const myChartJS = new Chart(ctx, {
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
                        options: {
                            plugins: {
                                legend: {
                                    labels: {
                                        font: {
                                            family: 'Janna LT',
                                        }
                                    }
                                }
                            },
                            onClick: (evt) => {
                                console.log(evt);
                                const points = myChartJS.getElementsAtEventForMode(evt, 'nearest', {
                                    intersect: true
                                }, true);
                                if (points.length) {
                                    const firstPoint = points[0];
                                    var label = myChartJS.data.labels[firstPoint.index];
                                    var value = myChartJS.data.datasets[firstPoint.datasetIndex].data[
                                        firstPoint.index];
                                    // alert(label + " : " + value);
                                    switch (label) {
                                        case 'مشاريع قيد الإنجاز':
                                            $('#modalTitle').text('المشاريع قيد الإنجاز');
                                            $('[data-state]').addClass('hidden');
                                            $('[data-state=\'inProgress\']').removeClass('hidden');
                                            $('#projectsModal').removeClass('hidden');
                                            break;
                                        case 'مشاريع جديدة':

                                            $('#modalTitle').text('المشاريع الجديدة');
                                            $('[data-state]').addClass('hidden');
                                            $('[data-state=\'new\']').removeClass('hidden');
                                            $('#projectsModal').removeClass('hidden');
                                            break;
                                        case 'مشاريع منجزة':

                                            $('#modalTitle').text('المشاريع المنجزة');
                                            $('[data-state]').addClass('hidden');
                                            $('[data-state=\'completed\']').removeClass('hidden');
                                            $('#projectsModal').removeClass('hidden');
                                            break;
                                        default:
                                            break;
                                    }
                                }
                            }
                        }
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
                        },
                        options: {
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        stepSize: 1,
                                    }
                                },
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        font: {
                                            family: 'Janna LT',
                                        }
                                    },
                                },
                            }
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