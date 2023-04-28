<div class="form-group d-flex flex-row align-items-center justify-content-left" style="margin-bottom: 0px;">
    <p style="margin-bottom: 0px;" @if ($verifikasi == 1)
            class="badge badge-info" 
        @else
            class="badge badge-warning"
    @endif>{{$verifikasi == 1 ? "Terverifikasi" : "Belum Terverifikasi"}}</p>
</div>
