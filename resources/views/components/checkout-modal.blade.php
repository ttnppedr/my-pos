<div x-show="showCheckoutModal" x-cloak x-data="{amountReceived: @entangle('amountReceived').defer}">
    <div class="fixed inset-0 overflow-y-auto">
        <div x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div
            x-transition
            class="relative min-h-screen flex items-center justify-center text-black"
        >
            <div
                x-on:click.stop
                x-trap.noscroll.inert="openNewProductModal"
                class="relative w-[450px] bg-white border border-black overflow-y-auto rounded px-5 pt-2 pb-4 font-medium"
            >
                <div class="flex justify-between mb-6">
                    <span class="text-2xl">結帳</span>
                    <button @click="showCheckoutModal = false"
                    >
                        <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 8.345 18.276.069a.234.234 0 0 1 .331 0l1.324 1.324a.234.234 0 0 1 0 .33L11.655 10l8.276 8.276a.234.234 0 0 1 0 .331l-1.324 1.324a.234.234 0 0 1-.33 0L10 11.655l-8.276 8.276a.234.234 0 0 1-.331 0L.069 18.607a.234.234 0 0 1 0-.33L8.345 10 .069 1.724a.234.234 0 0 1 0-.331L1.393.069a.234.234 0 0 1 .33 0L10 8.345z"
                                fill="#000" fill-rule="nonzero"/>
                        </svg>
                    </button>
                </div>
                <!-- Content -->
                <div class="flex flex-col items-center">
                    <div class="w-full mb-4">
                        <div class="text-lg"><span>應收金額</span></div>
                        <input
                            x-model="new Intl.NumberFormat().format(totalPrice)"
                            disabled
                            class="w-full h-10 px-4 py-2 flex-1 rounded bg-[#f8f8f8] border border-[#e5e5e5] text-xl text-[#8d8d8d]"
                            type="text"
                        >
                    </div>
                    <div class="w-full mb-4">
                        <div class="text-lg"><span class="text-red-700">*</span><span>實收金額</span></div>
                        <input
                            x-model="amountReceived"
                            class="w-full h-10 px-4 py-2 flex-1 rounded bg-[#f8f8f8] border border-[#e5e5e5] text-xl"
                            type="number"
                        >
                    </div>
                </div>
                <!-- Buttons -->
                <div class="mt-4 flex space-x-2 justify-center">
                    <x-disablable-button type="outline" @click="showCheckoutModal = false">
                        取 消
                    </x-disablable-button>
                    <button
                        wire:click="checkout"
                        :disabled="!amountReceived && amountReceived <= 0"
                        :class="!amountReceived && amountReceived <= 0 ? 'bg-[#e5e5e5]' : 'bg-[#0f375b]'"
                        class="flex flex-1 justify-center items-center px-8 xl:px-16 py-2 w-full rounded"
                    >
                        <span
                            :class="!amountReceived && amountReceived <= 0 ? 'text-[#8d8d8d]' : 'text-white'"
                            class="font-bold text-xl"
                        >確認</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
