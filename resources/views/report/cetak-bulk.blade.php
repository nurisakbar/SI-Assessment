<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            position: relative;
            margin: 0;
            padding: 0;
            background-image: url('watermak.png'); /* Path to your watermark image */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: fixed; /* Keep the background in place while scrolling */
            opacity: 0.2;
            z-index: -1;
        }
        @page {
            background: url('watermak.png') center center no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
    <h2 align="right">RAHASIA</h2>
    <table width="100%">
        <tr>
            <th colspan="3">IDENTITAS </th>
        </tr>
        <tr>
            <td width="20%">Nama</td>
            <td width="5%">:</td>
            <td>{{ strtoupper($user->name) ?? '' }}</td>
        </tr>
        <tr>
            <td width="20%">Pekerjaan</td>
            <td width="5%">:</td>
            <td>{{ $user->pekerjaan ?? '' }}</td>
        </tr>
        <tr>
            <td width="20%">Tanggal Assesment</td>
            <td width="5%">:</td>
            <td>{{ \Carbon\Carbon::parse($tanggal_submit->created_at)->translatedFormat('d M Y') ?? '' }}</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 10px">
        <tr>
            <th colspan="3">BERIKUT INI ADALAH HASIL SKORING DARI SETIAP BAGIAN TEST</th>
        </tr>
        <?php
        $REa = 0;
        $REm = 0;
        $skorpemecahanmasalah = 0;
        $skordukungansosial = 0;
        $skorpenilaianulang = 0;
        $skorpengalihan = 0;
        $skorpenerimaanperasaan = 0;
        $skorpenghindaran = 0;
        $skorperenungan = 0;
        ?>
        @foreach($skor as $row)
        <?php
        if (in_array($row->jenis, ['Pemecahan Masalah', 'Dukungan Sosial', 'Penilaian Ulang', 'Pengalihan', 'Penerimaan perasaan menyenangkan'])):
            $REa += $row->total_jawaban;
        endif;
        if (in_array($row->jenis, ['Penghindaran', 'Perenungan'])):
            $REm += $row->total_jawaban;
        endif;
        ?>
        <tr>
            <td width="35%">{{ $row->jenis }}</td>
            <td width="5%">:</td>
            <td>{{ $row->total_jawaban }}</td>
        </tr>
        <?php
        if($row->jenis == 'Pemecahan Masalah'){
            $skorpemecahanmasalah += $row->total_jawaban;
        }
        if($row->jenis == 'Dukungan Sosial'){
            $skordukungansosial += $row->total_jawaban;
        }
        if($row->jenis == 'Penilaian Ulang'){
            $skorpenilaianulang += $row->total_jawaban;
        }
        if($row->jenis == 'Pengalihan'){
            $skorpengalihan += $row->total_jawaban;
        }
        if($row->jenis == 'Penerimaan Perasaan Menyenangkan'){
            $skorpenerimaanperasaan += $row->total_jawaban;
        }
        if($row->jenis == 'Penghindaran'){
            $skorpenghindaran += $row->total_jawaban;
        }
        if($row->jenis == 'Perenungan'){
            $skorperenungan += $row->total_jawaban;
        }
        ?>
        @endforeach
    </table>

    <table width="100%" style="margin-top: 10px">
        <tr>
            <th colspan="3">HASIL ANALISA DARI SKOR YANG DIDAPATKAN ADALAH SEBAGAI BERIKUT:</th>
        </tr>
        <tr>
            <td colspan="3">Penilaian terhadap REa:</td>
        </tr>
        <tr>
            <td width="20%">Nilai REa</td>
            <td width="5%">:</td>
            <td><b>{{$REa}}</b> - {!! $REa <= 108 ? 'MEMILIKI STRATEGI REGULASI EMOSI ADAPTIF RENDAH (<b><i>ADA INDIKASI GEJALA DEPRESI</i></b>)' : 'MEMILIKI STRATEGI REGULASI EMOSI ADAPTIF YANG BAIK (<b><i>TIDAK ADA INDIKASI GEJALA DEPRESI</i></b>)' !!}</td>
        </tr>
        <tr>
            <td colspan="3">Penilaian terhadap REm:</td>
        </tr>
        <tr>
            <td width="20%">Nilai REm</td>
            <td width="5%">:</td>
            <td><b>{{$REm}}</b> - {!! $REm >= 29 ? 'MEMILIKI STRATEGI REGULASI MALADAPTIF YANG TINGGI (<b><i>ADA INDIKASI GEJALA DEPRESI</i></b>)' : 'MEMILIKI STRATEGI REGULASI EMOSI MALADAPTIF YANG RENDAH (<b><i>TIDAK ADA INDIKASI GEJALA DEPRESI</i></b>)' !!}</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 10px">
        <tr>
            <th>DESKRIPSI DAN PENJELASAN SETIAP DIMENSI</th>
        </tr>
    </table>
    <table width="100%" border="1" cellspacing="0" cellpadding="3" style="margin-top: 10px">
        <tr>
            <th>Dimensi</th>
            <th>Keterangan</th>
            <th>Rekomendasi</th>
        </tr>
        <tr>
            <td width="33%">
                <h3>Pemecahan Masalah</h3>
                <p style="margin-top: -10px">Berusaha untuk secara sadar mengubah situasi untuk menyelesaikan kesusahan.</p>
            </td>
            <td width="20%">{{ ($skorpemecahanmasalah > 27) ? 'Normal' : 'Bermasalah' }}</td>
            <td style="text-align: justify">{{ ($skorpemecahanmasalah > 27) ? 'Menunjukkan kemampuan yang baik dalam menganalisis masalah dan mengambil tindakan langsung untuk mengatasinya.' : 'Dorong remaja untuk terus mengembangkan keterampilan problem-solving melalui latihan menyelesaikan masalah nyata. Berikan tantangan yang sesuai untuk memperkuat kemampuan analisis dan pengambilan keputusan.' }}</td>
        </tr>
        <tr>
            <td width="33%">
                <h3>Dukungan Sosial</h3>
                <p style="margin-top: -10px">Menceritakan masalah yang sedang dihadapi dan emosi yang dirasakan pada orang lain untuk meminta saran.</p>
            </td>
            <td width="20%">{{ ($skordukungansosial > 20) ? 'Normal' : 'Bermasalah' }}</td>
            <td style="text-align: justify">{{ ($skordukungansosial > 20) ? 'Kemampuan baik dalam meminta bantuan atau berbagi masalah dengan orang lain.' : 'Berikan penguatan atas kebiasaan berbagi emosi dan meminta bantuan kepada orang lain. Dorong untuk menjaga hubungan sosial yang sehat dengan teman, keluarga, atau mentor.' }}</td>
        </tr>
        <tr>
            <td width="33%">
                <h3>Penilaian Ulang</h3>
                <p style="margin-top: -10px">Membingkai ulang makna situasi dengan cara yang mengubah penilaian orang tersebut atas situasi tersebut.</p>
            </td>
            <td width="20%">{{ ($skorpenilaianulang > 13) ? 'Normal' : 'Bermasalah' }}</td>
            <td style="text-align: justify">{{ ($skorpenilaianulang > 13) ? 'Kemampuan baik dalam reframing situasi yang sulit untuk meredam emosi negatif.' : 'Bantu remaja mempraktikkan reframing situasi secara aktif. Misalnya, ajarkan remaja untuk melihat sisi positif atau pembelajaran dari pengalaman sulit.' }}</td>
        </tr>
        <tr>
            <td width="33%">
                <h3>Pengalihan</h3>
                <p style="margin-top: -10px">Mengalihkan perhatian seseorang dari stimulus negatif dan menuju sesuatu yang tidak terkait dengan hal tersebut.</p>
            </td>
            <td width="20%">{{ ($skorpengalihan > 11) ? 'Normal' : 'Bermasalah' }}</td>
            <td style="text-align: justify">{{ ($skorpengalihan > 11) ? 'Efektif dalam menggunakan strategi pengalihan untuk mengelola emosi.' : 'Dorong pengalihan yang sehat melalui aktivitas positif seperti olahraga, seni, atau membaca. Pastikan distraksi digunakan sebagai strategi sementara, bukan pelarian permanen.' }}</td>
        </tr>
        <tr>
            <td width="33%">
                <h3>Penerimaan Perasaan Menyenangkan</h3>
                <p style="margin-top: -10px">Mengenali dan merangkum emosi negatif untuk menghentikan keinginan mengubah emosi negatif yang seseorang rasakan.</p>
            </td>
            <td width="20%">{{ ($skorpenerimaanperasaan > 35) ? 'Normal' : 'Bermasalah' }}</td>
            <td style="text-align: justify">{{ ($skorpenerimaanperasaan > 35) ? 'Kemampuan baik dalam menerima emosi negatif sebagai bagian dari pengalaman hidup.' : 'Dorong penerimaan emosi positif dengan mindfulness atau latihan gratitude. Ajak remaja  untuk mengenali dan merayakan momen-momen kecil yang menyenangkan.' }}</td>
        </tr>
        <tr>
            <td width="33%">
                <h3>Penghindaran</h3>
                <p style="margin-top: -10px">Meninggalkan atau menjauh dari situasi atau orang yang memunculkan emosi negatif.</p>
            </td>
            <td width="20%">{{ ($skorpenghindaran <= 13) ? 'Normal' : 'Bermasalah' }}</td>
            <td style="text-align: justify">
                {!! ($skorpenghindaran <= 13) ? 'Kemampuan untuk menghadapi situasi sulit tanpa menghindar.' : 'Dorong pendekatan langsung terhadap masalah atau emosi yang sulit. Ajarkan keterampilan problem-solving agar remaja lebih percaya diri menghadapi tantangan.<br>Latih remaja untuk mengenali situasi yang membuatnya ingin menghindar dan bagaimana meresponsnya dengan cara yang sehat.' !!}
            </td>
        </tr>
        <tr>
            <td width="33%">
                <h3>Perenungan</h3>
                <p style="margin-top: -10px">Mengulang-ulang pikiran tentang peristiwa atau emosi negatif.</p>
            </td>
            <td width="20%">{{ ($skorperenungan <= 15) ? 'Normal' : 'Bermasalah' }}</td>
            <td style="text-align: justify">
                {!! ($skorperenungan <= 15) ? 'Kemampuan untuk melepaskan pikiran negatif dan tidak terjebak dalam pola perenungan.' : 'Ajarkan cara berpikir yang fleksibel, seperti dengan latihan reframing. Misalnya, bantu remaja fokus pada solusi daripada terus memikirkan masalah.<br>Dorong aktivitas mindfulness untuk membantu remaja mengarahkan perhatian pada saat ini dan mengurangi kecenderungan overthinking.' !!}
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 10px">
        <tr>
            <th>JUDMENT AKHIR (INDIKASI MENGALAMI GEJALA DEPRESI)</th>
        </tr>
    </table>
    <table width="100%" border="1" cellspacing="0" cellpadding="3" style="margin-top: 10px">
        <tr>
            <td width="33%">
                <h3>Strategi Regulasi Emosi Adaptif (REa)</h3>
            </td>
            <td width="33%">{!! $REa <= 108 ? 'MEMILIKI STRATEGI REGULASI EMOSI ADAPTIF RENDAH (<b><i>ADA INDIKASI GEJALA DEPRESI</i></b>)' : 'MEMILIKI STRATEGI REGULASI EMOSI ADAPTIF YANG BAIK (<b><i>TIDAK ADA INDIKASI GEJALA DEPRESI</i></b>)' !!}</td>
            <td style="text-align: justify">{!! $REa <= 108 ? 'Bantu remaja mempertahankan keterampilan regulasi emosi yang sehat. Berikan tantangan yang mendorong untuk  menggunakan strategi adaptif dalam situasi baru. Perlu intervensi untuk meningkatkan keterampilan regulasi emosi adaptif.' : 'Menunjukkan kemampuan yang baik dalam menggunakan strategi adaptif untuk mengelola emosi.' !!}</td>
        </tr>
        <tr>
            <td width="33%">
                <h3>Strategi Regulasi Emosi Maladaptif  (REm)</h3>
            </td>
            <td width="33%">{!! $REm >= 29 ? 'MEMILIKI STRATEGI REGULASI MALADAPTIF YANG TINGGI (<b><i>ADA INDIKASI GEJALA DEPRESI</i></b>)' : 'MEMILIKI STRATEGI REGULASI EMOSI MALADAPTIF YANG RENDAH (<b><i>TIDAK ADA INDIKASI GEJALA DEPRESI</i></b>)' !!}</td>
            <td style="text-align: justify">
                {!! $REm >= 29 ? 'Mengindikasikan penggunaan strategi yang maladaptif, perlu perhatian untuk mengurangi dampak negatifnya. Diperlukan intervensi untuk strategi maladaptif yang dominan.' : 'Pertahankan pola regulasi emosi yang sehat.' !!}
            </td>
        </tr>
    </table>
</body>
</html>