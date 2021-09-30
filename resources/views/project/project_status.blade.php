<div id="status"
    class="bg-white rounded-md p-6 grid grid-cols-1 gap-6 border-2 border-[#E9EAEB] place-items-center">
    <h1 class="text-2xl">
        حالة المشروع:
    </h1>
    <div class="flex flex-row-reverse">
        @include('project.level_status',['at'=>'admin','status' => $project->status])
        @include('project.level_status',['at'=>'procurator','status' => $project->status])
        @include('project.level_status',['at'=>'supervisor','status' => $project->status])
        @include('project.level_status',['at'=>'inspector','status' => $project->status])
    </div>
</div>
