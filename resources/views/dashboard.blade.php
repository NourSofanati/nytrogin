<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-8">
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
