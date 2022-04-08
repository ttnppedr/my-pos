@section('title', '訂單列表')
<div x-data="{orders: @entangle('orders')}">
    <div class="bg-[#f8f8f8] h-full">
        <div class="py-4 px-6 grid grid-cols-1 xl:grid-cols-3 gap-x-4 gap-y-6">
            @foreach($orders as $order)
                <a
                    href="{{$order->link}}"
                >
                    <div class="h-full bg-white p-4 font-bold border border-[#e5e5e5] rounded cursor-pointer"
                    >
                        <div class="flex justify-between mb-4 text-2xl text-[#0f375b]">
                            @if ($order->status !== 2)
                                <div>
                                    <span class="text-red-700">*</span>
                                    <span>{{$order->note}}</span>
                                </div>
                                <span>${{number_format($order->amount_receivable, 0, '', ',')}}</span>
                            @else
                                <div>
                                    <span>{{$order->note}}</span>
                                </div>
                                <span>${{number_format($order->amount_received, 0, '', ',')}}</span>
                            @endif
                        </div>
                        <div class="text-[#2678c6] text-xl text-left">
                            @foreach($order->products as $i => $product)
                                @if($product->note)
                                    @if ($loop->last)
                                        <span class="text-[#f5a623]">{{$product->name}}*{{$product->quantity}}({{$product->note}})</span>
                                    @else
                                        <span class="text-[#f5a623]">{{$product->name}}*{{$product->quantity}}({{$product->note}}) / </span>
                                    @endif
                                @else
                                    @if ($loop->last)
                                        <span>{{$product->name}}*{{$product->quantity}}</span>
                                    @else
                                        <span>{{$product->name}}*{{$product->quantity}} / </span>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
