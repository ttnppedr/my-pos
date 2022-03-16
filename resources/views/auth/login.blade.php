<x-guest-layout>
    <x-jet-authentication-card>
        <div class="flex justify-center mb-[44px]"><span class="text-[32px] font-semibold">登 入</span></div>
        <x-jet-validation-errors class="mb-4"/>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-[25px]">
                <x-jet-label for="mobile" class="text-2xl" required value="帳號"/>
                <x-jet-input id="mobile"
                             class="h-[50px] block mt-1 w-full bg-[#f8f8f8] border-[#d8d8d8] text-xl px-[16px] py-[12px]"
                             type="text"
                             name="mobile"
                             :value="old('mobile')"
                             required autofocus/>
            </div>

            <div class="mb-[50px]">
                <x-jet-label for="password" class="text-2xl" required value="密碼"/>
                <x-jet-input id="password"
                             class="h-[50px] block mt-1 w-full bg-[#f8f8f8] border-[#d8d8d8] text-xl px-[16px] py-[12px]"
                             type="password"
                             name="password"
                             required
                             autocomplete="current-password"/>
            </div>

            <div class="flex items-center justify-center mb-[25px]">
                <x-jet-button class="w-full h-[50px] text-2xl bg-[#0f375b] justify-center py-[9px]">登 入</x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
