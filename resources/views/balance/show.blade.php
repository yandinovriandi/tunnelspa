<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Details Transaksi') }}
            </h2>
            <Link href="{{route('dashboard')}}" class="px-2 py-1.5 bg-indigo-500 text-indigo-100 font-semibold hover:bg-indigo-700 hover:text-white rounded-md">Back</Link>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="mx-auto max-w-screen-lg">

            <div class="min-h-screen bg-white p-24 shadow-lg print:p-0 print:shadow-none">

                <div class="mb-10 grid grid-cols-2">
                    <div>
                        <a class="flex flex-shrink-0 items-center focus:outline-none text-2xl font-bold" href="/">
                            MIKROTIKBOT
                        </a>
                        <strong class="mt-4 mb-2 block font-semibold">
                            From
                        </strong>
                        <div>
                            <strong class="font-semibold">MikrotikBot</strong></div>team@mikrotikbot.com</div>
                    <div class="text-right">
                        <div class="mb-4">
                            <div>
                                Invoice ID
                                <strong class="font-semibold text-blue-500 shadow-down-strike">
                                    #{{$detail->reference}}
                                </strong>
                            </div>
                            Date of Invoice: {{ date('d M Y H:i', $detail->expired_time) }}
                        </div>
                        <strong class="mb-2 block font-semibold">
                            To
                        </strong>
                        <div>
                            <strong class="font-semibold">
                                {{$detail->customer_name}}
                            </strong>
                        </div>
                        {{$detail->customer_email}}
                    </div>
                </div>
                <div class="flex flex-col dark:!divide-slate-300">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="min-w-full divide-y dark:divide-slate-800">
                                <thead class="bg-slate-50 dark:bg-black/5">
                                <tr class="!bg-white">
                                    <th scope="col" class="!px-0 dark:text-slate-800 whitespace-nowrap px-6 py-3 text-left text-sm font-semibold text-black dark:text-white">
                                        Package
                                    </th>
                                    <th scope="col" class="dark:text-slate-800 whitespace-nowrap px-6 py-3 text-left text-sm font-semibold text-black dark:text-white">
                                        Made At
                                    </th>
                                    <th scope="col" class="dark:text-slate-800 whitespace-nowrap px-6 py-3 text-left text-sm font-semibold text-black dark:text-white">
                                        Status
                                    </th>
                                    <th scope="col" class="!px-0 text-right dark:text-slate-800 whitespace-nowrap px-6 py-3 text-left text-sm font-semibold text-black dark:text-white">
                                        Price
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y bg-white dark:divide-slate-800 dark:bg-slate-900 dark:!bg-white dark:divide-slate-300">
                                <tr class="hover:!bg-transparent"><td class="!px-0 dark:text-slate-800 whitespace-nowrap px-6 py-2.5 dark:text-slate-200">
                                        <div class="space-x-2">
                                            <span class="capitalize">
                                                Topup Balance
                                            </span>
                                            /
                                            <span class="text-sm font-medium capitalize text-black">
                                                {{formatRupiah($detail->amount)}}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="dark:text-slate-800 whitespace-nowrap px-6 py-2.5 dark:text-slate-200">{{ date('d M Y H:i', $detail->expired_time) }}</td>
                                    <td class="dark:text-slate-800 whitespace-nowrap px-6 py-2.5 dark:text-slate-200">
                                       <span class="text-xs font-semibold uppercase {{ $detail->status === 'PAID' ? 'text-emerald-500' : 'text-red-500' }}">
                                            {{ $detail->status }}
                                        </span>
                                    </td>
                                    <td class="!px-0 dark:text-slate-800 text-right font-mono whitespace-nowrap px-6 py-2.5 dark:text-slate-200">
                                        {{formatRupiah($detail->amount)}}
                                    </td>
                                </tr>
                                <tr class="hover:!bg-transparent dark:text-slate-800">
                                    <td colspan="4" class="!px-0 dark:text-slate-800 whitespace-nowrap px-6 py-2.5 dark:text-slate-200">
                                        Payment
                                    </td>
                                    <td class="!px-0 text-right dark:text-slate-800 whitespace-nowrap px-6 py-2.5 dark:text-slate-200">
                                        {{$detail->payment_method}}
                                    </td>
                                </tr>
                                <tr class="hover:!bg-transparent">
                                    <td colspan="3" class="!px-0 dark:text-slate-800 whitespace-nowrap px-6 py-2.5 dark:text-slate-200">
                                        Total
                                    </td>
                                    <td class="!px-0 text-right font-mono dark:text-slate-800 whitespace-nowrap px-6 py-2.5 dark:text-slate-200">
                                        <div class="text-xl font-semibold">
                                            <sup>Rp</sup>
                                            {{formatRupiah($detail->amount)}}
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-10 rounded-lg border p-4">
                    <h5 class="text-sm font-semibold uppercase">
                        Notes
                    </h5>
                    Thanks for paying.
                </div>
                <div class="mt-4 text-right">
                    <Link class="mr-2 inline-flex items-center rounded-lg border px-5 py-2 text-sm font-medium uppercase print:hidden" href="{{route('dashboard')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <path d="M15 6l-6 6l6 6"></path>
                        </svg>
                        Back
                    </Link>
                    <Link away href="{{$detail->checkout_url}}" class="inline-flex items-center gap-x-1.5 rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white fade hover:bg-blue-600 print:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"></path>
                            <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"></path>
                        </svg> Pay
                    </Link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
