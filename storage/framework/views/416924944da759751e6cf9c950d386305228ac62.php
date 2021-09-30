<div class="absolute top-0 bottom-0 <?php echo e(config('app.locale') == 'ar' ? 'lg:right-[380px] left-0 ' : 'lg-left[380px] right-0'); ?> bg-black/20  backdrop-blur-md grid place-content-center place-items-center overflow-hidden hidden"
    id="addCityModal">
    <div class="bg-white shadow-xl rounded p-2">

        <div class="py-4 px-8 ">
            <div class="flex justify-between gap-20">
                <h1 class="text-xl font-bold text-[#673B8c] my-auto tracking-tight" id="modalTitle">
                    إضافة مدينة
                </h1>
                <div id="city_exit_button"
                    class="text-[#673B8c] my-auto text-3xl cursor-pointer hover:text-red-500 transition duration-75">
                    &times;</div>
            </div>
            <div class="flex flex-col gap-4 mt-5 max-h-[500px] overflow-y-auto">
                <form action="<?php echo e(route('cities.store')); ?>" method="post" autocomplete="off">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="area_id" value="<?php echo e($area->id); ?>">
                    <label for="name" class="mt-5 block">اسم المدينة</label>
                    <input class="block border border-gray-400 bg-gray-100 rounded w-full"
                        placeholder="<?php echo e(__('Name')); ?>" type="text" name="name" id="name" autocomplete="off">
                    <button type="submit"
                        class="bg-[#FCB634] px-4 py-2 rounded block text-[#673B8C] border-[#673B8C] border font-bold mt-5"><?php echo e(__('Save')); ?>

                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('custom-scripts'); ?>
    <script>
        $('#city_exit_button').click(function(e) {
            e.preventDefault();
            $('#addCityModal').addClass('hidden');
        });
        $('#showAddCity').click(function(e) {
            e.preventDefault();
            $('#addCityModal').removeClass('hidden');
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/org_project/modals/addCity.blade.php ENDPATH**/ ?>