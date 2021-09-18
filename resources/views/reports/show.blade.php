<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <div class=" xl:p-8 p-4">

        <div class="bg-[#FCB634] text-3xl py-4 text-center tracking-tighter text-[#673B8C] font-semibold rounded-xl">
            التفتيش على الفعاليات الترفيهية
        </div>
        <form method="POST" enctype="multipart/form-data" action="{{ route('reports.store') }}">
            @csrf
            {{-- 'user_id', 'project_id', 'license_id', 'report_date', 'report_time', 'licence_expiration', 'commercial_license_id' --}}
            <div class="mt-3 border-2 bg-white rounded-xl py-4 px-2 text-lg grid grid-cols-2">
                <div class=" flex flex-col gap-4 w-full xl:w-1/2 p-5">
                    <div class="border-b py-2">
                        {{ __('Inspector Name') }} : {{ $report->user->name }}
                    </div>
                    <div class="border-b py-2">
                        {{ __('Project Name') }} : {{ $report->project->name }}
                    </div>
                    <div class="border-b py-2">
                        {{ __('City / State') }} :
                        {{ $report->project->city->name . ' / ' . $report->project->city->area->name }}
                    </div>
                    <div class="border-b py-2">
                        {{ __('Inspection Date') }} : {{ $report->report_date }}
                    </div>
                    <div class="border-b py-2">
                        {{ __('Inspection Time') }} : {{ $report->report_time }}
                    </div>
                    @if ($report->license_id)
                        <div class="border-b py-2">
                            {{ __('Permit ID') }} : {{ $report->license_id }}
                        </div>
                        <div class="border-b py-2">
                            {{ __('Permit Expiration Date') }} : {{ $report->license_expiration }}
                        </div>
                    @endif
                    @if ($report->commercial_license_id)
                        {{ __('Commercial license ID') }} : {{ $report->commercial_license_id }}
                    @endif
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
                        @foreach ($report->checklist->checkitems as $item)
                            <tr data-index="${index++}"
                                class="bg-white xl:hover:bg-gray-100 flex xl:table-row flex-row xl:flex-row flex-wrap xl:flex-no-wrap mb-10 xl:mb-0 border-collapse shadow-lg">
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 border border-b block xl:table-cell relative xl:static">
                                    <p>{{ $item->inspection }}</p>
                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    {{ __($item->check) }}
                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    {{ $item->notes }}
                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static ">
                                    <input type="file" class="hidden" multiple name="row[${index}][files]"
                                        id="files-${index}" class="border-none w-full h-full">

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
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
                    </tfoot> --}}
                </table>
            </div>
            {{-- <div class="mt-3 rounded-xl p-8 text-lg">
                <button type="submit" class="bg-green-500 text-xl rounded py-4 px-4 text-white w-full">حفظ</button>
            </div> --}}
        </form>
    </div>



    @push('custom-scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            //import Swal from 'sweetalert2'
            //             let index = 0;
            //             let defaultCheckItems = `هل المنشأة تحمل تصريح ساري المفعول من الهيئة العامة للترفيه  ,
    // هل تم الالتزام بالسماح للمفتشين بالدخول لموقع النشاط وتسهيل أدائهم لمهامهم,
    // هل تم الالتزام بإيقاف الموسيقى والعروض قبل الاذان ب15 دقيقه وحتى 45 دقيقة بعد الأذان,
    // هل تم الالتزام بعدم خروج الصوت خارج حدود مقر النشاط,
    // هل تم توفير بطاقات تعريفية للعاملين، وسترات مميزة تبين مهامهم.,
    // هل تم التعاقد مع شركات الحراسات الأمنية المرخصة لحفظ الأمن والسلامة وتوفير الحراسة من الجنسين حسب فئة الزوار المستهدفة ,
    // هل تم عرض خريطة تفصيلية للموقع بشكل واضح للزوار ولوحات إرشادية داخل وخارج الموقع,
    // هل تم الالتزام بالمظهر اللائق والسلوك الاحترافي.,
    // هل تم الالتزام ببيع التذاكر من خلال مزود خدمة معتمد من قبل الهيئة,
    // هل تم الالتزام بتعيين مسؤول متواجد طوال فترة الفعالية,
    // هل تم الالتزام بتوفير كاميرات مراقبة في الفعالية`;

            //             // protected $fillable = ['checklist_id', 'check', 'notes', 'inspection'];

            //             defaultCheckItems.split(',').forEach(function(item) {
            //                 let chechItemRowHtml = ` <tr data-index="${index++}" class="bg-white xl:hover:bg-gray-100 flex xl:table-row flex-row xl:flex-row flex-wrap xl:flex-no-wrap mb-10 xl:mb-0 border-collapse shadow-lg">
    //                                 <td class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
    //                                     <textarea name="row[${index}][inspection]" id=""
    //                                         class="border-none w-full h-full" rows="3">${item}</textarea>
    //                                 </td>
    //                                 <td class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
    //                                     <select name="row[${index}][check]" id="" class="border-none w-full h-full m-0">
    //                                         <option value="YES">{{ __('Yes') }}</option>
    //                                         <option value="NO">{{ __('No') }}</option>
    //                                         <option value="N\\A">{{ __('N\\A') }}</option>
    //                                     </select>
    //                                 </td>
    //                                 <td class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
    //                                     <input type="text" name="row[${index}][notes]" id="" class="border-none w-full h-full" placeholder="{{ __('Notes') }}">
    //                                 </td>
    //                                 <td class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static ">
    //                                     <input type="file" class="hidden" multiple name="row[${index}][files]" id="files-${index}" class="border-none w-full h-full">

    //                                 </td>
    //                             </tr>`;
            //                 $('#checkItemLines').append(chechItemRowHtml);
            //             })

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
                                        <option value="N\\A">{{ __('N\\A') }}</option>
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
