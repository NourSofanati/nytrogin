<div class="absolute top-0 bottom-0 {{ config('app.locale') == 'ar' ? 'lg:right-[380px] left-0 ' : 'lg-left[380px] right-0' }} bg-black/20  backdrop-blur-md grid place-content-center place-items-center overflow-hidden hidden"
    id="addAreaModal">
    <div class="bg-white shadow-xl rounded p-2">

        <div class="py-4 px-8 ">
            <div class="flex justify-between gap-20">
                <h1 class="text-xl font-bold text-[#673B8c] my-auto tracking-tight" id="modalTitle">
                    إضافة منطقة
                </h1>
                <div id="area_exit_button"
                    class="text-[#673B8c] my-auto text-3xl cursor-pointer hover:text-red-500 transition duration-75">
                    &times;</div>
            </div>
            <div class="flex flex-col gap-4 mt-5 max-h-[500px] overflow-y-auto">

                <form method="POST" action="{{ route('area_modal') }}">
                    @csrf
                    <input type="hidden" value={{ $orgProject->id }} name="org_project_id">
                    <select name="area_id" id="area_id" class="border-2 border-gray-400 w-full">
                        @foreach (\App\Models\AreaList::all() as $item)
                            @if (\App\Models\Area::where('area_id', $item->id)->count() == 0)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-[#673B8C] text-white px-4 py-2 rounded-xl text-lg w-full mt-3 shadow-lg">{{ __('Add area') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        $('#area_exit_button').click(function(e) {
            e.preventDefault();
            $('#addAreaModal').addClass('hidden');
        });
        $('#showAddArea').click(function(e) {
            e.preventDefault();
            $('#addAreaModal').removeClass('hidden');
        });
    </script>
@endpush
