<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-8">
                <p class="text-4xl font-bold text-[#673B8C] text-center col-span-full">
                    المشاريع
                </p>
                <div
                    class="bg-[#E5E6E7] border-[#673B8C] py-12 px-4 col-span-full border rounded-[50px] grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1">
                    <div class="lg:border-l-2 border-gray-400  pb-7 text-center px-4 h-full">
                        <p class="mb-4 font-extrabold text-2xl text-[#673B8C]"> المنجزة</p>
                        <div class="font-bold text-[#FCB634] text-6xl">{{ $completedProjects }}</div>
                    </div>
                    <div class="lg:border-l-2 border-gray-400 pb-7 text-center px-4 h-full">
                        <p class="mb-4 font-extrabold text-2xl text-[#673B8C]"> قيد الإنجاز</p>
                        <div class="font-bold text-[#FCB634] text-6xl">{{ $inProgressProjects }}</div>
                    </div>
                    <div class=" border-gray-400 pb-7 text-center px-4 h-full">
                        <p class="mb-4 font-extrabold text-2xl text-[#673B8C]"> الجديدة</p>
                        <div class="font-bold text-[#FCB634] text-6xl">{{$newProjects}}</div>
                    </div>

                </div>

                <hr class=" col-span-full">
                @forelse ($areas as $area)
                    <a href="{{ route('area.show', $area) }}"
                        class="bg-[#E5E6E7] py-12 px-4 text-center font-bold text-2xl border border-[#673B8C] text-[#673B8C] rounded-[50px]">
                        {{ $area->name }}
                    </a>
                @empty

                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
