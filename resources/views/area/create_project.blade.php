<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid grid-cols-1 xl:w-1/2 gap-8 mx-auto">
                <form action="{{ route('projects.store') }}" class="text-xl text-[#673B8C]" method="POST">
                    @csrf
                    <div class="bg-[#E5E6E7] px-4 py-3 mt-3 rounded-xl  shadow">

                        <p class="w-full flex gap-4"><span class="font-bold ">المنطقة:
                            </span>{{ $area->name }}</p>
                        <input type="hidden" name="area_id" value="{{ $area->id }}">
                    </div>
                    <div class="bg-[#E5E6E7] px-4 py-2 mt-3 rounded-xl shadow">
                        <p class="w-full flex gap-4"><span class="font-bold ">المدينة:
                            </span>{{ $city->name }}</p>
                        <input type="hidden" name="city_id" value="{{ $city->id }}">
                    </div>
                    <div class="bg-[#E5E6E7] mt-3 rounded-xl shadow">
                        <input type="text" name="name" id="name" required
                            class="border-none px-4 py-2  focus:outline-none active:border-none w-full h-full bg-transparent "
                            placeholder="اسم المشروع">
                    </div>
                    <div class="bg-[#E5E6E7] mt-3 rounded-xl shadow">
                        <textarea name="description" id="description" cols="30" rows="3"
                            class="border-none px-4 py-2  focus:outline-none active:border-none w-full h-full bg-transparent "
                            placeholder="وصف المشروع"></textarea>
                    </div>
                    <div class="px-4 py-4 bg-[#E5E6E7] rounded-xl mt-3 shadow">
                        <label for="category_id" class="block mb-3">
                            {{ __('Project Category') }} <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id" id="category_id" class=" border rounded w-full border-gray-400 bg-gray-50"
                            required>
                            @foreach (\App\Models\ProjectCategory::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="px-4 py-3 bg-[#E5E6E7] rounded-xl mt-3 shadow">
                        <label for="deadline" class="block mb-3">
                            تاريخ تسليم المشروع <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" name="deadline" required
                            class=" border rounded w-full border-gray-400 bg-gray-50">
                    </div>
                    <input type="hidden" value={{ $city->area->org_project_id }} name="org_project_id" />

                    <button type="submit" class="text-white bg-[#673B8C] mt-5 shadow-xl py-2 px-4 font-bold rounded-xl">
                        إنشاء مشروع جديد
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
