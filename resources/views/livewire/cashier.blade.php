<div class="flex h-screen bg-white" id="cashier">
    <div class="w-1/3">
        <div class="text-center flex h-[60px] border-b-2 border-black">
            <div class="py-2 pl-2">
                <div class="relative z-0 inline-flex shadow-sm rounded-md">
                    <div x-data="{dropdownMenu: false}" class="relative">
                        <!-- Dropdown toggle button -->
                        <button @click="dropdownMenu = ! dropdownMenu"
                                class="-ml-px relative inline-flex items-center px-4 py-2 ml-1 rounded-md border border-gray-500 bg-white text-lg font-medium text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <svg x-show="!dropdownMenu" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7" />
                            </svg>
                            <svg x-show="dropdownMenu" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                            </svg>
                        </button>
                        <!-- Dropdown list -->
                        <div x-show="dropdownMenu"
                             @click.away="dropdownMenu = false"
                             class="absolute py-2 mt-2 bg-white rounded-md border border-gray-500 shadow-xl w-full">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-lg font-medium text-gray-700">
                                    {{ __('登出') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <button type="button"
                            wire:click="viewProduct"
                            class="-ml-px relative inline-flex items-center px-4 py-2 ml-1 rounded-md border border-gray-500 bg-white text-lg font-medium text-gray-700">
                        商品
                    </button>
                    <button type="button"
                            wire:click="viewOrder"
                            class="-ml-px relative inline-flex items-center px-4 py-2 ml-1 rounded-md border border-gray-500 bg-white text-lg font-medium text-gray-700">
                        訂單
                    </button>
                    <button type="button"
                            onclick="openFullscreen();"
                            class="-ml-px relative inline-flex items-center px-4 py-2 ml-1 rounded-md border border-gray-500 bg-white text-lg font-medium text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div>
            <ul class="flex-1 flex flex-col p-2 overflow-y-auto h-[calc(100vh_-_60px)] overflow-x-hidden">
                @if($viewing === 'product')
                    @foreach($products as $product)
                        <li class="flex justify-between bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                            <button wire:click="addToCartFromProductList({{$product->id}})"
                                    class="flex flex-1 justify-between items-center p-4 rounded-3xl bg-gray-200 "
                            >
                                <span class="text-5xl font-semibold text-blue-500 whitespace-nowrap">{{$product->name}}</span>
                                <span class="text-5xl font-semibold text-blue-500">${{$product->price}}</span>
                            </button>
                        </li>
                    @endforeach
                @endif
                @if($viewing === 'order')
                    @foreach($orders as $order)
                        <li class="flex justify-between bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                            <button wire:click="showOrderContent({{$order->id}})"
                                    class="flex flex-1 justify-between items-center p-4 rounded-3xl bg-gray-200 "
                            >
                                <div class="text-3xl font-semibold text-blue-500 whitespace-nowrap">
                                    @foreach($order->products as $product)
                                        <span>{{$product->name}}</span> <span>*{{$product->quantity}}</span><br>
                                    @endforeach
                                </div>
                                <span class="text-5xl font-semibold text-blue-500">${{$order->amount_receivable}}</span>
                            </button>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="flex-1">
        <ul class="flex-1 flex flex-col p-2 overflow-y-auto h-screen">

            @foreach($cart as $index => $product)
                <li wire:key="cart-{{$index}}"
                    class="flex flex-col justify-between p-4 bg-gray-200 rounded-3xl mb-3 border border-black">
                    <div class="flex justify-between mb-2">
                        <span class="text-5xl font-semibold text-blue-500">{{$product['name']}}</span>
                        <span class="text-5xl font-semibold text-blue-500">${{$product['price']}}</span>
                    </div>
                    <div>
                        <div class="flex items-center justify-center">
                            <button type="button"
                                    wire:click="cartMinus({{$index}})"
                                    class="border border-red-500 shadow-sm text-white bg-red-500">
                                <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M20 12H4"></path>
                                </svg>
                            </button>
                            <input type="text" value="{{$product['quantity']}}" disabled
                                   class="mx-3 shadow-sm block w-1/4 border-4 border-gray-500 px-4 rounded-lg text-center text-gray-500 text-3xl"
                            >
                            <button type="button"
                                    wire:click="cartPlus({{$index}})"
                                    class="border border-green-500 shadow-sm text-white bg-green-500">
                                <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </li>
            @endforeach

            <li class="flex justify-center bg-gray-200 rounded-3xl mb-3 border border-black">
                <button type="button" class="text-blue-700 rounded-3xl border flex-1 flex justify-center"
                        wire:click="$set('showNewProductModal',true)"
                >
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                @if($showNewProductModal)
                    <x-new-product-model></x-new-product-model>
                @endif
            </li>
        </ul>
    </div>
    <div class="w-1/4">
        <ul class="flex-1 flex flex-col p-2 overflow-y-auto h-[calc(100vh_-_180px)]">
            @foreach($this->cart as $product)
                <li class="flex justify-between p-2">
                    <div class="flex flex-col justify-between">
                        <span class="text-2xl">{{$product['name']}}</span>
                    </div>
                    <div>
                        <span class="text-2xl">*{{$product['quantity']}} </span>
                        <span class="text-2xl">${{$product['price']}}</span>
                    </div>
                </li>
            @endforeach

            @if($amountReceivable)
                <li>
                    <hr>
                </li>
                {{--            <li class="flex justify-between p-2">--}}
                {{--                <div class="flex flex-col justify-between">--}}
                {{--                </div>--}}
                {{--                <div class="border-double">--}}
                {{--                    <span class="text-2xl">$900</span>--}}
                {{--                </div>--}}
                {{--            </li>--}}
                {{--            <li class="flex justify-between p-2">--}}
                {{--                <div class="flex flex-col justify-between">--}}
                {{--                    <span class="text-2xl">折扣</span>--}}
                {{--                </div>--}}
                {{--                <div class="border-double">--}}
                {{--                    <span class="text-2xl">-$400</span>--}}
                {{--                </div>--}}
                {{--            </li>--}}
                {{--            <li>--}}
                {{--                <hr>--}}
                {{--            </li>--}}
                <li class="flex justify-between p-2">
                    <div class="flex flex-col justify-between">
                        <span class="text-2xl">總計</span>
                    </div>
                    <div class="border-double border-b-8 border-red-600">
                        <span class="text-4xl">${{$amountReceivable}}</span>
                    </div>
                </li>
            @endif
        </ul>
        <div class="flex flex-col h-[180px]">
            <div class="flex mb-2">
                <button wire:click="save"
                        type="button"
                        class="w-1/2 h-20 px-6 py-3 mx-1 border border-transparent text-3xl font-bold rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    儲存
                </button>
                <button type="button"
                        wire:click="clear"
                        class="w-1/2 h-20 px-6 py-3 mx-1 border border-transparent text-3xl font-bold rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    取消
                </button>
            </div>
            <div class="flex mb-2">
                <button type="button"
                        wire:click="openCheckoutModal"
                        {{!$orderId ? 'disabled' : ''}}
                        class="flex-1 h-20 px-6 py-3 mx-1 border border-transparent text-3xl font-bold rounded-md shadow-sm text-white bg-red-600 {{!$orderId ? 'bg-gray-400' : ''}}">
                    結帳
                </button>
                @if($showCheckoutModal)
                    <x-checkout-model :amount-receivable="$amountReceivable"></x-checkout-model>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    var elem = document.getElementById("cashier");
    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.webkitRequestFullscreen) { /* Safari */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE11 */
            elem.msRequestFullscreen();
        }
    }
</script>
