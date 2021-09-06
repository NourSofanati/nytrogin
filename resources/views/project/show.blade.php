<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">

                @include('project.project_status',['project'=>$project])
                <div class="text-2xl text-white font-bold bg-[#673B8C] col-span-full py-12 text-center rounded-[50px]">
                    {{ $project->area->name }}
                </div>
                <div
                    class="text-2xl text-[#673B8C] font-bold bg-[#FBB23A] col-span-full py-12 text-center   rounded-[50px]">
                    {{ $project->category->name }}
                </div>
                <div
                    class="bg-[#E5E6E7] text-[#673B8C] border border-[#673B8C] px-4 py-3 mt-3 text-2xl rounded-3xl col-span-2">

                    <p class="w-full grid grid-cols-2"><span class="font-bold ">اسم المشروع:
                        </span>{{ $project->name }}</p>
                </div>
                <div
                    class="bg-[#E5E6E7] text-[#673B8C] border border-[#673B8C] px-4 py-3 mt-3 row-span-2 text-2xl rounded-3xl col-span-2">

                    <p class="w-full  "><span class="font-bold ">الوصف:
                        </span><br>{{ $project->description }}</p>
                </div>
                <div
                    class="bg-[#E5E6E7] text-[#673B8C] border border-[#673B8C] px-4 py-3 mt-3 text-2xl rounded-3xl col-span-2 relative">
                    <span class="font-bold ">الملاحظات:
                    </span>
                    <div id="editorjs"></div>
                    <button id="save-button" class="absolute top-5 left-5">
                        <span class="material-icons">
                            save
                        </span>
                        حفظ
                    </button>
                </div>
                <div class=" p-5 col-span-full relative">

                    <div class="flex justify-between py-2 text-lg">

                        @if (auth()->user()->role->id == \App\Models\Role::IS_SUPERVISOR && $project->status == 'pending_2')

                            <form action="{{ route('project.approve_project') }}" method="post">
                                <input type="hidden" value="{{ $project->id }}" name="project_id">
                                @csrf
                                <x-jet-button class="text-md tracking-tight bg-green-500">
                                    موافقة
                                </x-jet-button>
                            </form>
                            <form action="{{ route('project.decline_project') }}" method="post">
                                <input type="hidden" value="{{ $project->id }}" name="project_id">
                                @csrf
                                <x-jet-button class="text-md tracking-tight bg-red-500">
                                    رفض
                                </x-jet-button>
                            </form>
                        @elseif(auth()->user()->role->id == \App\Models\Role::IS_PROCURATOR &&
                            $project->status == 'pending_3')
                            <form action="{{ route('project.approve_project_procurator') }}" method="post">
                                <input type="hidden" value="{{ $project->id }}" name="project_id">
                                @csrf
                                <x-jet-button class="text-md tracking-tight bg-green-500">
                                    موافقة
                                </x-jet-button>
                            </form>
                            <form action="{{ route('project.decline_project_procurator') }}" method="post">
                                <input type="hidden" value="{{ $project->id }}" name="project_id">
                                @csrf
                                <x-jet-button class="text-md tracking-tight bg-red-500">
                                    رفض
                                </x-jet-button>
                            </form>
                        @elseif(auth()->user()->role->id == \App\Models\Role::IS_ADMIN &&
                            $project->status == 'pending_4')
                            <form action="{{ route('project.approve_project_admin') }}" method="post">
                                <input type="hidden" value="{{ $project->id }}" name="project_id">
                                @csrf
                                <x-jet-button class="text-md tracking-tight bg-green-500">
                                    موافقة
                                </x-jet-button>
                            </form>
                            <form action="{{ route('project.decline_project_admin') }}" method="post">
                                <input type="hidden" value="{{ $project->id }}" name="project_id">
                                @csrf
                                <x-jet-button class="text-md tracking-tight bg-red-500">
                                    رفض
                                </x-jet-button>
                            </form>
                        @endif
                    </div>

                    @if (($project->status == 'pending_1' || explode('_', $project->status)[0] == 'declined') && auth()->user()->role_id == \App\Models\Role::IS_INSPECTOR)
                        <form action="{{ route('project.request_approval_from_supervisor') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $project->id }}" name="project_id">
                            <x-jet-button type="submit"
                                class="mt-4 bg-[#FBBC41] tracking-tighter text-lg w-full md:w-1/2 lg:w-1/3">
                                طلب الموافقة من المشرفين
                            </x-jet-button>
                        </form>
                    @endif
                </div>
                <div class=" col-span-full">
                    <form enctype="multipart/form-data" id="stupid_form" action="{{ route('upload_file') }}"
                        method="POST">
                        @csrf
                        <input id="file" type="file" name="file" class="hidden" accept="image/*, video/*" />
                        <button
                            class="bg-[#e5e6e7] text-[#FAB049] flex flex-col  items-center justify-center p-10 rounded-3xl border border-[#673B8C]"
                            id="upload_files">
                            <span class="material-icons md-48">
                                add
                            </span>
                            <progress class="hidden"></progress>
                        </button>
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                    </form>
                </div>
                <div class="col-span-full flex flex-col gap-4 md:flex-row" id="attachments">
                    @foreach ($project->media as $item)
                        @php
                            $ff = explode('.', $item->filename);
                            $file_extension = end($ff);

                        @endphp
                        @if ($file_extension == 'mp4')
                            <a href="{{ $item->url }}" target="_blank"
                                class="w-[150px] h-[150px] shadow-xl border-2 rounded-xl flex text-[#673B8C] justify-center">
                                <span class="material-icons md-48 mx-auto my-auto">play_circle</span>
                            </a>
                        @else
                            <a href="{{ $item->url }}" target="_blank">
                                <img src="{{ $item->url }}" alt=""
                                    class="w-[150px] h-[150px] shadow-xl border-2 rounded-xl object-cover">

                            </a>
                        @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>


        <script>
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            let editor;

            let commentsFormData = new FormData();
            commentsFormData.append('_token', CSRF_TOKEN);
            commentsFormData.append('project_id', "{{ $project->id }}");
            $.ajax({
                type: "POST",
                url: "{{ route('get-comments') }}",
                data: commentsFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    let sexData = JSON.parse(response.comments);
                    console.log(JSON.parse(response.comments));
                    editor = new EditorJS({
                        /**
                         * Id of Element that should contain the Editor
                         */
                        holder: 'editorjs',
                        data: sexData
                    });
                }
            });


            $('#upload_files').on('click', function(event) {
                event.preventDefault();
                $('#file').trigger('click');

            });
            $('#file').change(function() {
                // Get the selected file
                var files = $('#file')[0].files;

                if (files.length > 0) {
                    var fd = new FormData();

                    // Append data
                    fd.append('file', files[0]);
                    fd.append('_token', CSRF_TOKEN);
                    fd.append('project_id', "{{ $project->id }}");

                    // Hide alert
                    $('#responseMsg').hide();
                    $('progress').show();
                    // AJAX request
                    $.ajax({
                        url: "{{ route('upload_file') }}",
                        method: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        xhr: function() {
                            var myXhr = $.ajaxSettings.xhr();
                            if (myXhr.upload) {
                                // For handling the progress of the upload
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

                            // Hide error container
                            // $('#err_file').removeClass('d-block');
                            // $('#err_file').addClass('d-none');

                            if (response.success == 1) { // Uploaded successfully

                                // Response message
                                // $('#responseMsg').removeClass("alert-danger");
                                // $('#responseMsg').addClass("alert-success");
                                // $('#responseMsg').html(response.message);
                                // $('#responseMsg').show();

                                // // File preview
                                // $('#filepreview').show();
                                // $('#filepreview img,#filepreview a').hide();
                                if (response.extension == 'jpg' || response.extension == 'jpeg' || response
                                    .extension == 'png') {
                                    htmldd = `
                                    <a href="${response.filepath}" target="_blank">
                                        <img src="${response.filepath}" alt=""
                                            class="w-[150px] h-[150px] shadow-xl border-2 rounded-xl object-cover">
                                    </a>`;
                                    $('#attachments').append(htmldd);
                                } else {
                                    htmldd = `
                                    <a href="${response.filepath}" target="_blank" class="w-[150px] h-[150px] shadow-xl border-2 rounded-xl flex text-[#673B8C] justify-center">
                                <span class="material-icons md-48 mx-auto my-auto">play_circle</span>
                                    </a>`;
                                    $('#attachments').append(htmldd);
                                }
                                $('progress').hide();
                            } else if (response.success == 2) { // File not uploaded

                                // Response message
                                $('#responseMsg').removeClass("alert-success");
                                $('#responseMsg').addClass("alert-danger");
                                $('#responseMsg').html(response.message);
                                $('#responseMsg').show();
                            } else {
                                // Display Error
                                // $('#err_file').text(response.error);
                                // $('#err_file').removeClass('d-none');
                                // $('#err_file').addClass('d-block');
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
            $('#save-button').click(function() {
                editor.save().then((outputData) => {
                    // console.log('Article data: ', outputData)
                    let formData = new FormData();

                    formData.append('_token', CSRF_TOKEN);
                    formData.append('project_id', "{{ $project->id }}");
                    formData.append('comments', JSON.stringify(outputData));
                    $.ajax({
                        type: "POST",
                        url: "{{ route('add-comment') }}",
                        data: formData,

                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        // dataType: "dataType",
                        success: function(response) {
                            console.log(response);
                            alert('تم الحفظ');
                        }
                    });
                }).catch((error) => {
                    console.log('Saving failed: ', error)
                });
                // console.log("clicked");

            });
        </script>
    @endpush
</x-app-layout>
