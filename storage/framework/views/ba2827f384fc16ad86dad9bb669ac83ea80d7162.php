<!DOCTYPE html>
<html lang="ar-SA" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>

<body>
    <table>
        <thead class="table-header-group border-none pb-4 mb-4">
            <tr>
                <td>
                    <img src="<?php echo e(asset('images/logos.png')); ?>" class="max-h-[100px] mr-auto " alt="" srcset="">
                </td>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    <div>
                        <div class=" text-3xl tracking-tighter text-[#673B8C] font-semibold rounded-xl my-4 mt-[50px]">
                            التفتيش على <?php echo e($projectReport->project->name); ?>

                        </div>
                        <div class="gap-2 w-full">
                            <div class="border-b py-2">
                                <?php echo e(__('نوع التفتيش')); ?> : <?php echo e(__($projectReport->project->category->name)); ?>

                            </div>
                            <div class="border-b py-2">
                                <?php echo e(__('Inspector Name')); ?> : <?php echo e($projectReport->user->name); ?>

                            </div>
                            <div class="border-b py-2">
                                <?php echo e(__('Project Name')); ?> : <?php echo e($projectReport->project->name); ?>

                            </div>
                            <div class="border-b py-2">
                                <?php echo e(__('City / State')); ?> :
                                <?php echo e($projectReport->project->city->name . ' / ' . $projectReport->project->city->area->area->name); ?>

                            </div>
                            <div class="border-b py-2">
                                <?php echo e(__('Location')); ?> :
                                <?php echo e($projectReport->location); ?>

                            </div>
                            <div class="border-b py-2">
                                <?php echo e(__('Inspection Date')); ?> : <?php echo e($projectReport->report_date); ?>

                            </div>
                            <div class="border-b py-2">
                                <?php echo e(__('Inspection Time')); ?> : <?php echo e($projectReport->report_time); ?>

                            </div>
                            <?php if($projectReport->license_id): ?>
                                <div class="border-b py-2">
                                    <?php echo e(__('Permit ID')); ?> : <?php echo e($projectReport->license_id); ?>

                                </div>
                                <div class="border-b py-2">
                                    <?php echo e(__('Permit Expiration Date')); ?> : <?php echo e($projectReport->license_expiration); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($projectReport->commercial_license_id): ?>
                                <?php echo e(__('Commercial license ID')); ?> : <?php echo e($projectReport->commercial_license_id); ?>

                            <?php endif; ?>
                        </div>
                        <div class=" text-3xl tracking-tighter text-[#673B8C] font-semibold rounded-xl my-5">
                            قائمة التفتيش
                        </div>
                        <div class="mt-5 ">

                            <table class="min-w-full table-fixed">
                                <tbody id="checkItemLines">
                                    <?php $__currentLoopData = $projectReport->checklist->checkitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr data-index="${index++}" class="bg-white ">
                                            <td class="w-7/12 p-3 text-gray-800 border-b-2 border-dashed  ">
                                                <p><?php echo e($item->inspection); ?></p>
                                            </td>
                                            <td class="w-1/12 p-3 text-gray-800 text-center border-b-2 border-dashed  ">
                                                <?php echo e(__($item->check)); ?>

                                            </td>
                                            <td class=" p-3 text-gray-800 text-center border-b-2 border-dashed  ">
                                                <?php echo e($item->notes); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class=" text-3xl tracking-tighter text-[#673B8C] font-semibold rounded-xl my-5">
                            المرفقات
                        </div>
                        <div class="flex gap-5 flex-wrap">
                            <?php $__currentLoopData = $projectReport->checklist->checkitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $checkitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $checkitem->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(strpos($item->mimeType, 'image') >= 0): ?>
                                        <img src="<?php echo e($item->url); ?>"
                                            class="max-w-[4cm] max-h-[4cm] min-w-[4cm] min-h-[4cm] border-2 rounded-2xl object-cover" alt="" />
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>


</body>

</html>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/pdf.blade.php ENDPATH**/ ?>