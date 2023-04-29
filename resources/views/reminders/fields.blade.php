<div x-data="{
    inputDokter: '',
    inputKlien: '',
    valueDokter: '',
    valueKlien: '',
    dokter: [],
    klien: [],
    keteranganDokter: '',
    keteranganKlien: '',

    async getDokter(){
        let url = '/api/dokter?email=' + this.inputDokter;
        const resp = await fetch(url);
        const json = await resp.json();
        this.dokter = json['data'];
        console.log(this.dokter)
        this.keteranganDokter = this.dokter.length == 0 ? 'Dokter tidak ditemukan' : '';
        this.valueDokter = ''
    },

    async getKlien(){
        let url = '/api/pasien?name=' + this.inputKlien;
        const resp = await fetch(url);
        const json = await resp.json();
        this.klien = json['data'];
        console.log(this.klien)
        this.keteranganKlien = this.klien.length == 0 ? 'Klien tidak ditemukan' : '';
        this.valueKlien = ''
    },

    clickDokter(dokter){
        this.inputDokter = dokter['email']
        this.valueDokter = dokter['id']
        this.dokter = []
    },

    clickKlien(klien){
        this.inputKlien = klien['nama_hewan']
        this.valueKlien = klien['id']
        this.klien = []
    },

}" x-init="
        $watch('valueDokter', value => {
            if(value != '') document.querySelector('#check1').style.display = 'inline'
            else document.querySelector('#check').style.display = 'none'
        })
        $watch('valueKlien', value => {
            if(value != '') document.querySelector('#check2').style.display = 'inline'
            else document.querySelector('#check').style.display = 'none'
        })
        getDokter();
        getKlien();
    "
class="row">
        <div class="form-group col-sm-6">
            {!! Form::label('dokter_id', 'Email Dokter:') !!} <span class="required">*</span>
            <div :class="dokter.length != 0 ? 'form-control-custom' :'form-control'" class="d-flex justify-content-between align-items-center">
                <input type="text" x-model="inputDokter" @input.debounce.1000ms="getDokter" class="form-google" placeholder="Cari Dokter">
                <svg id="check1" style="margin-right: 10px; display: none;" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path fill="green" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
                </svg>
                <i class="fas fa-search"></i>
            </div>
            <input x-model="valueDokter" class="form-control" name="dokter_id" type="text" id="dokter_id" hidden>
            <div class="alert alert-warning" x-show="keteranganDokter != ''" x-text="keteranganDokter"></div>

            <div class="ajax-request">
                <div :class="dokter.length != 0 ? 'ajax-items col-sm-12' : 'ajax-items-initial'">
                    <template x-for="item in dokter">
                        <a @click="clickDokter(item)" href="#"><li x-text="`${item['email']} (${item['full_name']})`"></li></a>
                    </template>
                </div>
            </div>
        </div>

        <div class="form-group col-sm-6">
            {!! Form::label('klien_id', 'Nama Pasien:') !!} <span class="required">*</span>
            <div :class="klien.length != 0 ? 'form-control-custom' :'form-control'" class="d-flex justify-content-between align-items-center">
                <input type="text" x-model="inputKlien" @input.debounce.1000ms="getKlien" class="form-google" placeholder="Cari Pasien">
                <svg id="check2" style="margin-right: 10px; display: none;" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path fill="green" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
                </svg>
                <i class="fas fa-search"></i>
            </div>

            <input x-model="valueKlien" class="form-control" name="pasien_id" type="text" id="klien_id" hidden>

            <div class="alert alert-warning" x-show="keteranganKlien != ''" x-text="keteranganKlien"></div>

            <div class="ajax-request">
                <div :class="klien.length != 0 ? 'ajax-items col-sm-12' : 'ajax-items-initial'">
                    <template x-for="item in klien">
                        <a @click="clickKlien(item)" href="#"><li x-text="`${item['nama_hewan']} -> ${item['user']['full_name']}`"></li></a>
                    </template>
                </div>
            </div>
        </div>

</div>

<div class="row">
    <!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal', 'Tanggal:') !!}
    {!! Form::date('tanggal', null, ['class' => 'form-control','id'=>'tanggal']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6" hidden>
    {!! Form::label('status', 'Status:') !!}
    {!! Form::number('status', null, ['class' => 'form-control']) !!}
</div>
</div>
