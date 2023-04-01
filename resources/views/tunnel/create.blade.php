<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Tunnel Remote') }}
            </h2>
            <Link href="{{route('tunnels.index')}}" class="px-2 py-1.5 bg-indigo-500 text-indigo-100 font-semibold hover:bg-indigo-700 hover:text-white rounded-md">Back</Link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form :action="route('tunnels.store')">
                        <x-splade-select name="server_id" :options="$servers" label="Server Tunnels" choices/>
                            <div class="grid gap-x-6 md:grid-cols-2">
                            <div class="my-3">
                                <x-splade-input name="username" label="Username" placeholder="user tunnel remote"/>
                            </div>
                            <div class="my-3">
                                <x-splade-input name="password" label="Password" placeholder="Password Tunnel"/>
                            </div>
                        </div>
                        <x-splade-checkbox name="auto_renew" value="ya" false-value="tidak" label="Perpanjang Otomatis!" />
                        <x-splade-submit class="mt-4"/>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
