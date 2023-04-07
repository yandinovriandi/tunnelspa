<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Details Transaksi') }}
            </h2>
            <Link href="{{route('dashboard')}}" class="px-2 py-1.5 bg-indigo-500 text-indigo-100 font-semibold hover:bg-indigo-700 hover:text-white rounded-md">Back</Link>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="mx-auto max-w-screen-lg">
{{--            <div class="min-h-screen bg-white p-24 shadow-lg print:p-0 print:shadow-none">--}}
{{--                <div class="p-4" id="print">--}}
{{--                    <div class="mt-6">--}}
{{--                        <div class="mb-4 grid grid-cols-2">--}}
{{--                            <span class="font-bold">Invoice Number:</span>--}}
{{--                            <span class="text-right font-semibold text-blue-500">#{{$detail->reference}}</span>--}}
{{--                            <span class="font-bold">To:</span>--}}
{{--                            <span class="text-right">MIKROTIKBOT</span>--}}
{{--                            <span class="font-bold">From:</span>--}}
{{--                            <span class="text-right">{{$detail->customer_name}}</span>--}}
{{--                            <span class="font-bold">Email:</span>--}}
{{--                            <span class="text-right">{{$detail->customer_email}}</span>--}}
{{--                        </div>--}}
{{--                        <table class="w-full text-left">--}}
{{--                            <thead>--}}
{{--                            <tr class="border-y border-black/10 text-sm md:text-base">--}}
{{--                                <th>ITEM</th>--}}
{{--                                <th class="text-center">STATUS</th>--}}
{{--                                <th class="text-center">QTY</th>--}}
{{--                                <th class="text-right">PRICE</th>--}}
{{--                                <th class="text-right">AMOUNT</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                @foreach($detail->order_items as $item)--}}
{{--                                    <td class="w-full">{{$item->name}}</td>--}}
{{--                                    <td class="min-w-[50px] text-center font-semibold {{ $detail->status === 'PAID' ? 'text-green-500' : ($detail->status === 'UNPAID' ? 'text-red-500' : 'text-yellow-500') }}">--}}
{{--                                        {{ $detail->status }}--}}
{{--                                    </td>--}}
{{--                                    <td class="min-w-[50px] text-center">{{$item->quantity}}</td>--}}
{{--                                    <td class="min-w-[80px] text-right">{{formatRupiah($item->price)}}</td>--}}
{{--                                    <td class="min-w-[90px] text-right">{{formatRupiah($item->subtotal)}}</td>--}}
{{--                                @endforeach--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                                            <x-splade-lazy>--}}
{{--                                                <x-slot:placeholder>--}}
{{--                                                    <div class="flex justify-end items-center h-12 mt-6">--}}
{{--                                                        <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>--}}
{{--                                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>--}}
{{--                                                        </svg>--}}
{{--                                                        <span class="sr-only">Loading...</span>--}}
{{--                                                    </div>--}}
{{--                                                </x-slot:placeholder>--}}
{{--                                                <div class="flex justify-end items-center my-4 gap-x-3">--}}
{{--                                                  <div class="text-1xl font-semibold">Scan to pay</div>--}}

{{--                                                @if(isset($detail) && property_exists($detail, 'qr_url') && $detail->qr_url)--}}
{{--                                                    <img class="w-32" src="{{$detail->qr_url}}" alt="{{$detail->reference}}">--}}
{{--                                                @endif--}}
{{--                                                </div>--}}
{{--                                                <x-splade-modal name="pay-invoice" :close-button="false">--}}
{{--                                                 <iframe src="{{$detail->checkout_url}}" width="100%" height="500"></iframe>--}}
{{--                                              </x-splade-modal>--}}
{{--                                            </x-splade-lazy>--}}
{{--                        <div class="mt-4 flex flex-col items-end space-y-2">--}}
{{--                            <div class="flex w-full justify-between border-t border-black/10 pt-2">--}}
{{--                                <span class="font-bold">Subtotal:</span>--}}
{{--                                <span>Rp. {{formatRupiah($detail->amount)}}</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex w-full justify-between">--}}
{{--                                <span class="font-bold">Discount:</span>--}}
{{--                                <span>Rp. 0</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex w-full justify-between">--}}
{{--                                <span class="font-bold">Tax:</span>--}}
{{--                                <span>Rp. 0</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex w-full justify-between border-t border-black/10 py-2">--}}
{{--                                <span class="font-bold">Total:</span>--}}
{{--                                <span class="font-bold">Rp. {{formatRupiah($detail->amount)}}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="mt-4 text-right">--}}
{{--                    <Link class="mr-2 inline-flex items-center rounded-lg border px-5 py-2 text-sm font-medium uppercase print:hidden" href="{{route('dashboard')}}">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"="currentColor"-width="1"-linecap="round"-linejoin="round" class="h-5 w-5">--}}
{{--                        <path d="M15 6l-6 6l6 6"></path>--}}
{{--                    </svg>--}}
{{--                    Back--}}
{{--                    </Link>--}}
{{--                    <Link away href="{{$detail->checkout_url}}" class="inline-flex items-center gap-x-1.5 rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white fade hover:bg-blue-600 print:hidden">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24"-width="2"="currentColor" fill="none"-linecap="round"-linejoin="round">--}}
{{--                        <path="none" d="M0 0h24v24H0z" fill="none"></path>--}}
{{--                        <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"></path>--}}
{{--                        <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"></path>--}}
{{--                    </svg> Pay--}}
{{--                    </Link>--}}
{{--                    <x-splade-lazy>--}}
{{--                        <x-slot:placeholder>--}}
{{--                            <div class="flex justify-center items-center h-12 mt-6">--}}
{{--                                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>--}}
{{--                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>--}}
{{--                                </svg>--}}
{{--                                <span class="sr-only">Loading...</span>--}}
{{--                            </div>--}}
{{--                        </x-slot:placeholder>--}}
{{--                      <x-splade-modal name="pay-invoice" :close-button="false">--}}
{{--                         <iframe src="{{$detail->checkout_url}}" width="100%" height="500"></iframe>--}}
{{--                      </x-splade-modal>--}}
{{--                    </x-splade-lazy>--}}
{{--                </div>--}}
{{--            </div>--}}


            <div class="rounded-lg border border bg-white p-4 shadow-lg dark:border-gray-200 dark:bg-gray-50 md:p-6 xl:p-9">

                    <div class="flex flex-col-reverse gap-5 xl:flex-row xl:justify-between">
                        <div class="flex flex-col gap-4 sm:flex-row xl:gap-9">
                            <div>
                                <p class="mb-1.5 text-lg font-medium text-black dark:text-gray-700">
                                    From
                                </p>
                                <h4 class="mb-4 text-2xl font-medium text-black dark:text-gray-700">
                                    {{$detail->customer_name}}
                                </h4>
                                <a href="#" class="block"><span class="font-medium">Email:</span>
                                    {{$detail->customer_email}}</a>
                                <span class="mt-2 block"><span class="font-medium">Phone:</span>
                                    {{$detail->customer_phone}}
                                </span>
                            </div>
                            <div>
                                <p class="mb-1.5 text-lg font-medium text-black dark:text-gray-700">
                                    To
                                </p>
                                <h4 class="mb-4 text-2xl font-medium text-black dark:text-gray-700">
                                    MikrotikBot
                                </h4>
                                <a href="#" class="block"><span class="font-medium">Email:</span>
                                    admin@mikrotikbot.com</a>
                                <span class="mt-2 block"><span class="font-medium">Address:</span>
                                    0851 5700 0387
                                </span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-medium text-black dark:text-gray-700">
                            Order <span class="text-sm text-blue-500">#{{$detail->reference}}</span>
                        </h3>
                    </div>

                    <div class="my-10 rounded-lg border border p-5 dark:border-gray-200">
                        <div class="items-center sm:flex">
{{--                            <div class="mb-3 mr-6 h-20 w-20 sm:mb-0">--}}
{{--                                <img src="" alt="product" class="h-full w-full rounded-sm object-cover object-center">--}}
{{--                            </div>--}}
                            @foreach($detail->order_items as $item)
                            <div class="w-full items-center justify-between md:flex">
                                <div class="mb-3 md:mb-0">
                                    <a href="#" class="inline-block font-medium text-black hover:text-blue dark:text-gray-700">
                                        {{$item->name}}
                                    </a>
                                    <p class="flex text-sm font-medium">
                                        <span class="mr-5"> Balance: {{formatRupiah($item->subtotal)}} </span>
                                        <span class="mr-5"> Status:
                                            <span class="min-w-[50px] text-center font-semibold {{ $detail->status === 'PAID' ? 'text-green-500' : ($detail->status === 'UNPAID' ? 'text-red-500' : 'text-yellow-500') }}">
                                                    {{$detail->status}}
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div class="flex items-center md:justify-end">
                                        <p class="mr-20 font-medium text-black dark:text-gray-700">
                                            Qty: {{$item->quantity}}
                                        </p>
                                        <p class="mr-5 font-medium text-black dark:text-gray-700">
                                            {{formatRupiah($item->subtotal)}}
                                        </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="-mx-4 flex flex-wrap">
                        <div class="w-full px-4 sm:w-1/2 xl:w-3/12">
                            <div class="mb-10">
                                <h4 class="mb-4 text-xl font-medium text-black dark:text-gray-700 md:text-2xl">
                                    Info
                                </h4>
                                <p class="font-medium text-sm">
                                    Jika pembayaran berhasil <br>
                                    Balance otomatis terisi.
                                </p>
                            </div>
                        </div>
                        <div class="w-full px-4 sm:w-1/2 xl:w-3/12">
                            <div class="mb-10">
                                <h4 class="mb-4 text-xl font-medium text-black dark:text-gray-700 md:text-2xl">
                                    Payment Method
                                </h4>
                                <x-splade-lazy>
                                    <x-slot:placeholder>
                                        <div class="flex justify-end items-center h-12 mt-6">
                                            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </x-slot:placeholder>
                                    <div>
                                        @if(isset($detail) && property_exists($detail, 'qr_url') && $detail->qr_url)
                                            {{$detail->payment_name}}
                                            <img class="w-32" src="{{$detail->qr_url}}" alt="{{$detail->reference}}">
                                        @else
                                            <p class="font-medium">
                                                {{$detail->payment_name}} <br>
                                                {{$detail->pay_code}}
                                            </p>
                                        @endif
                                    </div>
                                </x-splade-lazy>
                            </div>
                        </div>
                        <div class="w-full px-4 xl:w-6/12">
                            <div class="mr-10 text-right md:ml-auto">
                                <div class="ml-auto sm:w-1/2">
                                    <p class="mb-4 flex justify-between font-medium text-black dark:text-gray-700">
                                        <span> Subtotal </span>
                                        <span> Rp. {{formatRupiah($detail->amount)}} </span>
                                    </p>
                                    <p class="mb-4 flex justify-between font-medium text-black dark:text-gray-700">
                                        <span> Shipping Cost (+) </span>
                                        <span> Rp. {{formatRupiah($detail->total_fee)}} </span>
                                    </p>
                                    <p class="mb-4 mt-2 flex justify-between border-t border-b pt-6 font-medium text-black dark:border-gray-200 dark:text-gray-700">
                                        <span> Total Payable </span>
                                        <span> Rp. {{formatRupiah($detail->amount)}} </span>
                                    </p>
                                </div>

                                <div class="mt-10 flex flex-col justify-end gap-4 sm:flex-row">
                                    <Link href="{{route('dashboard')}}" class="flex items-center justify-center rounded bg-blue-500 py-2.5 px-8 text-center font-medium text-blue-100 hover:bg-opacity-90">
                                        Back
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
