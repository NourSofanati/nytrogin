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
                    <select name="type_id" id="type_id" class="block border border-gray-400 bg-gray-100 rounded w-full">
                        @foreach (\App\Models\InspectionType::all() as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>

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
    @push('custom-scripts')
        <script>
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
        </script>
    @endpush
</x-app-layout>
