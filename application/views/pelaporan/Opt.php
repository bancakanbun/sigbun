    <div class="container sigbun-container">
      <h2>Organisme penggangu tanaman</h2>

      <table id="example" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Komoditi</th>
                <th>Organisme</th>
                <th>Nama Latin</th>
                <th>Kehilangan hasil (%)</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach ($data->result() as $row) { 
                echo '<tr>';
                echo '<td>'.$row->id_opt.'</td>';
                echo '<td>'.$row->nm_tanaman.'</td>';
                echo '<td>'.$row->nm_opt.'</td>';
                echo '<td>'.$row->nm_latinopt.'</td>';
                echo '<td>'.$row->persentase_hilang.'</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
    </div>
