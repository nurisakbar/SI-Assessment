<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <th colspan="3">IDENTITAS </th>
        </tr>
        <tr>
            <td width="20%">Nama</td>
            <td width="5%">:</td>
            <td>{{ $user->name ?? '' }}</td>
        </tr>
        <tr>
            <td width="20%">Tanggal Lahir</td>
            <td width="5%">:</td>
            <td>{{ $user->tanggal_lahir ?? '' }}</td>
        </tr>
        <tr>
            <td width="20%">Pekerjaan</td>
            <td width="5%">:</td>
            <td>{{ $user->pekerjaan ?? '' }}</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 10px">
        <tr>
            <th colspan="3">BERIKUT INI ADALAH HASIL SKORING DARI SETIAP BAGIAN TEST</th>
        </tr>
        <?php
        $REa = 0;
        $REm = 0;
        ?>
        @foreach($skor as $row)
        <?php
        if (in_array($row->jenis, ['Pemecahan Masalah', 'Dukungan Sosial', 'Penilaian Ulang', 'Pengalihan', 'Penerimaan Perasaan Menyenangkan'])):
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
            <td>{{$REa}}, {{ $REm < 108 ? 'memiliki strategi regulasi emosi yang baik /tinggi' : 'memiliki strategi regulasi emosi adaptif yang rendah (tidak sehat)' }}</td>
        </tr>
        <tr>
            <td colspan="3">Penilaian terhadap REm:</td>
        </tr>
        <tr>
            <td width="20%">Nilai REm</td>
            <td width="5%">:</td>
            <td>{{$REm}}, {{$REm > 29 ? 'memiliki strategi regulasi emosi maladaptif yang rendah (sehat)' : 'memiliki strategi regulasi emosi maladaptif yang tinggi (tidak sehat)' }}</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 10px">
        <tr>
            <th>DESKRIPSI DAN PENJELASAN SETIAP DIMENSI</th>
        </tr>
    </table>
    <table width="100%" border="1" cellspacing="0" style="margin-top: 10px">
        <tr>
            <th>Dimensi</th>
            <th>Keterangan</th>
            <th>Rekomendasi</th>
        </tr>
        <tr>
            <td width="33%">Pemecahan Masalah</td>
            <td width="33%">Berusaha untuk secara sadar mengubah situasi untuk menyelesaikan kesusahan.</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias assumenda iste quo, earum id eum ex modi, dolorem necessitatibus beatae atque harum neque facilis, asperiores qui ipsa ad excepturi explicabo.</td>
        </tr>
        <tr>
            <td width="33%">Dukungan Sosial</td>
            <td width="33%">Menceritakan masalah yang sedang dihadapi dan emosi yang dirasakan pada orang lain untuk meminta saran.</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias assumenda iste quo, earum id eum ex modi, dolorem necessitatibus beatae atque harum neque facilis, asperiores qui ipsa ad excepturi explicabo.</td>
        </tr>
        <tr>
            <td width="33%">Penilaian Ulang</td>
            <td width="33%">Membingkai ulang makna situasi dengan cara yang mengubah penilaian orang tersebut atas situasi tersebut.</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias assumenda iste quo, earum id eum ex modi, dolorem necessitatibus beatae atque harum neque facilis, asperiores qui ipsa ad excepturi explicabo.</td>
        </tr>
        <tr>
            <td width="33%">Pengalihan</td>
            <td width="33%">Mengalihkan perhatian seseorang dari stimulus negatif dan menuju sesuatu yang tidak terkait dengan hal tersebut.</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias assumenda iste quo, earum id eum ex modi, dolorem necessitatibus beatae atque harum neque facilis, asperiores qui ipsa ad excepturi explicabo.</td>
        </tr>
        <tr>
            <td width="33%">Penerimaan Perasaan Menyenangkan</td>
            <td width="33%">Mengenali dan merangkum emosi negatif untuk menghentikan keinginan mengubah emosi negatif yang seseorang rasakan.</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias assumenda iste quo, earum id eum ex modi, dolorem necessitatibus beatae atque harum neque facilis, asperiores qui ipsa ad excepturi explicabo.</td>
        </tr>
        <tr>
            <td width="33%">Penghindaran</td>
            <td width="33%">Meninggalkan atau menjauh dari situasi atau orang yang memunculkan emosi negatif.</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias assumenda iste quo, earum id eum ex modi, dolorem necessitatibus beatae atque harum neque facilis, asperiores qui ipsa ad excepturi explicabo.</td>
        </tr>
        <tr>
            <td width="33%">Perenungan</td>
            <td width="33%">Mengulang-ulang pikiran tentang peristiwa atau emosi negatif.</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias assumenda iste quo, earum id eum ex modi, dolorem necessitatibus beatae atque harum neque facilis, asperiores qui ipsa ad excepturi explicabo.</td>
        </tr>
    </table>
</body>
</html>