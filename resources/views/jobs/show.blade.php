<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>
    <div class="col-span-full">
        <div class=" flex items-center gap-x-3">
            <div class="col-span-full">
                <div class=" flex items-center gap-x-3">
                    <img class="size-16 border-2 border-blue-500 rounded-full" src="{{ asset('public/storage/'.$job->src) }}" alt="no logo">
                </div>
            </div>
        </div>
    </div>

    <h2 @class(['font-bold' => true,'text-lg'])>{{ $job->title }}</h2>

    <p>This job pays {{$job->salary }} per year.</p>

    @can('edit-job', $job)
        <p class="mt-6">
            <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
        </p>
    @endcan

</x-layout>
