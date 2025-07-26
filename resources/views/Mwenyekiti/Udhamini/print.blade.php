<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Udhamini - {{ $udhamini->watu->first_name }} {{ $udhamini->watu->last_name }}</title>
    <style>
        @media print {
            body {
                margin: 0;
                padding: 15px;
                font-size: 12px;
            }
            .no-print {
                display: none !important;
            }
            .print-container {
                width: 100%;
                max-width: none;
            }
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .print-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #333;
            padding-bottom: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .subtitle {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }

        .document-number {
            font-size: 12px;
            color: #888;
            margin-top: 10px;
        }

        .content-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .info-row {
            display: flex;
            margin-bottom: 12px;
            align-items: flex-start;
        }

        .info-label {
            font-weight: bold;
            min-width: 180px;
            color: #555;
        }

        .info-value {
            flex: 1;
            color: #333;
            word-wrap: break-word;
        }

        .photo-section {
            text-align: center;
            margin: 30px 0;
        }

        .photo-container {
            display: inline-block;
            border: 2px solid #333;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .photo-container img {
            max-width: 200px;
            max-height: 250px;
            object-fit: cover;
        }

        .photo-placeholder {
            width: 200px;
            height: 250px;
            background-color: #f0f0f0;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-style: italic;
        }

        .signature-section {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }

        .signature-block {
            width: 45%;
            text-align: center;
        }

        .signature-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .signature-info {
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .signature-line {
            border-bottom: 2px solid #333;
            height: 60px;
            margin-bottom: 10px;
            position: relative;
        }

        .signature-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 11px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .print-buttons {
            text-align: center;
            margin-bottom: 30px;
        }

        .btn {
            background-color: #4f46e5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin: 0 10px;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background-color: #4338ca;
        }

        .btn-secondary {
            background-color: #6b7280;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        .official-stamp {
            margin-top: 20px;
            text-align: center;
            border: 2px solid #333;
            padding: 15px;
            width: 150px;
            height: 80px;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="print-buttons no-print">
        <button onclick="window.print()" class="btn">
            <i class="fas fa-print"></i> Print Document
        </button>
        <a href="{{ route('mwenyekiti.udhamini.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="print-container">
        <div class="header">
            <div class="title">Cheti cha Udhamini</div>
            <div class="subtitle">Guarantee Certificate</div>
            <div class="subtitle">Halmashauri ya Wilaya</div>
            <div class="document-number">Document No: UDH-{{ str_pad($udhamini->id, 5, '0', STR_PAD_LEFT) }}</div>
        </div>

        <div class="content-section">
            <div class="section-title">Taarifa za Mtu Anayedhaminiwa / Person Being Guaranteed</div>
            
            <div class="info-row">
                <div class="info-label">Jina Kamili / Full Name:</div>
                <div class="info-value">{{ $udhamini->watu->first_name }} {{ $udhamini->watu->middle_name }} {{ $udhamini->watu->last_name }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Namba ya Simu / Phone Number:</div>
                <div class="info-value">{{ $udhamini->watu->phone_number }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Barua Pepe / Email:</div>
                <div class="info-value">{{ $udhamini->watu->email ?? 'Hakuna / N/A' }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Jinsia / Gender:</div>
                <div class="info-value">{{ $udhamini->watu->gender }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Mtaa / Street:</div>
                <div class="info-value">{{ $udhamini->watu->mtaa ?? 'Hakuna / N/A' }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Wilaya / District:</div>
                <div class="info-value">{{ $udhamini->watu->district ?? 'Hakuna / N/A' }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Mkoa / Region:</div>
                <div class="info-value">{{ $udhamini->watu->region ?? 'Hakuna / N/A' }}</div>
            </div>
        </div>

        <div class="content-section">
            <div class="section-title">Taarifa za Udhamini / Guarantee Information</div>
            
            <div class="info-row">
                <div class="info-label">Tarehe / Date:</div>
                <div class="info-value">{{ $udhamini->tarehe->format('d/m/Y') }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Sababu za Udhamini / Reason for Guarantee:</div>
                <div class="info-value">{{ $udhamini->sababu }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Muelekeo / Direction:</div>
                <div class="info-value">{{ $udhamini->muelekeo }}</div>
            </div>
        </div>

        @if($udhamini->picha)
        <div class="photo-section">
            <div class="section-title">Picha ya Mtu Anayedhaminiwa / Photo of Person Being Guaranteed</div>
            <div class="photo-container">
                <img src="{{ asset('storage/' . $udhamini->picha) }}" alt="Person Photo">
            </div>
        </div>
        @else
        <div class="photo-section">
            <div class="section-title">Picha ya Mtu Anayedhaminiwa / Photo of Person Being Guaranteed</div>
            <div class="photo-container">
                <div class="photo-placeholder">
                    Hakuna Picha / No Photo
                </div>
            </div>
        </div>
        @endif

        <div class="content-section">
            <div class="section-title">Taarifa za Mwenyekiti / Chairperson Information</div>
            
            <div class="info-row">
                <div class="info-label">Jina la Mwenyekiti / Chairperson Name:</div>
                <div class="info-value">{{ $udhamini->createdBy->first_name }} {{ $udhamini->createdBy->middle_name }} {{ $udhamini->createdBy->last_name }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Namba ya Simu / Phone Number:</div>
                <div class="info-value">{{ $udhamini->createdBy->phone }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Kata / Ward:</div>
                <div class="info-value">{{ $udhamini->createdBy->ward ?? 'Hakuna / N/A' }}</div>
            </div>
        </div>

        <div class="signature-section">
            <div class="signature-block">
                <div class="signature-title">Sahihi ya Mwenyekiti</div>
                <div class="signature-title">Chairperson's Signature</div>
                <div class="signature-info">
                    {{ $udhamini->createdBy->first_name }} {{ $udhamini->createdBy->last_name }}<br>
                    Simu: {{ $udhamini->createdBy->phone }}
                </div>
                <div class="signature-line"></div>
                <div class="signature-label">Sahihi na Tarehe / Signature & Date</div>
            </div>
            
            <div class="signature-block">
                <div class="signature-title">Sahihi ya Muhakiki</div>
                <div class="signature-title">Verifier's Signature</div>
                <div class="signature-info">
                    <br>
                    Namba ya Simu / Phone: ________________
                </div>
                <div class="signature-line"></div>
                <div class="signature-label">Sahihi na Tarehe / Signature & Date</div>
            </div>
        </div>

        <div class="official-stamp">
            <div>
                MUHURI WA OFISI<br>
                OFFICIAL STAMP
            </div>
        </div>

        <div class="footer">
            <p><strong>MAELEKEZO MUHIMU / IMPORTANT NOTES:</strong></p>
            <p>1. Hati hii imetolewa kwa madhumuni ya udhamini tu. / This document is issued for guarantee purposes only.</p>
            <p>2. Mtu anayedhaminiwa anahitaji kufuata sheria zote za nchi. / The guaranteed person must follow all country laws.</p>
            <p>3. Udhamini huu si dhamana ya kisheria kwa mahitaji mengine. / This guarantee is not a legal warranty for other requirements.</p>
            <p style="margin-top: 20px;">
                <strong>Imeandaliwa na:</strong> {{ $udhamini->createdBy->first_name }} {{ $udhamini->createdBy->last_name }} | 
                <strong>Tarehe:</strong> {{ $udhamini->created_at->format('d/m/Y H:i') }}
            </p>
        </div>
    </div>

    <script>
        // Auto-print when page loads (optional)
        // window.onload = function() { window.print(); }
        
        // Print function
        function printDocument() {
            window.print();
        }
    </script>
</body>
</html>