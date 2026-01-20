<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/png" href="{{ asset('PUPLogo 1 Login.png') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-lg-7 col-12 bg-white d-flex align-items-center justify-content-center">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-md-10 col-11 mb-3 mb-sm-0">
                        <div class="">
                            <div class="card shadow"
                                style="border: 1px solid #f0b2b2; border-radius: 48px; background-color: white;">
                                <div class="card-body p-5 text-center">

                                    <!-- Card Heading -->
                                    <div class="d-flex justify-content-center mb-4">
                                        <div
                                            style="background-color: #b22222; width: 80px; height: 80px; border-radius: 18px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-mortarboard text-white" style="font-size: 40px;"></i>
                                        </div>
                                    </div>

                                    <h1 class="fw-bold mb-1" style="font-size: 40px;">Welcome Back!</h1>
                                    <p class="text-dark mb-4" style="font-size: 17px;">Sign in to access your account
                                    </p>

                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        @if($errors->any())
                                        @foreach($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                                            {{ $error }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                        @endforeach
                                        @endif

                                        <!-- Email Address -->
                                        <div class="mb-3 text-start">
                                            <label class="form-label ms-1" style="font-weight: 500;">Email
                                                Address</label>
                                            <div class="input-group shadow-sm"
                                                style="border-radius: 12px; overflow: hidden; border: 1px white;">
                                                <span class="input-group-text border-0"
                                                    style="background-color: #eb5757; color: white; padding: 12px 16px;">
                                                    <i class="bi bi-person-fill"></i>
                                                </span>
                                                <input type="email" class="form-control border-0" name="email"
                                                    placeholder="Email Address" style="padding: 12px;">
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-4 text-start">
                                            <label class="form-label ms-1" style="font-weight: 500;">Password</label>
                                            <div class="input-group shadow-sm"
                                                style="border-radius: 0.8rem; overflow: hidden; border: 1px white;">
                                                <span class="input-group-text border-0"
                                                    style="background-color: #eb5757; color: white; padding: 12px 16px;">
                                                    <i class="bi bi-briefcase-fill"></i>
                                                </span>
                                                <input type="password" class="form-control border-0" name="password"
                                                    placeholder="Password" style="padding: 12px;" id="password">
                                                <span class="input-group-text border-0 bg-white text-muted"
                                                    id="togglePassword">
                                                    <i class="bi bi-eye-slash "></i>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Sign In Button -->
                                        <div class="d-grid mb-4">
                                            <button type="submit" class="btn text-white fw-bold py-2 shadow-sm"
                                                style="background-color: #b22222; border-radius: 12px; font-size: 18px;">
                                                Sign In
                                            </button>
                                        </div>
                                    </form>

                                    <p class="px-4" style="font-size: 12px; line-height: 1.4; color: #333;">
                                        By using this service, you understood and agree to the PUP Online Services
                                        <a href="https://www.pup.edu.ph/terms/"
                                            class="text-danger text-decoration-none">Terms
                                            of Use</a> and
                                        <a href="https://www.pup.edu.ph/privacy/"
                                            class="text-danger text-decoration-none">Privacy Statement</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5 d-none d-lg-flex flex-column align-items-center text-white text-center position-relative"
                style="padding: 40px; overflow: hidden;">

                <!-- Background -->
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('{{ asset('Pup_pic_2.jpg') }}') center/cover; opacity: 0.6; z-index: 1;"></div>
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(139, 0, 0, 0.55); z-index: 2;"></div>

                <div class="position-relative d-flex flex-column justify-content-center flex-grow-1" style="z-index: 3;">
                    <!-- Logo -->
                    <div class="mb-4">
                        <img src="{{ asset('IsKorrections.png') }}" alt="IsKorrections Logo" class="img-fluid" style="width: 320px; filter: drop-shadow(0px 8px 16px rgba(0,0,0,0.4));">
                    </div>

                    <!-- Title -->
                    <h1 class="fw-bold mb-3 display-2 lh-1" style="letter-spacing: 1px; text-shadow: 3px 3px 6px #361717;">
                        IsKorrections
                    </h1>

                    <h2 class="fw-semibold mb-5 h4" style="text-shadow: 2px 2px 4px #361717;">
                        Student Conduct & Discipline<br>Management System
                    </h2>
                </div>

                <!-- Tagline -->
                <div class="position-relative mb-4" style="z-index: 3;">
                    <p class="fw-bold fst-italic fs-5 mb-0" style="text-shadow: 2px 2px 4px #361717;">
                        "Mula Sa 'Yo, Para Bayan"
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>