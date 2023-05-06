@php
    if (isset($pembayaran)) {
        $media = $pembayaran->getMedia();
        $image_url = count($media) == 0 ? "http://bmkg.go.id/asset/img/logo/logo-bmkg.png" : $media[0]->getUrl();
    }
@endphp
<div class="row"
    x-data="{
        @if(isset($pembayaran))
            kode_booking:'{{$pembayaran->booking->kode_booking}}',
            booking_id: {{$pembayaran->booking_id}},
            tanggal_bayar:'{{$pembayaran->tanggal_bayar}}',
            jumlah_transaksi:{{$pembayaran->jumlah_transaksi}},
            verifikasi:{{$pembayaran->verifikasi}},
            edit: true,
        @else
            kode_booking:'',
            booking_id: 0,
            tanggal_bayar:'',
            jumlah_transaksi:'',
            verifikasi:'',
            edit: false,
        @endif
        dataBooking: [],
        keteranganBooking: '',
        async getBooking(){
            let url = '/api/booking?kode=';
            if(this.kode_booking == ''){
                url += ' ' + '&id={{Auth::user()->id}}' + '&role={{Auth::user()->getRoleNames()[0]}}'
            }else{
                url += this.kode_booking + '&id={{Auth::user()->id}}' + '&role={{Auth::user()->getRoleNames()[0]}}'
            }
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
    }"
    x-init="
        $watch('booking_id', value => {
            if(value != 0) document.querySelector('#check').style.display = 'inline'
            else document.querySelector('#check').style.display = 'none'
        })
        if(!edit) getBooking();
    "
>
       
    <!-- Booking Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('booking_id', 'Booking Id:') !!} <span class="required">*</span>
        <div :class="dataBooking.length != 0 ? 'form-control-custom' :'form-control'" class="d-flex justify-content-between align-items-center">
            <input @role('klien') disabled @endrole type="text" @input.debounce.2000ms="getBooking" x-model="kode_booking" class="form-google" required placeholder="Masukan Kode Booking">
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

    <!-- Jumlah Transaksi Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('jumlah_transaksi', 'Jumlah Transaksi:') !!}
        <input @role('klien') disabled @endrole class="form-control" required="" name="jumlah_transaksi" type="text" x-model="jumlah_transaksi" id="jumlah_transaksi">
    </div>
   

    @role('klien')
    <!-- Tanggal Bayar Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('tanggal_bayar', 'Tanggal Pembayaran:') !!} <span class="required">*</span>
    <input type="datetime-local" class="form-control" required
        name="tanggal_bayar" value="{{isset($pembayaran)? $pembayaran->tanggal_bayar : ''}}"
        min="" max="">
    </div>

    <div class="form-group col-sm-6">
        <label for="image">Bukti Pembayaran</label> <br>
        <input type="file" name="image" required> <br>
        <span class="text-muted">Maks. 2MB</span>
        @if (count($media) > 0)
        <div class="col-sm-12" style="height: 100px;">
            <img src="{{$image_url}}" alt="" class="img-profil" style="object-fit: contain;">
            <div class="text-center">{{$media[0]->name }}</div>
        </div>
        @endif
    </div> 
    @endrole

    @role('administrator|manajer|dokter-hewan')
    <div class="form-group col-sm-6" x-show='edit'>
        <label for="verifikasi">Verifikasi</label> <br>
        <select class="custom-select" x-model='verifikasi' name="verifikasi" id="">
        @if(isset($pembayaran))
            <option @if($pembayaran->verifikasi) selected @endif value="0">Belum Verifikasi</option>
            <option @if($pembayaran->verifikasi) selected @endif value="1">Sudah Verifikasi</option>
        @endif
        </select>
    </div> 
    @endrole
</div>

    




