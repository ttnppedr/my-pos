<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Laravel</title>
</head>
<body>
<div class="flex h-screen" x-data="{openNewItemModal: false}">
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
                <li class="flex justify-between items-center p-4 bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                    <span class="text-[1vw] font-semibold text-blue-500 whitespace-nowrap">一二三四五六七八九十一二三四五六七八九十</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </li>
                <li class="flex justify-between items-center p-4 bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                    <span class="text-[12px] font-semibold text-blue-500 whitespace-nowrap">Mojitoaoenuthaounsthatoenhuaontuehaontueh</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </li>
                <li class="flex justify-between p-4 bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                    <span class="text-5xl font-semibold text-blue-500">Aperol Spritz</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </li>
                <li class="flex justify-between p-4 bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                    <span class="text-5xl font-semibold text-blue-500">Manhattan</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </li>
                <li class="flex justify-between items-center p-4 bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                    <span class="text-[48px] font-semibold text-blue-500 whitespace-nowrap">Whiskey Sour</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </li>
                <li class="flex justify-between p-4 bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                    <span class="text-4xl font-semibold text-blue-500 whitespace-nowrap">Espresso Martini</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </li>
                <li class="flex justify-between p-4 bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                    <span class="text-5xl font-semibold text-blue-500">Margarita</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </li>
                <li class="flex justify-between p-4 bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                    <span class="text-5xl font-semibold text-blue-500">Dry Martini</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </li>
                <li class="flex justify-between p-4 bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                    <span class="text-5xl font-semibold text-blue-500">Daiquiri</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </li>
                <li class="flex justify-between p-4 bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                    <span class="text-5xl font-semibold text-blue-500">Negroni</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </li>
                <li class="flex justify-between p-4 bg-gray-200 rounded-3xl mb-3 border border-slate-600">
                    <span class="text-5xl font-semibold text-blue-500 whitespace-nowrap">Old Fashioned</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="flex-1">
        <ul class="flex-1 flex flex-col p-2 overflow-y-auto h-screen">
            <li class="flex flex-col justify-between p-4 bg-gray-200 rounded-3xl mb-3 border border-black">
                <div class="flex justify-between mb-2">
                    <span class="text-5xl font-semibold text-blue-500">Mojito</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </div>
                <div>
                    <div class="flex items-center justify-center">
                        <button type="button"
                                class="border border-red-500 shadow-sm text-white bg-red-500">
                            <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20 12H4"></path>
                            </svg>
                        </button>
                        <input type="text" name="name" id="name" value="1"
                               class="mx-3 shadow-sm block w-1/4 border-4 border-gray-500 px-4 rounded-lg text-center text-gray-500 text-3xl"
                        >
                        <button type="button"
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
            <li class="flex flex-col justify-between p-4 bg-gray-200 rounded-3xl mb-3 border border-black">
                <div class="flex justify-between mb-2">
                    <span class="text-5xl font-semibold text-blue-500">Manhattan</span>
                    <span class="text-5xl font-semibold text-blue-500">$300</span>
                </div>
                <div>
                    <div class="flex items-center justify-center">
                        <button type="button"
                                class="border border-red-500 shadow-sm text-white bg-red-500">
                            <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20 12H4"></path>
                            </svg>
                        </button>
                        <input type="text" name="name" id="name" value="2"
                               class="mx-3 shadow-sm block w-1/4 border-4 border-gray-500 px-4 rounded-lg text-center text-gray-500 text-3xl"
                        >
                        <button type="button"
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
            <li class="mb-3">
                <div class="h-2 bg-gray-500 rounded">
                </div>
            </li>
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
            <li class="flex justify-between p-2">
                <div class="flex flex-col justify-between">
                    <span class="text-2xl">Mojito</span>
                </div>
                <div>
                    <span class="text-2xl">*1 </span>
                    <span class="text-2xl">$300</span>
                </div>
            </li>
            <li class="flex justify-between p-2">
                <div class="flex flex-col justify-between">
                    <span class="text-2xl">Manhattan</span>
                </div>
                <div>
                    <span class="text-2xl">*2 </span>
                    <span class="text-2xl">$600</span>
                </div>
            </li>
            <li>
                <hr>
            </li>
            <li class="flex justify-between p-2">
                <div class="flex flex-col justify-between">
                </div>
                <div class="border-double">
                    <span class="text-2xl">$900</span>
                </div>
            </li>
            <li class="flex justify-between p-2">
                <div class="flex flex-col justify-between">
                    <span class="text-2xl">折扣</span>
                </div>
                <div class="border-double">
                    <span class="text-2xl">-$400</span>
                </div>
            </li>
            <li>
                <hr>
            </li>
            <li class="flex justify-between p-2">
                <div class="flex flex-col justify-between">
                    <span class="text-2xl">總計</span>
                </div>
                <div class="border-double border-b-8 border-red-600">
                    <span class="text-4xl">$500</span>
                </div>
            </li>
        </ul>
        <div class="flex flex-col h-[180px]">
            <div class="flex mb-2">
                <button type="button"
                        class="w-1/2 h-20 px-6 py-3 mx-1 border border-transparent text-3xl font-bold rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    取消
                </button>
                <button type="button"
                        class="w-1/2 h-20 px-6 py-3 mx-1 border border-transparent text-3xl font-bold rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    折扣
                </button>
            </div>
            <div class="flex mb-2">
                <button type="button"
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
    <div x-show="openNewItemModal" class="fixed inset-0 overflow-y-auto">
        <div x-show="openNewItemModal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div
            x-show="open" x-transition
            x-on:click="openNewItemModal = false"
            class="relative min-h-screen flex items-center justify-center p-4"
        >
            <div
                x-on:click.stop
                x-trap.noscroll.inert="open"
                class="relative max-w-3xl w-full bg-white border border-black p-8 overflow-y-auto"
            >
                <!-- Title -->
                <h2 class="text-3xl font-medium" :id="$id('modal-title')">Confirm</h2>
                <!-- Content -->
                <p class="mt-2 text-gray-600">Are you sure you want to learn how to create an awesome modal?</p>
                <!-- Buttons -->
                <div class="mt-8 flex space-x-2">
                    <button type="button" x-on:click="openNewItemModal = false"
                            class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                        Confirm
                    </button>
                    <button type="button" x-on:click="openNewItemModal = false"
                            class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
