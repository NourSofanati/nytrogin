<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">
                <div class="text-2xl text-white font-bold bg-[#673B8C] col-span-full py-12 text-center  rounded-[50px]">
                    {{ $area->name }}

                </div>
                @foreach ($area->cities as $city)
                    <form action="{{ route('show_projects') }}" method="post">
                        @csrf
                        <input type="hidden" name="area_id" value="{{ $area->id }}">
                        <input type="hidden" name="city_id" value="{{ $city->id }}">
                        <button type="submit"
                            class="bg-[#E5E6E7] py-12 px-4 text-center font-bold text-2xl border border-[#673B8C] text-[#673B8C] rounded-[50px] w-full">
                            {{ $city->name }}</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
