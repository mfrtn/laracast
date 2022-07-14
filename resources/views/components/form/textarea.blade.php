@props(['name'])

<x-form.field>
    <x-form.label name="{{ $name }}" />

    <textarea class="border border-gray-400 p-2 w-full" name="excerpt" id="excerpt" required>{{ old('excerpt') }}</textarea>

    <x-form.error name="{{ $name }}" />
</x-form.field>
