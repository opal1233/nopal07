<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Transaction History Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">📜 Riwayat Transaksi</h3>
                    
                    @if($transactions->isEmpty())
                        <div class="rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 p-8 text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-gray-600 font-semibold">Belum ada transaksi</p>
                            <p class="text-sm text-gray-500 mt-2">Mulai berbelanja untuk melihat riwayat transaksi Anda di sini</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="border-b-2 border-gray-200">
                                    <tr class="text-left">
                                        <th class="pb-3 font-semibold text-gray-700">No. Transaksi</th>
                                        <th class="pb-3 font-semibold text-gray-700">Tanggal</th>
                                        <th class="pb-3 font-semibold text-gray-700">Total</th>
                                        <th class="pb-3 font-semibold text-gray-700">Status</th>
                                        <th class="pb-3 font-semibold text-gray-700">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($transactions as $transaction)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="py-4">
                                                <span class="font-semibold text-gray-900">#{{ $transaction->id }}</span>
                                            </td>
                                            <td class="py-4 text-gray-600">
                                                {{ $transaction->created_at->format('d M Y H:i') }}
                                            </td>
                                            <td class="py-4">
                                                <span class="font-bold text-[#8b4513]">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                                            </td>
                                            <td class="py-4">
                                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $transaction->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                <a href="{{ route('transactions.show', $transaction) }}" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition">
                                                    Lihat Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Summary Stats -->
                        <div class="mt-8 grid gap-4 sm:grid-cols-3">
                            <div class="rounded-lg bg-gradient-to-br from-blue-50 to-blue-100 p-4 border border-blue-200">
                                <p class="text-sm text-blue-700 font-semibold">Total Transaksi</p>
                                <p class="mt-2 text-2xl font-bold text-blue-900">{{ $transactions->count() }}</p>
                            </div>
                            <div class="rounded-lg bg-gradient-to-br from-green-50 to-green-100 p-4 border border-green-200">
                                <p class="text-sm text-green-700 font-semibold">Total Pengeluaran</p>
                                <p class="mt-2 text-2xl font-bold text-green-900">Rp {{ number_format($transactions->sum('total'), 0, ',', '.') }}</p>
                            </div>
                            <div class="rounded-lg bg-gradient-to-br from-purple-50 to-purple-100 p-4 border border-purple-200">
                                <p class="text-sm text-purple-700 font-semibold">Rata-rata Pembelian</p>
                                <p class="mt-2 text-2xl font-bold text-purple-900">Rp {{ number_format($transactions->count() > 0 ? $transactions->sum('total') / $transactions->count() : 0, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
