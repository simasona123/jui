<!-- Dokter Id Field -->
<div x-data="
{
    @if(isset($user))
        search: '{{$user->email}}',
        value: {{$user->id}},
        keterangan: '{{$user->email}}',
    @else
        {{"search: '',"}}
        {{"value: '',"}}
    @endif
    dokter: [],
    keterangan: '',
    target: '',

    async getUser(){
        let url = '/api/dokter?email=' + this.search;
        const resp = await fetch(url);
        const json = await resp.json();
        this.dokter = json['data'];
        this.keterangan = this.dokter.length == 0 ? 'Dokter tidak ditemukan' : '';
        this.target = '';
        this.value = ''
    },

    clickKlien(dokter){
        this.search = dokter['email']
        this.target = dokter['email']
        this.value = dokter['id']
        this.dokter = []
    }

}" x-init="$watch('value', value => {
    if(value != '') document.querySelector('#check').style.display = 'inline'
    else document.querySelector('#check').style.display = 'none'
})" class="form-group col-sm-6">

    {!! Form::label('user_id', 'Email Dokter:') !!}
    <div :class="dokter.length != 0 ? 'form-control-custom' :'form-control'" class="d-flex justify-content-between align-items-center">
        <input type="text" x-model="search" @input.debounce.1000ms="getUser" class="form-google" placeholder="Cari Dokter">
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

<!-- Tanggal Masuk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_masuk', 'Tanggal Masuk (WIB):') !!}
    <input type="datetime-local" class="form-control" required
       name="tanggal_masuk" value="{{isset($jadwalPraktik)? $jadwalPraktik->tanggal_masuk : ''}}"
       min="{{date("Y-m-d\T00:00")}}" max="">
</div>

<!-- Tanggal Selesai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_selesai', 'Tanggal Selesai (WIB):') !!}
    <input type="datetime-local" class="form-control" required
        name="tanggal_selesai" value="{{isset($jadwalPraktik)? $jadwalPraktik->tanggal_selesai : ''}}"
        min="{{date("Y-m-d\T00:00")}}" max="">
</div>

<!-- Ketersediaan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ketersediaan', 'Ketersediaan:') !!}
    <input type="number" name="ketersediaan" class="form-control" required
       min="1" max="7" value="{{isset($jadwalPraktik) ? $jadwalPraktik->ketersediaan : ''}}">

</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>