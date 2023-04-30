@extends('layouts.app')

@section('content')
    <div class="row" style="padding-top: 20px; margin-left: 10px; margin-right: 10px;">
        <div class="col-sm-6">
            <div class="card" style="padding: 20px;">
                <div class="pemberitahuan d-flex flex-row align-items-center card-title justify-content-between" style="margin-bottom: 20px;">
                    <div class="d-flex flex-row align-items-center"><i class="fas fa-bell" style="margin-right: 10px;"></i>
                        <h5 style="margin-bottom:0px;">Temu Janji Dokter</h5>
                    </div>
                    <a href="/pemberitahuan">
                        <button id="tandai-semua" type="button" class="btn btn-primary" style="margin-right: .75rem;">Tandai Semua</button>
                    </a>
                </div>
                <table class="table table-hover">
                    <tbody>
                        @foreach ($user->notifications as $item)
                            <tr>
                                <td>
                                    {{$item->data['keterangan']}}
                                    <br>
                                    @if (!$item->read_at)
                                        <span class="badge badge-warning">Pemberitahuan</span>
                                    @else
                                        <span class="badge badge-success">Telah Diketahui</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    {{ date("Y-m-d H:i:s", strtotime($item->created_at."+7 hours"))}} WIB
                                    <br>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-sm-6">
            <div class="card" style="padding: 20px;">
                <div class="pemberitahuan d-flex flex-row align-items-center card-title justify-content-between" style="margin-bottom: 20px;">
                    <div class="d-flex flex-row align-items-center"><i class="fas fa-bell" style="margin-right: 10px;"></i>
                        <h5 style="margin-bottom:0px;">Pemberitahuan</h5>
                    </div>
                    <a href="/pemberitahuan">
                        <button id="tandai-semua" type="button" class="btn btn-primary" style="margin-right: .75rem;">Tandai Semua</button>
                    </a>
                </div>
                <table class="table table-hover">
                    <tbody>
                        @foreach ($user->notifications as $item)
                            <tr>
                                <td>
                                    {{$item->data['keterangan']}}
                                    <br>
                                    @if (!$item->read_at)
                                        <span class="badge badge-warning">Pemberitahuan</span>
                                    @else
                                        <span class="badge badge-success">Telah Diketahui</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    {{ date("Y-m-d H:i:s", strtotime($item->created_at."+7 hours"))}} WIB
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script>
       
    </script>
    
@endsection
