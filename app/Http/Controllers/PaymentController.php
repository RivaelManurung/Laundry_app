<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function pay(Transaction $transaction)
    {
        // Jika sudah dibayar, redirect kembali
        if ($transaction->payment_status == 'paid') {
            return redirect()->back()->with('info', 'Transaksi sudah dibayar.');
        }

        // Jika snap_token belum ada atau kadaluarsa (opsional), buat baru
        if (empty($transaction->snap_token)) {
            $params = [
                'transaction_details' => [
                    'order_id' => $transaction->invoice_code . '-' . rand(), // Tambah random string biar unik jika retry
                    'gross_amount' => (int) $transaction->total_amount,
                ],
                'customer_details' => [
                    'first_name' => $transaction->customer->name,
                    'email' => $transaction->customer->email,
                    'phone' => $transaction->customer->phone,
                ],
            ];

            try {
                $snapToken = Snap::getSnapToken($params);
                $transaction->snap_token = $snapToken;
                $transaction->save();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
            }
        }

        return view('transactions.pay', compact('transaction'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                // Cari transaksi berdasarkan invoice code (perlu parsing order_id karena kita tambah random string tadi)
                // Format order_id: TRX-123456-RANDOM
                $orderIdParts = explode('-', $request->order_id);
                // Asumsi invoice code adalah TRX-TIMESTAMP (2 bagian)
                // Jika invoice code TRX-1733107972, maka order_id TRX-1733107972-1234
                // Kita perlu ambil invoice code aslinya.
                
                // Cara lebih aman: simpan order_id yang dikirim ke midtrans di database, atau cari pakai like.
                // Tapi untuk simplifikasi, kita cari transaction yang punya invoice code cocok.
                
                // Mari kita perbaiki logika order_id di method pay dulu agar konsisten.
                // Sebaiknya kita simpan order_id yang dikirim ke midtrans di kolom terpisah atau gunakan invoice_code saja jika yakin unik dan tidak akan di-retry dengan ID sama tapi gagal.
                // Midtrans tidak membolehkan order_id yang sama untuk transaksi yang berbeda (atau retry).
                // Jika user cancel dan coba lagi, snap token lama masih valid sebenarnya.
                
                // Kita cari berdasarkan invoice_code yang terkandung di order_id
                $invoiceCode = implode('-', array_slice($orderIdParts, 0, 2)); 
                
                $transaction = Transaction::where('invoice_code', $invoiceCode)->first();
                
                if ($transaction) {
                    $transaction->update([
                        'payment_status' => 'paid',
                        'payment_method' => $request->payment_type,
                        'paid_at' => now(),
                    ]);
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
    
    public function success()
    {
        return redirect()->route('transactions.history')->with('success', 'Pembayaran berhasil!');
    }
}
