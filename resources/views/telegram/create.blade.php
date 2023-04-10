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
                    <x-splade-form :action="route('bottelegram.store')">
                        <x-splade-input name="telegram_token" label="Bot Token" placeholder="Bot Token"/>
                        <x-splade-input name="username_bot" label="Username Bot" placeholder="Username Bot"/>
                        <x-splade-input name="username_owner" label="Username Owner" placeholder="Useername Owner"/>
                        <x-splade-input name="owner_id" label="Owner ID" placeholder="Owner ID"/>
                        <x-splade-input name="group_id" label="Group ID" placeholder="Group ID"/>
                        <x-splade-submit class="mt-4"/>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
