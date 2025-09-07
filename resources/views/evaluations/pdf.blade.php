<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Evaluación</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { display: flex; align-items: center; margin-bottom: 20px; }
        .logo { width: 80px; height: 80px; margin-right: 20px; }
        .company { font-size: 1.5em; font-weight: bold; }
        .user { font-size: 1.1em; margin-top: 5px; }
        .section { margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #ccc; padding: 8px; }
        .table th { background: #f3f3f3; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <div class="company">{{ $companyName }}</div>
            <div class="user">Evaluado: {{ $userName }}</div>
            <strong>Fecha:</strong> {{ $evaluation->created_at->format('d/m/Y H:i') }}<br>
        </div>
    </div>
    <div class="section">
        @if(isset($chartImage))
            <div style="text-align:center; margin-bottom:20px;">
                <img src="{{ $chartImage }}" alt="Gráfico de resultados" style="max-width:700px; width:100%;">
            </div>
        @endif
        @if(!empty($labels) && !empty($data))
            <div style="margin-bottom:12px;">
                @php
                    $palette = ['#22c55e','#3b82f6','#f59e42','#ef4444','#a855f7','#eab308','#14b8a6','#6366f1','#f43f5e','#64748b'];
                @endphp
                @foreach($labels as $i => $label)
                    @php
                        $color = $palette[$i % count($palette)];
                        $percent = isset($data[$i]) ? round(($data[$i] / 4) * 100) : 0;
                    @endphp
                    <div style="display:flex;align-items:center;margin-bottom:4px;">
                        <span style="display:inline-block;width:12px;height:12px;border-radius:50%;background:{{ $color }};margin-right:8px;"></span>
                        <span style="font-size:0.95em;color:#333;margin-right:8px;">{{ $label }}</span>
                        <span style="font-size:0.85em;color:#666;font-weight:bold;">{{ $data[$i] ?? '-' }}</span>
                    </div>
                @endforeach
            </div>
        @endif
        <h4 style="font-size:1.2em; font-weight:bold; margin-bottom:10px;">Informe diagnóstico</h4>
    <div style="font-size:1em; white-space:pre-line; margin-top:-16px; line-height:1.05;">
        {!! nl2br(e($diagnosis)) !!}
        </div>
    </div>
</body>
</html>
