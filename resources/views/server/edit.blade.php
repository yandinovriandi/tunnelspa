<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Server') }} - {{$server->name}}
            </h2>
            <Link href="{{route('server.index')}}" class="px-2 py-1.5 bg-indigo-500 text-indigo-100 font-semibold hover:bg-indigo-700 hover:text-white rounded-md">Back</Link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form :default="$server" method="PUT" :action="route('server.update',$server->slug)">
                        <x-splade-input name="name" label="Identity" placeholder="Server ID1"/>
                        <x-splade-input name="domain" label="Host/Domain" placeholder="id1.mikrotikbot.com"/>
                        <x-splade-input name="host" label="Host" placeholder="192.168.88.1"/>
                        <x-splade-input name="username" label="Username" placeholder="admin"/>
                        <x-splade-input name="password" label="Password" placeholder="********"/>
                        <x-splade-input name="port" label="Port" placeholder="8728"/>
                        <x-splade-submit class="mt-4"/>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
