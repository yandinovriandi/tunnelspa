<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerStoreRequest;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query,$value){
            $query->where(function ($query) use ($value){
               Collection::wrap($value)->each(function ($value)use($query){
                   $query->orWhere('name','LIKE',"%$value%")
                       ->orWhere('domain','LIKE',"%$value%");
               });
            });
        });
        return view('server.index',[
         'servers' => SpladeTable::for(Server::class)
             ->column('name',
                 sortable: true
             )->withGlobalSearch(columns: ['name', 'domain'])
             ->column('domain')
             ->column('host')
             ->column('username')
             ->column('password')
             ->column('port')
             ->column('actions')
             ->paginate(5),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $servers = Server::pluck('id','slug','name')->toArray();
        return view('server.create',['servers' => $servers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServerStoreRequest $request)
    {
         Server::create([
                'name' => $name = $request->name,
                'slug' => str($name . '-'. Str::random(6))->slug(),
                'domain'   => $request->domain,
                'username' => $request->username,
                'password' => $request->password,
                'host' => $request->host,
                'port' => $request->port
            ]);
            Toast::title('Berhasil.')
                ->message('Server baru berhasil di simpan.')
                ->backdrop()
                ->autoDismiss(2);
            return to_route('server.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Server $server)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Server $server)
    {
        return view('server.edit',[
            'server' => $server
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServerStoreRequest $request, Server $server)
    {
        $server->update([
            'name' => $request->name,
            'slug' => $server->slug,
            'domain'   => $request->domain,
            'username' => $request->username,
            'password' => $request->password,
            'host' => $request->host,
            'port' => $request->port
        ]);
        Toast::title('Berhasil.')
            ->message('Data server berhasil di update.')
            ->backdrop()
            ->autoDismiss(2);
        return to_route('server.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Server $server)
    {
        $server->delete();
        Toast::title('Berhasil.')
            ->message('Data server berhasil di hapus.')
            ->backdrop()
            ->autoDismiss(2);
        return to_route('server.index');
    }
}
