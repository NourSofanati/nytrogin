<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <div class=" xl:p-8 p-4">

        <div class="bg-[#FCB634] text-3xl py-4 text-center tracking-tighter text-[#673B8C] font-semibold rounded-xl">
            التفتيش على الفعاليات الترفيهية
        </div>

        <div class="flex justify-end mt-5">
            @if ($report->user->id == auth()->user()->id)
                @if ($report->isApproved->count() == 0 && $report->isPending->count() == 0)
                    <form action="{{ route('approvals.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="report_id" value="{{ $report->id }}">
                        <button type="submit"
                            class="bg-[#FBB445] text-[#673B8C] text-lg font-bold py-2 px-4 mb-4 rounded-lg shadow">
                            طلب الموافقة
                        </button>
                    </form>
                @elseif($report->isApproved->count() > 0 )
                    <p class="text-green-800 mb-4">
                        تم قبول هذا التقرير
                    </p>
                @elseif($report->isPending->count() > 0 )
                    <p class="text-gray-800 mb-4">
                        هذا المشروع بإنتظار الموافقة
                    </p>
                @endif
            @elseif (auth()->user()->role_id == \App\Models\Role::IS_SUPERVISOR)
                @if ($report->isPending->count() > 0)

                    @foreach ($report->isPending as $approval)
                        {{-- 'report_id', 'user_id', 'feedback', 'approved' --}}
                        <form action="{{ route('approvals.update', $approval) }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="report_id" value="{{ $report->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="approved" value="1">

                            <button type="submit"
                                class="bg-green-500 text-white text-lg font-bold py-2 px-4 mb-4 rounded-lg shadow">
                                موافقة
                            </button>
                        </form>
                        <form action="{{ route('approvals.update', $approval) }}" method="post" id="decline_form">
                            @csrf
                            @method('put')
                            <input type="hidden" name="report_id" value="{{ $report->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="approved" value="0">
                            <input type="text" name="feedback" id="feedback" class="hidden">
                            <button type="submit"
                                class="bg-red-500 text-white text-lg font-bold py-2 px-4 mb-4 rounded-lg shadow mr-4">
                                رفض
                            </button>
                        </form>
                    @endforeach
                @endif
            @endif

        </div>
        <form method="POST" enctype="multipart/form-data" action="{{ route('reports.store') }}">
            @csrf

            <div class="mt-3 border-2 bg-white rounded-xl py-4 px-2 text-lg grid grid-cols-2">
                <div class=" flex flex-col gap-4 w-full xl:w-1/2 p-5">
                    <div class="border-b py-2">
                        {{ __('Inspector Name') }} : {{ $report->user->name }}
                    </div>
                    <div class="border-b py-2">
                        {{ __('Project Name') }} : {{ $report->project->name }}
                    </div>
                    <div class="border-b py-2">
                        {{ __('City / State') }} :
                        {{ $report->project->city->name . ' / ' . $report->project->city->area->name }}
                    </div>
                    <div class="border-b py-2">
                        {{ __('Inspection Date') }} : {{ $report->report_date }}
                    </div>
                    <div class="border-b py-2">
                        {{ __('Inspection Time') }} : {{ $report->report_time }}
                    </div>
                    @if ($report->license_id)
                        <div class="border-b py-2">
                            {{ __('Permit ID') }} : {{ $report->license_id }}
                        </div>
                        <div class="border-b py-2">
                            {{ __('Permit Expiration Date') }} : {{ $report->license_expiration }}
                        </div>
                    @endif
                    @if ($report->commercial_license_id)
                        {{ __('Commercial license ID') }} : {{ $report->commercial_license_id }}
                    @endif
                </div>

            </div>
            <div class="mt-3 border-2 bg-white rounded-xl p-8 text-lg ">

                <table class="min-w-full">
                    <thead>
                        <tr class="border border-collapse ">
                            <th class="border hidden xl:table-cell border-collapse py-2 w-7/12">قائمة التفتيش</th>
                            <th class="border hidden xl:table-cell border-collapse py-2 w-1/12">نعم/لا</th>
                            <th class="border hidden xl:table-cell border-collapse py-2">ملاحظات</th>
                            <th class="border hidden xl:table-cell border-collapse py-2 w-1/12">المرفقات</th>
                        </tr>
                    </thead>
                    <tbody id="checkItemLines">
                        @foreach ($report->checklist->checkitems as $item)
                            <tr data-index="${index++}"
                                class="bg-white xl:hover:bg-gray-100 flex xl:table-row flex-row xl:flex-row flex-wrap xl:flex-no-wrap mb-10 xl:mb-0 border-collapse shadow-lg">
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 border border-b block xl:table-cell relative xl:static">
                                    <p>{{ $item->inspection }}</p>
                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    {{ __($item->check) }}
                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static">
                                    {{ $item->notes }}
                                </td>
                                <td
                                    class="w-full xl:w-auto p-3 text-gray-800 text-center border border-b block xl:table-cell relative xl:static ">
                                    @switch($item->attachments->count())
                                        @case(1)
                                            <span class="cursor-pointer" data-attachmentShow
                                                data-id="{{ $item->id }}">مرفق واحد</span>
                                        @break
                                        @case(2)
                                            <span class="cursor-pointer" data-attachmentShow
                                                data-id="{{ $item->id }}">مرفقين</span>
                                        @break
                                        @case(0)
                                            <span>لا يوجد</span>
                                        @break
                                        @default
                                            <span class="cursor-pointer" data-attachmentShow
                                                data-id="{{ $item->id }}">{{ $item->attachments->count() }}
                                                مرفقات</span>

                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <div class="absolute top-0 left-0 right-0 bottom-0 lg:right-[380px] bg-black/20  backdrop-blur-md grid place-content-center place-items-center overflow-hidden hidden"
        id="attachmentsModal">
        <div class="bg-white shadow-xl rounded p-2">

            <div class="py-4 px-8 ">
                <div class="flex justify-between">
                    <h1 class="text-xl font-bold text-[#673B8c] my-auto tracking-tight" id="modalTitle">
                        المرفقات
                    </h1>
                    <div id="exit_button"
                        class="text-[#673B8c] my-auto text-3xl cursor-pointer hover:text-red-500 transition duration-75">
                        &times;</div>
                </div>
                <div class="flex gap-4 mt-5 max-h-[500px] overflow-y-auto flex-wrap justify-center"
                    id="attachments-display">

                </div>
            </div>
        </div>
    </div>


    @push('custom-scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $('[data-attachmentShow]').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: `{{ route('get_checkitem_attachments') }}?checkitem_id=` + this.dataset.id,
                    success: function(data) {
                        let attachmentsHtml = ``;
                        attachmentsHtml = data.map(attachment => {
                            if (attachment.mimeType.indexOf('image') >= 0) {
                                return `<a href="${attachment.url}" target="_blank"><img src="${attachment.url}" alt="image" class="w-[150px] h-[150px] rounded border-2 object-cover" /></a>`;
                            } else {
                                return `<video src="${attachment.url}" class="min-w-[150px] h-[150px] rounded border-2" controls/>`;
                            }
                        });
                        // console.log(attachmentsHtml);
                        $('#attachments-display').html(attachmentsHtml);
                        $('#attachmentsModal').removeClass('hidden');
                    }
                });
            });
            $('#exit_button').click(function(e) {
                e.preventDefault();
                $('#attachmentsModal').addClass('hidden');
                $('#attachments-display').html('');
            });
        </script>
    @endpush
</x-app-layout>
