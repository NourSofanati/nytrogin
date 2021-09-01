<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden border-2 rounded p-4 sm:rounded-lg">
                <div class="text-2xl flex  justify-center">
                    <div class="ring-[#FDBB3E] z-10 ring-2 text-[#FDBB3E] px-4 py-2 rounded-full">الخطوة الأولى</div>
                    <div class="h-12 w-12 rounded-full z-0 bg-[#7056A1] flex justify-center">
                        <p class="my-auto text-white font-extrabold">1</p>
                    </div>
                    {{-- <div class="h-12 w-12 rounded-full bg-[#7056A1]"></div> --}}

                </div>
                <div class="container p-2 w-full lg:w-1/2 mx-auto text-center py-4 text-[#7056A1]">
                    <form action="{{ route('projects.store') }}" method="post" class="relative ">
                        @csrf
                        <div>
                            <label for="org_id" class="block text-gray-700 text-lg mt-5 font-bold mb-2">اختر
                                العميل</label>
                            <bdi>
                                <select
                                    class="shadow appearance-none border-2 border-[#7056A1] rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    name="org_id" id="org_id">
                                    <option>---</option>
                                    @foreach ($areas as $area)
                                        <optgroup label="{{ $area->name }}">
                                            @foreach ($area->organizations as $org)
                                                <option value="{{ $org->id }}">{{ $org->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </bdi>
                        </div>
                        <address id="address"></address>
                        <div>
                            <label for="deadline" class="block text-gray-700 text-lg mt-5 font-bold mb-2">الموعد النهائي
                                للمشروع</label>
                            <input
                                class="shadow appearance-none border-2 border-[#7056A1] rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="datetime-local" name="deadline" id="deadline">
                        </div>
                        <div class="">
                            <label for="description" class="block text-gray-700 text-lg mt-5 font-bold mb-2">تعليقات ووصف
                                للمشروع</label>
                            <textarea
                                class="shadow appearance-none border-2 border-[#7056A1] rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="description" id="description" cols="30" rows="10" ></textarea>
                        </div>
                        <input type="hidden" name="status" value="pending_1" required >
                        <x-jet-button>التالي</x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('footerScripts')
        <script type="text/javascript">
            console.log('hello')
            $("#org_id").change(function() {
                $.ajax({
                    url: "{{ route('organizations.get_by_id') }}?organization=" + $(this).val(),
                    method: 'GET',
                    success: function(data) {
                        $('#address').html(data.html);
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>
