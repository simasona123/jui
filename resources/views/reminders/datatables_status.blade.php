@php
    $status_array = [
        '-1' => 'Belum Terkirm',
        '1' => 'Sudah Terkirim',
];
@endphp
<div class="form-group d-flex flex-row align-items-center justify-content-left" style="margin-bottom: 0px;">
    <a href="{{ route('reminders.kirim', $id) }}">
        <p style="margin-bottom: 0px;" @if ($status == 1)
            class="badge badge-info" 
        @else
            class="badge badge-warning"
        @endif>{{$status == 1 ? "Sudah Terkirim" : "Belum Terkirim"}}</p>
    </a>
</div>