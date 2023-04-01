@extends('layout.layout')

@section('content')
<h2 style="text-align:center">All Data </h2>
<div class="tombol" style="text-align: center; margin-bottom:20px"> 
    <a class="btn btn-success" href="/export/excel">Cetak Excel</a>
    <a class="btn btn-warning" href="/export/pdf">Cetak PDF</a>
    <a class="btn btn-danger" href="{{route('logout')}}">Logout</a>
</div>
<div style="display:flex; justify-content:flex-end; align-items:center;">
    <form action="" method="GET">
        @csrf
        <input type="text" name="search" placeholder="Cari Berdasarkan Nama..">
        <button type="submit" class="btn-login">Search</button>
    </form>
    <a class="btn btn-primary btn-sm" href="{{route('data.admin')}}">Refresh</a>
</div>
    <table class="table table-striped table-hover">
        <tr style="text-align:center;">
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
        <tr style="text-align: center">
        <td>{{$no++}}</td>
        <td>{{$dt->name}}</td>
        <td>{{$dt->email}}</td>
        <td>{{$dt->age}}</td>
        @php 
        $telp =  substr_replace($dt->phone_number, "62", 0, 1);
         if ($dt->response) {
        $pesanWA = 'Hallo '  .   $dt->name  . '! Interview '.  $dt->response['status']. '  pesan untuk anda :' .$dt->response['pesan'];
       }
       else {
           $pesanWA = 'Belum Menambahkan Response!';
       }
       
       // substr_replace :  mengubah karakter string 
       //  punya 3 argumen, argumen ke-1: data yg mau dimasukin ke string
       //  argumen ke-2: mulai dr index mana ubahnya
       // argumen ke-3: sampai index mana diubahnya
        @endphp
        <td><a href="https://wa.me/{{$telp}}?text={{$pesanWA}}" target="_blank">{{$telp}}</a></td>
        <td>{{$dt->last_education}}</td>
        <td>{{$dt->education_name}}</td>
        <td> <a href="../assets/cvfile/{{ $dt->cv_file }}" target="_blank">Lihat CV</a></td>
        <td>
            @if ($dt->response)
            {{$dt->response['status']}}
            @else 
            - 
            @endif
        </td>
        <td>
            @if ($dt->response)
            {{$dt->response['pesan']}}
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
            <form action="/hapus/{{$dt->id}}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Delete</button>
            </form> 
        </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
@endsection