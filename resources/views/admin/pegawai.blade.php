@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Manajemen Data Pegawai</h3>
        <button class="btn btn-success" id="btn-tambah" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Tambah</button>
    </div>

    <!-- Modal untuk Menambahkan Pegawai -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Kop Modal (Logo dan Identitas Mitra) -->
                <div class="modal-body text-center" style="background-color: #ffffff; padding: 20px;">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('img/KPP.png') }}" alt="KPP" width="160" height="60" class="me-2">
                        <p style="font-size: 29px; font-weight: bold; color: #2196f3; margin-top:10px;">
                            KPP | Lhokseumawe, Aceh Utara
                        </p>
                    </div>
                </div>
                <div class="modal-header justify-content-center align-items-center text-center" style="background-color: #2196f3; color: white;">
                    <h5 class="modal-title text-center" id="addEmployeeModalLabel">
                        <strong>Tambah Data Pegawai</strong>
                    </h5>
                </div>
                <form action="{{ route('store-pegawai') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Pilih User</label>
                            <select class="form-select" id="user_id" name="user_id" required>
                                <option value="" disabled selected>-- Pilih User --</option>
                                @foreach ($ausers as $userk)
                                    <option value="{{ $userk->id }}">{{ $userk->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="dvisi" class="form-label">Divisi</label>
                            <input type="text" class="form-control" id="divisi" name="divisi" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="lama_bekerja" class="form-label">Lama Bekerja (Tahun)</label>
                            <input type="text" class="form-control" id="lama_bekerja" name="lama_bekerja" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" disabled selected>-- Pilih Status --</option>
                                <option value="Active">Aktif</option>
                                <option value="Inactive">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah Pegawai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($apegawai as $pegawai)
    <div class="modal fade" id="editPegawaiModal{{ $pegawai->id }}" tabindex="-1" aria-labelledby="editPegawaiModalLabel{{ $pegawai->id }}" aria-hidden="true">
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
                    <h5 class="modal-title text-center" id="editPegawaiModalLabel{{ $pegawai->id }}">
                        <strong>Ubah Data Pegawai</strong>
                    </h5>
                </div>
                <form action="{{ route('update-pegawai', $pegawai->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_id{{ $pegawai->id }}" class="form-label">Pilih User</label>
                            <select class="form-select" id="user_id{{ $pegawai->id }}" name="user_id" required>
                                <option value="" disabled>-- Pilih User --</option>
                                @foreach($ausers as $userk)
                                    <option value="{{ $userk->id }}" {{ $userk->id == $pegawai->user_id ? 'selected' : '' }}>{{ $userk->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nip{{ $pegawai->id }}" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip{{ $pegawai->id }}" name="nip" value="{{ $pegawai->nip }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama{{ $pegawai->id }}" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama{{ $pegawai->id }}" name="nama" value="{{ $pegawai->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin{{ $pegawai->id }}" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin{{ $pegawai->id }}" name="jenis_kelamin" required>
                                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ $pegawai->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $pegawai->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir{{ $pegawai->id }}" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir{{ $pegawai->id }}" name="tempat_lahir" value="{{ $pegawai->tempat_lahir }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir{{ $pegawai->id }}" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir{{ $pegawai->id }}" name="tanggal_lahir" value="{{ $pegawai->tanggal_lahir->format('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon{{ $pegawai->id }}" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon{{ $pegawai->id }}" name="telepon" value="{{ $pegawai->telepon }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="divisi{{ $pegawai->id }}" class="form-label">Divisi</label>
                            <input type="text" class="form-control" id="divisi{{ $pegawai->id }}" name="divisi" value="{{ $pegawai->divisi }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat{{ $pegawai->id }}" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat{{ $pegawai->id }}" name="alamat" rows="3" required>{{ $pegawai->alamat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="lama_bekerja{{ $pegawai->id }}" class="form-label">Lama Bekerja (Tahun)</label>
                            <input type="text" class="form-control" id="lama_bekerja{{ $pegawai->id }}" name="lama_bekerja" value="{{ $pegawai->lama_bekerja }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="status{{ $pegawai->id }}" class="form-label">Status</label>
                            <select class="form-select" id="status{{ $pegawai->id }}" name="status" required>
                                <option value="" disabled selected>-- Pilih Status --</option>
                                <option value="Active" {{ $pegawai->status == 'Active' ? 'selected' : '' }}>Aktif</option>
                                <option value="Inactive" {{ $pegawai->status == 'Inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach


    @foreach($apegawai as $pegawai)
    <div class="modal fade" id="detailPegawaiModal{{ $pegawai->id }}" tabindex="-1" aria-labelledby="detailPegawaiModalLabel{{ $pegawai->id }}" aria-hidden="true">
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
                    <h5 class="modal-title text-center" id="detaPegawaiModalLabel{{ $pegawai->id }}">
                        <strong>Detail Data Pegawai</strong>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Nama:</strong>
                        <p>{{ $pegawai->nama }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>NIP:</strong>
                        <p>{{ $pegawai->nip }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Jenis Kelamin:</strong>
                        <p>{{ $pegawai->jenis_kelamin }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Tempat Lahir:</strong>
                        <p>{{ $pegawai->tempat_lahir }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Tanggal Lahir:</strong>
                        <p>{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->translatedFormat('d F Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Telepon:</strong>
                        <p>{{ $pegawai->telepon }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Divisi:</strong>
                        <p>{{ $pegawai->divisi }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Alamat:</strong>
                        <p>{{ $pegawai->alamat }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Lama Bekerja:</strong>
                        <p>{{ $pegawai->lama_bekerja }} tahun</p>
                    </div>
                    <div class="mb-3">
                        <strong>Status:</strong>
                        <p>
                            @if($pegawai->status == 'Active')
                                <span class="badge bg-success text-light">Aktif</span>
                            @elseif($pegawai->status == 'Inactive')
                                <span class="badge bg-danger text-light">Tidak Aktif</span>
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
                <th class="text-center">No. HP</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($apegawai as $key => $pegawai)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $pegawai->nama }}</td>
                    <td>{{ $pegawai->nip }}</td>
                    <td class="text-center"> {{ $pegawai->telepon }}
                        
                    </td>
                    <td class="text-center">
                        @if($pegawai->status == 'Active')
                            <span class="badge bg-success text-light">Aktif</span>
                        @elseif($pegawai->status == 'Inactive')
                            <span class="badge bg-danger text-light">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailPegawaiModal{{ $pegawai->id }}"  
                            data-id="{{ $pegawai->id }}" >
                        <i class="bi bi-eye"></i>
                    </button>
                        <!-- Edit Button membuka modal -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPegawaiModal{{ $pegawai->id }}"  
                                data-id="{{ $pegawai->id }}" >
                            <i class="bi bi-pencil"></i>
                        </button>
                        <!-- Delete Button menggunakan Form dan SweetAlert konfirmasi -->
                        <form action="{{ route('delete-pegawai', $pegawai->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $pegawai->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="button" onclick="confirmDelete({{ $pegawai->id }})">
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
    function confirmDelete(pegawaiId) {
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
                // Kirim form penghapusan jika pegawai mengonfirmasi
                document.getElementById('delete-form-' + pegawaiId).submit();
            }
        });
    }
</script>

@endsection
