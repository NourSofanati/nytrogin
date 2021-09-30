<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('تعديل المنطقة') }}
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="bg-white border-2 rounded-xl p-5">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <form action="{{ route('area.update', $area) }}" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <label for="name" class="mt-5 block">اسم المنطقة</label>
                    <input class="block border border-gray-400 bg-gray-100 rounded w-full"
                        placeholder="{{ __('Name') }}" type="text" name="name" id="name" autocomplete="off"
                        value="{{ $area->name }}">
                    <button type="
                                    submit"
                        class="bg-[#FCB634] px-4 py-2 rounded block text-[#673B8C] border-[#673B8C] border font-bold mt-5">{{ __('Save') }}
                    </button>
                </form>
                <div class=" col-span-full my-5">
                    @if ($area->cities->count() > 0)
                    @endif
                    @forelse ($area->cities as $item)
                        {{-- Write a function that returns a list of the cities inside this area --}}
                        <li>
                            {{ $item->name }}
                        </li>
                    @empty
                        <h1 class="text-xl">لا يوجد مدن مدخلة لهذه المنطقة,

                        </h1>

                    @endforelse
                    <form action="{{ route('create_from_area') }}" class="text-indigo-600" method="get">
                        <input type="hidden" name="area_id" value="{{ $area->id }}">
                        <button type="submit">
                            إضافة مدينة
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
