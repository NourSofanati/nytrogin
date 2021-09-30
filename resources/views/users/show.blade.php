<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('معلومات ') . $user->name }}
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="bg-white border-2 rounded-xl p-5">
            <div class="flex justify-end">
                <form action="{{ route('users.destroy', $user) }}" method="post"
                    onsubmit="return confirm('هل انت متأكد من حذف هذا المستخدم؟');">
                    @csrf
                    @method('delete')
                    <button type="submit" class="text-red-500 flex">
                        حذف هذا المستخدم
                        <span class="material-icons my-auto">
                            delete
                        </span>
                    </button>
                </form>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <form action="{{ route('users.update', $user) }}" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <label for="name" class="mt-5 block">{{ __('Name') }}</label>
                    <input class="block border border-gray-400 bg-gray-100 rounded w-full"
                        placeholder="{{ __('Name') }}" type="text" name="name" id="name" autocomplete="off"
                        value="{{ $user->name }}">
                    <label for="name" class="mt-5 block">{{ __('Email') }}</label>
                    <input class="block border border-gray-400 bg-gray-100 rounded w-full"
                        placeholder="{{ __('Email') }}" type="email" name="email" id="email" autocomplete="off"
                        value="{{ $user->email }}" />
                    <label for="area_id" class="mt-5 block">{{ __('المنطقة') }}</label>
                    {{-- <input class="block border border-gray-400 bg-gray-100 rounded w-full"
                        placeholder="{{ __('Email') }}" type="email" name="email" id="email" autocomplete="off"
                        value="{{ $user->email }}" /> --}}

                    <select name="area_id" id="area_id" class="block border border-gray-400 bg-gray-100 rounded w-full"
                        required>
                        <option value="null">---</option>
                        @foreach (\App\Models\Area::all() as $area)
                            <option value="{{ $area->id }}" {{ $user->area_id == $area->id ? 'selected' : '' }}>
                                {{ $area->name }}</option>
                        @endforeach
                    </select>


                    <label for="phone_number" class="mt-5 block">{{ __('رقم الجوال') }}</label>
                    <div class="relative">
                        <div class="absolute top-0 bottom-0 left-0 flex">
                            <span dir="ltr" class="my-auto pl-2 pr-1 border-r-2 border-gray-300">
                                +966
                            </span>
                        </div>
                        <bdi>
                            <input type="tel" name="phone_number" pattern="[0-9]{9}"
                                class="block border border-gray-400 bg-gray-100 rounded w-full pl-14"
                                placeholder="500011234" value="{{ $user->phone_number }}" />
                        </bdi>
                    </div>



                    <label for="name" class="mt-5 block w-full">{{ __('Role') }}</label>
                    <select name="role_id" id="role_id" class=" border-gray-400 bg-gray-100 rounded w-full">
                        @foreach (\App\Models\Role::all() as $role)
                            @can('view', $role)

                                <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>
                                    {{ __($role->name) }}</option>
                            @endcan
                        @endforeach
                    </select>
                    <div class="w-full" id="specialization_form">
                        <label for="specialization" class="mt-5 block">
                            {{ __('الوظيفة') }}</label>
                        <input type="text" name="specialization" id="specialization"
                            class="block border border-gray-400 bg-gray-100 rounded w-full"
                            value="{{ $user->specialization }}">
                    </div>
                    <button type="submit"
                        class="bg-[#FCB634] px-4 py-2 rounded block text-[#673B8C] border-[#673B8C] border font-bold mt-5">{{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    @push('custom-scripts')

    @endpush
</x-app-layout>
