<h1 align="center">Data Agenda</h1>
<h3 align="center">Tanggal : {{ $tanggal }}</h3>
<h3 align="center">Waktu : {{ $jam }}</h3>
<hr>
<table width="100%" border="1px" style="border-collepse;">
    <thead>
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