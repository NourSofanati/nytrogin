<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('تعيين مشرفين مشروع') }} {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden border-2 rounded p-4 sm:rounded-lg">
                <div class="text-2xl flex  justify-center">
                    <div class="ring-[#FDBB3E] z-10 ring-2 text-[#FDBB3E] px-4 py-2 rounded-full">الخطوة الثانية</div>
                    <div class="h-12 w-12 rounded-full z-0 bg-[#7056A1] flex justify-center">
                        <p class="my-auto text-white font-extrabold">2</p>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class=" my-5 text-2xl font-semibold">إختر المشرفين</h1>
                    <hr class=" my-5 w-full lg:w-1/2 s mx-auto">

                    <form method="post" action="{{ route('organizations.assign_supervisors') }}">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}" required>
                        <div class="flex justify-center">
                            <div id="supervisors" class="flex flex-col ">
                                <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-[#7056A1]">
                                </div>
                            </div>
                        </div>
                        <x-jet-button id="submitBtn" class="hidden mx-auto">
                            إرسال المشروع وتعييّن المشرفين
                        </x-jet-button>
                        @if (auth()->user()->role_id != App\Models\Role::IS_PROJECT_MANAGER)
                            <a id="pass" class="hidden mx-auto mt-5 text-lg"
                                href="{{ route('projects.show', $project) }}">
                                تمرير أختيار المراقبين و المشرفين من قبل مدير المشروع
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('footerScripts')
        <script type="text/javascript">
            $.ajax({
                url: "{{ route('organizations.get_all_supervisors') }}",
                method: 'GET',
                success: function(data) {
                    $('#supervisors').html(data.html).fadeIn();
                    $('#submitBtn').toggle('hidden');

                    $('#pass').toggle('hidden');
                }
            });
        </script>
    @endsection
</x-app-layout>
