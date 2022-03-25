@if($attributes->has('disabled') && $attributes['disabled'])
    <button
        {{ $attributes->merge(['class' => 'flex flex-1 justify-center items-center px-16 py-2 bg-[#e5e5e5] rounded w-full']) }}
    ><span
            class="font-bold text-xl text-[#8d8d8d]">{{$slot}}</span>
    </button>
@else
    @switch($type)
        @case('outline')
        <button
            {{ $attributes->merge(['class' => 'flex flex-1 justify-center items-center px-16 py-2 w-full bg-white rounded border ' . ($css ?? 'border-[#0f375b]')]) }}
        ><span
                class="font-bold text-xl {{$spanCss ?? 'text-[#0f375b]'}}">{{$slot}}</span>
        </button>
        @break
        @case('danger')
        <button
            {{ $attributes->merge(['class' => 'flex flex-1 justify-center items-center px-16 py-2 w-full bg-[#a71f23] rounded ' . ($css ?? '')]) }}
        ><span
                class="font-bold text-xl {{$spanCss ?? 'text-white'}}">{{$slot}}</span>
        </button>
        @break

        @case('primary')
        <button
            {{ $attributes->merge(['class' => 'flex flex-1 justify-center items-center px-16 py-2 w-full bg-[#0f375b] rounded ' . ($css ?? '')]) }}
        ><span
                class="font-bold text-xl {{$spanCss ?? 'text-white'}}">{{$slot}}</span>
        </button>
        @break

        @case('normal')
        <button
            {{ $attributes->merge(['class' => 'flex flex-1 justify-center items-center px-16 py-2 w-full bg-[#006941] rounded ' . ($css ?? '')]) }}
        ><span
                class="font-bold text-xl {{$spanCss ?? 'text-white'}}">{{$slot}}</span>
        </button>
        @break
    @endswitch
@endif
