<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <div class="p-12">
        <div class="flex justify-end">
            @if ($inspection->user->id == auth()->user()->id)
                @if ($inspection->isApproved->count() == 0 && $inspection->isPending->count() == 0)
                    <form action="{{ route('approvals.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="inspection_id" value="{{ $inspection->id }}">
                        <button type="submit"
                            class="bg-[#FBB445] text-[#673B8C] text-lg font-bold py-2 px-4 mb-4 rounded-lg shadow">
                            طلب الموافقة
                        </button>
                    </form>
                @elseif($inspection->isApproved->count() > 0 )
                    <p class="text-green-800 mb-4">
                        تم قبول هذا التقرير
                    </p>
                @elseif($inspection->isPending->count() > 0 )
                    <p class="text-gray-800 mb-4">
                        هذا المشروع بإنتظار الموافقة
                    </p>
                @endif
            @elseif (auth()->user()->role_id == \App\Models\Role::IS_SUPERVISOR)
                @if ($inspection->isPending->count() > 0)

                    @foreach ($inspection->isPending as $approval)
                        {{-- 'inspection_id', 'user_id', 'feedback', 'approved' --}}
                        <form action="{{ route('approvals.update', $approval) }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="inspection_id" value="{{ $inspection->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="approved" value="1">

                            <button type="submit"
                                class="bg-green-500 text-white text-lg font-bold py-2 px-4 mb-4 rounded-lg shadow">
                                موافقة
                            </button>
                        </form>
                        <form action="{{ route('approvals.update', $approval) }}" method="post" id="decline_form">
                            @csrf
                            @method('put')
                            <input type="hidden" name="inspection_id" value="{{ $inspection->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="approved" value="0">
                            <input type="text" name="feedback" id="feedback" class="hidden">
                            <button type="submit"
                                class="bg-red-500 text-white text-lg font-bold py-2 px-4 mb-4 rounded-lg shadow mr-4">
                                رفض
                            </button>
                        </form>
                    @endforeach
                @endif
            @endif

        </div>
        <div class="bg-white border-2 rounded-xl p-5">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <form action="{{ route('inspection.update', $inspection) }}" method="post" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <h1 class="text-xl font-bold text-[#673B8C]">
                        {{ $inspection->project->name }}
                    </h1>
                    <label for="type_id" class="mt-5 block">نوع الملاحظة / المشكلة</label>
                    <select name="type_id" id="type_id" class="block border border-gray-400 bg-gray-100 rounded w-full">
                        @foreach (\App\Models\InspectionType::all() as $type)
                            <option value="{{ $type->id }}"
                                {{ $type->id == $inspection->type->id ? ' selected' : '' }}>{{ $type->name }}
                            </option>
                        @endforeach
                    </select>

                    <input type="hidden" name="project_id" required value="{{ $inspection->project->id }}" />
                    <input type="hidden" name="user_id" required value="{{ auth()->user()->id }}" />

                    <label for="comments" class="mt-5 block">الملاحظات</label>
                    <textarea name="comments" id="comments" cols="30" rows="10"
                        class="block border-gray-400 bg-gray-100 w-full"
                        value={{ $inspection->comments }}> {{ $inspection->comments }}</textarea>
                    @csrf
                    <button type="submit"
                        class="bg-[#FCB634] px-4 py-2 rounded block text-[#673B8C] border-[#673B8C] border font-bold mt-5">{{ __('Save') }}
                    </button>
                </form>
                <div id="declines" class="p-5">
                    <div class="flex flex-col w-full gap-4">
                        @foreach ($inspection->declines as $decline)
                            <div class="w-full py-4 px-4  font-semibold bg-gray-50 rounded-xl shadow-md">
                                تم رفض التقرير من قبل
                                <span class="font-bold">
                                    {{ $decline->user->name }}
                                </span>
                                منذ
                                <span>
                                    {{ $decline->updated_at->diffForHumans() }}
                                </span>
                                <br>
                                <p class="mt-2 ">
                                    <span class="italic">
                                        {{ $decline->feedback }}
                                    </span>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-span-full">

                    <label class=" font-extrabold mt-10 text-[#673B8C] text-xl block" for="file">إضافة مرفقات <progress
                            class="hidden"></label>
                    <button
                        class="bg-[#e5e6e7] text-[#673B8C] flex flex-col  items-center justify-center p-8 rounded-3xl border border-gray-400 my-4"
                        id="upload_files">
                        <span class="material-icons md-48">
                            add
                        </span>
                    </button>
                    <input id="file" type="file" name="file" class="hidden" accept="image/*, video/*" />
                    <div class="flex gap-4 flex-wrap w-full" id="preview">
                        @foreach ($inspection->media as $item)
                            @if (str_contains($item->mimeType, 'image/'))
                                <a href="{{ $item->url }}" target="_blank"
                                    class="bg-white rounded-3xl h-[150px] min-w-[150px] max-w-[150px] w-[150px] shadow-lg  border-2 overflow-hidden">
                                    <img class="object-cover w-full h-full" src="{{ $item->url }}" loading="lazy" />
                                </a>
                            @else
                                <video src="{{ $item->url }}"
                                    class="h-[150px] min-w-[150px] shadow-lg rounded-3xl border-2" controls></video>
                            @endif
                        @endforeach
                    </div>
                </div>
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
                var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                var files = $('#file')[0].files;
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
                    if (files.length > 0) {
                        var fd = new FormData();
                        fd.append('file', files[0]);
                        fd.append('_token', CSRF_TOKEN);
                        fd.append('inspection_id', "{{ $inspection->id }}");
                        fd.append('user_id', "{{ auth()->user()->id }}");
                        $('progress').show();
                        // AJAX request
                        $.ajax({
                            url: "{{ route('upload_file') }}",
                            method: 'post',
                            data: fd,
                            contentType: false,
                            processData: false,

                            xhr: function() {
                                var myXhr = $.ajaxSettings.xhr();
                                if (myXhr.upload) {
                                    myXhr.upload.addEventListener('progress', function(e) {
                                        if (e.lengthComputable) {
                                            $('progress').attr({
                                                value: e.loaded,
                                                max: e.total,
                                            });
                                        }
                                    }, false);
                                }
                                return myXhr;
                            },
                            success: function(response) {
                                if (response.success == 1) {
                                    $('progress').hide();
                                } else {
                                    alert(response.error);
                                }
                            },
                            error: function(response) {
                                console.log("error : " + JSON.stringify(response));
                            }
                        });
                    } else {
                        alert("رجاءا اختر ملف");
                    }
                });
            });
            $('#decline_form').submit(function(event) {
                event.preventDefault();
                let feedback = prompt('ما هو سبب الرفض؟');
                if (feedback == null) {
                    alert('يجب ادخال سبب الرفض');
                } else {
                    $('#feedback').val(feedback);
                    this.submit();
                }
            });
        </script>
    @endpush
</x-app-layout>
