<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Payment Getway - Setting') }}
            </h2>
            <Link href="{{route('dashboard')}}" class="px-2 py-1.5 bg-indigo-500 text-indigo-100 font-semibold hover:bg-indigo-700 hover:text-white rounded-md">Back</Link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form :action="route('payment.store')">
                        <x-splade-input name="vendor" label="Payment Vendor" placeholder="Tripay"/>
                        <x-splade-select name="mode" label="Mode">
                            <option value="local">Sandbox</option>
                            <option value="production">Production</option>
                        </x-splade-select>
                        <x-splade-input name="merchant_code" label="Merchant Code" placeholder="Merchant Code"/>
                        <x-splade-input name="api_key" label="Api Key" placeholder="Api Key"/>
                        <x-splade-input name="private_key" label="Private Key" placeholder="Private Key"/>
                        <x-splade-input name="url" label="URL Website" placeholder="https://tunnel.mikrotikbot.com"/>
                        <x-splade-input name="callback" label="Callback URL" placeholder="https://tunnel.mikrotikbot.com/confirm-payment"/>
                        <x-splade-submit class="mt-4"/>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
