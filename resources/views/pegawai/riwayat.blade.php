@extends('layouts.mainp')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Riwayat Pengajuan Cuti</h3>
    </div>

    @foreach($ariwayat as $riwayat)
    <div class="modal fade" id="detailriwayatModal{{ $riwayat->id }}" tabindex="-1" aria-labelledby="detailriwayatModalLabel{{ $riwayat->id }}" aria-hidden="true">
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
                    <h5 class="modal-title text-center" id="detailriwayatModalLabel{{ $riwayat->id }}">
                        <strong>Detail Riwayat Cuti Pegawai</strong>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Nama Pegawai:</strong>
                        <p>{{ $riwayat->_pegawai->nama }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>NIP Pegawai:</strong>
                        <p>{{ $riwayat->_pegawai->nip }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>No. Telpon Pegawai:</strong>
                        <p>{{ $riwayat->_pegawai->telepon }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Alamat Pegawai:</strong>
                        <p>{{ $riwayat->_pegawai->alamat }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Tanggal Mulai Cuti:</strong>
                        <p>{{ \Carbon\Carbon::parse($riwayat->tanggal_mulai_cuti)->translatedFormat('d F Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Tanggal Selesai Cuti:</strong>
                        <p>{{ \Carbon\Carbon::parse($riwayat->tanggal_selesai_cuti)->translatedFormat('d F Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Durasi Cuti:</strong>
                        <p>{{ $riwayat->durasi_cuti }} hari</p>
                    </div>
                    <div class="mb-3">
                        <strong>Tipe Cuti:</strong>
                        <p>{{ $riwayat->tipe_cuti }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Alasan Cuti:</strong>
                        <p>{{ $riwayat->alasan_cuti }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Status riwayat:</strong>
                        <p>
                            @if($riwayat->status_pengajuan == 'Baru')
                                <span class="badge bg-primary text-light">Baru</span>
                            @elseif($riwayat->status_pengajuan == 'Diproses')
                                <span class="badge bg-warning text-dark">Diproses</span>
                            @elseif($riwayat->status_pengajuan == 'Diterima')
                                <span class="badge bg-success text-light">Diterima</span>
                            @elseif($riwayat->status_pengajuan == 'Ditolak')
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
    
    <table class="table table-bordered table-hover" id="riwayatCutiTable">
        <thead class="table-light">
            <tr class="text-center">
                <th class="text-center">No</th>
                <th class="text-center">Tipe Cuti</th>
                <th class="text-center">Tanggal Mulai Cuti</th>
                <th>Tanggal Selesai Cuti</th>
                <th class="text-center"> Durasi Cuti</th>
                <th class="text-center">Status Pengajuan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ariwayat as $key => $riwayat)
                <tr>
                    <td class="text-center" width="50px">{{ intval($key) + 1 }}</td>

                    <td >{{ $riwayat->tipe_cuti }}</td>
                    <td width="160px">{{ \Carbon\Carbon::parse($riwayat->tanggal_mulai_cuti)->translatedFormat('d F Y') }}</td>
                    <td width="160px">{{ \Carbon\Carbon::parse($riwayat->tanggal_selesai_cuti)->translatedFormat('d F Y') }}</td>
                    <td class="text-center" width="100px">{{ $riwayat->durasi_cuti }} hari</td>
                    <td class="text-center" width="120px">
                        @if($riwayat->status_pengajuan == 'Baru')
                            <span class="badge bg-primary text-light">Baru</span>
                        @elseif($riwayat->status_pengajuan == 'Diproses')
                            <span class="badge bg-warning text-dark">Diproses</span>
                        @elseif($riwayat->status_pengajuan == 'Diterima')
                            <span class="badge bg-success text-light">Diterima</span>
                        @elseif($riwayat->status_pengajuan == 'Ditolak')
                            <span class="badge bg-danger text-light">Ditolak</span>
                        @endif
                    </td>
                    <td class="text-center text-sm" width="130px">
                        <!-- Tombol Lihat Modal -->
                        <button class="btn btn-info text-sm" data-bs-toggle="modal" 
                            data-bs-target="#detailriwayatModal{{ $riwayat->id }}">
                            <i class="bi bi-eye"></i> &nbsp; Lihat
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- DataTables Initialization -->
<script>
    $(document).ready(function() {
        $('#riwayatCutiTable').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.1/i18n/id.json"
            }
        });
    });
</script>

<!-- SweetAlert for Notifications -->
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
@endsection
