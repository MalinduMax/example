@props(['name'])
@error($name)
    <p class="text-xs italic font-semibold text-red-500">{{  $message }}</p>
@enderror
