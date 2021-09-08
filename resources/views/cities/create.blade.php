<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="bg-white border-2 rounded-xl p-5">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <h1 class="text-lg font-bold">
                    إضافة مدينة ل {{$area->name}}
                </h1>
                <form action="{{ route('cities.store') }}" method="post" autocomplete="off">
                    @csrf
                    <input type="hidden" name="area_id" value="{{ $area->id }}">
                    <label for="name" class="mt-5 block">اسم المدينة</label>
                    <input class="block border border-gray-400 bg-gray-100 rounded w-full"
                        placeholder="{{ __('Name') }}" type="text" name="name" id="name" autocomplete="off">

                    <button type="submit"
                        class="bg-[#FCB634] px-4 py-2 rounded block text-[#673B8C] border-[#673B8C] border font-bold mt-5">{{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
