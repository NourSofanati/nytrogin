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


                    <label for="name" class="mt-5 block">{{ __('Role') }}</label>
                    <select name="role_id" id="role_id" class=" border-gray-400 bg-gray-100 rounded w-1/2">
                        @foreach (\App\Models\Role::all() as $role)
                            <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>
                                {{ __($role->name) }}</option>
                        @endforeach
                    </select>
                    <div class="w-1/2 {{ $user->role_id == \App\Models\Role::IS_INSPECTOR ? '' : 'hidden' }}"
                        id="specialization_form">
                        <label for="specialization" class="mt-5 block">
                            {{ __('الوظيفة') }}</label>
                        <input type="text" name="specialization" id="specialization"
                            class="block border border-gray-400 bg-gray-100 rounded w-full" value="{{$user->specialization}}">
                    </div>
                    <button type="submit"
                        class="bg-[#FCB634] px-4 py-2 rounded block text-[#673B8C] border-[#673B8C] border font-bold mt-5">{{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script type="text/javascript">
            $('#role_id').change(function(event) {
                if (event.target.value == 4) {
                    $('#specialization_form').fadeIn();
                } else {
                    $('#specialization_form').fadeOut();
                }
            })
        </script>
    @endpush
</x-app-layout>
