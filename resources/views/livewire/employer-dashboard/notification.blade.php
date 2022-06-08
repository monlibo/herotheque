<div>
    <div class="w-full flex-col bg-white dark:bg-gray-800 dark:text-gray-200 rounded-md p-4">
        <div class="mb-3 font-semibold">Notifications</div>
        <div class="flex flex-col space-y-2">
            @if (count($notifications) > 0)
                @foreach ($notifications as $notification)
                    <div class="w-full flex flex-col dark:bg-gray-800 dark:text-gray-300  bg-white text-[14px] border-b py-2">
                        <div class="flex flex-1">
                            <a href="{{ $notification->data['link'] }}">
                                {{ $notification->data['title'] }}
                            </a>
                        </div>
                        <div class="text-[12px] text-gray-500">
                            @if (now()->diffInMinutes($notification->created_at) < 60)
                                il y a {{ now()->diffInMinutes($notification->created_at) }} minutes
                            @elseif (now()->diffInMinutes($notification->created_at) > 60)
                                il y a {{ now()->diffInHours($notification->created_at) }} heures
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="flex flex-col w-full items-center space-y-4 bg-white py-3">
                    <div class="md:w-[300px] md:h-[300px]">
                        <img src="{{ Storage::url('illustrations/notification-empty.jpg') }}" alt="">
                    </div>

                    <div class="text-center">Vous n'avez pas de notification

                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
