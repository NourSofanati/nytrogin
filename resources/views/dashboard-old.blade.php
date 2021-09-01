<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="py-[1.15rem] border-b-2 border-[#72559D] text-[#72559D]">
                جميع المشاريع
            </a>
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-8">
                @forelse ($projects as $project)
                    @can('view', $project)
                        <a class="bg-white  rounded-md p-6 flex flex-col border-2 border-[#E9EAEB] "
                            href="{{ route('projects.show', $project) }}">
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
                                    <div
                                        class="bg-green-100 tracking-tighter text-green-400 font-bold px-3 py-1 rounded-full">
                                        فعالية حية
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col text-gray-500 font-normal mt-12">
                                <p>بدء المشروع:
                                    <span>{{ \Carbon\Carbon::parse($project->created_at)->diffForHumans() }}</span>
                                </p>
                                <p>تسليم المشروع:
                                    <span>{{ \Carbon\Carbon::parse($project->deadline)->diffForHumans() }}</span>
                                </p>
                            </div>
                        </a>
                    @endcan
                @empty
                @endforelse
                @can('create', \App\Models\OrganizationProject::class)
                    <a href="{{ route('projects.create') }}"
                        class="h-[250px] rounded-md p-4  border-2 border-[#E9EAEB] grid place-items-center place-content-center">
                        <p class="text-gray-400 mb-4">
                            إضافة مشاريع أُخرى
                        </p>
                        <div class=" bg-[#72559D] px-7 py-4 rounded-md font-bold text-white shadow-lg">
                            + إنشاء مشروع جديد
                        </div>
                    </a>
                @endcan
            </div>
        </div>
        <div class="w-full flex my-10">
            <p class="text-xl text-gray-500">المشاريع المؤرشفة</p>
            <div class=" w-10/12 mx-auto my-auto border-b-2"></div>
        </div>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-8">
            {{-- <div class="bg-white h-[250px] rounded-lg p-4  border-2 border-[#E9EAEB]"></div> --}}

            <a class="h-[250px] rounded-md p-6 flex flex-col " style="background: repeating-linear-gradient(
                                                    45deg,
                                                    #F6F8FC,
                                                    #F6F8FC 10px,
                                                    #EDEFF3 10px,
                                                    #EDEFF3 20px
                                                  );">
                <div class="flex justify-end w-full gap-3">
                    <span class="material-icons text-gray-400">
                        star_border
                    </span>
                    <span class="material-icons text-gray-400">
                        more_horiz
                    </span>
                </div>
                <div class="flex flex-col  text-gray-500">
                    <h1 class="text-2xl ">
                        Nowaar Entertainment
                    </h1>
                    <div class="flex gap-2 mt-3">
                        <div class="bg-[#EDEFF3] tracking-tighter text-gray-400 font-bold px-3 py-1 rounded-full">
                            فعالية حية
                        </div>
                    </div>
                </div>
                <div class="flex flex-col text-gray-500 font-normal mt-auto">
                    <p>بدء المشروع:
                        <span>{{ \Carbon\Carbon::parse('2021-01-01')->diffForHumans() }}</span>
                    </p>
                    <p>تسليم المشروع:
                        <span>{{ \Carbon\Carbon::parse('2021-05-02')->diffForHumans() }}</span>
                    </p>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
