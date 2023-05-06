@php
    $user = Auth::user();
    $role = $user->getRoleNames()[0];
    if($role == 'klien'){
        $pasien_id = isset($booking) ? $booking->pasien_id : '';
        $klien = true;
    }else{
        $pasien_id = '';
        $klien = false;
    }
@endphp

<div class="row col-sm-12" 
    x-data="{
        klien: '{{$klien}}',
        data: [],
        @if(isset($booking))
            tanggal: '{{ date('Y-m-d', strtotime($booking->jadwal_praktik->tanggal_masuk))}}',
            target: {{$booking->jadwal_praktik}}, {{-- Untuk mengecek Centang Date --}}
            jadwal_praktik_id: '{{$booking['jadwal_praktik_id']}}',
        @else
            tanggal: '{{date('Y-m-d')}}',
            target: null,
            jadwal_praktik_id: 1,
        @endif

        async getJadwal(){
            let url = '/api/jadwal-praktik?date=' + this.tanggal;
            const resp = await fetch(url);
            const json = await resp.json();
            this.data = json;
        },

        clickJadwal(item){
            this.target = item;
            this.jadwal_praktik_id = item['id'];
            this.data = [];
            if(this.name == ''){
                alert('Tolong isi kolom pasien terlebih dahulu');
                this.target = null;
                this.getJadwal();
            }else{
                setTimeout(function(){
                    document.querySelector('#upload').submit(); 
                }, 1000);
            }
        },

        name: '',
        data1: [],
        pasien_id: '{{$pasien_id}}',
        async getPasien(){
            let url = '/api/pasien?name=' + this.name;
            if(this.klien){
                url += '&klien=' + {{$user->id}};
            }
            const resp = await fetch(url);
            const json = await resp.json();
            this.data1 = json['data'];
        },

        clickPasien(item){
            this.pasien_id = item['id'];
            this.name = item['nama_hewan'];
            this.data1 = [];
            console.log(this.pasien_id)
        },

        convertedTanggal(x, y = null){
            let date = new Date(x)
            let result = ` 
                ${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}:00`;
            if(y == null){
                return result;
            }
            date = new Date(y);
            result += ` 
                - ${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}:00 WIB`;
            return result;
        }, 
    }" 
    x-init="
        $watch('pasien_id', value => {
            if(value != null) document.querySelector('#check').style.display = 'inline'
            else document.querySelector('#check').style.display = 'none'
        });
        $nextTick(()=>{
            getJadwal();
        });
        getPasien();
    "
>

    <div class="form-group col-sm-6">
        {!! Form::label('pasien_id', 'Nama Pasien:') !!} <span class="required">*</span>
        <div :class="data1.length != 0 ? 'form-control-custom' :'form-control'" class="d-flex justify-content-between align-items-center">
            <input type="text" hidden x-model="pasien_id" name="pasien_id" @isset($booking)
                disabled
            @endisset>
            {!! Form::text('pasien_name', null, ['class' => 'form-google', 'required', 'x-model' => 'name', '@input.debounce.1000ms'=>"getPasien"]) !!}
            <svg id="check" style="margin-right: 10px; display: none;" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path fill="green" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
            </svg>
            <i class="fas fa-search"></i>
        </div>
        <div class="ajax-request">
            <div :class="data1.length != 0 ? 'ajax-items form-control' : 'ajax-items-initial'">
                <template x-for="item in data1">
                    <a @click="clickPasien(item)" href="#"><li x-text="`${item['nama_hewan']} (${item['user_id']})`"></li></a>
                </template>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        {!! Form::label('jadwal_praktik_id', 'Jadwal:') !!} <span class="required">*</span>
        <span x-text="target == null ? '' : convertedTanggal(target['tanggal_masuk'], target['tanggal_selesai'])" x-show="target"></span>
        <svg id="check" style="margin-left: 10px; display: none;" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <path fill="green" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
        </svg>

        <input type="date" id="start" @change.debounce.1000ms="getJadwal"
            x-model='tanggal' min="{{date('Y-m-d')}}" max="" required class="form-control">
        <input type="number" :value='jadwal_praktik_id' name="jadwal_praktik_id" hidden>
        <div class="alert alert-danger" x-text="data['message']" x-show="data['message']" style="padding: .2rem; margin-top: 5px;"></div>
    </div>
    <!-- Pasien Id Field -->
    

    <template x-for="item in data['data']">
        <div class="card col-sm-12">
            <h5 class="d-flex flex-row justify-content-between" style="
                background-color: transparent;
                border-bottom: 1px solid rgba(0, 0, 0, 0.125);
                padding: 0.75rem 1.25rem;
                position: relative;
                border-top-left-radius: 0.25rem;
                border-top-right-radius: 0.25rem;"
            >
                <div><i class="fas fa-clock" style="margin-right= 5px;"></i><span x-text="convertedTanggal(item['tanggal_masuk'], item['tanggal_selesai'])"></span></div>
                <div class=""><span x-text="item['ketersediaan']"></span><span> tersedia</span></div>
            </h5>
            <div class="card-body row">
              <h5 class="card-title col-sm-10">
                <div class="row">
                    <div class="col-sm-12 row align-items-center">
                        <div class="col-sm-1">
                            <img class="img-profil" :src="item['dokter']['img']" alt="" style="border-radius: 50%;">
                        </div>
                        <div class="col-sm-11">
                            <span x-text="item['dokter']['user']['full_name']"></span> (<span x-text="item['dokter']['user']['email']"></span>) | <span x-text="item['dokter']['spesialis']"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-2" x-text="item['dokter']['user']['phone']"></div>
                </div>
                <button type="submit" @click.prevent="clickJadwal(item)" class="btn btn-primary mt-2" :disabled="item['ketersediaan'] <= 0">Pilih Jadwal</button>
              </h5>
            </div>
          </div>
    </template>
</div>

