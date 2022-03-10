<div>
    <div class="bg-[#f8f8f8] h-screen">
        <div class="py-4 px-6 grid grid-cols-3 gap-x-4 gap-y-6">
            @foreach($orders as $order)
                <div class="bg-white p-4 font-bold border border-[#e5e5e5] rounded">
                    <div class="flex justify-between mb-4 text-2xl">
                        <span>{{$order->note}}</span>
                        <span>${{number_format($order->amount_receivable, 0, '', ',')}}</span>
                    </div>
                    <div class="text-[#2678c6] text-xl">
                        {{$order->detail}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
