<div id="status"
    class="bg-white rounded-md p-6 grid grid-cols-1 gap-6 border-2 border-[#E9EAEB] place-items-center">
    <h1 class="text-2xl">
        حالة المشروع:
    </h1>
    <div class="flex flex-row-reverse">
        <?php echo $__env->make('project.level_status',['at'=>'admin','status' => $project->status], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('project.level_status',['at'=>'procurator','status' => $project->status], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('project.level_status',['at'=>'supervisor','status' => $project->status], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('project.level_status',['at'=>'inspector','status' => $project->status], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/project/project_status.blade.php ENDPATH**/ ?>