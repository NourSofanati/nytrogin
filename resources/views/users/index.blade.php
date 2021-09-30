<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new user') }}
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="gap-4 grid grid-cols-3">
            @foreach ($roles as $role)
                @can('view', $role)
                    <div class="text-lg bg-white border-2 rounded-xl p-5 text-gray-700  font-semibold">
                        <h1 class="text-xl font-bold text-[#673B8C]">
                            {{ __($role->name) }}
                        </h1>
                        @foreach ($role->users as $user)
                            @can('view', $user)
                                <a href="{{ route('users.edit', $user) }}">
                                    <li>{{ $user->name }}</li>
                                </a>
                            @endcan
                        @endforeach
                    </div>
                @endcan
            @endforeach
        </div>
        @if (auth()->user()->role_id == \App\Models\Role::IS_ADMIN || auth()->user()->role_id == \App\Models\Role::IS_PROJECT_MANAGER || auth()->user()->role_id == \App\Models\Role::IS_DEPUTY_PROJECT_MANAGER)
            <div class="flex mt-5">
                <a href="{{ route('users.create') }}"
                    class="bg-[#673B8C] rounded-xl shadow-md text-xl flex py-2 px-4 text-white font-bold mb-4">إنشاء حساب
                    جديد</a>
            </div>
        @endif
    </div>
</x-app-layout>
