@extends('layouts.admin')

@section('title', 'Pembayaran')
@section('header-title', 'Pembayaran Transaksi')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow-sm p-6">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Invoice: {{ $transaction->invoice_code }}</h2>
        <p class="text-gray-500">Total Tagihan</p>
        <p class="text-4xl font-bold text-indigo-600 mt-2">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
    </div>

    <div class="border-t border-b border-gray-200 py-4 mb-6">
        <div class="flex justify-between mb-2">
            <span class="text-gray-600">Pelanggan</span>
            <span class="font-medium">{{ $transaction->customer->name }}</span>
        </div>
        <div class="flex justify-between mb-2">
            <span class="text-gray-600">Paket</span>
            <span class="font-medium">{{ $transaction->details->first()->package->name ?? '-' }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Tanggal</span>
            <span class="font-medium">{{ $transaction->created_at->format('d M Y H:i') }}</span>
        </div>
    </div>

    <div class="text-center">
        <button id="pay-button" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
            Bayar Sekarang
        </button>
        <a href="{{ route('transactions.history') }}" class="block mt-4 text-gray-500 hover:text-gray-700">Kembali</a>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $transaction->snap_token }}', {
            onSuccess: function(result){
                window.location.href = "{{ route('payment.success') }}";
            },
            onPending: function(result){
                alert("Menunggu pembayaran!");
                console.log(result);
            },
            onError: function(result){
                alert("Pembayaran gagal!");
                console.log(result);
            },
            onClose: function(){
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    };
</script>
@endsection
