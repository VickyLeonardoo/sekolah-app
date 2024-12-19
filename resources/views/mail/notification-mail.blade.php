<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pembayaran SPP</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    </style>
</head>
<body style="font-family: 'Inter', sans-serif; background-color: #f3f4f6; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <!-- Card Container -->
        <div style="background-color: #ffffff; border-radius: 12px; padding: 32px; margin-top: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <!-- Header with School Logo -->
            <div style="text-align: center; margin-bottom: 24px;">
                <img src="{{ asset('images/logo.png') }}" alt="School Logo" style="height: 60px; margin-bottom: 16px;">
                <div style="height: 2px; background-color: #e5e7eb; margin: 16px 0;"></div>
            </div>

            <!-- Main Content -->
            <div style="color: #1f2937;">
                <h1 style="color: #374151; font-size: 24px; font-weight: 600; margin-bottom: 16px; text-align: center;">
                    Notifikasi Pembayaran SPP
                </h1>

                <p style="margin-bottom: 16px; color: #4b5563; font-size: 16px;">
                    Yth. Orang Tua/Wali,
                </p>

                <div style="background-color: #f3f4f6; border-radius: 8px; padding: 16px; margin-bottom: 24px;">
                    <p style="margin: 0; color: #4b5563;">
                        Dengan ini kami informasikan bahwa siswa:
                    </p>
                    <p style="margin: 12px 0; font-weight: 600; color: #111827;">
                        Nama: {{ $student_name }}<br>
                        NIS: {{ $student_identity }}
                    </p>
                    <p style="margin: 0; color: #ef4444; font-weight: 500;">
                        Belum melakukan pembayaran SPP untuk periode:<br>
                        <span style="font-size: 18px; display: block; margin-top: 8px;">{{ now()->subMonth()->format('F Y') }}</span>
                    </p>
                </div>

                <div style="background-color: #fff8f1; border-left: 4px solid #f97316; padding: 16px; margin-bottom: 24px;">
                    <p style="margin: 0; color: #9a3412; font-weight: 500;">
                        Mohon segera melakukan pembayaran agar siswa dapat mengikuti ujian yang akan datang.
                    </p>
                </div>

                <!-- Payment Details -->
                <div style="background-color: #f0fdf4; border-radius: 8px; padding: 16px; margin-bottom: 24px;">
                    <h2 style="margin: 0 0 12px 0; color: #166534; font-size: 16px; font-weight: 600;">
                        Informasi Pembayaran
                    </h2>
                    <p style="margin: 0; color: #166534;">
                        Bank: BCA<br>
                        No. Rekening: 1234567890<br>
                        Atas Nama: Yayasan Sekolah
                    </p>
                </div>

                <!-- Call to Action -->
                <div style="text-align: center; margin-top: 32px;">
                    <a href="#" style="background-color: #2563eb; color: #ffffff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 500; display: inline-block;">
                        Bayar Sekarang
                    </a>
                </div>

                <!-- Footer -->
                <div style="margin-top: 32px; padding-top: 24px; border-top: 2px solid #e5e7eb; text-align: center; color: #6b7280; font-size: 14px;">
                    <p style="margin: 0;">
                        Jika Anda memiliki pertanyaan, silakan hubungi:<br>
                        WhatsApp: 081234567890<br>
                        Email: admin@sekolah.com
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>