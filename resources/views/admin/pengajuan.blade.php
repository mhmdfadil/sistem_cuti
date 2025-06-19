@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Manajemen Data Pengajuan Cuti</h3>
    </div>

    @foreach($apengajuan as $pengajuan)
<div class="modal fade" id="detailpengajuanModal{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="detailpengajuanModalLabel{{ $pengajuan->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center" style="background-color: #ffffff; padding: 20px;">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('img/KPP.png') }}" alt="KPP" width="160" height="60" class="me-2">
                    <p style="font-size: 29px; font-weight: bold; color: #2196f3; margin-top:10px;">
                        KPP | Lhokseumawe, Aceh Utara
                    </p>
                </div>
            </div>
            <div class="modal-header justify-content-center align-items-center text-center" style="background-color: #2196f3; color: white;">
                <h5 class="modal-title text-center" id="detailpengajuanModalLabel{{ $pengajuan->id }}">
                    <strong>Detail Pengajuan Cuti Pegawai</strong>
                </h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <strong>Nama Pegawai:</strong>
                    <p>{{ $pengajuan->_pegawai->nama }}</p>
                </div>
                <div class="mb-3">
                    <strong>NIP Pegawai:</strong>
                    <p>{{ $pengajuan->_pegawai->nip }}</p>
                </div>
                <div class="mb-3">
                    <strong>No. Telpon Pegawai:</strong>
                    <p>{{ $pengajuan->_pegawai->telepon }}</p>
                </div>
                <div class="mb-3">
                    <strong>Alamat Pegawai:</strong>
                    <p>{{ $pengajuan->_pegawai->alamat }}</p>
                </div>
                <div class="mb-3">
                    <strong>Tanggal Mulai Cuti:</strong>
                    <p>{{ \Carbon\Carbon::parse($pengajuan->tanggal_mulai_cuti)->translatedFormat('d F Y') }}</p>
                </div>
                <div class="mb-3">
                    <strong>Tanggal Selesai Cuti:</strong>
                    <p>{{ \Carbon\Carbon::parse($pengajuan->tanggal_selesai_cuti)->translatedFormat('d F Y') }}</p>
                </div>
                <div class="mb-3">
                    <strong>Durasi Cuti:</strong>
                    <p>{{ $pengajuan->durasi_cuti }} hari</p>
                </div>
                <div class="mb-3">
                    <strong>Tipe Cuti:</strong>
                    <p>{{ $pengajuan->tipe_cuti }}</p>
                </div>
                <div class="mb-3">
                    <strong>Alasan Cuti:</strong>
                    <p>{{ $pengajuan->alasan_cuti }}</p>
                </div>
                <div class="mb-3">
                    <strong>Status Pengajuan:</strong>
                    <p>
                        @if($pengajuan->status_pengajuan == 'Baru')
                            <span class="badge bg-primary text-light">Baru</span>
                        @elseif($pengajuan->status_pengajuan == 'Diproses')
                            <span class="badge bg-warning text-dark">Diproses</span>
                        @elseif($pengajuan->status_pengajuan == 'Diterima')
                            <span class="badge bg-success text-light">Diterima</span>
                        @elseif($pengajuan->status_pengajuan == 'Ditolak')
                            <span class="badge bg-danger text-light">Ditolak</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

    <table class="table table-bordered table-hover" id="abc">
        <thead class="table-light">
            <tr class="text-center">
                <th class="text-center">No</th>
                <th class="text-center">Nama</th>
                <th class="text-center">NIP</th>
                <th class="text-center">Tipe Cuti</th>
                <th class="text-center">Durasi Cuti</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($apengajuan as $key => $pengajuan)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td width="250px">{{ $pengajuan->_pegawai->nama }}</td>
                    <td width="120px"> {{ $pengajuan->_pegawai->nip }}</td>
                    <td width="160px"> {{ $pengajuan->tipe_cuti }}</td>
                    <td width="70px" class="text-center"> {{ $pengajuan->durasi_cuti }} hari
                        
                    </td>
                    <td class="text-center" width="150px">
                        @if($pengajuan->status_pengajuan == 'Baru')
                            <span class="badge bg-primary text-light">Baru</span>
                        @elseif($pengajuan->status_pengajuan == 'Diproses')
                            <span class="badge bg-warning text-dark">Diproses</span>
                        @elseif($pengajuan->status_pengajuan == 'Diterima')
                            <span class="badge bg-success text-light">Diterima</span>
                        @elseif($pengajuan->status_pengajuan == 'Ditolak')
                            <span class="badge bg-danger text-light">Ditolak</span>
                        @endif
                    
                    </td>
                    <td class="text-center" width="240px">
                        <button class="btn btn-secondary" title="Lihat" data-bs-toggle="modal" data-bs-target="#detailpengajuanModal{{ $pengajuan->id }}" data-id="{{ $pengajuan->id }}">
                            <i class="bi bi-eye"></i> 
                        </button>
                            @if($pengajuan->status_pengajuan == 'Baru')
                            <form action="{{ route('proses-pengajuan', $pengajuan->id) }}" method="POST" style="display:inline;" id="proses-form-{{ $pengajuan->id }}">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-warning" title="Proses" type="button" onclick="confirmProses({{ $pengajuan->id }})">
                                    <i class="bi bi-gear"></i> 
                                </button>
                            </form>
                            @elseif($pengajuan->status_pengajuan == 'Diproses')
                            <form action="{{ route('terima-pengajuan', $pengajuan->id) }}" method="POST" style="display:inline;" id="terima-form-{{ $pengajuan->id }}">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-success" title="Terima" type="button" onclick="confirmTerima({{ $pengajuan->id }})">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                            </form>

                            <form action="{{ route('tolak-pengajuan', $pengajuan->id) }}" method="POST" style="display:inline;" id="tolak-form-{{ $pengajuan->id }}">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-info"  title="Tolak" type="button" onclick="confirmTolak({{ $pengajuan->id }})">
                                    <i class="bi bi-x-circle"></i> 
                                </button>
                            </form>
                               
                            @else
                                
                            @endif
                       
                        <!-- Delete Button menggunakan Form dan SweetAlert konfirmasi -->
                        <form action="{{ route('delete-pengajuan', $pengajuan->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $pengajuan->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" title="Hapus" type="button" onclick="confirmDelete({{ $pengajuan->id }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#abc').DataTable({
            "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/id.json"  // URL untuk indonesia.json
            }
        });
    });
</script>
@if (session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        toast: true,
        icon: 'success',
        title: '{{ session("success") }}',
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
});
</script>
@endif

@if (session('error'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        toast: true,
        icon: 'error',
        title: '{{ session("error") }}',
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
});
</script>
@endif

<script>
    // Fungsi konfirmasi SweetAlert untuk Hapus
    function confirmDelete(pengajuanId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim form penghapusan jika pengajuan mengonfirmasi
                document.getElementById('delete-form-' + pengajuanId).submit();
            }
        });
    }

    function confirmProses(pengajuanId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan diproses!',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Proses',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim form penghapusan jika pengajuan mengonfirmasi
                document.getElementById('proses-form-' + pengajuanId).submit();
            }
        });
    }

    function confirmTolak(pengajuanId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan ditolak!',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Tolak',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim form penghapusan jika pengajuan mengonfirmasi
                document.getElementById('tolak-form-' + pengajuanId).submit();
            }
        });
    }

    function confirmTerima(pengajuanId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan diterima!',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Terima',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim form penghapusan jika pengajuan mengonfirmasi
                document.getElementById('terima-form-' + pengajuanId).submit();
            }
        });
    }
</script>

@endsection
