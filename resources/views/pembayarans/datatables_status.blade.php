@php
    $status = [
        'Menunggu Pembayaran', 'Telah Terverifikasi', 'Menunggu Verifikasi',
];
@endphp
<div class="form-group d-flex flex-row align-items-center justify-content-left" style="margin-bottom: 0px;">
    <p style="margin-bottom: 0px;" @if ($verifikasi == 1)
            class="badge badge-info" 
        @else
            class="badge badge-warning"
    @endif>
        {{$status[$verifikasi]}}
    </p>
</div>
