<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">

            @forelse ($areas as $area)
                @if ($area->organizations->count() > 0)
                    <div class="bg-white border-2 rounded-lg p-5">
                        <div class="text-2xl mb-2 text-center">
                            {{ $area->name }}
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            @forelse ($area->organizations as $index=>$organization)
                                <div class="px-3 py-2 {{ $index % 2 ? 'bg-gray-100' : '' }} border">
                                    <span class="font-bold text-lg">{{ $organization->name }}</span>
                                    <br>
                                    <address class=" text-gray-800 grid gap-4 mt-4">
                                        <span class="text-green-700 mb-2">
                                            <a href="tel:{{ $organization->phone_number }}"
                                                class="w-full flex justify-between ">
                                                <span class="material-icons">
                                                    phone
                                                </span>
                                                <bdi>
                                                    {{ $organization->phone_number }}
                                                </bdi>
                                            </a>
                                        </span>
                                        <span class="w-full flex justify-between ">
                                            <span class="material-icons">
                                                place
                                            </span>
                                            <bdi>{{ $organization->address }}</bdi>
                                        </span>
                                    </address>
                                </div>
                            @empty

                            @endforelse
                        </div>
                    </div>
                @endif
                @empty

                @endforelse
                @can('create', \App\Models\Organization::class)
                    <a href="{{ route('organizations.create') }}"
                        class="h-[250px] rounded-md p-4  border-2 border-[#E9EAEB] grid place-items-center place-content-center">
                        <p class="text-gray-400 mb-4">
                            إضافة هيئات أُخرى
                        </p>
                        <div class=" bg-[#72559D] px-7 py-4 rounded-md font-bold text-white shadow-lg">
                            + إنشاء هيئة جديدة
                        </div>
                    </a>
                @endcan

            </div>
        </div>
    </x-app-layout>
