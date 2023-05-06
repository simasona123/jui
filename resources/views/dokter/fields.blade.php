<div x-data="
{
    @if(isset($user))
        search: '{{$user->full_name}}',
        value: {{$user->id}},
    @else
        {{"search: '',"}}
        {{"value: '',"}}
    @endif
    dokter: [],
    keterangan: '',

    async getUser(){
        let url = '/api/dokter?email=' + this.search;
        const resp = await fetch(url);
        const json = await resp.json();
        this.dokter = json['data']
        this.keterangan = this.dokter.length == 0 ? 'Dokter tidak ditemukan' : '';
    },

    clickKlien(dokter){
        this.search = dokter['email']
        this.value = dokter['id']
        this.dokter = []
    }

}" x-init="$watch('value', value => {
    if(value != '') document.querySelector('#check').style.display = 'inline'
    else document.querySelector('#check').style.display = 'none'
})" class="form-group col-sm-6">
    {!! Form::label('user_id', 'Email User') !!} <span class="required">*</span>
    <div :class="dokter.length != 0 ? 'form-control-custom' :'form-control'" class="d-flex justify-content-between align-items-center">
        <input type="text" x-model="search" @input.debounce.1000ms="getUser" class="form-google" placeholder="Cari User">
        <svg id="check" style="margin-right: 10px; display: none;" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <path fill="green" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
        </svg>
        <i class="fas fa-search"></i>
    </div>
    <input x-model="value" class="form-control" name="user_id" type="text" id="user_id" hidden>
    <div class="alert alert-warning" x-show="keterangan != ''" x-text="keterangan"></div>
    <div class="ajax-request">
        <div :class="dokter.length != 0 ? 'ajax-items col-sm-12' : 'ajax-items-initial'">
            <template x-for="item in dokter">
                <a @click="clickKlien(item)" href="#"><li x-text="`${item['email']} (${item['full_name']})`"></li></a>
            </template>
        </div>
    </div>
</div>

<!-- Spesialis Field -->
<div class="form-group col-sm-6">
    {!! Form::label('spesialis', 'Spesialis:') !!}
    {!! Form::text('spesialis', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenis Kelamin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!} <span class="required">*</span>
    {!! Form::select('jenis_kelamin', ["pria" => "Pria", "perempuan"=>"Perempuan"], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Nip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nip', 'NIP:') !!}
    {!! Form::text('nip', null, ['class' => 'form-control']) !!}
</div>
@php
    if(isset($dokter)){
        $media = $dokter->getMedia();
        $image_url = count($media) == 0 ? "http://bmkg.go.id/asset/img/logo/logo-bmkg.png" : $media[0]->getUrl('preview');
    }
@endphp
<div class="form-group col-sm-6">
    <label for="image">Foto Dokter</label> <br>
    <input type="file" name="image"> <br>
    <span class="text-muted">
        Maks. 2MB
    </span>
    @if (isset($dokter))
        <img src="{{$image_url}}" alt="">
    @endif
</div> 

