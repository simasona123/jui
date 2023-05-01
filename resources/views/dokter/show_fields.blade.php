@php
    $media = $dokter->getMedia();
    $image_url = count($media) == 0 ? "https://bootdey.com/img/Content/avatar/avatar7.png" : $media[0]->getUrl('preview');
@endphp

<div class="row justify-content-center">
   <div class="card col-sm-6">
        <div class="row card-body align-items-start justify-content-around">
            <div class="col-sm-5 mb-4 mb-lg-0">
                <img class="dokter-profil" src="{{$image_url}}" alt="...">
            </div>
            <div class="px-xl-10">
                <div class="d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                    <h3 class="h2 mb-3">{{$dokter->user->full_name}}</h3>
                </div>
                <ul class="list-unstyled mb-1-9">
                    <li class="mb-1 mb-xl-1 display-28"><span class="display-26 text-secondary me-2 font-weight-600">NIP: </span>{{$dokter->nip}}</li>
                    <li class="mb-1 mb-xl-1 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Jenis Kelamin: </span>{{ucwords($dokter->jenis_kelamin)}}</li>
                    <li class="mb-1 mb-xl-1 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Spesialis: </span>{{$dokter->spesialis}}</li>
                    <li class="mb-1 mb-xl-1 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Email: </span>{{$dokter->user->email}}</li>
                    <li class="display-28"><span class="display-26 text-secondary me-2 font-weight-600">No. HP: </span>{{$dokter->user->phone}}</li>
                    <li class="display-28"><span class="display-26 text-secondary me-2 font-weight-600">Mulai Bergabung: </span>{{$dokter->created_at->format('Y-m-d')}}</li>
                    
                </ul>
            </div>
        </div>
   </div>
</div>

<style>
    .dokter-profil{
        object-fit: contain;
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }
</style>
