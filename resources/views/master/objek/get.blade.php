    <!-- @foreach($model as $row)
        <tr>
            <td>{!! $row->id !!}</td>
            <td>{!! $row->objek !!}</td>
            <td>{!! $row->koneksi !!}</td>
            <td>{!! $row->objek_tipe !!}</td>
            <td>{!! $row->nama_table !!}</td>
            <td>{!! $row->nama_kolom !!}</td>
            <td>
                <a href="javascript:void()" class="btn btn-info btn-sm" onclick="view(<?= $row->id; ?>)">view</a>
                <a href="javascript:void()" class="btn btn-warning btn-sm" onclick="edit(<?= $row->id; ?>)">Edit</a>
                <a href="javascript:void()" class="btn btn-danger btn-sm" onclick="destroy(<?= $row->id ?>)">delete</a>
            </td>
        </tr>
    @endforeach -->