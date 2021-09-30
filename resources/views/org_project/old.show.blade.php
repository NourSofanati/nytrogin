<x-app-layout class="relative">
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            @if (auth()->user()->role->name == 'admin')
                <form action="{{ route('organization_projects.destroy', $orgProject) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit"
                        class="bg-red-500 text-white py-2 px-4 text-lg rounded-xl shadow flex justify-center items-center mb-2"
                        onclick="return confirm('{{ __('Are you sure you want to delete this project?') }}')">حذف
                        <span class="material-icons">delete</span></button>
                </form>
            @endif

            @if ($orgProject->dpm_id == null)
                <button class="bg-green-500 text-white py-2 px-4 text-lg rounded-xl mb-4 shadow"
                    id="showAssignDeputy">تعييين نائب المشروع</button>
            @else
                <div class="w-full bg-gray-200 font-bold p-4 rounded-xl mb-2 text-xl">
                    نائب المشروع : {{ $orgProject->deputyManager->name }}
                    @if (auth()->user()->role->name == 'admin' || auth()->user()->role->name == 'project_manager')
                        <button class="text-green-500" id="showAssignDeputy">إعادة تعيين؟</button>
                    @endif
                </div>
            @endif
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">
                <div
                    class="col-span-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4 border-2  p-6 rounded-3xl bg-white">
                    <p class=" text-4xl font-bold text-[#673B8C] text-center col-span-full">
                        {{ $orgProject->name }}
                        @if (auth()->user()->role->name == 'admin')
                            <a href="{{ route('organization_projects.edit', $orgProject) }}"><span
                                    class="material-icons">edit</span></a>
                        @endif
                    </p>
                    <div class="col-span-full text-center flex justify-center">
                        <div class="h-12 border-l-2 border-[#FCB634] relative">
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-[#673B8C] text-center col-span-full">
                        المشاريع
                    </p>

                    <div
                        class="bg-[#E5E6E7] border-[#673B8C] py-12 px-4 col-span-full border rounded-[50px] grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1">
                        <div class="lg:border-l-2 border-gray-400  pb-7 text-center cursor-pointer px-4 h-full "
                            id="showCompletedProjects">
                            <p class="mb-4 font-extrabold text-2xl text-[#673B8C]"> المنجزة</p>
                            <div class="font-bold text-[#FCB634] text-6xl">{{ $completedProjects->count() }}</div>
                        </div>
                        <div class="lg:border-l-2 border-gray-400 pb-7 text-center cursor-pointer px-4 h-full"
                            id="showInProgressProjects">
                            <p class="mb-4 font-extrabold text-2xl text-[#673B8C]"> قيد الإنجاز</p>
                            <div class="font-bold text-[#FCB634] text-6xl">{{ $inProgressProjects->count() }}</div>
                        </div>
                        <div class=" border-gray-400 pb-7 text-center px-4 h-full  cursor-pointer" id="showNewProjects">
                            <p class="mb-4 font-extrabold text-2xl text-[#673B8C]"> الجديدة</p>
                            <div class="font-bold text-[#FCB634] text-6xl">{{ $newProjects->count() }}</div>
                        </div>
                    </div>
                </div>

                <p class="text-3xl font-bold text-[#673B8C] text-center col-span-full">
                    المناطق
                </p>

                <a href="{{ route('area.create', $orgProject) }}"
                    class="bg-[#673B8C] py-12 px-4 text-center relative font-bold text-2xl border text-white rounded-[50px]">
                    {{ __('Create an area') }} <span class="material-icons my-auto">add</span>
                </a>
                @forelse ($orgProject->areas as $area)
                    @can('view', $area)
                        <a href="{{ route('area.show', $area) }}"
                            class="bg-[#E5E6E7] py-12 px-4 text-center relative font-bold text-2xl border border-[#673B8C] text-[#673B8C] rounded-[50px]">
                            {{ $area->name }}
                            @if ($area->projects->where('status', '!=', 'done_5')->count() > 0)
                                <span
                                    class="absolute top-0 left-0 rounded-full bg-[#673B8c] text-white w-10 h-10 flex justify-center text-center">
                                    <span
                                        class="my-auto">{{ $area->projects->where('status', '!=', 'done_5')->count() }}</span>
                                </span>
                            @endif
                        </a>
                    @endcan
                @empty

                @endforelse
            </div>
        </div>
    </div>
    <div class="absolute top-0 bottom-0 {{ config('app.locale') == 'ar' ? 'lg:right-[380px] left-0 ' : 'lg-left[380px] right-0' }} bg-black/20  backdrop-blur-md grid place-content-center place-items-center overflow-hidden hidden"
        id="projectsModal">
        <div class="bg-white shadow-xl rounded p-2">

            <div class="py-4 px-8 ">
                <div class="flex justify-between">
                    <h1 class="text-xl font-bold text-[#673B8c] my-auto tracking-tight" id="modalTitle">
                        المشاريع الجديدة
                    </h1>
                    <div id="exit_button"
                        class="text-[#673B8c] my-auto text-3xl cursor-pointer hover:text-red-500 transition duration-75">
                        &times;</div>
                </div>
                <div class="flex flex-col gap-4 mt-5 max-h-[500px] overflow-y-auto">

                    @foreach ($newProjects as $item)
                        <a class="w-full flex justify-between py-4 px-8 gap-20 font-medium text-lg rounded-full bg-[#E8E3F0] hover:bg-[#683b8c3d] transition duration-75"
                            href="{{ route('projects.show', $item) }}" data-state="new">
                            <span>{{ $item->name }}</span>
                            <span>موعد التسليم:
                                {{ \Carbon\Carbon::parse($item->deadline)->diffForHumans() }}</span>
                        </a>
                    @endforeach

                    @foreach ($completedProjects as $item)
                        <a class="w-full flex justify-between py-4 px-8 gap-20 font-medium text-lg rounded-full bg-[#E8E3F0] hover:bg-[#683b8c3d] transition duration-75"
                            href="{{ route('projects.show', $item) }}" data-state="completed">
                            <span>{{ $item->name }}</span>
                            <span>موعد التسليم:
                                {{ \Carbon\Carbon::parse($item->deadline)->diffForHumans() }}</span>
                        </a>
                    @endforeach

                    @foreach ($inProgressProjects as $item)
                        <a class="w-full flex justify-between py-4 px-8 gap-20 font-medium text-lg rounded-full bg-[#E8E3F0] hover:bg-[#683b8c3d] transition duration-75"
                            href="{{ route('projects.show', $item) }}" data-state="inProgress">
                            <span>{{ $item->name }}</span>
                            <span>موعد التسليم:
                                {{ \Carbon\Carbon::parse($item->deadline)->diffForHumans() }}</span>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="absolute top-0 left-0 right-0 bottom-0 {{ config('locale') == 'ar' ? 'lg:right-[380px]' : 'lg-left[380px]' }} bg-black/20  backdrop-blur-md grid place-content-center place-items-center overflow-hidden hidden"
        id="assignDeputyModal">
        <div class="bg-white shadow-xl rounded p-2">

            <div class="py-4 px-8 ">
                <div class="flex justify-between gap-20">
                    <h1 class="text-xl font-bold text-[#673B8c] my-auto tracking-tight" id="modalTitle">
                        تعيين نائب المشروع
                    </h1>
                    <div id="deputy_exit_button"
                        class="text-[#673B8c] my-auto text-3xl cursor-pointer hover:text-red-500 transition duration-75">
                        &times;</div>
                </div>
                <div class="flex flex-col gap-4 mt-5 max-h-[500px] overflow-y-auto">

                    <form method="POST" action="{{ route('assign_dep') }}">
                        @csrf
                        <input type="hidden" value={{ $orgProject->id }} name="org_project_id">
                        <select name="dpm_id" id="dpm_id" class="border-2 border-gray-400 w-full">
                            @foreach (\App\Models\User::where('role_id', \App\Models\Role::IS_DEPUTY_PROJECT_MANAGER)->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="bg-[#673B8C] text-white px-4 py-2 rounded-xl text-lg w-full mt-3 shadow-lg">{{ __('Assign as deputy project manager') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"
                integrity="sha256-bC3LCZCwKeehY6T4fFi9VfOU0gztUa+S4cnkIhVPZ5E=" crossorigin="anonymous"></script>
        <script>
            $('#showNewProjects').click(function() {
                $('#modalTitle').text('المشاريع الجديدة');
                $('[data-state]').addClass('hidden');
                $('[data-state=\'new\']').removeClass('hidden');
                $('#projectsModal').removeClass('hidden');
            })
            $('#showInProgressProjects').click(function() {
                $('#modalTitle').text('المشاريع قيد الإنجاز');
                $('[data-state]').addClass('hidden');
                $('[data-state=\'inProgress\']').removeClass('hidden');
                $('#projectsModal').removeClass('hidden');
            })
            $('#showCompletedProjects').click(function() {
                $('#modalTitle').text('المشاريع المنجزة');
                $('[data-state]').addClass('hidden');
                $('[data-state=\'completed\']').removeClass('hidden');
                $('#projectsModal').removeClass('hidden');
            })
            $('#exit_button').click(function(e) {
                e.preventDefault();
                $('#projectsModal').addClass('hidden');
            });
            $('#deputy_exit_button').click(function(e) {
                e.preventDefault();
                $('#assignDeputyModal').addClass('hidden');
            });
            $('#showAssignDeputy').click(function(e) {
                e.preventDefault();
                $('#assignDeputyModal').removeClass('hidden');
            });
            // var ctx = document.getElementById('myChart').getContext('2d');
            // var myChart = new Chart(ctx, {
            //     type: 'doughnut',
            //     data: {
            //         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            //         datasets: [{
            //             label: '# of Votes',
            //             data: [12, 19, 3, 5, 2, 3],
            //             backgroundColor: [
            //                 'rgba(255, 99, 132, 1)',
            //                 'rgba(54, 162, 235, 1)',
            //                 'rgba(255, 206, 86, 1)',
            //                 'rgba(75, 192, 192, 1)',
            //                 'rgba(153, 102, 255, 1)',
            //                 'rgba(255, 159, 64, 1)'
            //             ],
            //             borderColor: [
            //                 'rgba(255, 99, 132, 1)',
            //                 'rgba(54, 162, 235, 1)',
            //                 'rgba(255, 206, 86, 1)',
            //                 'rgba(75, 192, 192, 1)',
            //                 'rgba(153, 102, 255, 1)',
            //                 'rgba(255, 159, 64, 1)'
            //             ],
            //             borderWidth: 1
            //         }]
            //     },
            // });
        </script>

    @endpush
</x-app-layout>
