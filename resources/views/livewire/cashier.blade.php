<div class="flex h-screen">
    <div class="w-1/3">
        <div class="text-center flex h-[60px] border-b-2 border-black">
            <div class="py-2 pl-2">
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    <button type="button"
                            class="relative inline-flex items-center px-4 py-2 ml-1 rounded-md border border-gray-500 bg-white text-lg font-medium text-gray-700">
                        歷史商品
                        </button>
                    <button type="button"
                            class="-ml-px relative inline-flex items-center px-4 py-2 ml-1 rounded-md border border-gray-500 bg-white text-lg font-medium text-gray-700">
                        商品
                    </button>
                    <button type="button"
                            class="-ml-px relative inline-flex items-center px-4 py-2 ml-1 rounded-md border border-gray-500 bg-white text-lg font-medium text-gray-700">
                        訂單
                    </button>
                </span>
            </div>
        </div>
        <div>
            <ul class="flex-1 flex flex-col p-2 overflow-y-auto h-[calc(100vh_-_60px)] overflow-x-hidden">
                @foreach($products as $product)
                    <li class="flex justify-between bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                        <button wire:click="addToCartFromProductList({{$product->id}})"
                                class="flex flex-1 justify-between items-center p-4 rounded-3xl bg-gray-200 "
                        >
                        <span
                            class="text-5xl font-semibold text-blue-500 whitespace-nowrap">{{$product->name}}</span>
                            <span class="text-5xl font-semibold text-blue-500">${{$product->price}}</span>
                        </button>
                    </li>
                @endforeach
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
                        @click="openNewItemModal = true">
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
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
                <button type="button"
                        wire:click="clear"
                        class="w-1/2 h-20 px-6 py-3 mx-1 border border-transparent text-3xl font-bold rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    取消
                </button>
                <button type="button"
                        class="w-1/2 h-20 px-6 py-3 mx-1 border border-transparent text-3xl font-bold rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    折扣
                </button>
            </div>
            <div class="flex mb-2">
                <button wire:click="save"
                        type="button"
                        class="w-1/2 h-20 px-6 py-3 mx-1 border border-transparent text-3xl font-bold rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    儲存
                </button>
                <button type="button"
                        class="w-1/2 h-20 px-6 py-3 mx-1 border border-transparent text-3xl font-bold rounded-md shadow-sm text-white bg-red-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    結帳
                </button>
            </div>
        </div>
    </div>

    <div class="hidden fixed inset-0 overflow-y-auto">
        <div x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div
            x-transition
            class="relative min-h-screen flex items-center justify-center p-4"
        >
            <div
                x-on:click.stop
                x-trap.noscroll.inert="openNewItemModal"
                class="relative max-w-3xl w-full bg-white border border-black p-8 overflow-y-auto rounded-2xl"
            >
                <!-- Content -->
                <div class="flex flex-col items-center">
                    <input type="text" class="w-3/4 rounded text-3xl" placeholder="名稱">
                    <input type="text" class="mt-2 w-3/4 rounded text-3xl" placeholder="價格">
                </div>
                <!-- Buttons -->
                <div class="mt-4 flex space-x-2 justify-center">
                    <button type="button"
                            class="p-2 text-5xl font-bold rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                        新增
                    </button>
                    <button type="button"
                            class="p-2 text-5xl font-bold rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                        取消
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
