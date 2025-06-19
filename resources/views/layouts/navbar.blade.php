<nav class="navbar navbar-expand-lg bg-white shadow-sm position-relative">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand text-teal fw-bold d-flex align-items-center" href="#">
            <img src="{{ asset('img/KPP.png') }}" alt="Logo" width="130" class="rounded-circle me-2">
            Sistem Cuti KPP Lhokseumawe
        </a>

        <!-- Center Badge -->
        <div class="position-absolute start-50 translate-middle-x">
            <span id="datetime-badge" class="badge digital-badge shadow px-4 py-2"></span>
        </div>

        <!-- User Dropdown -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                @php
                    $imagePath = 'img/profile/' . $user->profile_picture;
                    $defaultImage = 'https://dummyimage.com/150x150/edf2f7/1e3a8a.png&text=Foto+Tidak+Tersedia';
                @endphp
                <img src="{{ $user->profile_picture && file_exists(public_path($imagePath)) ? asset($imagePath) : $defaultImage }}" 
                    alt="User" width="36" height="36" 
                    class="rounded-circle border border-2 border-teal me-2">
                <span class="fw-semibold">{{ Auth::user()->nama ?? 'User' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow''" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('admin.profil') }}">Profil</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>


<style>
    /* Navbar Styling */
    .bg-white {
        background-color: #ffffff !important;
    }

    .text-teal {
        color: #008080 !important;
    }

    nav {
        border-bottom: 3px solid #1e3c72;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .digital-badge {
        font-family: 'Courier New', Courier, monospace;
        background: linear-gradient(145deg, #1f316f, #4a69bd);
        color: #ffffff !important;
        border-radius: 12px;
        font-size: 0.8rem;
        letter-spacing: 1px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .dropdown-menu {
        border: none;
        border-radius: 8px;
        padding: 10px 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        min-width: 200px;
    }

    .dropdown-menu .dropdown-item {
        padding: 10px 16px;
        font-size: 0.9rem;
        transition: background-color 0.2s ease;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #f1f1f1;
    }

    .rounded-circle {
        border-radius: 50%;
    }

    .border-teal {
        border-color: #008080 !important;
    }
</style>


<script>
    
    document.addEventListener('DOMContentLoaded', () => {
        const datetimeBadge = document.getElementById('datetime-badge');

        function updateDateTime() {
            const now = new Date();
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour12: false
            };

            const locale = 'id-ID'; // Bahasa Indonesia
            const dateStr = now.toLocaleDateString(locale, options);
            const timeStr = now.toLocaleTimeString(locale, { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
            
            datetimeBadge.textContent = `Tanggal: ${dateStr} | Pukul: ${timeStr}`;
        }

        // Perbarui waktu setiap detik
        updateDateTime();
        setInterval(updateDateTime, 1000);
    });
</script>
