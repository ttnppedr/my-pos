<div>
    <div class="fixed inset-0 overflow-y-auto">
        <div x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div
            x-transition
            class="relative min-h-screen flex items-center justify-center p-4"
        >
            <div
                x-on:click.stop
                x-trap.noscroll.inert="openNewProductModal"
                class="relative max-w-3xl w-full bg-white border border-black p-8 overflow-y-auto rounded-2xl"
            >
                <!-- Content -->
                <div class="flex flex-col items-center">
                    <input type="text" class="w-3/4 rounded text-3xl" placeholder="名稱" wire:model="newProductName">
                    <input type="text" class="mt-2 w-3/4 rounded text-3xl" placeholder="價格" wire:model="newProductPrice">
                </div>
                <!-- Buttons -->
                <div class="mt-4 flex space-x-2 justify-center">
                    <button type="button"
                            wire:click="addNewToCart"
                            class="p-2 text-5xl font-bold rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                        新增
                    </button>
                    <button type="button"
                            wire:click="$set('showNewProductModal',false)"
                            class="p-2 text-5xl font-bold rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                        取消
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
