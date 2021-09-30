<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 px-6">
        <div>
            <div class="grid grid-cols-1 xl:w-1/2 gap-8 mx-auto">
                <form action="{{ route('organization_projects.store') }}" class="text-xl text-[#673B8C]" method="POST">
                    @csrf
                    <div class="bg-[#E5E6E7] mt-3 rounded-xl shadow">
                        <input type="text" name="name" id="name" required
                            class="border-none px-4 py-2  focus:outline-none active:border-none w-full h-full bg-transparent "
                            placeholder="اسم المشروع">
                    </div>
                    @if (auth()->user()->role->name === 'admin')
                        <div class="px-4 py-4 bg-[#E5E6E7] rounded-xl mt-3 shadow">
                            <label for="pm_id" class="block mb-3">
                                {{ __('Project Manager') }} <span class="text-red-500">*</span>
                            </label>
                            <select name="pm_id" id="pm_id" class=" border rounded w-full border-gray-400 bg-gray-50"
                                required>
                                @foreach (\App\Models\User::all()->where('role_id', \App\Models\Role::IS_PROJECT_MANAGER) as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @elseif(auth()->user()->role->name==="project_manager")
                        <div class="px-4 py-4 bg-[#E5E6E7] rounded-xl mt-3 shadow">
                            <label for="pm_id" class="block mb-3">
                                {{ __('Project Manager') }} <span class="text-red-500">*</span>
                            </label>
                            <select name="pm_id" id="pm_id" class=" border rounded w-full border-gray-400 bg-gray-50"
                                required disabled>
                                @foreach (\App\Models\User::all()->where('role_id', \App\Models\Role::IS_PROJECT_MANAGER) as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id === auth()->user()->id ? ' selected="selected"' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="pm_id" value={{ auth()->user()->id }} />
                        </div>
                    @endif
                    <button type="submit" class="text-white bg-[#673B8C] mt-5 shadow-xl py-2 px-4 font-bold rounded-xl">
                        إنشاء مشروع جديد
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
