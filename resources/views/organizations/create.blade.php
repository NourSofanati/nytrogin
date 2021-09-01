<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        <div class="grid grid-cols-1">
            <div class="bg-white border-2 rounded-lg p-4">
                <h1 class="text-xl mb-4">إضافة مؤسسة جديدة</h1>
                <form action="{{ route('organizations.store') }}" method="post" class="w-full lg:w-1/3">
                    @csrf
                    <select name="area_id" id="area_id" required class="border-2 border-gray-200 rounded w-full">
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                    <div class="mt-3">

                        <label for="name">أسم الهيئة</label>
                        <input type="text" name="name" id="name" required
                            class="border-2 border-gray-200 rounded w-full">
                    </div>
                    <div class="mt-3">

                        <label for="address">عنوان الهيئة</label>
                        <input type="text" name="address" id="address" required
                            class="border-2 border-gray-200 rounded w-full">
                    </div>
                    <div class="mt-3">
                        <label for="phone_number">رقم هاتف الهيئة</label>
                        <input type="text" name="phone_number" id="phone_number" required
                            class="border-2 border-gray-200 rounded w-full">
                    </div>
                    <x-jet-button type="submit" class="mt-4 text-lg tracking-tighter">
                        إضافة الهيئة
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
    @section('footerScripts')
        <script type="text/javascript">
        </script>
    @endsection
</x-app-layout>
