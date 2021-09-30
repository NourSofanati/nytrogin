<div class="absolute top-0 bottom-0 {{ config('app.locale') == 'ar' ? 'lg:right-[380px] left-0 ' : 'lg-left[380px] right-0' }} bg-black/20  backdrop-blur-md grid place-content-center place-items-center overflow-hidden hidden"
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
    <script>
        $('#deputy_exit_button').click(function(e) {
            e.preventDefault();
            $('#assignDeputyModal').addClass('hidden');
        });
        $('#showAssignDeputy').click(function(e) {
            e.preventDefault();
            $('#assignDeputyModal').removeClass('hidden');
        });
    </script>
@endpush
