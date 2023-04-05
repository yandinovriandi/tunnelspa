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
                    <x-splade-form :default="$tunnel" method="PUT" :action="route('tunnels.reasync',$tunnel)">
                        <x-splade-select name="server_id" label="Server Tunnels">
                            @foreach($servers as $server)
                                <option value="{{$server->id}}">{{$server->name}}</option>
                            @endforeach
                        </x-splade-select>
                        <x-splade-select name="user_id" label="User Registered">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
                            @endforeach
                        </x-splade-select>
                        <x-splade-input name="password" label="Password" placeholder="*******"/>
                        <x-splade-input name="to_ports_winbox" label="Port Winbox" placeholder="8291"/>
                        <x-splade-input name="to_ports_api" label="Port Api" placeholder="8728"/>
                        <x-splade-input name="to_ports_web" label="Port Web" placeholder="80"/>
                        <x-splade-input name="expired" date time label="Expired"/>
                        <x-splade-checkbox name="status" value="aktif" false-value="nonaktif" label="Status!" />
                        <x-splade-checkbox name="auto_renew" value="aktif" false-value="nonaktif" label="Perpanjang Otomatis!" />
                        <x-splade-submit class="mt-4"/>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
