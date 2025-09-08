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
        @if(isset($tableImage) && $tableImage)
            <div style="text-align:center; margin-bottom:20px;">
                <img src="{{ $tableImage }}" alt="Tabla de resultados" style="max-width:700px; width:100%;">
            </div>
        @elseif(!empty($labels) && !empty($data))
            {{-- <table style="width:100%; border-collapse:collapse; margin-bottom:18px;">
                <thead>
                    <tr style="background:#e0e7ff;">
                        <th style="border:1px solid #888; padding:8px; text-align:left; background:#e0e7ff; color:#222;">Ítem</th>
                        <th style="border:1px solid #888; padding:8px; text-align:center; background:#e0e7ff; color:#222;">Puntaje</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $palette = ['#22c55e','#3b82f6','#f59e42','#ef4444','#a855f7','#eab308','#14b8a6','#6366f1','#f43f5e','#64748b'];
                    @endphp
                    @foreach($labels as $i => $label)
                        @php
                            $color = $palette[$i % count($palette)];
                            $score = isset($data[$i]) ? round(($data[$i] / 4) * 100) : '-';
                            if(is_numeric($score)) $total = isset($total) ? $total + $score : $score;
                        @endphp
                        <tr style="background:{{ $i % 2 == 0 ? '#f3f4f6' : '#fff' }};">
                            <td style="border:1px solid #888; padding:8px;">
                                <span style="display:inline-block;width:12px;height:12px;border-radius:50%;background:{{ $color }};margin-right:8px;"></span>
                                <span style="font-size:0.95em;color:#222;">{{ $label }}</span>
                            </td>
                            <td style="border:1px solid #888; padding:8px; text-align:center; font-weight:bold; color:#222;">{{ is_numeric($score) ? $score . '%' : $score }}</td>
                        </tr>
                    @endforeach
                    <tr style="background:#e0e7ff;">
                        <td style="border:1px solid #888; padding:8px; font-weight:bold; text-align:right; color:#222;">Total</td>
                        <td style="border:1px solid #888; padding:8px; text-align:center; font-weight:bold; color:#222;">{{ isset($total) && $total > 0 ? round($total / count($labels)) . '%' : '-' }}</td>
                    </tr>
                </tbody>
            </table> --}}
        @endif
        <h4 style="font-size:1.2em; font-weight:bold; margin-bottom:10px;">Informe diagnóstico</h4>
    <div style="font-size:1em; white-space:pre-line; margin-top:-16px; line-height:1.05;">
        {!! nl2br(e($diagnosis)) !!}
        </div>
        <div style="margin-top:40px; text-align:center; font-size:12px; color:#555;">
            Derechos de autor de Ingenios sas, fecha: {{ date('d/m/Y') }}
        </div>
    </div>
</body>
</html>
