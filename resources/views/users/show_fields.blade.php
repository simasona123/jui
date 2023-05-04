<!-- Patient Id Field -->
<div class="form-group d-flex flex-row align-items-center">
    <p @if ($user->verification == 1)
            class="badge badge-info" 
        @else
            class="badge badge-warning"
    @endif>{{$user->verification == 1 ? "Terverifikasi" : "Belum Terverifikasi"}}</p>
    <p style="margin-left: 5px;" 
    @if ($user->blocked == 0)
        class="badge badge-success" 
    @else
        class="badge badge-danger"
    @endif>{{$user->blocked == 1 ? "Terblokir" : "Aktif"}}</p>
</div>
<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col"></th>
        <th scope="col">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>ID User</td>
        <td>{{ $user->id }}</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Nama</td>
        <td>{{$user->full_name}}</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Email</td>
        <td>{{ $user->email }}</td>
      </tr><tr>
        <th scope="row">4</th>
        <td>No Telepon</td>
        <td>
            @isset($$user->phone)
                {{$user->phone}}
            @else
                Belum ada
            @endisset
        </td>
      </tr><tr>
        <th scope="row">5</th>
        <td>Peran</td>
        <td>{{ucwords($role[0])}}</td>
      </tr><tr>
        <th scope="row">6</th>
        <td>Alamat</td>
        <td>
            @isset($user->address)
                {{$user->address}}
            @else
                Belum ada
            @endisset
        </td>
      </tr><tr>
        <th scope="row">7</th>
        <td>Dibuat pada</td>
        <td>{{ $user->created_at }}</td>
      </tr><tr>
        <th scope="row">8</th>
        <td>Diupdate pada</td>
        <td>{{ $user->updated_at}}</td>
      </tr>
    </tbody>
  </table>

<style>
    .badge{
        padding: .5em;
        margin-bottom: 0px;
    }
</style>

