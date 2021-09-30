<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('تعيين مراقبين مشروع')); ?> <?php echo e($project->name); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden border-2 rounded p-4 sm:rounded-lg">
                <div class="text-2xl flex  justify-center">
                    <div class="ring-[#FDBB3E] z-10 ring-2 text-[#FDBB3E] px-4 py-2 rounded-full">الخطوة الثالثة</div>
                    <div class="h-12 w-12 rounded-full z-0 bg-[#7056A1] flex justify-center">
                        <p class="my-auto text-white font-extrabold">3</p>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class=" my-5 text-2xl font-semibold">إختر المراقبين</h1>
                    <hr class=" my-5 w-1/3 mx-auto">

                    <form method="post" action="<?php echo e(route('organizations.assign_inspectors')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>" required>
                        <div class="flex justify-center">
                            <div id="inspectors" class="flex flex-col w-full md:w-1/2">
                                <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-[#7056A1]">
                                </div>
                            </div>
                        </div>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['id' => 'submitBtn','class' => 'hidden mx-auto text-lg']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'submitBtn','class' => 'hidden mx-auto text-lg']); ?>
                            تعيين المراقبين
                         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                        <?php if(auth()->user()->role_id != App\Models\Role::IS_SUPERVISOR): ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['id' => 'pass','class' => 'hidden mx-auto mt-5 text-lg']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'pass','class' => 'hidden mx-auto mt-5 text-lg']); ?>
                                تمرير أختيار المراقبين من قبل المشرف
                             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startSection('footerScripts'); ?>
        <script type="text/javascript">
            $.ajax({
                url: "<?php echo e(route('organizations.get_all_inspectors')); ?>?project_id=<?php echo e($project->id); ?>",
                method: 'GET',
                success: function(data) {
                    $('#inspectors').html(data.html).fadeIn();
                    $('#submitBtn').toggle('hidden');
                    $('#pass').toggle('hidden');
                }
            });
        </script>
    <?php $__env->stopSection(); ?>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/project/step-three.blade.php ENDPATH**/ ?>