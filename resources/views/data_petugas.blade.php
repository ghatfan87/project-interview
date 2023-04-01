@extends('layout.layout')

@section('content')
    <h2 style="text-align:center">Laporan Keluhan(Petugas)</h2>
    <div class="tombol" style="text-align: center; margin-bottom:20px">
        <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
        <a class="btn btn-warning" href="/">Home</a>
    </div>
    <div style="display:flex; justify-content:flex-end; align-items:center;">
        <form action="" method="GET">
            @csrf
            <select name="search" id="search">
                <option selected hidden disabled>Sort By Type</option>
                <option value="Diterima">Diterima</option>
                <option value="Ditolak">Ditolak</option>
            </select>
            <button type="submit" class="btn btn-danger btn-sm">Search</button>
        </form>
        <a class="btn btn-primary btn-sm" href="{{ route('data_petugas') }}">Refresh</a>
    </div>
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
            $search = '';
            if (@$_GET['search']) {
                $search = $_GET['search'];
            }
            
        @endphp
        @foreach ($data as $dt)
            @if ($search !== '')
                @if ($dt->response)
                    @if ($dt->response['status'] == $search)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $dt->name }}</td>
                            <td>{{ $dt->email }}</td>
                            <td>{{ $dt->age }}</td>
                            <td>{{ $dt->phone_number }}</td>
                            <td>{{ $dt->last_education }}</td>
                            <td>{{ $dt->education_name }}</td>
                            <td> <a href="../assets/cvfile/{{ $dt->cv_file }}" target="_blank">Lihat CV</a></td>
                            <td>
                                @if ($dt->response)
                                    {{ $dt->response['status'] }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($dt->response)
                                    {{ $dt->response['pesan'] }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($dt->response)
                                {{ $dt->response['status'] == 'Diterima' ? \Carbon\Carbon::parse($dt->response['schedule'])->format('j F Y') : '-' }}  
                                @else 
                                -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('response_edit', $dt->id) }}" class="btn btn-success">Change Response</a>
                            </td>
                        </tr>
                    @endif
                @endif
            @else
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $dt->name }}</td>
                    <td>{{ $dt->email }}</td>
                    <td>{{ $dt->age }}</td>
                    <td>{{ $dt->phone_number }}</td>
                    <td>{{ $dt->last_education }}</td>
                    <td>{{ $dt->education_name }}</td>
                    <td> <a href="../assets/cvfile/{{ $dt->cv_file }}" target="_blank">Lihat CV</a></td>
                    <td>
                        @if ($dt->response)
                            {{ $dt->response['status'] }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($dt->response)
                            {{ $dt->response['pesan'] }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($dt->response)
                        {{ $dt->response['status'] == 'Diterima' ? \Carbon\Carbon::parse($dt->response['schedule'])->format('j F Y') : '-' }}  
                        @else 
                        -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('response_edit', $dt->id) }}" class="btn btn-success">Change Response</a>
                    </td>
                </tr>
            @endif
        @endforeach

    </table>
    </body>

    </html>
@endsection
