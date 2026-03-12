<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Servis - {{ $service->ticket_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .ticket {
            border: 2px solid #000;
            padding: 20px;
            background: #fff;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            color: #666;
        }

        .ticket-number {
            text-align: center;
            background: #000;
            color: #fff;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .section {
            margin-bottom: 15px;
        }

        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
            text-transform: uppercase;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .info-row {
            display: flex;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .info-label {
            width: 150px;
            font-weight: bold;
            color: #333;
        }

        .info-value {
            flex: 1;
            color: #000;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }

        .badge-reguler {
            background: #3b82f6;
            color: white;
        }

        .badge-authorized {
            background: #a855f7;
            color: white;
        }

        .status {
            background: #fbbf24;
            color: #000;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px dashed #000;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-top: 60px;
            padding-top: 5px;
            font-size: 12px;
        }

        .notes {
            margin-top: 20px;
            padding: 10px;
            background: #f3f4f6;
            border-left: 4px solid #3b82f6;
            font-size: 11px;
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 24px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .print-button:hover {
            background: #2563eb;
        }

        @media print {
            body {
                padding: 0;
            }

            .print-button {
                display: none;
            }

            .ticket {
                border: 2px solid #000;
            }
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">🖨️ Cetak Tiket</button>

    <div class="ticket">
        <!-- Header -->
        <div class="header">
            <h1>CELLCOM SERVICE CENTER</h1>
            <p>Jl. Service Center No. 123, Kota, Provinsi</p>
            <p>Telp: (021) 12345678 | Email: info@cellcom.com</p>
        </div>

        <!-- Ticket Number -->
        <div class="ticket-number">
            {{ $service->ticket_number }}
        </div>

        <!-- Customer Info -->
        <div class="section">
            <div class="section-title">Informasi Pelanggan</div>
            <div class="info-row">
                <span class="info-label">Nama:</span>
                <span class="info-value">{{ $service->customer->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">No. Telepon:</span>
                <span class="info-value">{{ $service->customer->phone }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Alamat:</span>
                <span class="info-value">{{ $service->customer->address ?? '-' }}</span>
            </div>
        </div>

        <!-- Service Info -->
        <div class="section">
            <div class="section-title">Informasi Servis</div>
            <div class="info-row">
                <span class="info-label">Tanggal Masuk:</span>
                <span class="info-value">{{ $service->created_at->format('d F Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tipe Servis:</span>
                <span class="info-value">
                    <span class="badge {{ $service->service_type === 'AUTHORIZED' ? 'badge-authorized' : 'badge-reguler' }}">
                        {{ $service->service_type }}
                    </span>
                </span>
            </div>
            @if($service->service_type === 'AUTHORIZED' && $service->rma_number)
                <div class="info-row">
                    <span class="info-label">No. RMA:</span>
                    <span class="info-value">{{ $service->rma_number }}</span>
                </div>
            @endif
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value">
                    <span class="badge status">{{ $service->status }}</span>
                </span>
            </div>
        </div>

        <!-- Device Info -->
        <div class="section">
            <div class="section-title">Informasi Perangkat</div>
            <div class="info-row">
                <span class="info-label">Nama Perangkat:</span>
                <span class="info-value">{{ $service->device_name }}</span>
            </div>
            @if($service->serial_number)
                <div class="info-row">
                    <span class="info-label">Serial Number:</span>
                    <span class="info-value">{{ $service->serial_number }}</span>
                </div>
            @endif
            <div class="info-row">
                <span class="info-label">Keluhan:</span>
                <span class="info-value">{{ $service->complaint }}</span>
            </div>
        </div>

        <!-- Notes -->
        <div class="notes">
            <strong>CATATAN PENTING:</strong><br>
            • Simpan tiket ini dengan baik sebagai bukti pengambilan perangkat<br>
            • Estimasi waktu servis akan diberitahukan melalui WhatsApp<br>
            • Perangkat yang tidak diambil dalam 30 hari dianggap hangus<br>
            • Untuk pertanyaan, hubungi customer service kami
        </div>

        <!-- Footer Signatures -->
        <div class="footer">
            <div class="signature">
                <div class="signature-line">
                    Penerima
                </div>
            </div>
            <div class="signature">
                <div class="signature-line">
                    Pelanggan
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto print when page loads (optional)
        // window.onload = function() {
        //     window.print();
        // };
    </script>
</body>
</html>
