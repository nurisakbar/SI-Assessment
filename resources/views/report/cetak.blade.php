<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Analisa SRED-7F</title>
    <style>
        @page { margin: 78px 36px 52px 36px; }
        * { box-sizing: border-box; }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10.5pt;
            color: #222;
            margin: 0;
            padding: 0;
        }
        .deco-top, .deco-bottom, .logo-a, .logo-b {
            position: fixed;
        }
        .deco-top { top: -150px; right: -150px; width: 340px; }
        .deco-bottom { bottom: -250px; left: -70px; width: 760px; }
        .logo-a { top: -58px; left: 0; height: 38px; }
        .logo-b { top: -62px; left: 42px; height: 42px; }
        .rahasia {
            position: fixed;
            top: -48px;
            right: 8px;
            color: #c5c5c5;
            font-size: 15pt;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .footer {
            position: fixed;
            bottom: -34px;
            left: 0;
            right: 0;
            text-align: center;
            color: #6d6d6d;
            font-size: 8pt;
            font-family: Calibri, Arial, sans-serif;
        }
        h3 {
            text-align: center;
            font-size: 10.5pt;
            margin: 14px 0 8px;
        }
        table.ident, table.skor { width: 100%; border-collapse: collapse; }
        table.ident td, table.skor td { font-size: 10.5pt; padding: 1px 0; vertical-align: top; }
        .label { width: 250px; white-space: nowrap; }
        .colon { width: 12px; }
        .section { font-weight: bold; text-align: center; margin: 12px 0 8px; font-size: 10.5pt; }
        .italic { font-style: italic; font-weight: bold; }
        table.grid { width: 100%; border-collapse: collapse; margin-top: 6px; table-layout: fixed; }
        table.grid th, table.grid td {
            border: 1px solid #222;
            padding: 6px 8px;
            vertical-align: middle;
            font-size: 10pt;
            width: 33.33%;
        }
        table.grid th { text-align: center; font-weight: bold; }
        table.grid td.mid { text-align: center; }
        table.grid td.rec { text-align: justify; }
        .dim-title { font-weight: bold; }
        .chart {
            width: 100%;
            border: 1px solid #bfc5ce;
            border-collapse: collapse;
            margin-top: 16px;
        }
        .chart td { border: none; padding: 3px 6px; font-size: 9pt; font-family: Calibri, Arial, sans-serif; }
        .chart .title { text-align: center; color: #666; font-size: 11pt; padding: 8px 6px 4px; }
        .ylab { width: 158px; text-align: right; color: #555; padding-right: 8px; white-space: nowrap; }
        .bar-cell { width: 78%; }
        .rval { color: #555; font-size: 8.5pt; }
        .axis { text-align: center; color: #777; font-size: 8pt; padding-top: 2px; }
        .legend { text-align: center; color: #777; font-size: 8pt; padding-bottom: 8px; }
        .swatch { display: inline-block; width: 9px; height: 9px; background: #178ea0; }
        .swatch-rea { background: #5c4d8a; }
        .swatch-rem { background: #f0b27a; }
        .summary {
            border: 1px solid #222;
            padding: 8px 10px;
            margin-top: 12px;
            font-size: 10pt;
            text-align: justify;
        }
        .note { font-size: 8.5pt; margin-top: 10px; text-align: justify; }
        .break { page-break-before: always; }
    </style>
</head>
<body>
@php
    $asset = function ($file) {
        return public_path('report-assets/'.$file);
    };

    $dims = [
        'Pemecahan Masalah' => [
            'adaptive' => true, 'chart' => 'Pemecahan Masalah',
            'desc' => 'Berusaha untuk secara sadar mengubah situasi untuk menyelesaikan kesusahan.',
            'teks' => [
                'Tinggi' => 'Cenderung mampu menggunakan strategi pemecahan masalah secara relatif kuat ketika menghadapi situasi atau pengalaman emosional yang menimbulkan tekanan.',
                'Sedang' => 'Memiliki kemampuan pemecahan masalah, meskipun belum menjadi strategi yang dominan ketika menghadapi tekanan emosional.',
                'Rendah' => 'Cenderung belum optimal dalam menggunakan strategi pemecahan masalah ketika menghadapi situasi atau pengalaman emosional yang menimbulkan tekanan.',
            ],
        ],
        'Dukungan Sosial' => [
            'adaptive' => true, 'chart' => 'Dukungan Sosial',
            'desc' => 'Menceritakan masalah yang sedang dihadapi dan emosi yang dirasakan pada orang lain untuk meminta saran.',
            'teks' => [
                'Tinggi' => 'Cenderung mampu memanfaatkan dukungan dari orang lain sebagai strategi untuk membantu mengelola pengalaman emosional.',
                'Sedang' => 'Memanfaatkan dukungan orang lain pada sebagian situasi, meskipun belum secara konsisten menjadi strategi utama.',
                'Rendah' => 'Cenderung belum optimal dalam memanfaatkan dukungan dari orang lain sebagai strategi untuk membantu mengelola pengalaman emosional.',
            ],
        ],
        'Penilaian Ulang' => [
            'adaptive' => true, 'chart' => 'Penilaian Ulang',
            'desc' => 'Membingkai ulang makna situasi dengan cara yang mengubah penilaian orang tersebut atas situasi tersebut.',
            'teks' => [
                'Tinggi' => 'Cenderung mampu melihat kembali dan memaknai situasi emosional dari perspektif yang berbeda sebagai strategi pengelolaan emosi.',
                'Sedang' => 'Mampu memaknai ulang situasi emosional pada sebagian pengalaman, meskipun belum menjadi kecenderungan yang dominan.',
                'Rendah' => 'Cenderung belum optimal dalam melihat kembali dan memaknai situasi emosional dari perspektif yang berbeda.',
            ],
        ],
        'Pengalihan' => [
            'adaptive' => true, 'chart' => 'Pengalihan',
            'desc' => 'Mengalihkan perhatian seseorang dari stimulus negatif dan menuju sesuatu yang tidak terkait dengan hal tersebut.',
            'teks' => [
                'Tinggi' => 'Cenderung sering menggunakan pengalihan perhatian atau aktivitas lain sebagai strategi dalam menghadapi dan mengelola pengalaman emosional.',
                'Sedang' => 'Menggunakan pengalihan perhatian pada sebagian situasi, meskipun belum menjadi strategi yang dominan.',
                'Rendah' => 'Cenderung jarang menggunakan pengalihan perhatian sebagai strategi dalam menghadapi pengalaman emosional.',
            ],
        ],
        'Penerimaan perasaan menyenangkan' => [
            'adaptive' => true, 'chart' => 'Perasaan Menyenangkan',
            'title' => 'Penerimaan Perasaan Menyenangkan',
            'desc' => 'Mengenali dan merangkum emosi negatif untuk menghentikan keinginan mengubah emosi negatif yang seseorang rasakan.',
            'teks' => [
                'Tinggi' => 'Cenderung mampu mengenali dan menerima pengalaman perasaan menyenangkan sebagai bagian dari pengelolaan emosi.',
                'Sedang' => 'Memiliki kemampuan untuk mengenali dan menerima pengalaman perasaan menyenangkan, meskipun belum menjadi kecenderungan yang dominan.',
                'Rendah' => 'Cenderung belum optimal dalam mengenali dan menerima pengalaman perasaan menyenangkan.',
            ],
        ],
        'Penghindaran' => [
            'adaptive' => false, 'chart' => 'Penghindaran',
            'desc' => 'Meninggalkan atau menjauh dari situasi atau orang yang memunculkan emosi negatif.',
            'teks' => [
                'Tinggi' => 'Cenderung lebih sering meninggalkan atau menjauh dari situasi yang memunculkan emosi negatif. Kondisi ini perlu diperhatikan sebagai area yang perlu dikembangkan.',
                'Sedang' => 'Menggunakan penghindaran sebagai salah satu strategi dalam menghadapi pengalaman emosional yang tidak menyenangkan, meskipun belum menjadi strategi yang dominan.',
                'Rendah' => 'Cenderung tidak menjadikan penghindaran sebagai strategi utama dalam menghadapi pengalaman emosional yang tidak menyenangkan.',
            ],
        ],
        'Perenungan' => [
            'adaptive' => false, 'chart' => 'Perenungan',
            'desc' => 'Mengulang-ulang pikiran tentang peristiwa atau emosi negatif.',
            'teks' => [
                'Tinggi' => 'Cenderung lebih sering melakukan pemikiran berulang mengenai pengalaman atau masalah emosional yang dialaminya. Kondisi ini perlu diperhatikan sebagai area yang perlu dikembangkan.',
                'Sedang' => 'Melakukan pemikiran berulang pada sebagian pengalaman emosional, meskipun belum menjadi pola yang dominan.',
                'Rendah' => 'Cenderung tidak terjebak dalam pemikiran berulang mengenai pengalaman atau masalah emosional.',
            ],
        ],
    ];

    $scoreOf = [];
    foreach ($skor as $row) {
        $scoreOf[$row->jenis] = (int) $row->total_jawaban;
    }

    $fmt = function ($n) {
        return number_format($n, 2, ',', '');
    };
    $join = function ($items) {
        $items = array_values(array_filter($items));
        if (count($items) === 0) return '-';
        if (count($items) === 1) return $items[0];
        $last = array_pop($items);
        return implode(', ', $items).', dan '.$last;
    };

    $rows = [];
    $rea = 0;
    $rem = 0;
    foreach ($dims as $jenis => $meta) {
        $score = $scoreOf[$jenis] ?? 0;
        $level = \App\SredScore::category($jenis, $score);
        if ($meta['adaptive']) {
            $rea += $score;
        } else {
            $rem += $score;
        }
        $rows[] = $meta + [
            'jenis' => $jenis,
            'score' => $score,
            'ratio' => \App\SredScore::ratio($jenis, $score),
            'level' => $level,
            'title' => $meta['title'] ?? $jenis,
        ];
    }
    $reaLevel = \App\SredScore::category('REa', $rea);
    $remLevel = \App\SredScore::category('REm', $rem);
    $reaRatio = \App\SredScore::ratio('REa', $rea);
    $remRatio = \App\SredScore::ratio('REm', $rem);
    $name = strtoupper($user->name ?? '');
    $tanggal = !empty($tanggal_submit)
        ? \Carbon\Carbon::parse($tanggal_submit->created_at)->locale('id')->translatedFormat('d F Y')
        : '-';

    $kekuatan = [];
    $perhatian = [];
    $pengembangan = [];
    foreach ($rows as $row) {
        $label = $row['title'];
        if ($row['adaptive'] && $row['level'] === 'Tinggi') $kekuatan[] = $label;
        if ((!$row['adaptive'] && $row['level'] === 'Tinggi') || ($row['adaptive'] && $row['level'] === 'Rendah')) $perhatian[] = $label;
        if ($row['level'] === 'Sedang') $pengembangan[] = $label;
    }

    $profiles = [
        'Rendah|Rendah' => 'penggunaan strategi maladaptif relatif rendah, namun strategi adaptif juga belum optimal. Penguatan keterampilan regulasi emosi adaptif tetap diperlukan.',
        'Rendah|Sedang' => 'strategi adaptif belum optimal dan strategi maladaptif masih digunakan pada tingkat tertentu. Penguatan strategi adaptif serta alternatif yang lebih sehat terhadap strategi maladaptif perlu diperhatikan.',
        'Rendah|Tinggi' => 'strategi adaptif berada pada kategori rendah dan strategi maladaptif pada kategori tinggi. Perlu perhatian lebih untuk mengurangi ketergantungan pada strategi maladaptif dan meningkatkan strategi adaptif.',
        'Sedang|Rendah' => 'telah memiliki sejumlah strategi adaptif, sementara penggunaan strategi maladaptif relatif rendah. Kondisi ini dapat dikembangkan lebih lanjut melalui penguatan strategi adaptif yang telah dimiliki.',
        'Sedang|Sedang' => 'strategi adaptif dan maladaptif sama-sama berada pada kategori sedang. Individu memiliki sejumlah strategi adaptif, namun masih menggunakan strategi maladaptif dalam menghadapi pengalaman emosional.',
        'Sedang|Tinggi' => 'memiliki sejumlah sumber daya regulasi emosi adaptif, namun penggunaan strategi maladaptif masih relatif menonjol. Penguatan strategi adaptif dan pengembangan cara yang lebih efektif menjadi area yang perlu diperhatikan.',
        'Tinggi|Rendah' => 'menunjukkan kapasitas regulasi emosi yang relatif baik, dengan strategi adaptif yang kuat dan penggunaan strategi maladaptif yang relatif rendah.',
        'Tinggi|Sedang' => 'memiliki sumber daya regulasi emosi adaptif yang relatif kuat, namun masih terdapat penggunaan strategi maladaptif pada tingkat tertentu.',
        'Tinggi|Tinggi' => 'memiliki kapasitas strategi adaptif yang kuat, sekaligus kecenderungan penggunaan strategi maladaptif yang relatif tinggi. Interpretasi perlu difokuskan pada dimensi yang paling menonjol.',
    ];
    $ringkas = $name.' '.$profiles[$reaLevel.'|'.$remLevel];

    $reaNotes = [
        'Rendah' => 'Cenderung belum optimal dalam menggunakan strategi regulasi emosi yang bersifat adaptif, seperti pemecahan masalah, dukungan sosial, penilaian ulang, pengalihan, dan penerimaan terhadap perasaan menyenangkan. Kondisi ini menunjukkan perlunya penguatan keterampilan regulasi emosi adaptif.',
        'Sedang' => 'Telah memiliki dan menggunakan sejumlah strategi regulasi emosi adaptif, meskipun penerapannya belum secara konsisten menjadi strategi yang dominan. Penguatan terhadap strategi adaptif yang telah dimiliki dapat membantu mengelola pengalaman emosional secara lebih efektif.',
        'Tinggi' => 'Cenderung memiliki kapasitas yang relatif kuat dalam menggunakan berbagai strategi regulasi emosi adaptif untuk menghadapi dan mengelola pengalaman emosional.',
    ];
    $remNotes = [
        'Rendah' => 'Cenderung jarang menggunakan strategi regulasi emosi maladaptif, seperti penghindaran dan perenungan, dalam menghadapi pengalaman emosional.',
        'Sedang' => 'Masih menggunakan strategi regulasi emosi maladaptif pada tingkat tertentu. Perlu dilihat dimensi penyusunnya untuk mengetahui strategi maladaptif yang paling menonjol.',
        'Tinggi' => 'Cenderung lebih sering menggunakan strategi regulasi emosi maladaptif dalam menghadapi pengalaman emosional. Perlu perhatian dan penguatan keterampilan regulasi emosi yang lebih adaptif, khususnya pada strategi maladaptif yang paling menonjol.',
    ];
    $reaLabel = 'MEMILIKI STRATEGI REGULASI EMOSI ADAPTIF YANG '.strtoupper($reaLevel);
    $remLabel = 'MEMILIKI STRATEGI REGULASI EMOSI MALADAPTIF YANG '.strtoupper($remLevel);
    $reaNote = $reaNotes[$reaLevel];
    $remNote = $remNotes[$remLevel];
@endphp

<img class="deco-top" src="{{ $asset('deco-corner.png') }}">
<img class="deco-bottom" src="{{ $asset('deco-band.png') }}">
<img class="logo-a" src="{{ $asset('logo-project.png') }}">
<img class="logo-b" src="{{ $asset('logo-mindfit.png') }}">
<div class="rahasia">RAHASIA</div>
<div class="footer">ya@gapapa.id &nbsp;&nbsp; @gapapa.project &nbsp;&nbsp; gapapa.id &nbsp;&nbsp; Jl. Nuri No.5, Demangan Baru, Kec. Depok, Kabupaten Sleman, DIY (55281)</div>

<h3>IDENTITAS</h3>
<table class="ident">
    <tr><td class="label">Nama</td><td class="colon">:</td><td>{{ $name }}</td></tr>
    <tr><td class="label">Pekerjaan</td><td class="colon">:</td><td>{{ $user->pekerjaan ?? '' }}</td></tr>
    <tr><td class="label">Tanggal Assesment</td><td class="colon">:</td><td>{{ $tanggal }}</td></tr>
    <tr><td class="label">Pemeriksa</td><td class="colon">:</td><td>Siti Bahiyah, S.Psi., M.Psi., Psikolog</td></tr>
</table>

<div class="section">BERIKUT INI ADALAH HASIL SKORING DARI SETIAP BAGIAN TEST</div>
<table class="skor">
    @foreach($rows as $row)
    <tr>
        <td class="label">{{ $row['jenis'] === 'Penerimaan perasaan menyenangkan' ? 'Penerimaan perasaan menyenangkan' : $row['jenis'] }}</td>
        <td class="colon">:</td>
        <td>{{ $row['score'] }}</td>
    </tr>
    @endforeach
</table>

<div class="section">HASIL ANALISA DARI SKOR YANG DIDAPATKAN ADALAH SEBAGAI BERIKUT:</div>
<div>Penilaian terhadap Rea :</div>
<table class="skor">
    <tr>
        <td class="label">Nilai REa</td>
        <td class="colon">:</td>
        <td><b>{{ $rea }}</b> - {{ $reaLabel }}</td>
    </tr>
</table>
<div style="margin-top:8px">Penilaian terhadap REm:</div>
<table class="skor">
    <tr>
        <td class="label">Nilai REm</td>
        <td class="colon">:</td>
        <td><b>{{ $rem }}</b> - {{ $remLabel }}</td>
    </tr>
</table>

<table class="chart">
    <tr><td colspan="3" class="title">PROFIL STRATEGI REGULASI EMOSI SRED-7F</td></tr>
    @foreach($rows as $row)
    <tr>
        <td class="ylab">{{ $row['chart'] }}</td>
        <td class="bar-cell">
            <table width="100%" cellspacing="0" cellpadding="0"><tr>
                <td width="{{ max(1, min(100, ($row['ratio'] / 2) * 100)) }}%" bgcolor="#178ea0" style="height:11px; font-size:1px;">&nbsp;</td>
                <td></td>
            </tr></table>
        </td>
        <td class="rval" width="42">{{ $fmt($row['ratio']) }}</td>
    </tr>
    @endforeach
    <tr>
        <td></td>
        <td class="axis" colspan="2">
            <table width="100%" cellspacing="0" cellpadding="0"><tr>
                <td width="20%" align="left">0,00</td>
                <td width="20%" align="center">0,50</td>
                <td width="20%" align="center">1,00</td>
                <td width="20%" align="center">1,50</td>
                <td width="20%" align="right">2,00</td>
            </tr></table>
        </td>
    </tr>
    <tr>
        <td></td>
        <td class="legend" colspan="2"><span class="swatch"></span> &nbsp; Rasio</td>
    </tr>
</table>

<div class="break"></div>

<table class="chart">
    <tr><td colspan="3" class="title">PROFIL STRATEGI REGULASI EMOSI SRED-7F</td></tr>
    <tr>
        <td class="ylab">REa</td>
        <td class="bar-cell">
            <table width="100%" cellspacing="0" cellpadding="0"><tr>
                <td width="{{ max(1, min(100, ($reaRatio / 2) * 100)) }}%" bgcolor="#5c4d8a" style="height:12px;">&nbsp;</td>
                <td></td>
            </tr></table>
        </td>
        <td class="rval">{{ $fmt($reaRatio) }}</td>
    </tr>
    <tr>
        <td class="ylab">REm</td>
        <td class="bar-cell">
            <table width="100%" cellspacing="0" cellpadding="0"><tr>
                <td width="{{ max(1, min(100, ($remRatio / 2) * 100)) }}%" bgcolor="#f0b27a" style="height:12px;">&nbsp;</td>
                <td></td>
            </tr></table>
        </td>
        <td class="rval">{{ $fmt($remRatio) }}</td>
    </tr>
    <tr>
        <td></td>
        <td class="axis" colspan="2">
            <table width="100%" cellspacing="0" cellpadding="0"><tr>
                <td width="20%" align="left">0,00</td>
                <td width="20%" align="center">0,50</td>
                <td width="20%" align="center">1,00</td>
                <td width="20%" align="center">1,50</td>
                <td width="20%" align="right">2,00</td>
            </tr></table>
        </td>
    </tr>
    <tr>
        <td></td>
        <td class="legend" colspan="2">
            <span class="swatch swatch-rem"></span> REm &nbsp;&nbsp; <span class="swatch swatch-rea"></span> REa
        </td>
    </tr>
</table>

<div class="section">DESKRIPSI DAN PENJELASAN SETIAP DIMENSI</div>
<table class="grid">
    <tr>
        <th>Dimensi</th>
        <th>Keterangan</th>
        <th>Rekomendasi</th>
    </tr>
    @foreach(array_slice($rows, 0, 5) as $row)
    <tr>
        <td class="dim"><div class="dim-title">{{ $row['title'] }}</div>{{ $row['desc'] }}</td>
        <td class="mid">{{ $row['level'] }}</td>
        <td class="rec">{{ $row['teks'][$row['level']] }}</td>
    </tr>
    @endforeach
</table>

<div class="break"></div>

<table class="grid">
    @foreach(array_slice($rows, 5) as $row)
    <tr>
        <td class="dim"><div class="dim-title">{{ $row['title'] }}</div>{{ $row['desc'] }}</td>
        <td class="mid">{{ $row['level'] }}</td>
        <td class="rec">{{ $row['teks'][$row['level']] }}</td>
    </tr>
    @endforeach
</table>

<div class="section">JUDGMENT AKHIR (INDIKASI MENGALAMI GEJALA DEPRESI)</div>
<table class="grid">
    <tr>
        <td class="dim"><b>Strategi Regulasi Emosi Adaptif (REa)</b></td>
        <td class="mid"><b>{{ $reaLabel }}</b></td>
        <td class="rec">{{ $reaNote }}</td>
    </tr>
    <tr>
        <td class="dim"><b>Strategi Regulasi Emosi Maladaptif (REm)</b></td>
        <td class="mid"><b>{{ $remLabel }}</b></td>
        <td class="rec">{{ $remNote }}</td>
    </tr>
</table>

<div class="summary">
    {{ $ringkas }}<br><br>
    <b>Kekuatan utama</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $join($kekuatan) }}<br>
    <b>Area perhatian utama</b> : {{ $join($perhatian) }}<br>
    <b>Area pengembangan</b> &nbsp;: {{ $join($pengembangan) }}
</div>
<p class="note">*Hasil SRED-7F merupakan gambaran strategi regulasi emosi berdasarkan respons individu pada saat pemeriksaan. Hasil tidak digunakan sebagai dasar diagnosis secara tunggal dan perlu diintegrasikan dengan wawancara, observasi, riwayat, serta data asesmen psikologis lain yang relevan.</p>
</body>
</html>
