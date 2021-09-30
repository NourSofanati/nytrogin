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

@push('custom-scripts')
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
    </script>
@endpush
