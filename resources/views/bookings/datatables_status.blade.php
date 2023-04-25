<div class="form-group d-flex flex-row align-items-center justify-content-left" style="margin-bottom: 0px;">
    <p style="margin-bottom: 0px;" @if ($status['id'] == 2)
            class="badge badge-success" 
        @else
            class="badge badge-warning"
    @endif>{{$status['name']}}</p>
</div>

