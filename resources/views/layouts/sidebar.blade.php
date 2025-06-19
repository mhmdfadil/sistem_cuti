<aside class="bg-custom text-light shadow-lg rounded-3" style="width: 350px;">
    <div class="p-4">
        <!-- Sidebar Header -->
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-grid-fill text-light me-3 fs-4"></i>
            <h5 class="mb-0 fw-bold">Menu Navigasi</h5>
        </div>

        <!-- Sidebar Menu -->
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center text-light rounded-lg {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}" >
                    <i class="bi bi-house-door-fill me-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center text-light rounded-lg {{ request()->is('admin/akun') ? 'active' : '' }}" href="{{ route('admin.akun') }}">
                    <i class="bi bi-bar-chart-fill me-3"></i>
                    <span>Data Akun</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center text-light rounded-lg {{ request()->is('admin/pegawai') ? 'active' : '' }}" href="{{ route('admin.pegawai') }}">
                    <i class="bi bi-file-earmark-text-fill me-3"></i>
                    <span>Data Pegawai</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center text-light rounded-lg {{ request()->is('admin/pengajuan') ? 'active' : '' }}" href="{{ route('admin.pengajuan') }}">
                    <i class="bi bi-chat-dots-fill me-3"></i>
                    <span>Pengajuan Cuti</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center text-light rounded-lg {{ request()->is('admin/profil') ? 'active' : '' }}" href="{{ route('admin.profil') }}">
                    <i class="bi bi-person-circle me-3"></i>
                    <span>Profil</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<style>
    /* Sidebar Custom Styling */
    aside {
        background: linear-gradient(135deg, #00657e, #72acd3); /* Vibrant purple-blue gradient */
        font-family: 'Roboto', sans-serif; /* Modern font for readability */
        border-radius: 16px; /* More rounded corners for a smoother look */
        border: 3px solid #ffffff; /* White border for sharp separation */
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1); /* Subtle shadow for separation */
        overflow: hidden;
    }

    /* Sidebar Header Styling */
    aside h5 {
        color: #ffcc00; /* Bright yellow for header for contrast */
        font-size: 1.4rem;
        font-weight: 700;
    }

    /* Link Styling */
    aside .nav-link {
        padding: 16px 24px; /* Slightly larger padding for more space */
        font-size: 1.1rem; /* Medium font size for clarity */
        font-weight: 500;
        border-radius: 10px; /* Softer rounded corners */
        transition: all 0.3s ease-in-out;
        color: #e0e0e0; /* Soft light gray for text */
    }

    aside .nav-link:hover,
    aside .nav-link.active {
        background-color: #001f86; /* Bright greenish active state */
        color: #ffffff !important; /* White text for visibility */
        transform: translateX(5px); /* Smooth shift effect */
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2); /* Stronger shadow on hover */
    }

    aside .nav-link i {
        font-size: 1.5rem; /* Larger icons for better visibility */
    }

    aside .nav-item + .nav-item {
        margin-top: 20px;
    }

    /* Sidebar Shadow */
    aside .shadow-lg {
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.15); /* Larger shadow for the whole sidebar */
    }

    /* Active Link Styling */
    .nav-link.active {
        background-color: #001f86; /* Bright greenish active state */
        color: #fff !important;
    }

    .nav-link.active i {
        color: #fff !important; /* Icon color on active */
    }

    /* Smooth Transitions for Hover */
    .nav-link {
        transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
    }
</style>
