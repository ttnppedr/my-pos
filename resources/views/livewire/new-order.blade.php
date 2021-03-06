@section('title', '新增訂單')
<div x-data="cartApp">
    <div x-data="{carts: @entangle('carts').defer}" class="flex font-bold">
        <div x-data="{products: @js($products)}" class="w-1/2 md:w-2/3">
            <div class="bg-[#f8f8f8] h-screen overflow-y-auto h-[calc(100vh_-_80px)] overflow-x-hidden">
                <div class="py-4 px-6 grid md:grid-cols-2 gap-x-4 gap-y-6 text-[#0f375b]">
                    <div
                        @click="showNewProductModal = true"
                        class="bg-white px-4 py-5 border border-[#e5e5e5] rounded cursor-pointer"
                    >
                        <div class=" text-2xl text-center">
                            <span>其他品項</span>
                        </div>
                    </div>
                    <template x-for="product in products">
                        <div
                            @click="openProductModal(product)"
                            class="bg-white px-4 py-5 border border-[#e5e5e5] rounded cursor-pointer"
                        >
                            <div class="flex justify-between text-2xl">
                                <span x-text="product.name"></span>
                                <span x-text="'$'+new Intl.NumberFormat().format(product.price)"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div class="w-1/2 md:w-1/3 flex flex-col">
            <div class="flex p-4 text-2xl items-center justify-between border-b">
                <span class="mr-4">桌號</span>
                <input
                    wire:model.defer="note"
                    type="text" class="flex-1 w-full rounded bg-[#f8f8f8] border border-[#e5e5e5]"
                >
            </div>
            <div class="overflow-y-auto h-[calc(100vh_-_370px)] overflow-x-hidden">
                <template x-for="cart in carts" :key="`${cart.name}-${cart.price}-${cart.note}`">
                    <div class="mx-4 mt-3 px-3 py-4 border border-[#e5e5e5] rounded">
                        <div class="flex justify-between text-[#0f375b] text-md md:text-xl pb-2">
                            <span x-text="cart.name"></span>
                            <span x-text="'*'+cart.quantity+' / $'+new Intl.NumberFormat().format(cart.price)"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex justify-around items-center">
                                <button
                                    @click="cartMinus(cart)"
                                    class="flex justify-center items-center bg-[#fce2e2] rounded w-[44px] h-[44px]"
                                >
                                    <svg width="22" height="4" viewBox="0 0 22 4" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2.444.289a1.711 1.711 0 0 0 0 3.422h17.112a1.711 1.711 0 0 0 0-3.422H2.444z"
                                            fill="#A71F23" fill-rule="nonzero"/>
                                    </svg>
                                </button>
                                <div class="px-3">
                                    <input
                                        x-model="cart.quantity"
                                        disabled
                                        class="w-14 lg:w-32 rounded bg-[#f8f8f8] border border-[#e5e5e5] text-center font-semibold text-xl"
                                        type="text"
                                    >
                                </div>
                                <button
                                    @click="cartPlus(cart)"
                                    class="flex justify-center items-center bg-[#d8f3e6] rounded w-[44px] h-[44px]"
                                >
                                    <svg width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11 .733c-.945 0-1.711.766-1.711 1.711V9.29H2.444a1.711 1.711 0 0 0 0 3.422H9.29v6.845a1.711 1.711 0 0 0 3.422 0V12.71h6.845a1.711 1.711 0 0 0 0-3.422H12.71V2.444c0-.945-.766-1.71-1.711-1.71z"
                                            fill="#006941" fill-rule="nonzero"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center">
                                <button
                                    @click="cartRemove(cart)"
                                    class="flex justify-center items-center bg-[#fce2e2] rounded w-[44px] h-[44px]"
                                >
                                    <svg width="22" height="25" viewBox="0 0 22 25" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.854 0c1.206 0 2.188.986 2.188 2.197v.733h3.645c1.207 0 2.188.985 2.188 2.197a2.2 2.2 0 0 1-1.507 2.088l-1.3 15.77A2.204 2.204 0 0 1 16.887 25h-11.9a2.204 2.204 0 0 1-2.18-2.015l-1.3-15.77A2.2 2.2 0 0 1 0 5.127C0 3.915.981 2.93 2.188 2.93h3.645v-.733C5.833.986 6.815 0 8.021 0zm5.041 7.324H2.98l1.281 15.54c.031.376.35.671.727.671h11.9a.735.735 0 0 0 .726-.671l1.281-15.54zM6.517 8.79c.4-.025.748.282.773.686l.73 11.817a.731.731 0 0 1-.73.777.73.73 0 0 1-.726-.687l-.73-11.816a.731.731 0 0 1 .683-.777zm4.42 0a.73.73 0 0 1 .73.731v11.817a.73.73 0 0 1-.73.732.73.73 0 0 1-.729-.732V9.52a.73.73 0 0 1 .73-.732zm4.42 0a.731.731 0 0 1 .683.777l-.729 11.816a.73.73 0 1 1-1.455-.09l.729-11.817a.73.73 0 0 1 .773-.686zm4.33-4.395h-17.5a.732.732 0 0 0 0 1.464h17.5a.732.732 0 0 0 0-1.464zm-5.833-2.93H8.021a.732.732 0 0 0-.73.732v.733h7.292v-.733a.732.732 0 0 0-.729-.732z"
                                            fill="#A71F23" fill-rule="nonzero"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex text-xl pt-2">
                            <span class="text-[#f5a623]" x-text="cart.note"></span>
                        </div>
                    </div>
                </template>
            </div>
            <div class="mt-auto border-t">
                <div class="flex justify-between border-b text-[#a71f23] text-3xl px-4 py-5">
                    <span>總金額</span>
                    <span x-text="'$'+new Intl.NumberFormat().format(totalPrice)"></span>
                </div>
                <div class="grid grid-cols-2 gap-3 px-3 py-4">
                    <button
                        @click="clearCart"
                        :disabled="isCartEmpty"
                        :class="isCartEmpty ? 'bg-[#e5e5e5]' : 'bg-white border border-[#0f375b]'"
                        class="flex flex-1 justify-center items-center px-8 xl:px-16 py-2 w-full rounded"
                    >
                        <span
                            :class="isCartEmpty ? 'text-[#8d8d8d]' : 'text-[#0f375b]'"
                            class="font-bold text-xl"
                        >取消</span>
                    </button>
                    <button
                        wire:click="save"
                        :disabled="isCartEmpty"
                        :class="isCartEmpty ? 'bg-[#e5e5e5]' : 'bg-[#0f375b]'"
                        class="flex flex-1 justify-center items-center px-8 xl:px-16 py-2 w-full rounded"
                    >
                        <span
                            :class="isCartEmpty ? 'text-[#8d8d8d]' : 'text-white'"
                            class="font-bold text-xl"
                        >儲存</span>
                    </button>
                    <x-disablable-button type="danger" disabled>刪除</x-disablable-button>
                    <x-disablable-button type="normal" disabled>結帳</x-disablable-button>
                </div>
            </div>
        </div>
        <x-new-product-modal></x-new-product-modal>
        <x-product-modal></x-product-modal>
    </div>
</div>
