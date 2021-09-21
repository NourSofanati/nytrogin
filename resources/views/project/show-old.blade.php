<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            تفاصيل مشروع {{ $project->organization->name }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
            <div class="bg-white rounded-md p-6 flex flex-col col-span-full lg:col-span-1 border-2 border-[#E9EAEB]">
                <div class="flex justify-end w-full gap-3">
                    <span class="material-icons text-gray-400">
                        star_border
                    </span>
                    <span class="material-icons text-gray-400">
                        more_horiz
                    </span>
                </div>
                <div class="flex flex-col text-gray-800">
                    <h1 class="text-2xl ">
                        {{ $project->organization->name }}
                    </h1>
                    <div class="flex gap-2 mt-3">
                        <div class="bg-green-100 tracking-tighter text-green-400 font-bold px-3 py-1 rounded-full">
                            فعالية حية
                        </div>
                    </div>
                </div>
                <div class="flex flex-col text-gray-500 font-normal mt-8">
                    <p>بدء المشروع:
                        <span>{{ \Carbon\Carbon::parse($project->created_at)->diffForHumans() }}</span>
                    </p>
                    <p>تسليم المشروع:
                        <span>{{ \Carbon\Carbon::parse($project->deadline)->diffForHumans() }}</span>
                    </p>
                </div>
            </div>
            <div
                class="bg-white rounded-md p-6 grid grid-cols-1 lg:grid-cols-2 col-span-full lg:col-span-2 gap-6 border-2 border-[#E9EAEB]">
                <div id="inspectors" class="border-b-2 lg:border-none">
                    <h1 class="text-xl">المراقبين:</h1>
                    @forelse ($project->inspectors as $index=>$inspector)
                        <div class="{{ $index % 2 ? 'bg-gray-100 rounded-xl' : '' }} p-3">
                            {{ $inspector->user->name }}
                        </div>
                    @empty

                    @endforelse
                </div>
                <div id="supervisors">
                    <h1 class="text-xl">المشرفين:</h1>
                    @forelse ($project->supervisors as $index=> $supervisor)
                        <div class="{{ $index % 2 ? 'bg-gray-100 rounded-xl' : '' }} p-3">
                            {{ $supervisor->user->name }}
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>

            @include('project.project_status',['checklist'=>$project->checklist])

            <div class="bg-white border-2 p-5 col-span-full relative">
                @can('create', \App\Models\ProjectChecklist::class)
                    <form id="new_inspection_item" class="flex">
                        @csrf
                        <input type="hidden" name="checklist_id" value="{{ $project->checklist->id }}">

                        <div class="w-full">
                            <div class=" relative rounded-md shadow-sm ">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-white rounded-full bg-[#FBBC41] sm:text-sm material-icons">
                                        add
                                    </span>
                                </div>
                                <input type="text" name="inspection_item" id="inspection_item"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full h-full pr-10 pl-12 border-gray-300 rounded-md"
                                    placeholder="اضافة معيار جديد" autocomplete="off">
                            </div>
                        </div>
                        <input type="submit" value="إضافة"
                            class=" bg-[#71579A] my-auto text-white font-bold px-5 h-11 mr-4 rounded-md">
                    </form>
                @endcan
                <form id="inspection_checklist" method="POST" action="{{ route('checklist.store') }}">
                    @csrf
                    <table class="min-w-full border border-collapse mt-4">
                        <thead>
                            <tr>
                                <th class="border py-4 w-4 hidden">رقم</th>
                                <th class="border py-4 w-1/2">المعيار</th>
                                <th class="border py-4 w-16">نعم</th>
                                <th class="border py-4 w-16">لا</th>
                                <th class="border py-4 w-16">لا ينطبق</th>
                                {{-- <th class="border py-4 w-auto">ملاحظات</th> --}}
                            </tr>
                        </thead>
                        <tbody id="inspection_rows">
                        </tbody>
                    </table>
                    @can('create', \App\Models\ProjectChecklist::class)
                        @if ($project->checklist->status == 'pending_1' || explode('_', $project->checklist->status)[0] == 'declined')
                            <x-jet-button type="submit"
                                class="mt-4 bg-[#705998] tracking-tighter text-lg w-full md:w-1/2 lg:w-1/3">
                                حفظ القائمة
                            </x-jet-button>
                        @else

                        @endif
                    @endcan
                </form>
                <div class="flex justify-between py-2 text-lg">

                    @if (auth()->user()->role->id == \App\Models\Role::IS_SUPERVISOR && $project->checklist->status == 'pending_2')

                        <form action="{{ route('checklist.approve_checklist') }}" method="post">
                            <input type="hidden" value="{{ $project->checklist->id }}" name="checklist_id">
                            @csrf
                            <x-jet-button class="text-md tracking-tight bg-green-500">
                                موافقة
                            </x-jet-button>
                        </form>
                        <form action="{{ route('checklist.decline_checklist') }}" method="post">
                            <input type="hidden" value="{{ $project->checklist->id }}" name="checklist_id">
                            @csrf
                            <x-jet-button class="text-md tracking-tight bg-red-500">
                                رفض
                            </x-jet-button>
                        </form>
                    @elseif(auth()->user()->role->id == \App\Models\Role::IS_DEPUTY_PROJECT_MANAGER &&
                        $project->checklist->status == 'pending_3')
                        <form action="{{ route('checklist.approve_checklist_procurator') }}" method="post">
                            <input type="hidden" value="{{ $project->checklist->id }}" name="checklist_id">
                            @csrf
                            <x-jet-button class="text-md tracking-tight bg-green-500">
                                موافقة
                            </x-jet-button>
                        </form>
                        <form action="{{ route('checklist.decline_checklist_procurator') }}" method="post">
                            <input type="hidden" value="{{ $project->checklist->id }}" name="checklist_id">
                            @csrf
                            <x-jet-button class="text-md tracking-tight bg-red-500">
                                رفض
                            </x-jet-button>
                        </form>
                    @elseif(auth()->user()->role->id == \App\Models\Role::IS_PROJECT_MANAGER &&
                        $project->checklist->status == 'pending_4')
                        <form action="{{ route('checklist.approve_checklist_admin') }}" method="post">
                            <input type="hidden" value="{{ $project->checklist->id }}" name="checklist_id">
                            @csrf
                            <x-jet-button class="text-md tracking-tight bg-green-500">
                                موافقة
                            </x-jet-button>
                        </form>
                        <form action="{{ route('checklist.decline_checklist_admin') }}" method="post">
                            <input type="hidden" value="{{ $project->checklist->id }}" name="checklist_id">
                            @csrf
                            <x-jet-button class="text-md tracking-tight bg-red-500">
                                رفض
                            </x-jet-button>
                        </form>
                    @endif
                </div>
                @can('create', \App\Models\ProjectChecklist::class)
                    @if (($project->checklist->status == 'pending_1' || explode('_', $project->checklist->status)[0] == 'declined') && $project->checklist->items->count() > 0)
                        <form action="{{ route('checklist.request_approval_from_supervisor') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $project->checklist->id }}" name="checklist_id">
                            <x-jet-button type="submit"
                                class="mt-4 bg-[#FBBC41] tracking-tighter text-lg w-full md:w-1/2 lg:w-1/3">
                                طلب الموافقة من المشرفين
                            </x-jet-button>
                        </form>
                    @endif
                @endcan
            </div>


        </div>
    </div>
    @section('footerScripts')
        <script>
            let count = 0;
            $('#new_inspection_item').submit(function(event) {
                event.preventDefault();
                let row_text = $('#inspection_item').val();
                if (row_text == null || row_text.trim() == '') return;
                $.ajax({
                    url: "{{ route('checklist.add_checkitem') }}",
                    method: 'POST',
                    data: $('#new_inspection_item').serialize(),
                    success: function(data) {
                        $('#inspection_rows').html(data.html).fadeIn();
                        $('#inspection_item').val('');

                    }
                });
            });
            $.ajax({
                url: "{{ route('checklist.get_all_checkitems') }}?checklist_id={{ $project->checklist->id }}",
                method: 'get',
                success: data => {
                    $('#inspection_rows').html(data.html).fadeIn()
                }
            });
        </script>
    @endsection
</x-app-layout>
