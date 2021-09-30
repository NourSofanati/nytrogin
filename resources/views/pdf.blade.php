<!DOCTYPE html>
<html lang="ar-SA" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body class="w-[21cm] h-[29.7]">
    <iframe id="printId" frameborder="0" style="display:none"></iframe>
    <section id="content">
        <header class=" flex justify-end mb-[50px]">
            <img src="{{ asset('images/logos.png') }}" class="max-h-[100px]" alt="" srcset="">
        </header>
        <div class=" text-3xl tracking-tighter text-[#673B8C] font-semibold rounded-xl my-4">
            التفتيش على {{ __($projectReport->project->category->name) }}
        </div>
        <div class=" flex flex-col gap-2 w-full ">
            <div class="border-b py-2">
                {{ __('Inspector Name') }} : {{ $projectReport->user->name }}
            </div>
            <div class="border-b py-2">
                {{ __('Project Name') }} : {{ $projectReport->project->name }}
            </div>
            <div class="border-b py-2">
                {{ __('City / State') }} :
                {{ $projectReport->project->city->name . ' / ' . $projectReport->project->city->area->name }}
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
                </thead>
                <tbody id="checkItemLines">
                    @foreach ($projectReport->checklist->checkitems as $item)
                        <tr data-index="${index++}" class="bg-white border-collapse ">
                            <td class="w-7/12 p-3 text-gray-800 border border-b ">
                                <p>{{ $item->inspection }}</p>
                            </td>
                            <td class="w-1/12 p-3 text-gray-800 text-center border border-b ">
                                {{ __($item->check) }}
                            </td>
                            <td class=" p-3 text-gray-800 text-center border border-b ">
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
        <div class="flex gap-5 mt-5">
            {{-- @foreach ($projectReport->checklist->checkitems as $checkitem)
                @foreach ($checkitem->attachments as $item)
                    @if (strpos($item->mimeType, 'image') >= 0)
                        <img src="{{ $item->url }}" class="w-[5cm] h-[5cm] border-2 rounded-2xl object-cover"
                            alt="" />
                    @endif
                @endforeach
            @endforeach --}}
        </div>
    </section>
    <script>
        const printable = document.querySelector('#content');
        printable.contentWindow.print();
    </script>
</body>

</html>
