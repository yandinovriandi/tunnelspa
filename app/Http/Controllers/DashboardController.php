<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Repositories\TripayRepository;
use ProtoneMedia\Splade\SpladeTable;

class DashboardController extends Controller
{
//    private TripayRepository $tripayRepository;
//    public function __construct(TripayRepository $tripayRepository)
//    {
//        $this->tripayRepository = $tripayRepository;
//    }

    public function index()
    {
        $debit = auth()->user()->balances()->where('balance', '>=', 0)->get('balance')->sum('balance');
        $credit = auth()->user()->balances()->where('balance', '<', 0)->get('balance')->sum('balance');
        $balance = $debit + $credit;
        $tunnel = auth()->user()->tunnels()->with('user')->where('user_id', auth()->user()->id)->get()->count();
        $invoice = auth()->user()->transactions()->with('user')->where('status', 'UNPAID')->get()->count();
        $transactions = Transaction::with('user')->where('user_id', auth()->user()->id)->paginate(5);

        return view('dashboard', [
            'transactions' => SpladeTable::for($transactions)
                ->column('reference',
                    sortable: true
                )->withGlobalSearch(columns: ['reference'])
                ->column('amount')
                ->column('type')
                ->column('created_at')
                ->column('status')
                ->column('actions')
            //                ->paginate(5)
            ,
            //            'detail' => $detail,
            'balance' => $balance,
            'tunnel' => $tunnel,
            'invoice' => $invoice,
        ]);
    }
}
