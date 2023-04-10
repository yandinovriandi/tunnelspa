<?php

namespace App\Http\Controllers;

use App\Models\Bottelegram;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use ProtoneMedia\Splade\Facades\Toast;

class BottelegramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('telegram.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bottelegram = new  Bottelegram();
        if (empty($request->telegram_token)) {
            throw ValidationException::withMessages([
                'telegram_token' => 'Token harus di isi',
                'username_bot' => 'Silahkan isi username bot',
                'username_owner' => 'Username Pemilik Bot harus di isi',
                'owner_id' => 'Chat id atau owner id',
                'group_id' => 'Group Chat id harus di isi',
            ]);
        }
        Bottelegram::create([
            'telegram_token' => $request->telegram_token,
            'username_bot' => $request->username_bot,
            'username_owner' => $request->username_owner,
            'owner_id' => $request->owner_id,
            'group_id' => $request->group_id,
        ]);
        Toast::title('Success!.')
            ->message('Data Telegram bot telah di simpan.')
            ->backdrop()
            ->autoDismiss(3);

        return to_route('bottelegram.edit', $bottelegram);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bottelegram $bottelegram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bottelegram $bottelegram)
    {
        return view('telegram.edit',[
            'bottelegram' => $bottelegram
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bottelegram $bottelegram)
    {
        if (empty($request->telegram_token)) {
            throw ValidationException::withMessages([
                'telegram_token' => 'Token harus di isi',
                'username_bot' => 'Silahkan isi username bot',
                'username_owner' => 'Username Pemilik Bot harus di isi',
                'owner_id' => 'Chat id atau owner id',
                'group_id' => 'Group Chat id harus di isi',
            ]);
        }
        $bottelegram->update([
            'telegram_token' => $request->telegram_token,
            'username_bot' => $request->username_bot,
            'username_owner' => $request->username_owner,
            'owner_id' => $request->owner_id,
            'group_id' => $request->group_id,
        ]);
        Toast::title('Success!.')
            ->message('Data Telegram bot telah di simpan.')
            ->backdrop()
            ->autoDismiss(3);

        return to_route('bottelegram.edit', $bottelegram);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bottelegram $bottelegram)
    {
        //
    }
}
