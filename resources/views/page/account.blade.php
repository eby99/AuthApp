<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Login & Register</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated background particles */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(120deg); }
            66% { transform: translateY(10px) rotate(240deg); }
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
            position: relative;
            overflow: hidden;
            animation: slideUp 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 300% 100%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .title {
            text-align: center;
            margin-bottom: 2rem;
            color: #2d3748;
        }

        .title h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        @keyframes textGlow {
            from { filter: brightness(1); }
            to { filter: brightness(1.2); }
        }

        .subtitle {
            color: #64748b;
            font-size: 1.1rem;
            font-weight: 400;
        }

        .form-tabs {
            display: flex;
            background: #f8fafc;
            border-radius: 12px;
            padding: 6px;
            margin-bottom: 2rem;
            position: relative;
        }

        .tab-btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            background: transparent;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            z-index: 2;
        }

        .tab-btn.active {
            color: white;
            transform: scale(1.02);
        }

        .tab-indicator {
            position: absolute;
            top: 6px;
            left: 6px;
            width: calc(50% - 6px);
            height: calc(100% - 12px);
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 8px;
            transition: transform 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .tab-indicator.register {
            transform: translateX(100%);
        }

        .form-container {
            position: relative;
            overflow: hidden;
        }

        .form {
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .form.hidden {
            opacity: 0;
            transform: translateX(-20px);
            pointer-events: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            color: #2d3748;
        }

        .form-group.password-field {
            position: relative;
        }

        .form-group.password-field input {
            padding-right: 55px;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 16px;
            background: none;
            border: none;
            cursor: pointer;
            color: #64748b;
            font-size: 1.1rem;
            transition: color 0.3s ease;
            z-index: 10;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-group input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .form-group input:focus + .form-label,
        .form-group input:not(:placeholder-shown) + .form-label {
            transform: translateY(-35px) scale(0.85);
            color: #667eea;
        }

        .form-group.password-field input:focus + .password-toggle + .form-label,
        .form-group.password-field input:not(:placeholder-shown) + .password-toggle + .form-label {
            transform: translateY(-35px) scale(0.85);
            color: #667eea;
        }

        .form-label {
            position: absolute;
            top: 16px;
            left: 20px;
            color: #64748b;
            font-size: 1rem;
            font-weight: 500;
            pointer-events: none;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            background: white;
            padding: 0 8px;
            margin-left: -8px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .checkbox-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .checkbox-wrapper input[type="checkbox"] {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .checkmark {
            width: 24px;
            height: 24px;
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            position: relative;
            transition: all 0.3s ease;
            background: white;
        }

        .checkbox-wrapper input:checked + .checkmark {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-color: #667eea;
            transform: scale(1.1);
        }

        .checkmark::after {
            content: '';
            position: absolute;
            left: 7px;
            top: 3px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg) scale(0);
            transition: transform 0.2s ease;
        }

        .checkbox-wrapper input:checked + .checkmark::after {
            transform: rotate(45deg) scale(1);
        }

        .checkbox-label {
            color: #64748b;
            font-weight: 500;
            margin-left: 8px;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .messages {
            margin-bottom: 1.5rem;
        }

        .message {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 8px;
            font-weight: 500;
            animation: messageSlide 0.5s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @keyframes messageSlide {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .message.success {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .message.error {
            background: linear-gradient(135deg, #ef4444, #f87171);
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .message.info {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .message-icon {
            font-size: 1.2rem;
        }

        .error-list {
            list-style: none;
        }

        .error-list li {
            padding: 8px 16px;
            background: linear-gradient(135deg, #ef4444, #f87171);
            color: white;
            border-radius: 8px;
            margin-bottom: 6px;
            animation: errorBounce 0.5s ease;
        }

        @keyframes errorBounce {
            0% { transform: scale(0.8); opacity: 0; }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); opacity: 1; }
        }

        @media (max-width: 480px) {
            .container {
                margin: 1rem;
                padding: 2rem 1.5rem;
            }
            
            .title h1 {
                font-size: 2rem;
            }
        }

        /* Loading animation */
        .loading {
            pointer-events: none;
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Fade out animation for messages */
        .message.fade-out {
            animation: fadeOut 0.5s ease forwards;
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateX(-20px);
            }
        }

        .field-error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            margin-left: 0.5rem;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">
            <h1>Welcome</h1>
            <p class="subtitle">Sign in to your account or create a new one</p>
        </div>

        <!-- Messages Section -->
        <div class="messages">
            <!-- Success Message -->
            <div class="message success" style="display: none;" id="successMessage">
                <span class="message-icon">✓</span>
                <span id="successText"></span>
            </div>

            <!-- Error Message -->
            <div class="message error" style="display: none;" id="errorMessage">
                <span class="message-icon">✕</span>
                <span id="errorText"></span>
            </div>

            <!-- Info Message -->
            <div class="message info" style="display: none;" id="infoMessage">
                <span class="message-icon">ℹ</span>
                <span id="infoText"></span>
            </div>

            <!-- Validation Errors -->
            <ul class="error-list" id="validationErrors" style="display: none;">
                <!-- Validation errors will be inserted here -->
            </ul>
        </div>

        <!-- Form Tabs -->
        <div class="form-tabs">
            <div class="tab-indicator" id="tabIndicator"></div>
            <button class="tab-btn active" id="loginTab" onclick="switchTab('login')">Login</button>
            <button class="tab-btn" id="registerTab" onclick="switchTab('register')">Register</button>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <!-- Login Form -->
            <form class="form" id="loginForm" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder=" " required value="{{ old('email') }}">
                    <label class="form-label">Email Address</label>
                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group password-field">
                    <input type="password" name="password" placeholder=" " required id="loginPassword">
                    <button type="button" class="password-toggle" onclick="togglePassword('loginPassword', this)">👁️</button>
                    <label class="form-label">Password</label>
                    @error('password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                
                <button type="submit" class="submit-btn" id="loginBtn">
                    Sign In
                </button>
            </form>

            <!-- Register Form -->
            <form class="form hidden" id="registerForm" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="firstname" placeholder=" " required value="{{ old('firstname') }}">
                    <label class="form-label">First Name</label>
                    @error('firstname')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <input type="text" name="lastname" placeholder=" " required value="{{ old('lastname') }}">
                    <label class="form-label">Last Name</label>
                    @error('lastname')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <input type="email" name="email" placeholder=" " required value="{{ old('email') }}" id="registerEmail">
                    <label class="form-label">Email Address</label>
                    <span class="field-error" id="emailError" style="display: none;"></span>
                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group password-field">
                    <input type="password" name="password" placeholder=" " required id="registerPassword">
                    <button type="button" class="password-toggle" onclick="togglePassword('registerPassword', this)">👁️</button>
                    <label class="form-label">Password</label>
                    @error('password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group password-field">
                    <input type="password" name="confirm_password" placeholder=" " required id="confirmPassword">
                    <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword', this)">👁️</button>
                    <label class="form-label">Confirm Password</label>
                    @error('confirm_password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="checkbox-group">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="subscribed" value="1" {{ old('subscribed') ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-label">Subscribe to newsletter</label>
                </div>
                
                <button type="submit" class="submit-btn" id="registerBtn">
                    Create Account
                </button>
            </form>
        </div>
    </div>

    <script>
        // Set CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function switchTab(tab) {
            const loginTab = document.getElementById('loginTab');
            const registerTab = document.getElementById('registerTab');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const tabIndicator = document.getElementById('tabIndicator');

            // Clear any existing messages when switching tabs
            clearMessages();

            if (tab === 'login') {
                loginTab.classList.add('active');
                registerTab.classList.remove('active');
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                tabIndicator.classList.remove('register');
                showMessage('info', 'Please enter your credentials to sign in');
            } else {
                registerTab.classList.add('active');
                loginTab.classList.remove('active');
                registerForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
                tabIndicator.classList.add('register');
                showMessage('info', 'Create a new account to get started');
            }
        }

        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Toggle eye icon
            button.textContent = type === 'password' ? '👁️' : '🙈';
        }

        function showMessage(type, text, duration = 5000) {
            clearMessages();
            
            const messageElement = document.getElementById(type + 'Message');
            const textElement = document.getElementById(type + 'Text');
            
            if (messageElement && textElement) {
                textElement.textContent = text;
                messageElement.style.display = 'flex';
                
                // Auto-hide after duration
                setTimeout(() => {
                    hideMessage(type);
                }, duration);
            }
        }

        function showValidationErrors(errors) {
            clearMessages();
            
            const errorList = document.getElementById('validationErrors');
            errorList.innerHTML = '';
            
            errors.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                errorList.appendChild(li);
            });
            
            errorList.style.display = 'block';
            
            // Auto-hide after 6 seconds
            setTimeout(() => {
                errorList.style.display = 'none';
            }, 6000);
        }

        function hideMessage(type) {
            const messageElement = document.getElementById(type + 'Message');
            if (messageElement) {
                messageElement.classList.add('fade-out');
                setTimeout(() => {
                    messageElement.style.display = 'none';
                    messageElement.classList.remove('fade-out');
                }, 500);
            }
        }

        function clearMessages() {
            const messages = ['success', 'error', 'info'];
            messages.forEach(type => {
                const messageElement = document.getElementById(type + 'Message');
                if (messageElement) {
                    messageElement.style.display = 'none';
                }
            });
            
            const errorList = document.getElementById('validationErrors');
            if (errorList) {
                errorList.style.display = 'none';
            }
        }

        // Real-time email validation for registration
        function checkEmailUnique(email) {
            if (!email || email.length < 3) return;
            
            fetch('/check-email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                const emailInput = document.getElementById('registerEmail');
                const emailError = document.getElementById('emailError');
                
                if (!data.available) {
                    emailInput.classList.add('error');
                    emailError.textContent = 'This email address is already registered';
                    emailError.style.display = 'block';
                } else {
                    emailInput.classList.remove('error');
                    emailError.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error checking email:', error);
            });
        }

        // Debounce function to limit API calls
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Add email validation on input
        const debouncedEmailCheck = debounce(checkEmailUnique, 500);
        
        document.getElementById('registerEmail').addEventListener('input', function(e) {
            const email = e.target.value;
            if (email && email.includes('@')) {
                debouncedEmailCheck(email);
            } else {
                const emailError = document.getElementById('emailError');
                emailError.style.display = 'none';
                e.target.classList.remove('error');
            }
        });

        // Login form submission with AJAX
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const loginBtn = document.getElementById('loginBtn');
            const originalText = loginBtn.textContent;
            
            // Show loading state
            loginBtn.classList.add('loading');
            loginBtn.textContent = '';
            loginBtn.disabled = true;
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage('success', data.message || 'Login successful!');
                    
                    // Redirect after successful login
                    setTimeout(() => {
                        window.location.href = data.redirect || '/dashboard';
                    }, 1500);
                } else {
                    if (data.errors) {
                        showValidationErrors(Object.values(data.errors).flat());
                    } else {
                        showMessage('error', data.message || 'Login failed. Please try again.');
                    }
                }
            })
            .catch(error => {
                console.error('Login error:', error);
                showMessage('error', 'An error occurred. Please try again.');
            })
            .finally(() => {
                // Reset button
                loginBtn.classList.remove('loading');
                loginBtn.textContent = originalText;
                loginBtn.disabled = false;
            });
        });

        // Register form submission with AJAX
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const registerBtn = document.getElementById('registerBtn');
            const originalText = registerBtn.textContent;
            
            // Show loading state
            registerBtn.classList.add('loading');
            registerBtn.textContent = '';
            registerBtn.disabled = true;
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage('success', data.message || 'Registration successful!');
                    
                    // Reset form
                    this.reset();
                    
                    // Switch to login tab after 2 seconds
                    setTimeout(() => {
                        switchTab('login');
                        showMessage('info', 'Please enter your credentials to sign in');
                    }, 2000);
                } else {
                    if (data.errors) {
                        showValidationErrors(Object.values(data.errors).flat());
                    } else {
                        showMessage('error', data.message || 'Registration failed. Please try again.');
                    }
                }
            })
            .catch(error => {
                console.error('Registration error:', error);
                showMessage('error', 'An error occurred. Please try again.');
            })
            .finally(() => {
                // Reset button
                registerBtn.classList.remove('loading');
                registerBtn.textContent = originalText;
                registerBtn.disabled = false;
            });
        });

        // Handle form input animations
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Show initial welcome message
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                showMessage('info', 'Please enter your credentials to sign in');
            }, 500);
        });

        // Handle Laravel validation errors from server
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                const errors = @json($errors->all());
                showValidationErrors(errors);
                
                @if(old('firstname') || old('lastname') || old('email'))
                    switchTab('register');
                @endif
            });
        @endif

        // Handle success messages from server
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                showMessage('success', '{{ session("success") }}');
            });
        @endif

        // Handle error messages from server
        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                showMessage('error', '{{ session("error") }}');
            });
        @endif

        // Disable register button if email is already taken
        document.getElementById('registerForm').addEventListener('input', function(e) {
            const registerBtn = document.getElementById('registerBtn');
            const emailInput = document.getElementById('registerEmail');
            
            if (emailInput.classList.contains('error')) {
                registerBtn.disabled = true;
            } else {
                registerBtn.disabled = false;
            }
        });
    </script>
</body>
</html>