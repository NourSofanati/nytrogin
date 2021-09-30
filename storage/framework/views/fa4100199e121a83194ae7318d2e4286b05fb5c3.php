<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
     <?php $__env->endSlot(); ?>

    <?php
        $allCount = 0;
    ?>
    <div class="p-6">

        <form method="POST" enctype="multipart/form-data" action="<?php echo e(route('reports.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="border-2 my-5 border-dashed p-5">
                <details open>
                    <summary class="flex mb-5 cursor-pointer">
                        <div class="justify-start">
                            <h1
                                class="text-3xl text-gray-700 border-b-2 pb-2 border-dashed  border-gray-400 pl-[3.2rem] mr-2">
                                التفاصيل</h1>
                        </div>
                    </summary>

                    <div class=" flex flex-col gap-4 w-full xl:w-1/2">
                        <div class="grid grid-cols-4">
                            <label class="my-auto" for="user_name"><?php echo e(__('Inspector Name')); ?></label>
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo e(auth()->id()); ?>" />
                            <input class=" col-span-3 border-gray-300 bg-gray-100 text-gray-600 rounded-xl" type="text"
                                name="user_name" id="user_name" value="<?php echo e(auth()->user()->name); ?>" disabled />
                        </div>
                        <div class="grid grid-cols-4">
                            <label class="my-auto" for="project_name">
                                <?php switch($project->category->name):
                                    case ('مراكز الترفيه ومدن الملاهي'): ?>
                                        <?php echo e(__('اسم المركز الترفيهي')); ?> :
                                    <?php break; ?>
                                    <?php case ('الفعاليات الترفيهية'): ?>
                                        <?php echo e(__('اسم ومكان الفعالية')); ?> :
                                    <?php break; ?>
                                    <?php case ('العروض الحية في المطاعم والمقاهي'): ?>
                                        <?php echo e(__('اسم المطعم/المقهى')); ?> :
                                    <?php break; ?>
                                    <?php default: ?>

                                <?php endswitch; ?>
                            </label>
                            <input type="hidden" name="project_id" id="project_id" value="<?php echo e($project->id); ?>" />
                            <input class=" col-span-3 border-gray-300 bg-gray-100 text-gray-600 rounded-xl" type="text"
                                name="project_name" id="project_name" value="<?php echo e($project->name); ?>" disabled />
                        </div>
                        <div class="grid grid-cols-4">
                            <label class="my-auto" for="city_name"><?php echo e(__('City / State')); ?></label>
                            <input type="hidden" name="city_id" id="city_id" value="<?php echo e($project->city->id); ?>" />
                            <input class=" col-span-3 border-gray-300 bg-gray-100 text-gray-600 rounded-xl" type="text"
                                name="city_name" id="city_name"
                                value="<?php echo e($project->city->name . ' / ' . $project->city->area->area->name); ?>"
                                disabled />
                        </div>
                        <div class="grid grid-cols-4">
                            <label class="my-auto" for="location"><?php echo e(__('Location')); ?></label>
                            <input class=" col-span-3 border-gray-300 bg-gray-50 text-gray-600 rounded-xl" type="text"
                                name="location" id="location" required>
                            <input type="hidden" name="place_json" id="place_json">
                        </div>
                        <div id="map" class="col-span-full h-[250px] hover:shadow-xl rounded-xl transition-all duration-150 hover:scale-105"></div>
                        <div class="grid grid-cols-4">
                            <label class="my-auto" for="report_date"><?php echo e(__('Inspection Date')); ?></label>
                            <input type="date" name="report_date" id="report_date" required
                                class=" col-span-3 border-gray-300 bg-gray-50 rounded-xl text-right" />
                        </div>
                        <div class="grid grid-cols-4">
                            <label class="my-auto" for="report_time"><?php echo e(__('Inspection Time')); ?></label>
                            <input type="time" name="report_time" id="report_time" required
                                class=" col-span-3 border-gray-300 bg-gray-50 rounded-xl text-right" />
                        </div>
                        <div class="grid grid-cols-4">
                            <label class="my-auto" for="license_id"><?php echo e(__('Permit ID')); ?></label>
                            <input type="text" name="license_id" id="license_id"
                                class=" col-span-3 border-gray-300 bg-gray-50 rounded-xl" />
                        </div>
                        <div class="grid grid-cols-4">
                            <label class="my-auto"
                                for="license_expiration"><?php echo e(__('Permit Expiration Date')); ?></label>
                            <input type="date" name="license_expiration" id="license_expiration"
                                class=" col-span-3 border-gray-300 bg-gray-50 rounded-xl text-right" />
                        </div>
                        <div class="grid grid-cols-4">
                            <label class="my-auto"
                                for="commercial_license_id"><?php echo e(__('Commercial license ID')); ?></label>
                            <input type="text" name="commercial_license_id" id="commercial_license_id"
                                class=" col-span-3 border-gray-300 bg-gray-50 rounded-xl" />
                        </div>
                    </div>

                </details>
            </div>
            <div class="mt-3 border-2 border-dashed p-8 text-lg ">

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
                        <?php $__currentLoopData = explode(',', $project->category->comma_seperated_list); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-index="<?php echo e($index); ?>"
                                class="bg-white xl:hover:bg-gray-100 flex xl:table-row flex-row xl:flex-row flex-wrap xl:flex-no-wrap mb-10 xl:mb-0 border-collapse shadow-lg xl:shadow-none relative">
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <textarea name="row[<?php echo e($index); ?>][inspection]" id=""
                                        class="border-none w-full h-full" rows="3"><?php echo e(trim($value)); ?></textarea>

                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <select name="row[<?php echo e($index); ?>][check]" id=""
                                        class="border-none w-full h-full m-0">
                                        <option value="YES"><?php echo e(__('Yes')); ?></option>
                                        <option value="NO"><?php echo e(__('No')); ?></option>
                                        <option value="NA"><?php echo e(__('N\\A')); ?></option>
                                    </select>
                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <input type="text" name="row[<?php echo e($index); ?>][notes]" id=""
                                        class="border-none w-full h-full" placeholder="<?php echo e(__('Notes')); ?>">
                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static ">
                                    <input type="file" class="hidden" multiple
                                        name="row[<?php echo e($index); ?>][files][]" id="files-<?php echo e($index); ?>"
                                        class="border-none w-full h-full" accept="image/*,video/*"
                                        data-index="<?php echo e($index); ?>">
                                    <span id="filecount-<?php echo e($index); ?>"></span>
                                    <span
                                        class="material-icons my-auto h-full w-full cursor-pointer hover:text-green-400"
                                        onclick="$('#files-<?php echo e($index); ?>').trigger('click')">attach_file</span>
                                </td>
                            </tr>

                            <?php
                                $allCount = $index;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    
                </table>
            </div>
            <div class="mt-3 border-2 bg-white rounded-xl p-8 text-lg">
                <label for="notes"><?php echo e(__('Notes')); ?></label>
                <textarea name="notes" id="notes" cols="30" rows="3" placeholder="<?php echo e(__('Write your notes here')); ?>"
                    class="w-full border-gray-300 rounded bg-gray-50"></textarea>
            </div>
            <div class="mt-3 border-2 bg-white rounded-xl p-8 text-lg">
                <label for="recommendations"><?php echo e(__('Recommendations')); ?></label>
                <textarea name="recommendations" id="recommendations" cols="30" rows="3"
                    placeholder="<?php echo e(__('Write your recommendations here')); ?>"
                    class="w-full border-gray-300 rounded bg-gray-50"></textarea>
            </div>

            <div class="mt-3 rounded-xl p-8 text-lg">
                <button type="submit" class="bg-green-500 text-xl rounded py-4 px-4 text-white w-full">حفظ</button>
            </div>
        </form>
    </div>

    <?php $__env->startPush('custom-scripts'); ?>

        <script async
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKt6rV3HX9odJ6RkStewHB_MU2zhS8oMA&libraries=places&callback=initMap&language=ar&region=SA">
        </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $('input[type=file]').change(function(e) {
                e.preventDefault();
                $('#filecount-' + this.dataset.index).html('تم تحديد ' + this.files.length + ' ملفات');
            });
            let index = <?php echo e($allCount); ?>;
            $('#addNewCheckItem').click(function(e) {
                e.preventDefault();
                let chechItemRowHtml = `<tr data-index="${index++}" class="bg-white xl:hover:bg-gray-100 flex xl:table-row flex-row xl:flex-row flex-wrap xl:flex-no-wrap mb-10 xl:mb-0 border-collapse shadow-lg">
                                <td class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <textarea name="row[${index}][inspection]" id=""
                                        class="border-none w-full h-full" rows="3" required></textarea>
                                </td>
                                <td class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <select name="row[${index}][check]" id="" class="border-none w-full h-full m-0" required>
                                        <option value="YES"><?php echo e(__('Yes')); ?></option>
                                        <option value="NO"><?php echo e(__('No')); ?></option>
                                        <option value="NA"><?php echo e(__('N\\A')); ?></option>
                                    </select>
                                </td>
                                <td class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <input type="text" name="row[${index}][notes]" id="" class="border-none w-full h-full" placeholder="<?php echo e(__('Notes')); ?>">
                                </td>
                                <td class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static ">
                                    <input type="file" class="hidden" multiple name="row[${index}][files]" id="files-${index}" class="border-none w-full h-full">

                                </td>
                            </tr>`;
                $('#checkItemLines').append(chechItemRowHtml);
            });
            $('#upload_files').on('click', function(event) {
                event.preventDefault();
                $('#file').trigger('click')
            });
            $('#file').change(function() {
                // Get the selected file
                var files = $('#file')[0].files;
                $('#preview').html(``);
                Object.values(files).forEach(file => {

                    if (file.type.indexOf('image/') >= 0) {
                        let previewHtml =
                            `<img class="bg-white rounded-3xl h-[150px] min-w-[150px] max-w-[150px] w-[150px] shadow-lg object-cover border-2" src="${URL.createObjectURL(file)}"/>`;
                        $('#preview').append(previewHtml);
                    } else {
                        let previewHtml =
                            `<video src="${URL.createObjectURL(file)}" class="h-[150px] min-w-[150px] shadow-lg rounded-3xl border-2" controls></video>`;
                        $('#preview').append(previewHtml);
                    }
                });
            });
            $('#addNewTypeForm').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('types.store')); ?>",
                    data: formData,

                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#addNewTypeModal').addClass('hidden');
                        Swal.fire({
                            'title': 'تم إضافة نوع ملاحظة / مشكلة',
                            'icon': 'success'
                        });
                        let options = ``;
                        console.log(response.types);
                        response.types.forEach(type => {
                            options +=
                                `<option value="${type.id}" ${type.name == e.target.name.value? 'selected' : ''}>${type.name}</option>`;
                        });
                        console.log(options);
                        $('#type_id').html(options);
                    }
                });
            });
            $('#exit_button').click(function(e) {
                e.preventDefault();
                $('#addNewTypeModal').addClass('hidden');
            });
            $('#addNewType').click(function(e) {
                e.preventDefault();
                $('#addNewTypeModal').removeClass('hidden');
            });

            let selectedLocation = {
                lat: 23.794850198707053,
                lng: 45.14557369331874
            };

            function initMap() {
                const input = document.getElementById("location");
                const options = {
                    componentRestrictions: {
                        country: "sa"
                    },
                    fields: ["address_components", "geometry", "icon", "name"],
                    strictBounds: false,
                };
                const autocomplete = new google.maps.places.Autocomplete(input, options);
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
                autocomplete.addListener("place_changed", () => {
                    // infowindow.close();
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();
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
                    // infowindowContent.children["place-name"].textContent = place.name;
                    // infowindowContent.children["place-address"].textContent =
                    //     place.formatted_address;
                    // infowindow.open(map, marker);
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
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/inspection/create.blade.php ENDPATH**/ ?>