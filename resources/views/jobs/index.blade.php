<x-layout>
    <x-slot:heading>
        Jobs Listing
    </x-slot:heading>
    <div class="space-y-4">
        <div class="row">
            <div class="col-md-12">
              <form action="{{ route('jobs.index') }}" method="GET">
                <div class="form-group">
                  <input
                    type="text"
                    class="px-3 py-2 rounded-md form-controll"
                    name="search"
                    placeholder="Search Jobs"
                  />
                  <x-form-button>
                    Search
                  </x-form-button>
                    
                </div>
              </form>
            </div>
        </div> 
        @foreach ( $jobs as $job )
                <a href="/jobs/{{ $job['id']}}" class="block px-4 py-6 border border-gray-200 rounde-lg">
                    <div class="col-span-full">
                        <div class="flex items-center gap-x-3">
                            <img class="border-2 border-blue-500 rounded-full size-16" src="{{ asset('public/storage/'.$job->src) }}" alt="no logo">
                        </div>
                    </div>
                    <div class="mt-3">{{ $job->employer->name }}</div>
                    <div>
                        <strong> {{ $job['title'] }}:</strong> Pays {{ $job['salary']}} per year.
                    </div>
                </a>
        @endforeach
        <div >
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>
