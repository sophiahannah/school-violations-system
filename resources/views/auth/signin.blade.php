<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-md-6 bg-white d-flex align-items-center justify-content-center">
                <div class="p-3" style="width: 100%; max-width: 450px;">
                    <div class="card shadow" style="border: 1px solid #f0b2b2; border-radius: 48px; background-color: white;">
                        <div class="card-body p-5 text-center">

                            <div class="d-flex justify-content-center mb-4">
                                <div style="background-color: #b22222; width: 80px; height: 80px; border-radius: 18px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-mortarboard text-white" style="font-size: 40px;"></i>
                                </div>
                            </div>

                            <h1 class="fw-bold mb-1" style="font-size: 40px;">Welcome Back!</h1>
                            <p class="text-dark mb-4" style="font-size: 17px;">Sign in to access your account</p>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3 text-start">
                                    <label class="form-label ms-1" style="font-weight: 500;">Email Address</label>
                                    <div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden; border: 1px white;">
                                        <span class="input-group-text border-0" style="background-color: #eb5757; color: white; padding: 12px 16px;">
                                            <i class="bi bi-person-fill"></i>
                                        </span>
                                        <input type="email" class="form-control border-0" name="email" placeholder="Email Address" style="padding: 12px;">
                                    </div>
                                </div>

                                <div class="mb-4 text-start">
                                    <label class="form-label ms-1" style="font-weight: 500;">Password</label>
                                    <div class="input-group shadow-sm" style="border-radius: 0.8rem; overflow: hidden; border: 1px white;">
                                        <span class="input-group-text border-0" style="background-color: #eb5757; color: white; padding: 12px 16px;">
                                            <i class="bi bi-briefcase-fill"></i>
                                        </span>
                                        <input type="password" class="form-control border-0" name="password" placeholder="••••••••••••" style="padding: 12px;">
                                        <span class="input-group-text border-0 bg-white text-muted">
                                            <i class="bi bi-eye-slash "></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn text-white fw-bold py-2 shadow-sm"
                                        style="background-color: #b22222; border-radius: 12px; font-size: 18px;">
                                        Sign In
                                    </button>
                                </div>
                            </form>

                            <p class="px-4" style="font-size: 12px; line-height: 1.4; color: #333;">
                                By using this service, you understood and agree to the PUP Online Services
                                <a href="https://www.pup.edu.ph/terms/" class="text-danger text-decoration-none">Terms of Use</a> and
                                <a href="https://www.pup.edu.ph/privacy/" class="text-danger text-decoration-none">Privacy Statement</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-none d-md-flex flex-column align-items-center justify-content-center text-white text-center" style="background-color: #8B0000; padding: 20px;">
                <img src="/PUPLogo 1 Login.png" alt="PUP Logo" class="img-fluid mb-4" style="max-width: 40%; height: auto; filter: drop-shadow(0px 0px 10px rgba(255,255,255,0.3));">
                <h1 class="fw-bold mb-5" style="font-size: 60px; letter-spacing: 2px; text-shadow: 4px 4px 0px rgba(0,0,0,0.4);">
                    SCHOOL VIOLATIONS <br> SYSTEM
                </h1>
                <h2 class="fw-bold mb-2" style="font-size: 45px;">Hello, Welcome back!</h2>
                <div class="mt-2">
                    <p class="mb-0" style="font-size: 18px; font-weight: 500;">To keep connected with us please login<br>with your personal informations</p>
                </div>

            </div>
        </div>
    </div>
</body>

</html>