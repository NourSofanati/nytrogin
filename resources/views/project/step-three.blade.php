<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('تعيين مراقبين مشروع') }} {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden border-2 rounded p-4 sm:rounded-lg">
                <div class="text-2xl flex  justify-center">
                    <div class="ring-[#FDBB3E] z-10 ring-2 text-[#FDBB3E] px-4 py-2 rounded-full">الخطوة الثالثة</div>
                    <div class="h-12 w-12 rounded-full z-0 bg-[#7056A1] flex justify-center">
                        <p class="my-auto text-white font-extrabold">3</p>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class=" my-5 text-2xl font-semibold">إختر المراقبين</h1>
                    <hr class=" my-5 w-1/3 mx-auto">

                    <form method="post" action="{{ route('organizations.assign_inspectors') }}">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}" required>
                        <div class="flex justify-center">
                            <div id="inspectors" class="flex flex-col w-full md:w-1/2">
                                <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-[#7056A1]">
                                </div>
                            </div>
                        </div>
                        <x-jet-button id="submitBtn" class="hidden mx-auto text-lg">
                            تعيين المراقبين
                        </x-jet-button>
                        @if (auth()->user()->role_id != App\Models\Role::IS_SUPERVISOR)
                            <x-jet-button id="pass" class="hidden mx-auto mt-5 text-lg">
                                تمرير أختيار المراقبين من قبل المشرف
                            </x-jet-button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('footerScripts')
        <script type="text/javascript">
            $.ajax({
                url: "{{ route('organizations.get_all_inspectors') }}?project_id={{ $project->id }}",
                method: 'GET',
                success: function(data) {
                    $('#inspectors').html(data.html).fadeIn();
                    $('#submitBtn').toggle('hidden');
                    $('#pass').toggle('hidden');
                }
            });
        </script>
    @endsection
</x-app-layout>
