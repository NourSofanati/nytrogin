<div id="status"
    class="bg-white  rounded-md p-6 grid grid-cols-1 gap-6 border-2 col-span-full border-[#E9EAEB] place-items-center">
    <h1 class="text-2xl">
        حالة المشروع:
    </h1>
    <div class="flex flex-col">
        {{-- <div class="flex">
            <div class="bg-gray-300 h-12 w-12 rounded-full grid place-items-center place-content-center text-white">
                <span class="material-icons">
                    alarm
                </span>
            </div>
            <p class="my-auto font-bold mr-5">
                المدير
            </p>
        </div>
        <div class="h-[50px] border-dashed border-2 w-[1px] border-gray-400 mr-[21px] my-2"></div>
        <div class="flex">
            <div
                class="bg-[#71579A] animate-pulse h-12 w-12 rounded-full grid place-items-center place-content-center text-white">
                <span class="material-icons animate-spin">
                    schedule
                </span>
            </div>
            <p class="my-auto font-bold mr-5">
                نائب المدير
            </p>
        </div> --}}

        @include('project.level_status',['at'=>'admin','status' => $project->status])
        @include('project.level_status',['at'=>'procurator','status' => $project->status])
        @include('project.level_status',['at'=>'supervisor','status' => $project->status])
        @include('project.level_status',['at'=>'inspector','status' => $project->status])
    </div>
</div>
