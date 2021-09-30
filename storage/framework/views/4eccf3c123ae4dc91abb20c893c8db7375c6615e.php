<div class="absolute top-0 bottom-0 <?php echo e(config('app.locale') == 'ar' ? 'lg:right-[380px] left-0 ' : 'lg-left[380px] right-0'); ?> bg-black/20  backdrop-blur-md grid place-content-center place-items-center overflow-hidden hidden"
    id="assignSupervisor">
    <div class="bg-white shadow-xl rounded p-2">

        <div class="py-4 px-8 ">
            <div class="flex justify-between gap-20">
                <h1 class="text-xl font-bold text-[#673B8c] my-auto tracking-tight" id="modalTitle">
                    تعيين مشرف
                </h1>
                <div id="supervisor_exit_button"
                    class="text-[#673B8c] my-auto text-3xl cursor-pointer hover:text-red-500 transition duration-75">
                    &times;</div>
            </div>
            <div class="flex flex-col gap-4 mt-5 max-h-[500px] overflow-y-auto">
                <form method="POST" action="<?php echo e(route('assign_supervisor')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" value=<?php echo e($orgProject->id); ?> name="org_project_id">
                    <select name="supervisor_id" id="supervisor_id" class="border-2 border-gray-400 w-full">
                        <?php $__currentLoopData = \App\Models\User::where('role_id', \App\Models\Role::IS_SUPERVISOR)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button type="submit"
                        class="bg-[#673B8C] text-white px-4 py-2 rounded-xl text-lg w-full mt-3 shadow-lg"><?php echo e(__('تعيين مشرف')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('custom-scripts'); ?>
    <script>
        $('#supervisor_exit_button').click(function(e) {
            e.preventDefault();
            $('#assignSupervisor').addClass('hidden');
        });
        $('#showAssignSupervisor').click(function(e) {
            e.preventDefault();
            $('#assignSupervisor').removeClass('hidden');
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/org_project/modals/assignSupervisor.blade.php ENDPATH**/ ?>