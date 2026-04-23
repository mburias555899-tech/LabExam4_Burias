<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Amount</th>
                                <th class="px-4 py-2">Payment Date</th>
                                <th class="px-4 py-2">Payment Method</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td class="border px-4 py-2">{{ $payment->name }}</td>
                                    <td class="border px-4 py-2">{{ $payment->amount }}</td>
                                    <td class="border px-4 py-2">{{ $payment->payment_date }}</td>
                                    <td class="border px-4 py-2">{{ $payment->payment_method }}</td>
                                    <td class="border px-4 py-2">{{ $payment->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>