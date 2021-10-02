<!DOCTYPE html>
<html lang="ar-SA" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <table>
        <thead class="table-header-group border-none pb-4 mb-4">
            <tr>
                <td>
                    <img src="{{ asset('images/logos.png') }}" class="max-h-[100px] mr-auto " alt="" srcset="">
                </td>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    <div>
                        <div class=" text-3xl tracking-tighter text-[#673B8C] font-semibold rounded-xl my-4 mt-[50px]">
                            التفتيش على {{ $projectReport->project->name }}
                        </div>
                        <div class="gap-2 w-full">
                            <div class="border-b py-2">
                                {{ __('نوع التفتيش') }} : {{ __($projectReport->project->category->name) }}
                            </div>
                            <div class="border-b py-2">
                                {{ __('Inspector Name') }} : {{ $projectReport->user->name }}
                            </div>
                            <div class="border-b py-2">
                                {{ __('Project Name') }} : {{ $projectReport->project->name }}
                            </div>
                            <div class="border-b py-2">
                                {{ __('City / State') }} :
                                {{ $projectReport->project->city->name . ' / ' . $projectReport->project->city->area->area->name }}
                            </div>
                            <div class="border-b py-2">
                                {{ __('Location') }} :
                                {{ $projectReport->location }}
                            </div>
                            <div class="border-b py-2">
                                {{ __('Inspection Date') }} : {{ $projectReport->report_date }}
                            </div>
                            <div class="border-b py-2">
                                {{ __('Inspection Time') }} : {{ $projectReport->report_time }}
                            </div>
                            @if ($projectReport->license_id)
                                <div class="border-b py-2">
                                    {{ __('Permit ID') }} : {{ $projectReport->license_id }}
                                </div>
                                <div class="border-b py-2">
                                    {{ __('Permit Expiration Date') }} : {{ $projectReport->license_expiration }}
                                </div>
                            @endif
                            @if ($projectReport->commercial_license_id)
                                {{ __('Commercial license ID') }} : {{ $projectReport->commercial_license_id }}
                            @endif
                        </div>
                        <div class=" text-3xl tracking-tighter text-[#673B8C] font-semibold rounded-xl my-5">
                            قائمة التفتيش
                        </div>
                        <div class="mt-5 ">

                            <table class="min-w-full table-fixed">
                                <tbody id="checkItemLines">
                                    @foreach ($projectReport->checklist->checkitems as $index => $item)
                                        <tr data-index="${index++}" class="bg-white ">
                                            <td class="p-3 text-gray-800 border-b-2 border-dashed  ">
                                                <p>{{ $index }}</p>
                                            </td>
                                            <td class="w-7/12 p-3 text-gray-800 border-b-2 border-dashed  ">
                                                <p>{{ $item->inspection }}</p>
                                            </td>
                                            <td class="w-1/12 p-3 text-gray-800 text-center border-b-2 border-dashed  ">
                                                {{ __($item->check) }}
                                            </td>
                                            <td class=" p-3 text-gray-800 text-center border-b-2 border-dashed  ">
                                                {{ $item->notes }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class=" text-3xl tracking-tighter text-[#673B8C] font-semibold rounded-xl my-5">
                            المرفقات
                        </div>
                        <div class="flex gap-5 flex-wrap">
                            @foreach ($projectReport->checklist->checkitems as $checkitem)
                                @foreach ($checkitem->attachments as $item)
                                    @if (strpos($item->mimeType, 'image') >= 0)
                                        <img src="{{ $item->url }}"
                                            class="max-w-[4cm] max-h-[4cm] min-w-[4cm] min-h-[4cm] border-2 rounded-2xl object-cover" alt="" />
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>


</body>

</html>
