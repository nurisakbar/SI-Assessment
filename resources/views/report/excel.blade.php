<table>
    <thead>
        <tr>
           <th style="background-color: #0D9488; color: white;">No</th>
           <th style="background-color: #0D9488; color: white;">Pertanyaan</th>
           <th style="background-color: #0D9488; color: white;">Jawaban</th>
           <th style="background-color: #0D9488; color: white;">Poin</th>
        </tr>
     </thead>
     <tbody>
      @foreach($pertanyaan as $row)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $row->pertanyaan }}</td>
          <?php
              $label_jawaban = 'Tidak pernah';
      
              if (in_array($loop->iteration, range(16, 19)) || in_array($loop->iteration, range(24, 28))) {
                  if ($row->jawaban == 1) {
                      $label_jawaban = 'Sangat sering';
                  } elseif ($row->jawaban == 2) {
                      $label_jawaban = 'Sering';
                  } elseif ($row->jawaban == 3) {
                      $label_jawaban = 'Kadang-kadang';
                  } elseif ($row->jawaban == 4) {
                      $label_jawaban = 'Jarang';
                  } elseif ($row->jawaban == 5) {
                      $label_jawaban = 'Tidak pernah';
                  }
              } else {
                  if ($row->jawaban == 2) {
                      $label_jawaban = 'Jarang';
                  } elseif ($row->jawaban == 3) {
                      $label_jawaban = 'Kadang-kadang';
                  } elseif ($row->jawaban == 4) {
                      $label_jawaban = 'Sering';
                  } elseif ($row->jawaban == 5) {
                      $label_jawaban = 'Sangat sering';
                  }
              }
          ?>
          <td>{{ $label_jawaban }}</td>
          <td>{{ $row->jawaban ?? '-' }}</td>
      </tr>
      @endforeach      
     </tbody>
</table>