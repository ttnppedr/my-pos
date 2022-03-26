<div x-show="showLogoutModal" x-cloak>
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
                    <span class="text-2xl">登出</span>
                    <button @click="showLogoutModal = false"
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
                        <span>是否確定要登出？</span>
                    </div>
                </div>
                <!-- Buttons -->
                <div class="mt-4 flex space-x-2 justify-center">
                    <x-disablable-button type="outline" @click="showLogoutModal = false">取 消</x-disablable-button>
                    <x-disablable-button type="primary" wire:click="logout">確 認</x-disablable-button>
                </div>
            </div>
        </div>
    </div>
</div>
