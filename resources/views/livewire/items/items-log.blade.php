<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Item Log</h1>
            </div>

        </div>
            @foreach ($logs as $log )
                <p>[{{ ($log['context']['tanggal']) }}] item nama: {{ $log['context']['nama']}} id: {{ $log['context']['id'] }} telah {{ $log['message'] }}</p>
            @endforeach
        </div>

    </div>
</x-app-layout>
