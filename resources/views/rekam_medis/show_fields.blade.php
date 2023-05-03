<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col"></th>
        <th scope="col">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Kode Booking</td>
        <td>{{ $rekamMedis->booking->kode_booking }}</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Dokter</td>
        <td>{{ $rekamMedis->dokter->user->full_name }} | {{ $rekamMedis->dokter->nip }}</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Keluhan</td>
        <td>{{ $rekamMedis->keluhan }}</td>
      </tr><tr>
        <th scope="row">4</th>
        <td>Diagnosis</td>
        <td>{{ $rekamMedis->diagnosis }}</td>
      </tr><tr>
        <th scope="row">5</th>
        <td>Prognosa</td>
        <td>{{ $rekamMedis->prognosa }}</td>
      </tr><tr>
        <th scope="row">6</th>
        <td>Tindakan</td>
        <td>{{ $rekamMedis->Tindakan }}</td>
      </tr><tr>
        <th scope="row">7</th>
        <td>Suhu</td>
        <td>{{ $rekamMedis->suhu}}</td>
      </tr><tr>
        <th scope="row">8</th>
        <td>Berat</td>
        <td>{{ $rekamMedis->berat}}</td>
      </tr><tr>
        <th scope="row">9</th>
        <td>Tanggal Pemeriksaan</td>
        <td>{{ $rekamMedis->tgl_pemeriksaan}}</td>
      </tr><tr>
        <th scope="row">10</th>
        <td>Keterangan</td>
        <td>{{ $rekamMedis->keterangan}}</td>
      </tr><tr>
        <th scope="row">11</th>
        <td>Dibuat dan Diubah</td>
        <td>{{ $rekamMedis->created_at}} dan {{ $rekamMedis->updated_at}}</td>
      </tr>
    </tbody>
  </table>
