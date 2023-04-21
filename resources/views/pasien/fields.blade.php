<!-- User Id Field -->
<div x-data="
{
    @if(isset($klien))
        search: '{{$klien->full_name}}',
        value: {{$klien->id}},
    @else
        {{"search: '',"}}
        {{"value: '',"}}
    @endif
    klien: [],

    async getUser(){
        let url = '/api/klien?full_name=' + this.search;
        const resp = await fetch(url);
        const json = await resp.json();
        this.klien = json['data']
    },

    clickKlien(klien){
        this.search = klien['full_name']
        this.value = klien['id']
        this.klien = []
    }

}" class="form-group col-sm-6">
    {!! Form::label('user_id', 'Pemilik:') !!}
    <input x-model="search" @input.debounce.1000ms="getUser" class="form-control" name="" type="text" id="user_id">
    <input x-model="value" class="form-control" name="user_id" type="text" id="user_id" hidden>
    <template x-for="item in klien">
        <a @click="clickKlien(item)" href="#"><li x-text="item['full_name']"></li></a>
    </template>
</div>

<!-- Nama Hewan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_hewan', 'Nama Hewan:') !!}
    {!! Form::text('nama_hewan', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Jenis Hewan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_hewan', 'Jenis Hewan:') !!}
    {!! Form::text('jenis_hewan', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Jenis Kelamin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}
    {!! Form::select('jenis_kelamin', ["jantan"=>'Jantan', "betina"=>'Betina'], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Ras Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ras', 'Ras:') !!}
    {!! Form::text('ras', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Umur Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    {!! Form::date('tanggal_lahir', isset($pasien) ? $pasien->tanggal_lahir : null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    <label for="image">Foto Pasien</label> <br>
    <input type="file" name="image">
</div> 