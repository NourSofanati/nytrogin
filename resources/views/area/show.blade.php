<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">

        <div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">
                <div class="text-2xl text-white font-bold bg-[#673B8C] col-span-full py-12 text-center  rounded-[50px]">
                    {{ $area->name }}

                </div>
                @if (auth()->user()->role_id == \App\Models\Role::IS_ADMIN || auth()->user()->role_id == \App\Models\Role::IS_PROJECT_MANAGER || auth()->user()->role_id == \App\Models\Role::IS_DEPUTY_PROJECT_MANAGER)
                    <form action="{{ route('create_from_area') }}" class="text-indigo-600" method="get">
                        <input type="hidden" name="area_id" value="{{ $area->id }}">
                        <button type="submit"
                            class="bg-[#673B8C] py-12 px-4 text-center font-bold text-2xl text-white rounded-[50px] w-full">
                            قم بإضافة مدينة <span class="material-icons">add</span>
                        </button>
                    </form>
                @endif
                @foreach ($area->cities as $city)
                    <form action="{{ route('show_projects') }}" method="post">
                        @csrf
                        <input type="hidden" name="area_id" value="{{ $area->id }}">
                        <input type="hidden" name="city_id" value="{{ $city->id }}">
                        <button type="submit"
                            class="bg-[#E5E6E7] py-12 px-4 text-center font-bold text-2xl border border-[#673B8C] text-[#673B8C] rounded-[50px] w-full relative">
                            {{ $city->name }}
                            @if ($city->projects->where('status', '!=', 'done_5')->count() > 0)
                                <span
                                    class="absolute top-0 left-0 rounded-full bg-[#673B8c] text-white w-10 h-10 flex justify-center text-center">
                                    <span
                                        class="my-auto">{{ $city->projects->where('status', '!=', 'done_5')->count() }}</span>
                                </span>
                            @endif
                        </button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
