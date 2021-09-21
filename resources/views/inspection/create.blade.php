<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    @php
        $allCount = 0;
    @endphp
    <div class="xl:p-12 xl:p-8 p-4">
        <div class="bg-[#FCB634] text-3xl py-4 text-center tracking-tighter text-[#673B8C] font-semibold rounded-xl">
            التفتيش على {{ __($project->category->name) }}
        </div>
        <form method="POST" enctype="multipart/form-data" action="{{ route('reports.store') }}">
            @csrf
            {{-- 'user_id', 'project_id', 'license_id', 'report_date', 'report_time', 'licence_expiration', 'commercial_license_id' --}}
            <div class="mt-3 border-2 bg-white rounded-xl py-4 px-2 text-lg">
                <div class=" flex flex-col gap-4 w-full xl:w-1/2">
                    <div class="grid grid-cols-4">
                        <label class="my-auto" for="user_name">{{ __('Inspector Name') }}</label>
                        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->id() }}" />
                        <input class=" col-span-3 border-gray-300 bg-gray-100 text-gray-600 rounded-xl" type="text"
                            name="user_name" id="user_name" value="{{ auth()->user()->name }}" disabled />
                    </div>
                    <div class="grid grid-cols-4">
                        <label class="my-auto" for="project_name">
                            @switch($project->category->name)
                                @case('مراكز الترفيه ومدن الملاهي')
                                    {{ __('اسم المركز الترفيهي') }} :
                                @break
                                @case('الفعاليات الترفيهية')
                                    {{ __('اسم ومكان الفعالية') }} :
                                @break
                                @case('العروض الحية في المطاعم والمقاهي')
                                    {{ __('اسم المطعم/المقهى') }} :
                                @break
                                @default

                            @endswitch
                        </label>
                        <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}" />
                        <input class=" col-span-3 border-gray-300 bg-gray-100 text-gray-600 rounded-xl" type="text"
                            name="project_name" id="project_name" value="{{ $project->name }}" disabled />
                    </div>
                    <div class="grid grid-cols-4">
                        <label class="my-auto" for="city_name">{{ __('City / State') }}</label>
                        <input type="hidden" name="city_id" id="city_id" value="{{ $project->city->id }}" />
                        <input class=" col-span-3 border-gray-300 bg-gray-100 text-gray-600 rounded-xl" type="text"
                            name="city_name" id="city_name"
                            value="{{ $project->city->name . ' / ' . $project->city->area->name }}" disabled />
                    </div>
                    <div class="grid grid-cols-4">
                        <label class="my-auto" for="report_date">{{ __('Inspection Date') }}</label>
                        <input type="date" name="report_date" id="report_date" required
                            class=" col-span-3 border-gray-300 bg-gray-50 rounded-xl" />
                    </div>
                    <div class="grid grid-cols-4">
                        <label class="my-auto" for="report_time">{{ __('Inspection Time') }}</label>
                        <input type="time" name="report_time" id="report_time" required
                            class=" col-span-3 border-gray-300 bg-gray-50 rounded-xl" />
                    </div>
                    <div class="grid grid-cols-4">
                        <label class="my-auto" for="license_id">{{ __('Permit ID') }}</label>
                        <input type="text" name="license_id" id="license_id"
                            class=" col-span-3 border-gray-300 bg-gray-50 rounded-xl" />
                    </div>
                    <div class="grid grid-cols-4">
                        <label class="my-auto"
                            for="license_expiration">{{ __('Permit Expiration Date') }}</label>
                        <input type="date" name="license_expiration" id="license_expiration"
                            class=" col-span-3 border-gray-300 bg-gray-50 rounded-xl" />
                    </div>
                    <div class="grid grid-cols-4">
                        <label class="my-auto"
                            for="commercial_license_id">{{ __('Commercial license ID') }}</label>
                        <input type="text" name="commercial_license_id" id="commercial_license_id"
                            class=" col-span-3 border-gray-300 bg-gray-50 rounded-xl" />
                    </div>
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
                        @foreach (explode(',', $project->category->comma_seperated_list) as $index => $value)
                            <tr data-index="{{ $index }}"
                                class="bg-white xl:hover:bg-gray-100 flex xl:table-row flex-row xl:flex-row flex-wrap xl:flex-no-wrap mb-10 xl:mb-0 border-collapse shadow-lg xl:shadow-none relative">
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <textarea name="row[{{ $index }}][inspection]" id=""
                                        class="border-none w-full h-full" rows="3">{{ trim($value) }}</textarea>
                                    <div class="absolute top-0 -right-7 bottom-0 text-xl flex"><span
                                            class="material-icons my-auto bg-gray-300 rounded-full cursor-pointer hover:bg-red-500 text-white"
                                            onclick="confirm('{{ 'Are you sure you want to delete this item?' }}') && $('[data-index={{ $index }}]').remove()">close</span>
                                    </div>
                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <select name="row[{{ $index }}][check]" id=""
                                        class="border-none w-full h-full m-0">
                                        <option value="YES">{{ __('Yes') }}</option>
                                        <option value="NO">{{ __('No') }}</option>
                                        <option value="NA">{{ __('N\\A') }}</option>
                                    </select>
                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <input type="text" name="row[{{ $index }}][notes]" id=""
                                        class="border-none w-full h-full" placeholder="{{ __('Notes') }}">
                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static ">
                                    <input type="file" class="hidden" multiple
                                        name="row[{{ $index }}][files][]" id="files-{{ $index }}"
                                        class="border-none w-full h-full" accept="image/*,video/*"
                                        data-index="{{ $index }}">
                                    <span id="filecount-{{ $index }}"></span>
                                    <span
                                        class="material-icons my-auto h-full w-full cursor-pointer hover:text-green-400"
                                        onclick="$('#files-{{ $index }}').trigger('click')">attach_file</span>
                                </td>
                            </tr>

                            @php
                                $allCount = $index;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <button
                                    class="w-full h-full py-2 bg-gray-50 hover:bg-indigo-50 transition-all duration-100 text-gray-700 text-xl flex justify-center"
                                    id="addNewCheckItem">
                                    <span class="my-auto">{{ __('Add new line') }}</span>
                                    <span class="material-icons my-auto">add</span>
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="mt-3 border-2 bg-white rounded-xl p-8 text-lg">
                <label for="notes">{{ __('Notes') }}</label>
                <textarea name="notes" id="notes" cols="30" rows="3" placeholder="{{ __('Write your notes here') }}"
                    class="w-full border-gray-300 rounded bg-gray-50"></textarea>
            </div>
            <div class="mt-3 border-2 bg-white rounded-xl p-8 text-lg">
                <label for="recommendations">{{ __('Recommendations') }}</label>
                <textarea name="recommendations" id="recommendations" cols="30" rows="3"
                    placeholder="{{ __('Write your recommendations here') }}"
                    class="w-full border-gray-300 rounded bg-gray-50"></textarea>
            </div>

            <div class="mt-3 rounded-xl p-8 text-lg">
                <button type="submit" class="bg-green-500 text-xl rounded py-4 px-4 text-white w-full">حفظ</button>
            </div>
        </form>
    </div>



    @push('custom-scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            //import Swal from 'sweetalert2'
            $('input[type=file]').change(function(e) {
                e.preventDefault();
                $('#filecount-' + this.dataset.index).html('تم تحديد ' + this.files.length + ' ملفات');
            });
            let index = {{ $allCount }};
            $('#addNewCheckItem').click(function(e) {
                e.preventDefault();
                let chechItemRowHtml = `<tr data-index="${index++}" class="bg-white xl:hover:bg-gray-100 flex xl:table-row flex-row xl:flex-row flex-wrap xl:flex-no-wrap mb-10 xl:mb-0 border-collapse shadow-lg">
                                <td class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <textarea name="row[${index}][inspection]" id=""
                                        class="border-none w-full h-full" rows="3" required></textarea>
                                </td>
                                <td class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <select name="row[${index}][check]" id="" class="border-none w-full h-full m-0" required>
                                        <option value="YES">{{ __('Yes') }}</option>
                                        <option value="NO">{{ __('No') }}</option>
                                        <option value="NA">{{ __('N\\A') }}</option>
                                    </select>
                                </td>
                                <td class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    <input type="text" name="row[${index}][notes]" id="" class="border-none w-full h-full" placeholder="{{ __('Notes') }}">
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
                    url: "{{ route('types.store') }}",
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
        </script>
    @endpush
</x-app-layout>
