<x-layout>
    <x-slot:heading>
        Edit Job: {{ $job->title }}
    </x-slot:heading>

    <form method="POST" action="/jobs/{{  $job->id }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
          <div class="pb-12 border-b border-gray-900/10">
            <div class="col-span-full">
                <label for="photo" class="block text-sm/6 font-medium text-gray-900">Photo</label>
                <div class="mt-2 flex items-center gap-x-3">
                    <div class="col-span-full">
                        <div class=" flex items-center gap-x-3">
                            <img class="size-20 border-2 border-blue-500 rounded-full" src="{{ asset('public/storage/'.$job->src) }}" alt="no logo">
                        </div>
                    </div>
                  <input type="file" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" name="image" id="image"/>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-4">
                <label for="title" class="block font-medium text-gray-900 text-sm/6">Title</label>
                <div class="mt-2">
                  <div class="flex items-center pl-3 bg-white rounded-md outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="block min-w-0 grow py-1.5 px-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                        placeholder="Shift Leader"
                        value="{{ $job->title }}"
                        required>
                  </div>
                  @error('title')
                      <p class="text-xs italic font-semibold text-red-500">{{  $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="sm:col-span-4">
                <label for="salary" class="block font-medium text-gray-900 text-sm/6">Salary</label>
                <div class="mt-2">
                  <div class="flex items-center pl-3 bg-white rounded-md outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input
                        type="text"
                        name="salary"
                        id="salary"
                        class="block min-w-0 grow py-1.5 px-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                        placeholder="$25000 Per Year"
                        value="{{ $job->salary }}"
                        required>
                  </div>
                  @error('salary')
                      <p class="text-xs italic font-semibold text-red-500">{{  $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            {{-- <div class="mt-10">
                @if ($errors->any())
                    <ul>
                        @foreach ( $errors->all() as $error )
                            <li class="italic text-red-500">{{  $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div> --}}
          </div>
        </div>

        <div class="flex items-center justify-between mt-6 gap-x-6">
            <div class="flex items-center">
                <button class="text-sm font-bold text-red-500" form="delete_form">Delete</button>
            </div>
            <div class="flex items-center gap-x-6">
                <a href="/jobs/{{ $job->id }}" class="font-semibold text-gray-900 text-sm/6">Cancel</a>
                <div>
                    <button
                        type="submit"
                        class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Update
                    </button>
                </div>
            </div>
        </div>
      </form>
      <form method="POST" action="/jobs/{{ $job->id }}" class="hidden" id="delete_form">
        @csrf
        @method('DELETE')
      </form>
</x-layout>
