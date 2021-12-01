@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block p-2 w-full text-lg appearance-none focus:outline-none bg-transparent rounded-lg']) !!} placeholder=" " {!! $attributes->merge(['placeholder' => ""]) !!} required>
