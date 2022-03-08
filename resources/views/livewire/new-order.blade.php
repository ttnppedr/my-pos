<div>
    <div class="flex font-bold">
        <div class="w-2/3">
            <div class="bg-[#f8f8f8] h-screen overflow-y-auto h-[calc(100vh_-_80px)] overflow-x-hidden">
                <div class="py-4 px-6 grid grid-cols-2 gap-x-4 gap-y-6 text-[#0f375b]">
                    <div class="bg-white px-4 py-5 border border-[#e5e5e5] rounded">
                        <div class=" text-2xl text-center">
                            <span>其他品項</span>
                        </div>
                    </div>
                    @foreach($products as $product)
                        <div class="bg-white px-4 py-5 border border-[#e5e5e5] rounded">
                            <div class="flex justify-between text-2xl">
                                <span>{{$product->name}}</span>
                                <span>${{number_format($product->price, 0, '', ',')}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="w-1/3 flex flex-col">
            <div class="flex p-4 text-2xl items-center justify-between border-b">
                <span class="mr-4">桌號</span>
                <input type="text" class="flex-1 w-full rounded bg-[#f8f8f8] border border-[#e5e5e5]">
            </div>
            <div class="">

            </div>
            <div class="mt-auto border-t">
                <div class="flex justify-between border-b text-[#a71f23] text-3xl px-4 py-5">
                    <span>總金額</span>
                    <span>$ 0</span>
                </div>
                <div class="grid grid-cols-2 gap-3 px-3 py-4">
                    <button class="px-16 py-2 bg-[#e5e5e5] rounded"><span
                            class="font-bold text-xl text-[#8d8d8d]">取 消</span>
                    </button>
                    <button class="px-16 py-2 bg-[#e5e5e5] rounded"><span
                            class="font-bold text-xl text-[#8d8d8d]">儲 存</span>
                    </button>
                    <button class="px-16 py-2 bg-[#e5e5e5] rounded"><span
                            class="font-bold text-xl text-[#8d8d8d]">刪 除</span>
                    </button>
                    <button class="px-16 py-2 bg-[#e5e5e5] rounded"><span
                            class="font-bold text-xl text-[#8d8d8d]">結 帳</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
