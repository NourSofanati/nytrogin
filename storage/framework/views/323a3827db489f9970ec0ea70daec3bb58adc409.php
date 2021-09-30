<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <button class="bg-indigo-500 text-white text-lg font-bold shadow px-4 py-2 rounded-xl flex gap-4"
            id="printButton"><span class="material-icons">print</span><span>طباعة</span></button>
     <?php $__env->endSlot(); ?>

    <div class="p-6">

        <div class="flex justify-end mt-5">
            <?php if($report->user->id == auth()->user()->id): ?>
                <?php if($report->isApproved->count() == 0 && $report->isPending->count() == 0): ?>
                    <form action="<?php echo e(route('approvals.store')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="report_id" value="<?php echo e($report->id); ?>">
                        <button type="submit"
                            class="bg-[#FBB445] text-[#673B8C] text-lg font-bold py-2 px-4 mb-4 rounded-lg shadow">
                            طلب الموافقة
                        </button>
                    </form>
                <?php elseif($report->isApproved->count() > 0 ): ?>
                    <p class="text-green-800 mb-4">
                        تم قبول هذا التقرير
                    </p>
                <?php elseif($report->isPending->count() > 0 ): ?>
                    <p class="text-gray-800 mb-4">
                        هذا المشروع بإنتظار الموافقة
                    </p>
                <?php endif; ?>
            <?php elseif(auth()->user()->role_id == \App\Models\Role::IS_SUPERVISOR): ?>
                <?php if($report->isPending->count() > 0): ?>

                    <?php $__currentLoopData = $report->isPending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $approval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <form action="<?php echo e(route('approvals.update', $approval)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('put'); ?>
                            <input type="hidden" name="report_id" value="<?php echo e($report->id); ?>">
                            <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>">
                            <input type="hidden" name="approved" value="1">

                            <button type="submit"
                                class="bg-green-500 text-white text-lg font-bold py-2 px-4 mb-4 rounded-lg shadow">
                                موافقة
                            </button>
                        </form>
                        <form action="<?php echo e(route('approvals.update', $approval)); ?>" method="post" id="decline_form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('put'); ?>
                            <input type="hidden" name="report_id" value="<?php echo e($report->id); ?>">
                            <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>">
                            <input type="hidden" name="approved" value="0">
                            <input type="text" name="feedback" id="feedback" class="hidden">
                            <button type="submit"
                                class="bg-red-500 text-white text-lg font-bold py-2 px-4 mb-4 rounded-lg shadow mr-4">
                                رفض
                            </button>
                        </form>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>
        <form method="POST" enctype="multipart/form-data" action="<?php echo e(route('reports.store')); ?>">
            <?php echo csrf_field(); ?>

            <div class="border-2 my-5 border-dashed p-5">
                <header class="flex">
                    <div class="justify-start">
                        <h1
                            class="text-3xl text-gray-700 border-b-2 pb-2 border-dashed  border-gray-400 pl-[3.2rem] mr-2">
                            التفاصيل</h1>
                    </div>
                </header>
                <div class=" flex flex-col gap-4 w-full  p-5">
                    <div class="border-b py-2">
                        <?php echo e(__('Inspector Name')); ?> : <?php echo e($report->user->name); ?>

                    </div>
                    <div class="border-b py-2">
                        <?php echo e(__('Project Name')); ?> : <?php echo e($report->project->name); ?>

                    </div>
                    <div class="border-b py-2">
                        <?php echo e(__('City / State')); ?> :
                        <?php echo e($report->project->city->name . ' / ' . $report->project->city->area->area->name); ?>

                    </div>
                    <div class="border-b py-2">
                        <?php echo e(__('Location')); ?> :
                        <?php echo e($report->location); ?>

                    </div>
                    <div id="map"
                        class="col-span-full h-[250px] hover:shadow-xl rounded-xl transition-all duration-150 hover:scale-105">
                    </div>
                    <div class="border-b py-2">
                        <?php echo e(__('Inspection Date')); ?> : <?php echo e($report->report_date); ?>

                    </div>
                    <div class="border-b py-2">
                        <?php echo e(__('Inspection Time')); ?> : <?php echo e($report->report_time); ?>

                    </div>
                    <?php if($report->license_id): ?>
                        <div class="border-b py-2">
                            <?php echo e(__('Permit ID')); ?> : <?php echo e($report->license_id); ?>

                        </div>
                        <div class="border-b py-2">
                            <?php echo e(__('Permit Expiration Date')); ?> : <?php echo e($report->license_expiration); ?>

                        </div>
                    <?php endif; ?>
                    <?php if($report->commercial_license_id): ?>
                        <?php echo e(__('Commercial license ID')); ?> : <?php echo e($report->commercial_license_id); ?>

                    <?php endif; ?>
                </div>

            </div>
            <div class="mt-3 border-2 bg-white rounded-xl p-8 text-lg ">

                <table class="min-w-full">
                    <thead>
                        <tr class="border border-collapse ">
                            <th class="border hidden xl:table-cell border-collapse py-2 w-7/12">قائمة التفتيش</th>
                            <th class="border hidden xl:table-cell border-collapse py-2 w-1/12">نعم/لا</th>
                            <th class="border hidden xl:table-cell border-collapse py-2">ملاحظات</th>
                            <th class="border hidden xl:table-cell border-collapse py-2 w-1/12">المرفقات</th>
                        </tr>
                    </thead>
                    <tbody id="checkItemLines">
                        <?php $__currentLoopData = $report->checklist->checkitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-index="${index++}"
                                class="bg-white xl:hover:bg-gray-100 flex xl:table-row flex-row xl:flex-row flex-wrap xl:flex-no-wrap mb-10 xl:mb-0 border-collapse shadow-lg">
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 border border-b block xl:table-cell relative xl:static">
                                    <p><?php echo e($item->inspection); ?></p>
                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <?php echo e(__($item->check)); ?>

                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <?php echo e($item->notes); ?>

                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static ">
                                    <?php switch($item->attachments->count()):
                                        case (1): ?>
                                            <span class="cursor-pointer" data-attachmentShow
                                                data-id="<?php echo e($item->id); ?>">مرفق واحد</span>
                                        <?php break; ?>
                                        <?php case (2): ?>
                                            <span class="cursor-pointer" data-attachmentShow
                                                data-id="<?php echo e($item->id); ?>">مرفقين</span>
                                        <?php break; ?>
                                        <?php case (0): ?>
                                            <span>لا يوجد</span>
                                        <?php break; ?>
                                        <?php default: ?>
                                            <span class="cursor-pointer" data-attachmentShow
                                                data-id="<?php echo e($item->id); ?>"><?php echo e($item->attachments->count()); ?>

                                                مرفقات</span>

                                    <?php endswitch; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </form>
        <div class="mt-3 border-2 bg-white rounded-xl p-8 text-lg">
            <label for="notes"><?php echo e(__('Notes')); ?></label>
            <p><?php echo e($report->checklist->notes); ?></p>
        </div>
        <div class="mt-3 border-2 bg-white rounded-xl p-8 text-lg">
            <label for="recommendations"><?php echo e(__('Recommendations')); ?></label>
            <p><?php echo e($report->checklist->recommendations); ?></p>
        </div>
    </div>


    <div class="absolute top-0 left-0 right-0 bottom-0 lg:right-[380px] bg-black/20  backdrop-blur-md grid place-content-center place-items-center overflow-hidden hidden"
        id="attachmentsModal">
        <div class="bg-white shadow-xl rounded p-2">

            <div class="py-4 px-8 ">
                <div class="flex justify-between">
                    <h1 class="text-xl font-bold text-[#673B8c] my-auto tracking-tight" id="modalTitle">
                        المرفقات
                    </h1>
                    <div id="exit_button"
                        class="text-[#673B8c] my-auto text-3xl cursor-pointer hover:text-red-500 transition duration-75">
                        &times;</div>
                </div>
                <div class="flex gap-4 mt-5 max-h-[500px] overflow-y-auto flex-wrap justify-center"
                    id="attachments-display">

                </div>
            </div>
        </div>
    </div>


    <?php $__env->startPush('custom-scripts'); ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script async
                src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(config('app.mapsapi')); ?>&libraries=places&callback=initMap&language=ar&region=SA">
        </script>
        <script>
            $('[data-attachmentShow]').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: `<?php echo e(route('get_checkitem_attachments')); ?>?checkitem_id=` + this.dataset.id,
                    success: function(data) {
                        let attachmentsHtml = ``;
                        attachmentsHtml = data.map(attachment => {
                            if (attachment.mimeType.indexOf('image') >= 0) {
                                return `<a href="${attachment.url}" target="_blank"><img src="${attachment.url}" alt="image" class="w-[150px] h-[150px] rounded border-2 object-cover" /></a>`;
                            } else {
                                return `<video src="${attachment.url}" class="min-w-[150px] h-[150px] rounded border-2" controls/>`;
                            }
                        });
                        // console.log(attachmentsHtml);
                        $('#attachments-display').html(attachmentsHtml);
                        $('#attachmentsModal').removeClass('hidden');
                    }
                });
            });
            $('#exit_button').click(function(e) {
                e.preventDefault();
                $('#attachmentsModal').addClass('hidden');
                $('#attachments-display').html('');
            });
            $('#printButton').click(function(e) {
                e.preventDefault();
                var strWindowFeatures = "location=yes,scrollbars=yes,status=yes";
                let pdfWindow = window.open(window.location.href + (window.location.href[window.location.href.length -
                    1] == '/' ? '' : '/') + 'pdf', '_blank', strWindowFeatures);
                pdfWindow.onload = () => {
                    // pdfWindow.print();
                }
                pdfWindow.onafterprint = () => {
                    pdfWindow.close();
                }
            })

            function initMap() {
                const input = document.getElementById("location");
                const options = {
                    componentRestrictions: {
                        country: "sa"
                    },
                    fields: ["address_components", "geometry", "icon", "name"],
                    strictBounds: false,
                };
                // const autocomplete = new google.maps.places.Autocomplete(input, options);
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 4,
                    center: {
                        lat: 23.794850198707053,
                        lng: 45.14557369331874
                    },
                });
                const marker = new google.maps.Marker({
                    map
                });
                $.ajax({
                    type: "GET",
                    url: "<?php echo e(route('place_json', $report)); ?>",

                    success: function(response) {
                        console.log(response);
                        marker.setVisible(false);
                        const place = JSON.parse(response.json);
                        if (!place.geometry || !place.geometry.location) {
                            // User entered the name of a Place that was not suggested and
                            // pressed the Enter key, or the Place Details request failed.
                            window.alert("No details available for input: '" + place.name + "'");
                            return;
                        }

                        // If the place has a geometry, then present it on a map.
                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(17);
                        }
                        $('#place_json').val(JSON.stringify(place));
                        marker.setPosition(place.geometry.location);
                        marker.setVisible(true);
                    }
                });
            }
        </script>
    <?php $__env->stopPush(); ?>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/reports/show.blade.php ENDPATH**/ ?>