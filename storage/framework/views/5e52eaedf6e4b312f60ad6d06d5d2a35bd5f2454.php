<div class="absolute top-0 bottom-0 <?php echo e(config('app.locale') == 'ar' ? 'lg:right-[380px] right-0 left-0 ' : 'lg-left[380px]  left-0 right-0'); ?> bg-black/20  backdrop-blur-md grid place-content-center place-items-center overflow-hidden hidden"
    id="addTaskModal">
    <div class="bg-white shadow-xl rounded p-2">

        <div class="py-4 px-8 ">
            <div class="flex justify-between gap-20 border-b-2 pb-2">
                <h1 class="text-xl font-bold text-[#673B8c] my-auto tracking-tight" id="modalTitle">
                    إضافة مهمة
                </h1>
                <div id="task_exit_button"
                    class="text-[#673B8c] my-auto text-3xl cursor-pointer hover:text-red-500 transition duration-75">
                    &times;</div>
            </div>
            <div class="flex flex-col gap-4 mt-2 max-h-[500px] overflow-y-auto">
                <form action="<?php echo e(route('projects.store')); ?>" class="text-xl text-[#673B8C]" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="px-4 py-3 mt-3 bg-gray-100">

                        <p class="w-full flex gap-4"><span class="font-bold ">المنطقة:
                            </span><?php echo e($area->area->name); ?></p>
                        <input type="hidden" name="area_id" value="<?php echo e($area->id); ?>">
                    </div>
                    <div class="px-4 py-2 mt-2 bg-gray-100">
                        <p class="w-full flex gap-4"><span class="font-bold ">المدينة:
                            </span><?php echo e($city->name); ?></p>
                        <input type="hidden" name="city_id" value="<?php echo e($city->id); ?>">
                    </div>
                    <div class="mt-2 rounded-xl">
                    </div>
                    <div class="mt-2">
                        <label for="name" class="block mb-3">
                            <?php echo e(__('اسم المهمة')); ?> <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" required
                            class="border rounded w-full border-gray-400 bg-gray-50">
                    </div>
                    <div class="mt-2">
                        <label for="category_id" class="block mb-3">
                            <?php echo e(__('Task Category')); ?> <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id" id="category_id"
                            class=" border rounded w-full border-gray-400 bg-gray-50" required>
                            <?php $__currentLoopData = \App\Models\ProjectCategory::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="deadline" class="block mb-3">
                            تاريخ تسليم المهمة <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" name="deadline" required
                            class=" border rounded w-full border-gray-400 bg-gray-50">
                    </div>
                    <input type="hidden" value=<?php echo e($city->area->org_project_id); ?> name="org_project_id" />

                    <button type="submit" class="text-white bg-[#673B8C] mt-5 shadow-xl py-2 px-4 font-bold rounded-xl">
                        إنشاء مهمة
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('custom-scripts'); ?>
    <script>
        $('#task_exit_button').click(function(e) {
            e.preventDefault();
            $('#addTaskModal').addClass('hidden');
        });
        $('#showAddTask').click(function(e) {
            e.preventDefault();
            $('#addTaskModal').removeClass('hidden');
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/org_project/modals/createProject.blade.php ENDPATH**/ ?>