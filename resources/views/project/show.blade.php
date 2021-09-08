<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">

                 @include('project.project_status',['project'=>$project])
                <div class="text-2xl text-white font-bold bg-[#673B8C] col-span-full py-12 text-center rounded-[50px]">
                    {{ $project->city->area->name }}
                </div>
                <div
                    class="text-2xl text-[#673B8C] font-bold bg-[#FBB23A] col-span-full py-12 text-center   rounded-[50px]">
                    {{ $project->city->name }}
                </div>
                <div
                    class="bg-[#E5E6E7] text-[#673B8C] border border-[#673B8C] px-4 py-3 mt-3 text-2xl rounded-3xl col-span-2">

                    <p class="w-full"><span class="font-bold ">اسم المشروع:
                        </span>{{ $project->name }}</p>
                </div>
                <div
                    class="bg-[#E5E6E7] text-[#673B8C] border border-[#673B8C] px-4 py-3 mt-3 row-span-2 text-2xl rounded-3xl col-span-2">

                    <p class="w-full  "><span class="font-bold ">الوصف:
                        </span><br>{{ $project->description }}</p>
                </div>
                <div
                    class="bg-[#E5E6E7] text-[#673B8C] border border-[#673B8C] px-4 py-3 mt-3 text-2xl rounded-3xl col-span-2 relative">
                    <span class="font-bold ">التقارير:
                    </span>
                    <div class="flex flex-col gap-2">
                        @foreach ($project->inspections as $inspection)
                            <a href="{{ route('inspection.show', $inspection) }}"
                                class="w-full bg-white py-2 px-4 flex  rounded-xl shadow-lg my-2">
                                <img src="{{ $inspection->user->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                                    class="rounded-full h-10 w-10 object-cover ml-5">
                                <p class="my-auto">تقرير {{ $inspection->user->name }}</p>
                                <p class="my-auto mr-5 text-gray-600 text-sm">
                                    ({{ __($inspection->type->name) }})
                                </p>
                            </a>
                        @endforeach
                        @if ($project->inspections->count() == 0)
                            <h1 class="text-xl">
                                لا يوجد تقارير مدخلة حاليا.
                            </h1>
                        @endif
                        @can('create', \App\Models\ProjectInspection::class)
                            <form action="{{ route('create_inspection_report') }}" method="post">
                                @csrf
                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                <button type="submit"
                                    class="w-full bg-white p-2 flex justify-center rounded-xl shadow-lg my-5">
                                    <p>
                                        إنشاء تقرير جديد
                                    </p>
                                    <span class="material-icons my-auto">
                                        add
                                    </span>
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
                <div class=" p-5 col-span-full relative">

                    <div class="flex justify-between py-2 text-lg">


                        @if (auth()->user()->role->id == \App\Models\Role::IS_PROCURATOR && $project->status == 'pending_1')
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
                    {{-- @if (($project->status == 'pending_1' || explode('_', $project->status)[0] == 'declined') && auth()->user()->role_id == \App\Models\Role::IS_INSPECTOR)
                        <form action="{{ route('project.request_approval_from_supervisor') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $project->id }}" name="project_id">
                            <x-jet-button type="submit"
                                class="mt-4 bg-[#FBBC41] tracking-tighter text-lg w-full md:w-1/2 lg:w-1/3">
                                طلب الموافقة من المشرفين
                            </x-jet-button>
                        </form>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
    @endpush
</x-app-layout>
