<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="users-table" style="width: 100%;">
            <thead>
            <tr>
                <th class="td-min text-center">Nomor</th>
                <th class="">Name</th>
                <th class="">Email</th>
                <th class="">Role</th>
                <th class="td-min text-center">Verifikasi</th>
                <th class="td-min text-center">Status</th>
                <th class="">Action</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
            @foreach($users as $user)
                <tr>
                    <td class="text-center">{{$i}}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()[0] }}</td>
                    <td class="text-center">{{$user->verification == 1 ? "Terverifikasi" : "Belum Terverifikasi"}}</td>
                    <td class="text-center">{{$user->blocked == 0 ? "Aktif" : "Terblokir"}}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('users.show', [$user->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('users.edit', [$user->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @php
                    $i += 1
                @endphp
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $users])
        </div>
    </div>
</div>

<style>
    .absorbing-column{
        width: 100%;
    }
    .td-min{
        width: 1%;
    }
    .text-center{
        text-align: center;
    }
</style>