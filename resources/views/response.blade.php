<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/response.css')}}">
    <title>Document</title>
</head>
<body>
    <form action="{{route('response.update', $lamaranId)}}" method="POST" style="width:500px; margin:50px auto; display:block ">
        @csrf
        @method('PATCH')
          <div class="input-card">
              <label for="">Status :</label>
              @if ($interview)
              <select name="status">
                <option selected hidden disabled>Pilih Status</option>
                <option value="Ditolak" {{$interview['status'] == 'Ditolak' ? 'selected' : ""}}>Ditolak</option>
                <option value="Proses" {{$interview['status'] == 'Proses' ? 'selected' : ""}}>Proses</option>
                <option value="Diterima" {{$interview['status'] == 'Diterima' ? 'selected' : ""}}>Diterima</option>
              </select>
              @else
              <select name="status" id="status">
                <option selected hidden disabled ="Pilih Status"></option>
                <option value="Ditolak">Ditolak</option>
                <option value="Proses">Proses</option>
                <option value="Diterima">Diterima</option>
              </select>
            @endif
          </div>
          <div class="input-card">
            <label for="">Pesan :</label>
            <textarea name="pesan" id="pesan" rows="3" >{{$interview ? $interview['pesan'] : '' }}</textarea>
          </div>
          <div class="form-control">
            <label for="">Schedule :</label>
            <input type="date" name="schedule" value="{{$interview ? $interview['schedule'] : '-' }}">
        </div>
          <div>
              <button style="width: 100%" type="submit">Kirim</button>
        </div>
</body>
</html>