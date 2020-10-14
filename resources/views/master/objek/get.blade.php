    @foreach($model as $row)
        <tr>
            <td class="text-center">{!! $row->id !!}</td>
            <td class="text-center">{!! $row->objek !!}</td>
            <td class="text-center">{!! $row->koneksi !!}</td>
            <td class="text-center">{!! $row->objek_tipe !!}</td>
            <td class="text-center">{!! $row->nama_table !!}</td>
            <td class="text-center">{!! $row->nama_kolom !!}</td>
            <td class="text-center">
                <a href="javascript:void()" class="btn btn-info btn-sm" onclick="view(<?= $row->id; ?>)">view</a>
                <a href="javascript:void()" class="btn btn-warning btn-sm" onclick="edit(<?= $row->id; ?>)">Edit</a>
                <a href="javascript:void()" class="btn btn-danger btn-sm" onclick="destroy(<?= $row->id ?>)">delete</a>
            </td>
        </tr>
    @endforeach