<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Udhamini Document</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .content {
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }
        .signature-section {
            margin-top: 50px;
            display: table;
            width: 100%;
        }
        .signature-left, .signature-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .signature-line {
            border-bottom: 1px solid #000;
            width: 200px;
            height: 50px;
            margin-top: 20px;
        }
        .photo {
            text-align: center;
            margin: 20px 0;
        }
        .photo img {
            max-width: 150px;
            max-height: 200px;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">CHETI CHA UDHAMINI</div>
        <div>GUARANTEE CERTIFICATE</div>
    </div>

    <div class="content">
        <div class="section">
            <span class="label">Tarehe (Date):</span>
            {{ $udhamini->tarehe->format('d/m/Y') }}
        </div>

        <div class="section">
            <span class="label">Jina la Mtu:</span>
            {{ $udhamini->watu->first_name }} {{ $udhamini->watu->middle_name }} {{ $udhamini->watu->last_name }}
        </div>

        <div class="section">
            <span class="label">Namba ya Simu:</span>
            {{ $udhamini->watu->phone_number }}
        </div>

        <div class="section">
            <span class="label">Jinsia:</span>
            {{ $udhamini->watu->gender }}
        </div>

        <div class="section">
            <span class="label">Mtaa:</span>
            {{ $udhamini->watu->mtaa ?? 'N/A' }}
        </div>

        <div class="section">
            <span class="label">Wilaya:</span>
            {{ $udhamini->watu->district ?? 'N/A' }}
        </div>

        <div class="section">
            <span class="label">Sababu za Udhamini:</span>
            {{ $udhamini->sababu }}
        </div>

        <div class="section">
            <span class="label">Muelekeo:</span>
            {{ $udhamini->muelekeo }}
        </div>

        @if($udhamini->picha)
        <div class="photo">
            <img src="{{ public_path('storage/' . $udhamini->picha) }}" alt="Photo">
        </div>
        @endif
    </div>

    <div class="signature-section">
        <div class="signature-left">
            <div><strong>Mwenyekiti:</strong></div>
            <div>{{ $udhamini->createdBy->first_name }} {{ $udhamini->createdBy->last_name }}</div>
            <div>Simu: {{ $udhamini->createdBy->phone }}</div>
            <div class="signature-line"></div>
            <div style="margin-top: 5px;">Sahihi ya Mwenyekiti</div>
        </div>
        
        <div class="signature-right">
            <div><strong>Muhakiki:</strong></div>
            <div class="signature-line"></div>
            <div style="margin-top: 5px;">Sahihi ya Muhakiki</div>
        </div>
    </div>

    <div style="margin-top: 30px; text-align: center; font-size: 10px;">
        <p>Hati hii imetolewa kwa madhumuni ya udhamini tu.</p>
        <p>This document is issued for guarantee purposes only.</p>
    </div>
</body>
</html>