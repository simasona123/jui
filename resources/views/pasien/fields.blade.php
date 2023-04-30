<!-- User Id Field -->
@php
    $user = Auth::user();
    $role = $user->getRoleNames()[0];

    if($role == 'klien'){
        $search = $user->email;
        $value = $user->id;
    }else{
        $search = '';
        $value = '';
    }
@endphp
<div x-data="
{
    @if(isset($pasien))
        search: '{{$klien->email}}',
        value: {{$klien->id}},
    @else
        search: '{{$search}}',
        value: '{{$value}}',
    @endif

    klien: [],

    async getUser(){
        let url = '/api/klien?email=' + this.search;
        const resp = await fetch(url);
        const json = await resp.json();
        this.klien = json['data']
        console.log(this.klien)
    },

    clickKlien(klien){
        this.search = klien['email']
        this.value = klien['id']
        this.klien = []
    }

}" class="form-group col-sm-6">
    {!! Form::label('user_id', 'Pemilik:') !!} <span class="required">*</span>
    <div :class="klien.length != 0 ? 'form-control-custom' :'form-control'" class="d-flex justify-content-between align-items-center">
        <input type="text" x-model="search" @input.debounce.1000ms="getUser" class="form-google" placeholder="Cari User" @if($role == 'klien') disabled @endif>
        <svg id="check" style="margin-right: 10px; display: none;" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <path fill="green" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
        </svg>
        <i class="fas fa-search"></i>
    </div>
    <input x-model="value" class="form-control" name="user_id" type="text" id="user_id" hidden>
    <div class="ajax-request">
        <div :class="klien.length != 0 ? 'ajax-items col-sm-12' : 'ajax-items-initial'">
            <template x-for="item in klien">
                <a @click="clickKlien(item)" href="#"><li x-text="item['full_name']"></li></a>
            </template>
        </div>
    </div>
</div>

<!-- Nama Hewan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_hewan', 'Nama Hewan:') !!} <span class="required">*</span>
    {!! Form::text('nama_hewan', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Jenis Hewan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_hewan', 'Jenis Hewan:') !!} <span class="required">*</span>
    {!! Form::text('jenis_hewan', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Jenis Kelamin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!} <span class="required">*</span>
    {!! Form::select('jenis_kelamin', ["jantan"=>'Jantan', "betina"=>'Betina'], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Ras Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ras', 'Ras:') !!} <span class="required">*</span>
    {!! Form::text('ras', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Umur Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!} <span class="required">*</span>
    {!! Form::date('tanggal_lahir', isset($pasien) ? $pasien->tanggal_lahir : null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    <label for="image">Foto Pasien</label> <br>
    <input type="file" name="image">
</div> 