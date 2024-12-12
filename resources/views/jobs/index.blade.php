<x-layout>
    <x-slot:heading>
        Jobs Listing
    </x-slot:heading>
    <div class="space-y-4">
        @foreach ( $jobs as $job )
                <a href="/jobs/{{ $job['id']}}" class="block px-4 py-6 border border-gray-200 rounde-lg">
                    <div class="col-span-full">
                        <div class=" flex items-center gap-x-3">
                            <img class="size-16 border-2 border-blue-500 rounded-full" src={{ $job['src'] }} alt="no logo">
                        </div>
                    </div>
                    <div class="mt-3">{{ $job->employer->name }}</div>
                    <div>
                        <strong> {{ $job['title'] }}:</strong> Pays {{ $job['salary']}} per year.
                    </div>
                </a>
        @endforeach
        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>
