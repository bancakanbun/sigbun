<div class="container-fluid sigbun-container">
    <h2>Daftar Aktivitas User</h2>

    <table id="data" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Pengguna</th>
                <th>Aktivitas</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data->result() as $row) { ?>
            <tr>
                <td><?php echo $row->username; ?></td>
                <td><?php echo $row->activity; ?></td>
                <td><?php echo $row->activity_time; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

