<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">
                <div class="text-2xl text-white font-bold bg-[#673B8C] col-span-full py-12 text-center  rounded-[50px]">
                    {{ $project->area->name }}
                </div>
                <div
                    class="text-2xl text-[#673B8C] font-bold bg-[#FBB23A] col-span-full py-12 text-center  rounded-[50px]">
                    {{ $project->category->name }}
                </div>
                <div
                    class="bg-[#E5E6E7] text-[#673B8C] border border-[#673B8C] px-4 py-3 mt-3 text-2xl rounded-3xl col-span-2">

                    <p class="w-full grid grid-cols-2"><span class="font-bold ">اسم المشروع:
                        </span>{{ $project->name }}</p>
                </div>
                <div
                    class="bg-[#E5E6E7] text-[#673B8C] border border-[#673B8C] px-4 py-3 mt-3 text-2xl rounded-3xl col-span-2">

                    <p class="w-full grid grid-cols-2"><span class="font-bold ">الوصف:
                        </span>{{ $project->description }}</p>
                </div>
                <div
                    class="bg-[#E5E6E7] text-[#673B8C] border border-[#673B8C] px-4 py-3 mt-3 text-2xl rounded-3xl col-span-2">


                    <details>
                        <summary>
                            <span class="font-bold ">الملاحظات:
                            </span>
                        </summary>
                        <div id="editorjs"></div>
                    </details>
                </div>
                <div class="___class_+?12___">
                    <form>
                        <button class="bg-[#e5e6e7] text-[#FAB049] flex  items-center justify-center p-10 "
                            id="upload_files">
                            <span class="material-icons md-48">
                                add
                            </span>
                        </button>
                        <input id="file-input" type="file" name="name" style="display: none;" />
                    </form>
                </div>
                <div class="___class_+?15___">
                    <progress></progress>
                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
        <script>
            const editor = new EditorJS({
                /**
                 * Id of Element that should contain the Editor
                 */
                holder: 'editorjs',
            })
            $('#upload_files').on('click', function() {
                $('#file-input').trigger('click');
            });
        </script>
    @endpush
</x-app-layout>
