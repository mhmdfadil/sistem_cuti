@extends('layouts.mainp')

@section('content')
<div class="dashboard-container mt-2">
    <!-- Welcome Section -->
    <div class="welcome-card shadow">
        <div class="welcome-header text-center">
            <h1 class="welcome-title">
                Selamat Datang, <span class="user-name">{{ $user->nama }}</span>
            </h1>
            <p class="welcome-subtitle">
                di Sistem Informasi <span class="highlight">Cuti Pegawai</span><br>
                Kantor Pelayanan Pajak | Lhokseumawe, Aceh Utara
            </p>
        </div>
    </div>

    <!-- Quick List Section -->
    <div class="quick-list mt-4">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card quick-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-folder2-open quick-icon"></i>
                        <h5 class="card-title">Riwayat Data Pengajuan</h5>
                        <p class="card-text">Lihat semua pengajuan Anda</p>
                        <a href="{{ route('pegawai.riwayat') }}" class="btn btn-primary btn-sm">Lihat Data</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card quick-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-file-earmark-plus quick-icon"></i>
                        <h5 class="card-title">Formulir Pengajuan</h5>
                        <p class="card-text">Ajukan cuti baru</p>
                        <a href="{{ route('pegawai.pengajuan') }}" class="btn btn-primary btn-sm">Isi Formulir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card quick-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-person quick-icon"></i>
                        <h5 class="card-title">Profil</h5>
                        <p class="card-text">Kelola profil Anda</p>
                        <a href="{{ route('pegawai.profil') }}" class="btn btn-primary btn-sm">Lihat Profil</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card quick-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-card-list quick-icon"></i>
                        <h5 class="card-title">Biodata</h5>
                        <p class="card-text">Perbarui biodata</p>
                        <a href="{{ route('pegawai.biodata') }}" class="btn btn-primary btn-sm">Ubah Biodata</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    body {
        font-family: 'Montserrat', sans-serif;
        background: linear-gradient(to right, #e3f2fd, #fff3e0);
        margin: 0;
        padding: 0;
        color: #333;
    }

    .dashboard-container {
        max-width: 96%;
        margin: 0 auto;
    }

    .welcome-card {
        background: #ffffff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .welcome-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .welcome-header {
        padding: 30px 20px;
        background: linear-gradient(135deg, #2196f3, #42a5f5);
        color: #fff;
    }

    .welcome-title {
        font-size: 2.5rem;
        font-weight: bold;
        margin: 0 0 15px;
        text-transform: uppercase;
    }

    .user-name {
        color: #ffe082;
        font-weight: 700;
    }

    .welcome-subtitle {
        font-size: 1.2rem;
        margin: 0;
        line-height: 1.6;
    }

    .highlight {
        color: #ffcc80;
        font-weight: 700;
    }

    .quick-card {
        border: none;
        border-radius: 15px;
        background: #fff;
        transition: box-shadow 0.3s ease-in-out;
    }

    .quick-card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .quick-icon {
        font-size: 2.5rem;
        color: #2196f3;
        margin-bottom: 15px;
    }

    .btn {
        border-radius: 50px;
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .welcome-title {
            font-size: 2rem;
        }

        .quick-icon {
            font-size: 2rem;
        }
    }
</style>
@endsection
