<x-app-layout class="relative">
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8 mb-8   ">
                <div class="overflow-hidden bg-white border-2 p-4 rounded-2xl">
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
                <div class="overflow-hidden lg:col-span-2 col-span-full bg-white border-2 p-4 rounded-2xl">
                    <canvas id="reportsChart" width="400" height=""></canvas>
                </div>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">
                {{-- <p class="text-4xl font-bold text-[#673B8C] text-center col-span-full">
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

                </div> --}}

                {{-- <hr class=" col-span-full"> --}}
                {{-- @forelse ($areas as $area)
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

                @endforelse --}}
                @can('create', \App\Models\OrgProject::class)
                    <a href="{{ route('organization_projects.create') }}"
                        class="bg-[#673B8C] py-12 px-4 text-center relative font-bold text-2xl border text-white rounded-[50px] flex justify-center">
                        <span class="material-icons my-auto">add</span> <span
                            class="my-auto">{{ __('Create a new project') }}</span>
                    </a>
                @endcan
                @foreach (\App\Models\OrgProject::all() as $project)
                    @can('view', $project)
                        <a href="{{ route('organization_projects.show', $project) }}"
                            class="bg-[#E5E6E7] py-12 px-4 text-center relative font-bold text-2xl border border-[#673B8C] text-[#673B8C] rounded-[50px] ">
                            {{ $project->name }}
                        </a>
                    @endcan
                @endforeach
            </div>
        </div>
    </div>
    <div class="absolute top-0 left-0 right-0 bottom-0 lg:right-[380px] bg-black/20  backdrop-blur-md grid place-content-center place-items-center overflow-hidden hidden"
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
    @push('custom-scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"
                integrity="sha256-bC3LCZCwKeehY6T4fFi9VfOU0gztUa+S4cnkIhVPZ5E=" crossorigin="anonymous"></script>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var reportsCtx = document.getElementById('reportsChart').getContext('2d');

            $.ajax({
                type: "GET",
                url: "{{ route('projects_chart') }}",
                success: function(response) {
                    console.log(response);
                    var myChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: Object.keys(response),
                            datasets: [{
                                label: '# of projects',
                                data: Object.values(response),
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                ]
                            }]
                        },
                    });
                }
            });
            $.ajax({
                type: "GET",
                url: "{{ route('reports_chart') }}",
                success: function(response) {
                    console.log(response);
                    var myChart = new Chart(reportsCtx, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(response),
                            datasets: [{
                                label: 'عدد التقارير',
                                data: Object.values(response),
                                backgroundColor: [
                                    '#FCB634',
                                ]
                            }]
                        }
                    });
                }
            });
        </script>

    @endpush
</x-app-layout>
