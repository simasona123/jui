<div class="row"
    x-data="{
        @if(isset($rekamMedis))
            kode_booking:'{{$rekamMedis->booking->kode_booking}}',
            booking_id: {{$rekamMedis->booking_id}},
            search:'{{$rekamMedis->dokter->user->email}}',
            value:{{$rekamMedis->dokter->user->id}},
        @else
            kode_booking:'',
            booking_id: 0,
            search:'',
            value:'',
        @endif
        dataBooking: [],
        keteranganBooking: '',
        async getBooking(){
            let url = '/api/booking?kode=' + this.kode_booking;
            const resp = await fetch(url);
            const json = await resp.json();
            this.dataBooking = json['data'];
            this.keteranganBooking = this.dataBooking.length == 0 ? 'Kode tidak ditemukan' : '';
        },
        clickBooking(booking){
            this.kode_booking = booking['kode_booking']
            this.booking_id = booking['id']
            this.dataBooking = []
        },

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
    }"
    x-init="
        $watch('booking_id', value => {
            if(value != 0) document.querySelector('#check').style.display = 'inline'
            else document.querySelector('#check').style.display = 'none'
        })
        $watch('value', value => {
            if(value != '') document.querySelector('#check1').style.display = 'inline'
            else document.querySelector('#check1').style.display = 'none'
        })
    "
>
       
    <!-- Booking Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('booking_id', 'Booking Id:') !!} <span class="required">*</span>
        <div :class="dataBooking.length != 0 ? 'form-control-custom' :'form-control'" class="d-flex justify-content-between align-items-center">
            <input type="text" @input.debounce.2000ms="getBooking" x-model="kode_booking" class="form-google" required placeholder="Masukan Kode Booking">
            <svg id="check" style="margin-right: 10px; display: none;" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path fill="green" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
            </svg>
            <i class="fas fa-search"></i>
        </div>
        <input type="text" hidden :value="booking_id" name="booking_id">
        
        <div class="alert alert-warning" x-show="keteranganBooking != ''" x-text="keteranganBooking"></div>

        <div class="ajax-request">
            <div :class="dataBooking.length != 0 ? 'ajax-items col-sm-12' : 'ajax-items-initial'">
                <template x-for="item in dataBooking" x-if="dataBooking > 0">
                    <a @click="clickBooking(item)" href="#"><li x-text="`${item['kode_booking']}`"></li></a>
                </template>
            </div>
        </div>
    </div>

    <!-- Dokter Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('user_id', 'Dokter Pemeriksa') !!} <span class="required">*</span>
        <div :class="dokter.length != 0 ? 'form-control-custom' :'form-control'" class="d-flex justify-content-between align-items-center">
            <input type="text" x-model="search" @input.debounce.1000ms="getUser" class="form-google" placeholder="Cari Email Dokter">
            <svg id="check1" style="margin-right: 10px; display: none;" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
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
    
    <!-- Keluhan Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('keluhan', 'Keluhan:') !!} <span class="required">*</span>
        {!! Form::text('keluhan', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Diagnosis Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('diagnosis', 'Diagnosis:') !!} <span class="required">*</span>
        {!! Form::text('diagnosis', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Prognosa Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('prognosa', 'Prognosa:') !!} <span class="required">*</span>
        {!! Form::text('prognosa', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Tindakan Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('tindakan', 'Tindakan:') !!} <span class="required">*</span>
        {!! Form::text('tindakan', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Suhu Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('suhu', 'Suhu:') !!} <span class="required">*</span>
        {!! Form::number('suhu', null, ['class' => 'form-control', 'required', "step" => '0.1']) !!}
    </div>

    <!-- Berat Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('berat', 'Berat:') !!} <span class="required">*</span>
        {!! Form::number('berat', null, ['class' => 'form-control', 'required', "step" => '0.1']) !!}
    </div>

    <!-- Tgl Pemeriksaan Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('tgl_pemeriksaan', 'Tgl Pemeriksaan:') !!} <span class="required">*</span>
        <input type="date" class="form-control" required
           name="tgl_pemeriksaan" value="{{date('Y-m-d')}}">
    </div>

    <!-- Keterangan Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('keterangan', 'Keterangan:') !!} <span class="required">*</span>
        {!! Form::text('keterangan', null, ['class' => 'form-control', 'required']) !!}
    </div>

</div>