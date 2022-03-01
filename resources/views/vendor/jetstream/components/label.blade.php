@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    <span class="text-[#a71f23]">{{$attributes->has('required') ? '*' : ''}}</span>{{ $value ?? $slot }}
</label>
