<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">
                <div class="text-2xl text-white font-bold bg-[#673B8C] col-span-full py-12 text-center  rounded-[50px]">
                    {{ $area->name }}
                </div>
                <div
                    class="text-2xl text-[#673B8C] font-bold bg-[#FBB23A] col-span-full py-12 text-center  rounded-[50px]">
                    {{ $city->name }}
                </div>
                @if (auth()->user()->role_id == \App\Models\Role::IS_ADMIN || auth()->user()->role_id == \App\Models\Role::IS_PROCURATOR)

                    <div class="mt-5 col-span-full">
                        <form action="{{ route('create_project') }}" method="post">
                            @csrf
                            <input type="hidden" name="city_id" value="{{ $city->id }}">
                            <input type="hidden" name="area_id" value="{{ $area->id }}">
                            <button type="submit" class="text-white bg-[#673B8C] py-2 px-4 font-bold rounded-xl">
                                إنشاء مشروع جديد
                            </button>
                        </form>
                    </div>
                @endif
                @foreach ($projects as $project)
                    <a href="{{ route('projects.show', $project) }}"
                        class="bg-[#E5E6E7] py-12 px-4 text-center font-bold text-2xl border border-[#673B8C] text-[#673B8C] rounded-[50px] w-full">{{ $project->name }}</a>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
