<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Transaksi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .custom-gradient {
            background: linear-gradient(135deg, #6366F1, #3B82F6);
        }
    </style>
</head>
<body style="font-family: 'Inter', sans-serif; background-color: #F3F4F6; margin: 0; padding: 0;">
    <table style="width: 100%; max-width: 600px; margin: 0 auto; background-color: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <tr>
            <td style="background: linear-gradient(135deg, #6366F1, #3B82F6); color: white; padding: 20px; text-align: center; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <h1 style="margin: 0; font-size: 24px; font-weight: 700;">Notifikasi Transaksi</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <p style="color: #4B5563; margin-bottom: 20px; font-size: 16px;">
                    Halo Petugas,
                </p>
                <p style="color: #4B5563; margin-bottom: 20px; font-size: 16px;">
                    Ada transaksi baru dengan detail berikut:
                </p>
                
                <div style="background-color: #F3F4F6; border-radius: 8px; padding: 15px; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span style="color: #6B7280;">Nomor Transaksi</span>
                        <span style="color: #1F2937; font-weight: 600;">{{ $transaction->transaction_no }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #6B7280;">Nama Pengguna</span>
                        <span style="color: #1F2937; font-weight: 600;">{{ $transaction->user->name }}</span>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 20px;">
                    <a href="{{ route('transaction.show', $transaction->id) }}" style="display: inline-block; background-color: #3B82F6; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: 600; transition: background-color 0.3s;">
                        Lihat Detail Transaksi
                    </a>
                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color: #F3F4F6; color: #6B7280; text-align: center; padding: 15px; font-size: 12px; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                © {{ date('Y') }} SMKN 1 Batang Angkola . Hak Cipta Dilindungi.
            </td>
        </tr>
    </table>
</body>
</html>