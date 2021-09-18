<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <div class="p-12">
        <div class="bg-white border-2 rounded-xl p-5">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <form action="{{ route('inspection.store') }}" method="post" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-xl font-bold text-[#673B8C]">
                        {{ $project->name }}
                    </h1>
                    <label for="type_id" class="mt-5 block">نوع الملاحظة / المشكلة</label>
                    <div class="flex gap-2">
                        <select name="type_id" id="type_id"
                            class="block border border-gray-400 bg-gray-100 rounded w-full">
                            @foreach (\App\Models\InspectionType::all() as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <button
                            class="bg-green-500 text-white font-bold tracking-tight px-4 w-6/12 rounded shadow hover:shadow-lg transition-shadow duration-75"
                            id="addNewType">
                            إضافة نوع جديد
                        </button>
                    </div>

                    <input type="hidden" name="project_id" required value="{{ $project->id }}" />
                    <input type="hidden" name="user_id" required value="{{ auth()->user()->id }}" />

                    <label for="comments" class="mt-5 block">الملاحظات</label>
                    <textarea name="comments" id="comments" cols="30" rows="10"
                        class="block border-gray-400 bg-gray-100 w-full"></textarea>
                    @csrf
                    {{-- <label class="font-extrabold mt-10 text-[#673B8C] text-xl block" for="file">إضافة مرفقات</label>
                    <button
                        class="bg-[#e5e6e7] text-[#673B8C] flex flex-col  items-center justify-center p-8 rounded-3xl border border-gray-400 my-4"
                        id="upload_files">
                        <span class="material-icons md-48">
                            add
                        </span>
                    </button>
                    <input id="file" type="file" name="files[]" class="hidden" accept="image/*, video/*"
                        multiple />
                    <div class="flex gap-4" id="preview">

                    </div> --}}
                    <button type="submit"
                        class="bg-[#FCB634] px-4 py-2 rounded block text-[#673B8C] border-[#673B8C] border font-bold mt-5">{{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>



    <div class="absolute top-0 left-0 right-0 bottom-0 lg:right-[380px] bg-black/20  backdrop-blur-md grid place-content-center place-items-center overflow-hidden hidden"
        id="addNewTypeModal">
        <div class="bg-white shadow-xl rounded p-2">

            <div class="py-4 px-8 ">
                <div class="flex justify-between gap-20">
                    <h1 class="text-xl font-bold text-[#673B8c] my-auto tracking-tight" id="modalTitle">
                        إضافة نوع ملاحظة / مشكلة جديدة
                    </h1>
                    <div id="exit_button"
                        class="text-[#673B8c] my-auto text-3xl cursor-pointer hover:text-red-500 transition duration-75">
                        &times;</div>
                </div>
                <div class="flex flex-col gap-4 mt-5 max-h-[500px] overflow-y-auto">

                    <form method="POST" action="{{ route('types.store') }}" id="addNewTypeForm">
                        @csrf
                        <input type="text" name="name" id="name"
                            class="w-full rounded-xl border border-[#FCB634] shadow-lg">
                        <button type="submit"
                            class="bg-[#673B8C] text-white px-4 py-2 rounded-xl text-lg w-full mt-3 shadow-lg">إضافة</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            //import Swal from 'sweetalert2'
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
