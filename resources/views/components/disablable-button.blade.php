<div class="flex flex-1 justify-center items-center">
    @if($attributes->has('disabled'))
        <button
            {{ $attributes->merge(['class' => 'flex flex-1 justify-center items-center px-16 py-2 bg-[#e5e5e5] rounded w-full']) }}
        ><span
                class="font-bold text-xl text-[#8d8d8d]">{{$slot}}</span>
        </button>
    @else
        @switch($type)
            @case('outline')
            <button
                {{ $attributes->merge(['class' => 'flex flex-1 justify-center items-center px-16 py-2 w-full bg-white rounded border border-[#0f375b] ' . ($css ?? '')])
                }}
            ><span
                    class="font-bold text-xl text-[#0f375b] {{$spanCss ?? ''}}">{{$slot}}</span>
            </button>
            @break
            @case('danger')
            <button
                {{ $attributes->merge(['class' => 'flex flex-1 justify-center items-center px-16 py-2 w-full bg-[#a71f23] rounded']) }}
            ><span
                    class="font-bold text-xl text-white {{$spanCss ?? ''}}">{{$slot}}</span>
            </button>
            @break

            @case('primary')
            <button
                {{ $attributes->merge(['class' => 'flex flex-1 justify-center items-center px-16 py-2 w-full bg-[#0f375b] rounded']) }}
            ><span
                    class="font-bold text-xl text-white {{$spanCss ?? ''}}">{{$slot}}</span>
            </button>
            @break

            @case('normal')
            <button
                {{ $attributes->merge(['class' => 'flex flex-1 justify-center items-center px-16 py-2 w-full bg-[#006941] rounded']) }}
            ><span
                    class="font-bold text-xl text-white {{$spanCss ?? ''}}">{{$slot}}</span>
            </button>
            @break
        @endswitch
    @endif
</div>
