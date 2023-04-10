<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
{{--    <x-splade-event private channel="transaction.paid" listen="TransactionPaid" />--}}

    <x-splade-lazy>
        <x-slot:placeholder>
            <div class="flex justify-center items-center h-12 mt-6">
                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </x-slot:placeholder>
        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <Link class="bg-white border dark:text-slate-100 text-slate-800 dark:border-slate-700 dark:bg-slate-800 group relative block !border-none rounded-xl p-3 shadow lg:p-6" href="{{route('transaction.create')}}">
                            <div class="mb-2 flex items-center justify-between">
                                <h4 class="font-mono text-base tracking-tighter dark:text-white sm:text-3xl">
                                   Rp.{{formatRupiah($balance)}}
                                </h4>
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-slate-900 fade group-hover:bg-sky-100 group-hover:text-sky-900 dark:bg-black/20 dark:text-slate-200 dark:group-hover:bg-sky-900/50 dark:group-hover:text-sky-500 lg:h-10 lg:w-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 lg:h-5 lg:w-5">
                                        <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                        <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                        <path d="M9 8h6"></path>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-xs tracking-tight text-muted sm:text-sm">Saldo
                            </span>
                        </Link>
                        <Link class="bg-white border dark:text-slate-100 text-slate-800 dark:border-slate-700 dark:bg-slate-800 group relative block !border-none rounded-xl p-3 shadow lg:p-6" href="{{route('tunnels.index')}}">
                            <div class="mb-2 flex items-center justify-between">
                                <h4 class="font-mono text-base tracking-tighter dark:text-white sm:text-3xl">
                                    {{$tunnel}}
                                </h4>
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-slate-900 fade group-hover:bg-sky-100 group-hover:text-sky-900 dark:bg-black/20 dark:text-slate-200 dark:group-hover:bg-sky-900/50 dark:group-hover:text-sky-500 lg:h-10 lg:w-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 lg:h-5 lg:w-5">
                                        <path d="M9 4h6a2 2 0 0 1 2 2v14l-5 -3l-5 3v-14a2 2 0 0 1 2 -2"></path>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-xs tracking-tight text-muted sm:text-sm">Tunnels Remote
                            </span>
                        </Link>
                        <Link class="bg-white border dark:text-slate-100 text-slate-800 dark:border-slate-700 dark:bg-slate-800 group relative block !border-none rounded-xl p-3 shadow lg:p-6" href="{{route('transaction.create')}}">
                            <div class="mb-2 flex items-center justify-between">
                                <h4 class="font-mono text-base tracking-tighter dark:text-white sm:text-3xl">
                                   {{$invoice}}
                                </h4>
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-slate-900 fade group-hover:bg-sky-100 group-hover:text-sky-900 dark:bg-black/20 dark:text-slate-200 dark:group-hover:bg-sky-900/50 dark:group-hover:text-sky-500 lg:h-10 lg:w-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 lg:h-5 lg:w-5">
                                        <path d="M5 5m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-xs tracking-tight text-muted sm:text-sm">Invoce Pending
                            </span>
                        </Link>
                    </div>
                        <x-splade-table  :for="$transactions" class="mt-6">
                            @cell('reference',$transaction)
                            <span class="bg-green-100 capitalize hover:cursor-pointer hover:text-green-700 font-semibold text-green-500 rounded-md px-4 py-0.5">{{$transaction->reference}}</span>
                            @endcell
                            @cell('amount',$transaction)
                            <span class="bg-blue-100 capitalize hover:cursor-pointer hover:text-blue-700 font-semibold text-blue-500 rounded-md px-4 py-0.5">Rp. {{formatRupiah($transaction->amount)}}</span>
                            @endcell
                            @cell('created_at',$transaction)
                            <span class="bg-yellow-100 capitalize hover:cursor-pointer hover:text-yellow-700 font-semibold text-yellow-500 rounded-md px-4 py-0.5">{{$transaction->created_at}}</span>
                            @endcell
                            @cell('status',$transaction)
                                <span class="
                                  {{ $transaction->status == \App\Enums\TransactionStatus::PAID ? 'text-green-500 bg-green-100 hover:text-green-700' : 'text-yellow-500 bg-yellow-100 hover:text-yellow-700' }}
                                  hover:cursor-pointer font-semibold rounded-md px-4 py-0.5"
                                                            >
                                  {{ $transaction->status }}
                                </span>
                            @endcell
                            @cell('actions',$transaction)
                            @if ($transaction->type == 'Order Layanan Tunnel' || $transaction->type == 'Perpanjang Layanan Tunnel')
                                {{-- Do nothing --}}
                            @else
                                <div class="flex items-center justify-center gap-x-1">
                                    <Link href="{{ route('transaction.show', $transaction->reference) }}" class="text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-invoice" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                        <path d="M9 7l1 0"></path>
                                        <path d="M9 13l6 0"></path>
                                        <path d="M13 17l2 0"></path>
                                    </svg>
                                    </Link>
                                </div>
                            @endif

                            @endcell
                     </x-splade-table>
                </div>
            </div>
        </div>
    </div>
  </x-splade-lazy>
</x-app-layout>
