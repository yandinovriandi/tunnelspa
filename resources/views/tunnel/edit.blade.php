<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Tunnel') }} - {{$tunnel->username}}
            </h2>
            <Link href="{{route('tunnels.index')}}" class="px-2 py-1.5 bg-indigo-500 text-indigo-100 font-semibold hover:bg-indigo-700 hover:text-white rounded-md">Back</Link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form :default="$tunnel" method="PUT" :action="route('tunnels.update',$tunnel)">
                        <x-splade-input name="password" label="Password" placeholder="*******"/>
                        <x-splade-input name="to_ports_winbox" label="Port Winbox" placeholder="8291"/>
                        <x-splade-input name="to_ports_api" label="Port Api" placeholder="8728"/>
                        <x-splade-input name="to_ports_web" label="Port Web" placeholder="80"/>
                        <x-splade-checkbox name="auto_renew" value="aktif" false-value="nonaktif" label="Perpanjang Otomatis!" />
                        <x-splade-submit class="mt-4"/>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
