<table>
    <thead>
        <tr>
            <th colspan="6" align="center">Data Agenda</th>
        </tr>
        <tr>
            <th colspan="6"  align="center">
               Tanggal : {{ $tanggal }}
            </th>
        </tr>
        <tr>
            <th colspan="6" align="center">
               Waktu : {{ $jam }}
            </th>
        </tr> 
    <tr>
        <th width="5" align="center">No</th>
        <th width="20" align="center">Name</th>
        <th width="20" align="center">Email</th>
        <th width="20" align="center">Agenda</th>
        <th width="20" align="center">Tanggal Mulai</th>
        <th width="20" align="center">Tanggal Selesai</th>
    </tr>
    </thead>
    <tbody>
       @foreach ($agenda as $item )
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->user->nama }}</td>
                <td>{{ $item->user->email }}</td>
                <td>{{ $item->agenda }}</td>
                <td align="center">{{ $item->tanggal_mulai }}</td>
                <td align="center">{{ $item->tanggal_selesai }}</td>
            </tr>
       @endforeach
    </tbody>
</table>