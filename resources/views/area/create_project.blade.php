<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <form action="{{ route('projects.store') }}" class="text-xl text-[#673B8C]" method="POST">
                    @csrf
                    <div class="bg-[#E5E6E7] px-4 py-3 mt-3 rounded-3xl ">

                        <p class="w-full grid grid-cols-2"><span class="font-bold ">المنطقة:
                            </span>{{ $area->name }}</p>
                        <input type="hidden" name="area_id" value="{{ $area->id }}">
                    </div>
                    <div class="bg-[#E5E6E7] px-4 py-2 mt-3 rounded-3xl">
                        <p class="w-full grid grid-cols-2"><span class="font-bold ">نوع المشروع:
                            </span>{{ $cat->name }}</p>
                        <input type="hidden" name="cat_id" value="{{ $cat->id }}">
                    </div>
                    <div class="bg-[#E5E6E7] mt-3 rounded-3xl">
                        <input type="text" name="name" id="name" required
                            class="border-none px-4 py-2  focus:outline-none active:border-none w-full h-full bg-transparent "
                            placeholder="اسم المشروع">
                    </div>
                    <div class="bg-[#E5E6E7] mt-3 rounded-3xl">
                        <textarea name="description" id="description" cols="30" rows="10"
                            class="border-none px-4 py-2  focus:outline-none active:border-none w-full h-full bg-transparent "
                            placeholder="وصف المشروع"></textarea>
                    </div>
                    <button type="submit" class="text-white bg-[#673B8C] mt-5 shadow-xl py-2 px-4 font-bold rounded-xl">
                        إنشاء مشروع جديد
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
