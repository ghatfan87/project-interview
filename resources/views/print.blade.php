@extends('layout.layout')

@section('content')
<h2 style="text-align:center">Data(Petugas)</h2>
    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Phone Number</th>
            <th>Last Education</th>
            <th>Education Name</th>
            <th>CV</th>
            <th>Status Responses</th>
            <th>Pesan Responses</th>
            <th>Schedule</th>
            <th>Action</th>
        </tr>
        @php 
        $no = 1;
        @endphp

        @foreach ($data as $dt)
        <tr>
        <td>{{$no++}}</td>
        <td>{{$dt['name']}}</td>
        <td>{{$dt['email']}}</td>
        <td>{{$dt['age']}}</td>
        <td>{{$dt['phone_number']}}</td>
        <td>{{$dt['last_education']}}</td>
        <td>{{$dt['education_name']}}</td>
        <td> <a href="../assets/cvfile/{{ $dt['cv_file'] }}" target="_blank">Lihat CV</a></td>
        <td>
            @if ($dt['response'])
            {{ $dt['response']['status'] }}
            @else 
            - 
            @endif
        </td>
        <td>
            @if ($dt['response'])
            {{ $dt['response']['pesan'] }}
            @else 
            - 
            @endif
        </td>
        <td>
            @if ($dt['response'])
            {{ $dt['response']['status'] == 'Diterima' ? \Carbon\Carbon::parse($dt['response']['schedule'])->format('j F Y') : '-' }}  
            @else 
            -
            @endif
        </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
@endsection