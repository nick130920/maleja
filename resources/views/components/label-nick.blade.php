@props(['value'])

<label {{ $attributes->merge(['class' => 'absolute ml-5 top-0 text-gray-700 mt-2 -z-1 duration-300 origin-0']) }}>
    {{ $value ?? $slot }}
</label>
