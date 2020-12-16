@foreach($get_table as $row)
    <tr>
        <td><?= $row->$koneksi_db ?></td>
        <td>
        <?php $get_kolom = $db_objek->select('SHOW COLUMNS FROM '.$row->$koneksi_db.' ');
            foreach($get_kolom as $row){
                echo $row->Field.', ';
            }
        ?>
        </td>
    </tr>
@endforeach