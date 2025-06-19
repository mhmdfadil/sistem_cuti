@extends('layouts.mainp')

@section('content')
<style>
    .bg-customs {
        background-color: #2196f3;
    }
    .card {
        border-radius: 10px; /* Sudut card melengkung */
    }
    .card-header {
        border-radius: 10px 10px 0 0; /* Sudut card-header melengkung */
        font-weight: bold;
    }
    .form-control {
        border-radius: 5px; /* Sudut input melengkung */
        box-shadow: none;
        border: 1px solid #ccc;
        transition: border 0.3s ease;
    }
    .form-control:focus {
        border-color: #2196f3;
        box-shadow: 0 0 5px rgba(33, 150, 243, 0.5); /* Efek fokus biru */
    }
    .btn-custom {
        background-color: #2196f3;
        color: white;
        border-radius: 5px;
        padding: 10px 20px;
        width: 100%;
        transition: background-color 0.3s ease;
    }
    .btn-custom:hover {
        background-color: #1976d2;
    }
    .additional-input {
        display: none;
    }
    label {
        font-weight: 600;
    }
</style>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-customs text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Formulir Pengajuan Cuti Pegawai</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('store-pengajuanp') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <!-- Input Pegawai ID -->
                    <div class="col-md-6">
                        <label for="pegawai_id">Nama Pegawai</label>
                        <input type="hidden" class="form-control" id="pegawai_id" name="pegawai_id" value="{{ $pegawai->id }}" readonly>
                        <input type="text" class="form-control" id="pegawai_name" name="pegawai_name" value="{{ $pegawai->nama }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="pegawai_nip">NIP Pegawai</label>
                        <input type="text" class="form-control" id="pegawai_nip" name="pegawai_nip" value="{{ $pegawai->nip }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Input Tanggal Mulai Cuti -->
                    <div class="col-md-6">
                        <label for="tanggal_mulai_cuti">Tanggal Mulai Cuti</label>
                        <input type="date" class="form-control" id="tanggal_mulai_cuti" name="tanggal_mulai_cuti">
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Input Tanggal Selesai Cuti -->
                    <div class="col-md-6">
                        <label for="tanggal_selesai_cuti">Tanggal Selesai Cuti</label>
                        <input type="date" class="form-control" id="tanggal_selesai_cuti" name="tanggal_selesai_cuti">
                    </div>

                    <!-- Input Durasi Cuti -->
                    <div class="col-md-6">
                        <label for="durasi_cuti">Durasi Cuti (hari)</label>
                        <input type="text" class="form-control" id="durasi_cuti" name="durasi_cuti" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Input Tipe Cuti -->
                    <div class="col-md-6">
                        <label for="tipe_cuti">Tipe Cuti</label>
                        <select class="form-control" id="tipe_cuti" name="tipe_cuti">
                            <option value="Cuti Tahunan">Cuti Tahunan</option>
                            <option value="Cuti Sakit">Cuti Sakit</option>
                            <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                            <option value="Cuti Besar">Cuti Besar</option>
                            <option value="Lainnya">Lainnya</option> <!-- Opsi lainnya -->
                        </select>
                    </div>

                    <!-- Input Alasan Cuti -->
                    <div class="col-md-6">
                        <label for="alasan_cuti">Alasan Cuti</label>
                        <textarea class="form-control" id="alasan_cuti" name="alasan_cuti" rows="3"></textarea>
                    </div>
                </div>

                <!-- Input Lainnya (Hanya muncul jika opsi Lainnya dipilih) -->
                <div class="row mb-3 additional-input" id="input-lainnya">
                    <div class="col-md-6">
                        <label for="lainnya">Tipe Cuti Lainnya</label>
                        <input type="text" class="form-control" id="lainnya" name="lainnya">
                    </div>
                </div>

                <!-- Button Submit -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block">Ajukan Cuti</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tanggal_mulai_cuti, #tanggal_selesai_cuti').on('change', function() {
    var tanggalMulai = $('#tanggal_mulai_cuti').val();
    var tanggalSelesai = $('#tanggal_selesai_cuti').val();

    if (tanggalMulai && tanggalSelesai) {
        var startDate = new Date(tanggalMulai);
        var endDate = new Date(tanggalSelesai);

        // Validasi: Cek apakah tanggal selesai lebih kecil dari tanggal mulai
        if (endDate < startDate) {
            alert('Tanggal selesai tidak boleh lebih kecil dari tanggal mulai.');
            $('#tanggal_mulai_cuti').val(''); // Reset tanggal mulai
            $('#tanggal_selesai_cuti').val(''); // Reset tanggal selesai
            $('#durasi_cuti').val(0); // Set durasi menjadi 0
            return; // Keluar dari fungsi jika validasi gagal
        }

        var durasi = 0;

        // Loop untuk menghitung jumlah hari kerja (Senin - Jumat)
        for (var date = new Date(startDate); date <= endDate; date.setDate(date.getDate() + 1)) {
            var dayOfWeek = date.getDay(); // Dapatkan hari dalam bentuk angka (0 = Minggu, 1 = Senin, ... , 6 = Sabtu)
            
            // Cek apakah hari tersebut adalah Sabtu (6) atau Minggu (0)
            if (dayOfWeek !== 0 && dayOfWeek !== 6) {
                durasi++;
            }
        }

        // Menampilkan durasi cuti
        $('#durasi_cuti').val(durasi);
    }
});


        // Menampilkan input tambahan jika memilih "Lainnya"
        $('#tipe_cuti').on('change', function() {
            var selectedOption = $(this).val();
            if (selectedOption === 'Lainnya') {
                $('#input-lainnya').show();
            } else {
                $('#input-lainnya').hide();
            }
        });
    });
</script>
@endsection
