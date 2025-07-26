
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Udhamini Document</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            color: #000;
            position: relative;
        }
        
        /* Verified Signature at End - Reduced Size */
        .verified-signature {
            position: relative;
            text-align: center;
            margin: 20px 0;
            padding: 15px;
        }
        
        .verified-text {
            font-size: 24px;
            font-family: 'Brush Script MT', cursive, 'DejaVu Sans';
            font-style: italic;
            color: #2563eb;
            transform: rotate(-3deg);
            display: inline-block;
            border: 2px solid #2563eb;
            padding: 8px 16px;
            border-radius: 8px;
            background-color: rgba(37, 99, 235, 0.05);
        }
        
        .verification-details {
            margin-top: 8px;
            font-size: 9px;
            color: #666;
            text-align: center;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .subtitle {
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }
        .document-info {
            font-size: 10px;
            margin-top: 10px;
            color: #666;
        }
        .content {
            margin-bottom: 25px;
        }
        .section {
            margin-bottom: 12px;
            display: table;
            width: 100%;
        }
        .label {
            font-weight: bold;
            display: table-cell;
            width: 180px;
            vertical-align: top;
            padding-right: 10px;
        }
        .value {
            display: table-cell;
            vertical-align: top;
            border-bottom: 1px dotted #ccc;
            padding-bottom: 2px;
        }
        .photo-section {
            text-align: center;
            margin: 25px 0;
            page-break-inside: avoid;
        }
        .photo-container {
            display: inline-block;
            border: 2px solid #000;
            padding: 5px;
            background-color: #f9f9f9;
        }
        .photo-container img {
            max-width: 120px;
            max-height: 150px;
            border: 1px solid #333;
        }
        .photo-placeholder {
            width: 120px;
            height: 150px;
            border: 2px dashed #666;
            display: inline-block;
            text-align: center;
            line-height: 150px;
            background-color: #f0f0f0;
            color: #666;
            font-style: italic;
            font-size: 10px;
        }
        .acknowledgment {
            margin: 30px 0;
            padding: 15px;
            border: 1px solid #000;
            background-color: #f9f9f9;
        }
        .acknowledgment-title {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: center;
            text-transform: uppercase;
        }
        .acknowledgment-text {
            text-align: justify;
            line-height: 1.8;
            margin-bottom: 8px;
        }
        .signature-section {
            margin-top: 40px;
            width: 100%;
            page-break-inside: avoid;
        }
        .signature-row {
            display: table;
            width: 100%;
        }
        .signature-left, .signature-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 0 10px;
        }
        .signature-title {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 8px;
            text-align: center;
        }
        .signature-info {
            text-align: center;
            margin-bottom: 15px;
            font-size: 11px;
        }
        .signature-line {
            border-bottom: 2px solid #000;
            width: 180px;
            height: 60px;
            margin: 20px auto;
        }
        .signature-label {
            font-size: 10px;
            color: #666;
            text-align: center;
            margin-top: 5px;
        }
        .verification-box {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 20px;
            text-align: center;
        }
        .verification-title {
            font-weight: bold;
            margin-bottom: 8px;
        }
        .stamp-area {
            width: 100px;
            height: 80px;
            border: 2px dashed #666;
            margin: 10px auto;
            text-align: center;
            line-height: 80px;
            font-size: 9px;
            color: #666;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 9px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }
        .footer-note {
            margin: 5px 0;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Cheti cha Udhamini</div>
        <div class="subtitle">Guarantee Certificate</div>
        <div class="subtitle">Halmashauri ya Wilaya</div>
        <div class="document-info">
            Document No: UDH-{{ str_pad($udhamini->id, 5, '0', STR_PAD_LEFT) }} | 
            Imeandaliwa: {{ $udhamini->created_at->format('d/m/Y') }}
        </div>
    </div>

    <div class="content">
        <div class="section">
            <span class="label">Tarehe ya Udhamini:</span>
            <span class="value">{{ $udhamini->tarehe->format('d/m/Y') }}</span>
        </div>

        <div class="section">
            <span class="label">Jina Kamili la Mtu:</span>
            <span class="value">{{ $udhamini->watu->first_name }} {{ $udhamini->watu->middle_name }} {{ $udhamini->watu->last_name }}</span>
        </div>

        <div class="section">
            <span class="label">Namba ya Simu:</span>
            <span class="value">{{ $udhamini->watu->phone_number }}</span>
        </div>

        <div class="section">
            <span class="label">Barua Pepe (Email):</span>
            <span class="value">{{ $udhamini->watu->email ?? 'Hakuna' }}</span>
        </div>

        <div class="section">
            <span class="label">Jinsia:</span>
            <span class="value">{{ $udhamini->watu->gender }}</span>
        </div>

        <div class="section">
            <span class="label">Mtaa/Kijiji:</span>
            <span class="value">{{ $udhamini->watu->mtaa ?? 'Hakuna' }}</span>
        </div>

        <div class="section">
            <span class="label">Wilaya:</span>
            <span class="value">{{ $udhamini->watu->district ?? 'Hakuna' }}</span>
        </div>

        <div class="section">
            <span class="label">Mkoa:</span>
            <span class="value">{{ $udhamini->watu->region ?? 'Hakuna' }}</span>
        </div>

        <div class="section">
            <span class="label">Sababu za Udhamini:</span>
            <span class="value">{{ $udhamini->sababu }}</span>
        </div>

        <div class="section">
            <span class="label">Muelekeo/Madhumuni:</span>
            <span class="value">{{ $udhamini->muelekeo }}</span>
        </div>
    </div>

    <div class="photo-section">
        <strong>Picha ya Mtu Anayedhaminiwa:</strong><br>
        <div class="photo-container">
            @if(isset($udhamini->imageDataUri))
                <img src="{{ $udhamini->imageDataUri }}" alt="Person Photo">
            @else
                <div class="photo-placeholder">
                    Hakuna Picha
                </div>
            @endif
        </div>
    </div>

    <div class="acknowledgment">
        <div class="acknowledgment-title">Uthibitisho wa Mwenyekiti</div>
        <div class="acknowledgment-text">
            <strong>Mimi, {{ $udhamini->createdBy->first_name }} {{ $udhamini->createdBy->last_name }}</strong>, 
            kwa sifa yangu ya <strong>Mwenyekiti wa Kata</strong>, ninathibitisha kwamba nina ujuzi mkuu wa mtu huyu aliyetajwa hapo juu.
        </div>
        <div class="acknowledgment-text">
            Ninamjua kwa muda wa zaidi ya miaka mitatu (3), na ni mtu wa maadili mazuri na mwenye nidhamu nzuri katika jamii yetu.
        </div>
        <div class="acknowledgment-text">
            <strong>Kwa hiyo, naomba maombi yake yafanyiwe kazi</strong> na serikali husika kwa mujibu wa sheria na taratibu zilizopo.
        </div>
        <div class="acknowledgment-text">
            Pia, ninaahidi kuwa nitamhusisha katika shughuli za kiraia na za kijamii, na kuhakikisha anaendelea kuwa raia mzuri.
        </div>
    </div>

    <div class="signature-section">
        <div class="signature-row">
            <div class="signature-left">
                <div class="signature-title">Sahihi ya Mwenyekiti</div>
                <div class="signature-info">
                    {{ $udhamini->createdBy->first_name }} {{ $udhamini->createdBy->last_name }}<br>
                    Simu: {{ $udhamini->createdBy->phone }}<br>
                    Kata: {{ $udhamini->createdBy->ward ?? 'N/A' }}
                </div>
                <div class="signature-line"></div>
                <div class="signature-label">Sahihi na Tarehe</div>
                
                <div class="verification-box">
                    <div class="verification-title">MUHURI WA OFISI</div>
                    <div class="stamp-area">OFFICIAL STAMP</div>
                </div>
            </div>
            
           
        </div>
    </div>

    <!-- Compact Verified Signature at End -->
    <div class="verified-signature">
        <div class="verified-text">Verified</div>
        <div class="verification-details">
            Document electronically verified on {{ date('d/m/Y H:i') }}<br>
            System Generated - Prototype Government System v1.0
        </div>
    </div>

    <div class="footer">
        <div class="footer-note">
            <strong>MAELEKEZO MUHIMU:</strong>
        </div>
        <div class="footer-note">
            1. Hati hii imetolewa kwa madhumuni ya udhamini tu na sio dhamana ya kisheria.
        </div>
        <div class="footer-note">
            2. Mtu anayedhaminiwa anahitaji kufuata sheria zote za nchi na taratibu za serikali.
        </div>
        <div class="footer-note">
            3. Udhamini huu ni wa muda wa miaka miwili (2) kuanzia tarehe ya kutolewa kwa hati hii.
        </div>
        <div style="margin-top: 15px; font-size: 8px;">
            <strong>Imeandaliwa na:</strong> {{ $udhamini->createdBy->first_name }} {{ $udhamini->createdBy->last_name }} | 
            <strong>Tarehe:</strong> {{ $udhamini->created_at->format('d/m/Y H:i') }} | 
            <strong>Mfumo:</strong> Prototype System v1.0
        </div>
    </div>
</body>
</html>