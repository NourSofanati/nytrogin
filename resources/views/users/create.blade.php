<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new user') }}
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="bg-white border-2 rounded-xl p-5">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <form action="{{ route('users.store') }}" method="post" autocomplete="off">
                    @csrf
                    <label for="name" class="mt-5 block">{{ __('Name') }}</label>
                    <input class="block border border-gray-400 bg-gray-100 rounded w-full"
                        placeholder="{{ __('Name') }}" type="text" name="name" id="name" autocomplete="off">
                    <label for="name" class="mt-5 block">{{ __('Email') }}</label>
                    <input class="block border border-gray-400 bg-gray-100 rounded w-full"
                        placeholder="{{ __('Email') }}" type="email" name="email" id="email" autocomplete="off">
                    <label for="name" class="mt-5 block">{{ __('Password') }}</label>
                    <input class="block border border-gray-400 bg-gray-100 rounded w-full"
                        placeholder="{{ __('Password') }}" type="password" name="password" id="password"
                        autocomplete="off">

                    <label for="name" class="mt-5 block">{{ __('Role') }}</label>
                    <select name="role_id" id="role_id" class=" border-gray-400 bg-gray-100 rounded w-1/2">
                        @foreach (\App\Models\Role::all() as $role)
                            <option value="{{ $role->id }}">{{ __($role->name) }}</option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="bg-[#FCB634] px-4 py-2 rounded block text-[#673B8C] border-[#673B8C] border font-bold mt-5">{{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
