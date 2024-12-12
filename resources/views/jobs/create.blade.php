<x-layout>
    <x-slot:heading>
        Create Job
    </x-slot:heading>

    <form method="POST" action="/jobs" enctype="multipart/form-data">
        @csrf
        <div class="space-y-12">
          <div class="pb-12 border-b border-gray-900/10">
            <h2 class="font-bold text-gray-900 text-base/8">Create a New Job</h2>
            <p class="mt-1 text-gray-600 text-sm/6">We just need a handful of details from you.</p>

            <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
              <x-form-field>
                <input type="file" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" name="image" />
                <x-form-label for="title">Title</x-form-label>
                <div class="mt-2">
                  <x-form-input name="title" id="title" placeholder="CEO"/>
                  <x-form-error name='title'/>
                </div>
              </x-form-field>
              <x-form-field>
                <x-form-label for="salary">Salary</x-form-label>
                <div class="mt-2">
                  <x-form-input name="salary" id="salary" placeholder="$25000 Per Year"/>
                  <x-form-error name='salary'/>
                </div>
              </x-form-field>
            </div>
          </div>
        </div>

        <div class="flex items-center justify-end mt-6 gap-x-6">
          <button type="button" class="font-semibold text-gray-900 text-sm/6">Cancel</button>
          <x-form-button>Save</x-form-button>
        </div>
      </form>

</x-layout>
