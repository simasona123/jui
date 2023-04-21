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

}" class="form-group col-sm-6">
    {!! Form::label('user_id', 'Email User') !!}
    <input x-model="search" @input.debounce.1000ms="getUser" class="form-control" name="" type="text" id="user_id">
    <input x-model="value" class="form-control" name="user_id" type="text" id="user_id" hidden>
    <div class="" x-show="keterangan != ''" x-text="keterangan"></div>
    <template x-for="item in dokter">
        <a @click="clickKlien(item)" href="#"><li x-text="`${item['email']} (${item['full_name']})`"></li></a>
    </template>
</div>

<!-- Spesialis Field -->
<div class="form-group col-sm-6">
    {!! Form::label('spesialis', 'Spesialis:') !!}
    {!! Form::text('spesialis', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenis Kelamin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}
    {!! Form::select('jenis_kelamin', ["pria" => "Pria", "perempuan"=>"Perempuan"], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Nip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nip', 'NIP:') !!}
    {!! Form::text('nip', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    <label for="image">Foto Dokter</label> <br>
    <input type="file" name="image">
</div> 