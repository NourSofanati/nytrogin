<!DOCTYPE html>
<html lang="ar-SA" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
</head>

<body class="w-[21cm] h-[29.7]">
    <iframe id="printId" frameborder="0" style="display:none"></iframe>
    <section id="content">
        <header class=" flex justify-end mb-[50px]">
            <img src="<?php echo e(asset('images/logos.png')); ?>" class="max-h-[100px]" alt="" srcset="">
        </header>
        <div class=" text-3xl tracking-tighter text-[#673B8C] font-semibold rounded-xl my-4">
            التفتيش على <?php echo e(__($projectReport->project->category->name)); ?>

        </div>
        <div class=" flex flex-col gap-2 w-full ">
            <div class="border-b py-2">
                <?php echo e(__('Inspector Name')); ?> : <?php echo e($projectReport->user->name); ?>

            </div>
            <div class="border-b py-2">
                <?php echo e(__('Project Name')); ?> : <?php echo e($projectReport->project->name); ?>

            </div>
            <div class="border-b py-2">
                <?php echo e(__('City / State')); ?> :
                <?php echo e($projectReport->project->city->name . ' / ' . $projectReport->project->city->area->name); ?>

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
                </thead>
                <tbody id="checkItemLines">
                    <?php $__currentLoopData = $projectReport->checklist->checkitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-index="${index++}" class="bg-white border-collapse ">
                            <td class="w-7/12 p-3 text-gray-800 border border-b ">
                                <p><?php echo e($item->inspection); ?></p>
                            </td>
                            <td class="w-1/12 p-3 text-gray-800 text-center border border-b ">
                                <?php echo e(__($item->check)); ?>

                            </td>
                            <td class=" p-3 text-gray-800 text-center border border-b ">
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
        <div class="flex gap-5 mt-5">
            
        </div>
    </section>
    <script>
        const printable = document.querySelector('#content');
        printable.contentWindow.print();
    </script>
</body>

</html>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/pdf.blade.php ENDPATH**/ ?>