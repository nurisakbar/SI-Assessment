<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
    <div class="d-flex gap-1">
        <a href="{{ route('report.excel', ['user_id' => $user_id]) }}" class="btn btn-primary btn-sm">Export</a>
        <a href="{{ route('report.cetak', ['user_id' => $user_id]) }}" class="btn btn-primary btn-sm">Cetak</a>
    </div>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table id="basic-datatables" class="display table table-striped table-hover">
           <thead>
              <tr>
                 <th style="width: 5%">No</th>
                 <th>Pertanyaan</th>
                 <th width="200">Jawaban</th>
                 <th>Poin</th>
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
                <td class="text-center">{{ $row->jawaban ?? '-' }}</td>
            </tr>
            @endforeach            
           </tbody>
        </table>
     </div>
</div>