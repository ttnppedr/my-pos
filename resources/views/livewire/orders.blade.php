@section('title', '訂單列表')
<div>
    <div class="bg-[#f8f8f8] h-full">
        <div class="py-4 px-6 grid grid-cols-3 gap-x-4 gap-y-6">
            @foreach($orders as $order)
                <button
                    wire:click="redirectTo({{$order->id}})"
                >
                    <div class="h-full bg-white p-4 font-bold border border-[#e5e5e5] rounded cursor-pointer"
                    >
                        <div class="flex justify-between mb-4 text-2xl">
                            <span>{{$order->note}}</span>
                            <span>${{number_format($order->amount_receivable, 0, '', ',')}}</span>
                        </div>
                        <div class="text-[#2678c6] text-xl text-left">
                            {{$order->detail}}
                        </div>
                    </div>
                </button>
            @endforeach
        </div>
    </div>
</div>
