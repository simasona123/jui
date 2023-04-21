<div class="form-group d-flex flex-row align-items-center justify-content-left" style="margin-bottom: 0px;">
    <p style="margin-bottom: 0px;" @if ($verification == 1)
            class="badge badge-info" 
        @else
            class="badge badge-warning"
    @endif>{{$verification == 1 ? "Terverifikasi" : "Belum Terverifikasi"}}</p>
    <p style="margin-bottom: 0px; margin-left: 2px;" 
    @if ($blocked == 0)
        class="badge badge-success" 
    @else
        class="badge badge-danger" 
    @endif>{{$blocked == 1 ? "Terblokir" : "Aktif"}}</p>
</div>
