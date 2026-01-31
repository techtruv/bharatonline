<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bharat Online - Login</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- UIL Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Google reCAPTCHA v3 -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <!-- Custom Login Styles -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/login-styles.css') }}">
    
    <style>
        html, body {
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="login-card">
            <!-- Header with Logo -->
            <div class="login-header">
                <div class="login-logo">
                    <i class="uil uil-truck-side"></i>
                </div>
                <h1 class="login-title">Bharat Online</h1>
                <p class="login-subtitle">Transport & Logistics Management</p>
            </div>

            <!-- Login Form -->
            <div class="login-form">
                <!-- Alert Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="uil uil-exclamation-circle"></i>
                        <div>
                            <strong>Login Failed!</strong>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="uil uil-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        <i class="uil uil-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('loginPost') }}" method="POST" id="loginForm">
                    @csrf

                    <!-- Session Warning (if exists) -->
                    @if (session('session_warning'))
                        <div class="alert alert-warning" role="alert">
                            <i class="uil uil-info-circle"></i>
                            <strong>Session Timeout!</strong> Your session expired. Please login again.
                        </div>
                    @endif

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="uil uil-envelope"></i>
                            Email Address
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            placeholder="Enter your email address"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                        @error('email')
                            <div class="invalid-feedback">
                                <i class="uil uil-info-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="uil uil-lock"></i>
                            Password
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            placeholder="Enter your password"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">
                                <i class="uil uil-info-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <!-- Session Selection -->
                    <div class="form-group">
                        <label for="session_id" class="form-label">
                            <i class="uil uil-calendar-alt"></i>
                            Select Session
                        </label>
                        <select 
                            id="session_id" 
                            name="session_id" 
                            class="form-control @error('session_id') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Choose a session --</option>
                            @if(isset($sessions) && count($sessions) > 0)
                                @foreach($sessions as $session)
                                    <option value="{{ $session->id }}" 
                                        {{ old('session_id') == $session->id ? 'selected' : '' }}>
                                        {{ $session->session_name }} 
                                      </option>
                                @endforeach
                            @else
                                <option value="" disabled>No sessions available</option>
                            @endif
                        </select>
                        @error('session_id')
                            <div class="invalid-feedback d-block">
                                <i class="uil uil-info-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" id="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-password">Forgot password?</a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="login-btn">
                        <i class="uil uil-sign-in-alt"></i>
                        Sign In
                    </button>
                </form>
            </div>

            <!-- Footer with Signup Link -->
            <div class="signup-link">
                Don't have an account? <a href="{{ route('register') }}">Create one now</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Form validation on submit
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const sessionId = document.getElementById('session_id').value.trim();

            // Check all fields
            if (!email || !password || !sessionId) {
                e.preventDefault();
                alert('Please fill in all fields');
                return false;
            }

            // Validate email format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                document.getElementById('email').classList.add('is-invalid');
                return false;
            }
        });

        // Clear error class on input
        document.getElementById('email').addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });

        document.getElementById('password').addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });

        document.getElementById('session_id').addEventListener('change', function() {
            this.classList.remove('is-invalid');
        });

        // Show/Hide password toggle (optional)
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }
    </script>
</body>
</html>