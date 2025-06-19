@extends('layouts.mainp')

@section('content')
<style>
    .bg-customs {
        background-color: #2196f3;
    }
</style>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-customs text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Biodata Pegawai</h4>
            <!-- Tombol untuk membuka modal -->
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="bi bi-pencil-square"></i> Ubah Data
            </button>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <p><strong>Nama:</strong> {{ $pegawai->nama }}</p>
                    <p><strong>NIP:</strong> {{ $pegawai->nip }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $pegawai->jenis_kelamin }}</p>
                    <p><strong>Tempat Lahir:</strong> {{ $pegawai->tempat_lahir }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->translatedFormat('d F Y') }}</p>
                    <p><strong>No. Telpon:</strong> {{ $pegawai->telepon }}</p>
                    <p><strong>Divisi:</strong> {{ $pegawai->divisi }}</p>
                    <p><strong>Alamat:</strong> {{ $pegawai->alamat }}</p>
                    
                    <p><strong>Status Prgawai:</strong>
                        <span class="badge 
                            @if($user->status === 'Active') 
                                bg-success 
                            @elseif($user->status === 'Inactive') 
                                bg-danger 
                            @else
                                bg-secondary
                            @endif">
                            {{ $user->status }}
                        </span>
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk mengubah data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Kop Modal (Logo dan Identitas Mitra) -->
            <div class="modal-body text-center" style="background-color: #ffffff; padding: 20px;">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('img/KPP.png') }}" alt="KPP" width="160" height="60" class="me-2">
                    <p style="font-size: 29px; font-weight: bold; color:  #2196f3; margin-top:10px;">
                        KPP | Lhokseumawe, Aceh Utara
                    </p>
                </div>
            </div>

            <!-- Modal Header -->
            <div class="modal-header justify-content-center align-items-center text-center" style="background-color: #2196f3; color: white;">
                <h5 class="modal-title" id="editModalLabel">
                    <strong>Biodata Pegawai</strong>
                </h5>
            </div>

            <!-- Form untuk Edit Biodata Pegawai -->
            <form action="{{ route('biodata.updatep') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $pegawai->id }}">

                <div class="modal-body">
                    <!-- Display Data in Editable Fields -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('name', $pegawai->nama) }}">
                    </div>

                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $pegawai->nip) }}">
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="Laki-laki" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir->format('Y-m-d')) }}">
                    </div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label">No. Telpon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', $pegawai->telepon) }}">
                    </div>

                    <div class="mb-3">
                        <label for="divisi" class="form-label">Divisi</label>
                        <input type="text" class="form-control" id="divisi" name="divisi" value="{{ old('divisi', $pegawai->divisi) }}">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $pegawai->alamat) }}</textarea>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
