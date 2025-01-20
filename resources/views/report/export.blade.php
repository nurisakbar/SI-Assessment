<table>
    <thead>
        <tr>
            <th style="background-color: #0D9488; color: white;">No</th>
            <th style="background-color: #0D9488; color: white;">Nama</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 1 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 2 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 3 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 4 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 5 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 6 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 7 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 8 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 9 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 10 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 11 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 12 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 13 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 14 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 15 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 16 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 17 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 18 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 19 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 20 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 21 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 22 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 23 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 24 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 25 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 26 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 27 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 28 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 29 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 30 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 31 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 32 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 33 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 34 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 35 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 36 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 37 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 38 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 39 | Jawaban</th>
            <th style="background-color: #0D9488; color: white;">Pertanyaan 40 | Jawaban</th>
        </tr>
     </thead>
     <tbody>
        @foreach($users as $row)
       <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $row->name}}</td>
          <?php
           $pertanyaan = \DB::table('pertanyaan as p')
               ->join('jawaban as j', 'j.pertanyaan_id', '=', 'p.id')
               ->where('j.user_id', $row->id)
               ->select(\DB::raw("CONCAT(p.pertanyaan, ' | ', j.jawaban) AS pertanyaan_jawaban"))
               ->get();
          ?>
          @foreach($pertanyaan as $p)
           <td>{{ $p->pertanyaan_jawaban }}</td>
          @endforeach
       </tr>
       @endforeach
    </tbody>
</table>