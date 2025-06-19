<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Cuti KPP Lhokseumawe</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1d3557, #457b9d);
            font-family: 'Montserrat', sans-serif;
            color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #1d3557, #457b9d);
            color: #fff;
            padding: 2rem;
            text-align: center;
        }

        .login-header img {
            max-width: 370px;
            margin-bottom: 1rem;
        }

        .login-header h3 {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .login-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 30px;
        }

        .btn-primary {
            background: #1d3557;
            border: none;
            border-radius: 30px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: #457b9d;
        }

        footer.ss {
            padding: 1rem;
            font-size: 0.9rem;
            text-align: center;
            background: linear-gradient(135deg, #1d3557, #457b9d);
            color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-header">
            <img src="{{ asset('img/KPP.png') }}" alt="Logo KPP" height="120" width="300">
            <h3>Sistem Cuti KPP Lhokseumawe</h3>
            <p>Selamat datang, silakan login untuk melanjutkan</p>
        </div>
        <div class="login-body">
            <form id="login-form" method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white" aria-label="Ikon Email"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white" aria-label="Ikon Password"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>
        </div>
        <footer class="ss">
            &copy; 2024 Kantor Pelayanan Pajak Lhokseumawe. All Rights Reserved.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                toast: true,
                icon: 'success',
                title: '{{ session("success") }}',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        });
    </script>
    @endif
    @if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                toast: true,
                icon: 'error',
                title: '{{ session("error") }}',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        });
    </script>
    @endif
</body>

</html>
