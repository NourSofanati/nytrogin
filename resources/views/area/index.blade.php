<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">
                <div class="bg-white  border-2 rounded-lg p-4 col-span-full lg:col-span-2 ">

                    <h1 class="text-xl font-bold text-[#673B8C]">المناطق الموجودة</h1>
                    @foreach ($areas as $area)
                        <div class=" my-4 font-bold  text-gray-700 flex gap-4">
                            <form action="{{ route('area.destroy', $area) }}"
                                onsubmit="return confirm('هل انت متأكد من حذف هذه المنطقة؟ ({{ $area->name }}) سيؤدي حذف هذه المنطقة لحذف المشاريع المندرجة تحته');" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit">
                                    <span class="material-icons text-gray-500 hover:text-red-500">
                                        delete
                                    </span>
                                </button>
                            </form>
                            <a href="{{ route('area.edit', $area) }}" class="flex gap-4">
                                <span class="material-icons my-auto">
                                    edit
                                </span>
                                {{ $area->name }}
                            </a>
                        </div>
                    @endforeach
                    <hr class="my-5">
                    <a href="{{ route('area.create') }}"
                        class="px-4 py-1 bg-[#673B8C] text-white rounded shadow  font-bold ">
                        إضافة منطقة جديدة
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
