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
                    {{ $cat->name }}
                </div>
                <div class="mt-5 col-span-full">
                    <form action="{{route('create_project')}}" method="post">
                        @csrf
                        <input type="hidden" name="cat_id" value="{{$cat->id}}">
                        <input type="hidden" name="area_id" value="{{$area->id}}">
                        <button type="submit" class="text-white bg-[#673B8C] py-2 px-4 font-bold rounded-xl">
                            إنشاء مشروع جديد
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
