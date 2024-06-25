<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Qr Code Mail</title>

</head>
<body class="bg-gray-100">
    <div class="w-96 mx-auto sm:px-4 lg:px-6">

        <div class="mt-8 p-6">
            <div class="bg-white grid grid-cols-1 shadow rounded-lg p-5">
                <h6 class="text-gray-800 font-bold text-center mb-1">Scan This Qr Code</h6>
                 <div class="bg-gray-100 flex justify-center py-6 rounded mx-5">
                             {{-- {{ QrCode::size(150)->generate($attendee->id); }} --}}
                </div>

                <div class="relative mt-4 border-t-2 border-gray-200 border-dashed border-">
                    <div class="absolute bg-gray-100 p-3 rounded-full -top-3 -left-7"></div>
                    <div class="absolute bg-gray-100 p-3 rounded-full -top-3 -right-7"></div>

                    <h6 class="text-center mt-2 font-bold text-gray-900">{{ $attendee->reference }}</h6>
                    <div class="mt-2 flex justify-between items-center">
                        <div class="">
                            <h6 class="text-gray-500 font-medium text-xs">Event Name</h6>
                            <div class="text-gray-800 font-semibold text-base"> {{ $attendee->event->title }}</div>
                        </div>
                        <div>
                            <h6 class="text-gray-500 font-medium text-xs">Event Date</h6>
                            <div class="text-gray-800 font-semibold text-base">
                                {{ Carbon\Carbon::parse($attendee->event->start_date)->format('Y-m-d') }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 flex justify-between items-center">
                        <div class="">
                            <h6 class="text-gray-500 font-medium text-xs">Venue</h6>
                            <div class="text-gray-800 font-semibold text-base">{{ $attendee->event->venue }}</div>
                        </div>
                        <div class="">
                            <h6 class="text-gray-500 font-medium text-xs">Name</h6>
                            <div class="text-gray-800 font-semibold text-base">{{ $attendee->fullname }}</div>
                        </div>
                    </div>
                    <div class="mt-2 flex justify-between items-center">
                        <div class="">
                            <h6 class="text-gray-500 font-medium text-xs">Type</h6>
                            <div class="text-gray-800 font-semibold text-base">{{ $attendee->ticket->title }}</div>
                        </div>
                        <div class="">
                            <h6 class="text-gray-500 font-medium text-xs">Price</h6>
                            <div class="text-green-500 font-semibold text-base">GHS{{ $attendee->ticket->price }}</div>
                        </div>
                    </div>
                </div>
            </div>

    </div>

</div>
</body>
</html>
