<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Kasir</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">

    <div class="row justify-content-center vh-100 align-items-center">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">

                    <h4>
                        <i class="bi bi-shop"></i>
                        Sistem Kasir Warung Madura
                    </h4>

                </div>

                <div class="card-body">

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="/login">

                        @csrf

                        <div class="mb-3">
                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>
                        </div>

                        <button class="btn btn-primary w-100">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>