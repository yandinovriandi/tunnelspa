<?php

namespace App\Http\Controllers;

use App\Models\UserBalace;
use App\Repositories\TripayRepository;
use Illuminate\Http\Request;

class UserBalaceController extends Controller
{
    private TripayRepository $tripayRepository;

    public function __construct(TripayRepository $tripayRepository)
    {
        $this->tripayRepository = $tripayRepository;
    }

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
        $paymentChannels = $this->tripayRepository->getPaymentChannels();

        return view('balance.create', [
            'paymentChannels' => $paymentChannels,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserBalace $userBalace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserBalace $userBalace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserBalace $userBalace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserBalace $userBalace)
    {
        //
    }
}
