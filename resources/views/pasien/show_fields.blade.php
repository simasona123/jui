<!-- User Id Field -->
@php
    $media = $pasien->getMedia();
    $image_url = count($media) == 0 ? "http://bmkg.go.id/asset/img/logo/logo-bmkg.png" : $media[0]->getUrl('preview');
@endphp
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-md-12 col-xl-4">
    <div class="card">
        <div class="card-body text-center">
            <div class="mt-3 mb-4">
            <img src="{{$image_url}}"
                class="img-fluid" style="width: 100px;" />
            </div>
            <h4 class="mb-2">
                @if ($pasien->jenis_kelamin == 'betina')
                    <i class="fas fa-venus" style="margin-right: 2px;"></i>
                @else
                    <i class="fas fa-mars" style="margin-right: 2px;"></i>
                @endif
                {{ $pasien->nama_hewan }} 
            </h4>
            <p class="text-muted">{{$klien->full_name}} ({{ $klien->email }})</p>
            <div class="d-flex justify-content-around text-center">
                <div>
                    <p class="text-muted mb-0">Jenis Hewan</p>
                    <p class="mb-2 ">{{ $pasien->jenis_hewan }}</p>
                </div>
                <div class="px-3">
                    <p class="text-muted mb-0">Ras</p>
                    <p class="mb-2 ">{{ $pasien->ras }}</p>
                </div>
            </div>
            <div class="d-flex justify-content-around text-center">
                <div>
                    <p class="text-muted mb-0">Dibuat</p>
                    <p class="mb-2 ">{{ $pasien->created_at }} WIB</p>
                </div>
                <div class="px-3">
                    <p class="text-muted mb-0">Diupdate</p>
                    <p class="mb-2 ">{{ $pasien->updated_at }} WIB</p>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>