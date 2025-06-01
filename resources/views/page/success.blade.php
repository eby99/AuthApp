<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success - Welcome!</title>
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

        .success-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            padding: 3rem;
            text-align: center;
            max-width: 500px;
            width: 90%;
            position: relative;
            overflow: hidden;
            animation: slideUp 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .success-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #34d399, #22c55e, #16a34a);
            background-size: 300% 100%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .success-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #10b981, #34d399);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: successBounce 1.5s ease-out;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
        }

        @keyframes successBounce {
            0% { 
                transform: scale(0) rotate(0deg);
                opacity: 0;
            }
            50% { 
                transform: scale(1.2) rotate(180deg);
                opacity: 0.8;
            }
            100% { 
                transform: scale(1) rotate(360deg);
                opacity: 1;
            }
        }

        .checkmark {
            animation: checkmarkDraw 0.8s ease-out 0.5s both;
        }

        @keyframes checkmarkDraw {
            0% { stroke-dasharray: 0 50; }
            100% { stroke-dasharray: 50 0; }
        }

        .success-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #2d3748, #4a5568);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            animation: titleFade 1s ease-out 0.3s both;
        }

        @keyframes titleFade {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-message {
            font-size: 1.2rem;
            color: #64748b;
            margin-bottom: 2.5rem;
            line-height: 1.6;
            animation: messageFade 1s ease-out 0.6s both;
        }

        @keyframes messageFade {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-info {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid #10b981;
            animation: infoBounce 1s ease-out 0.9s both;
        }

        @keyframes infoBounce {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .user-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .user-email {
            color: #64748b;
            font-size: 1rem;
        }

        .back-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            overflow: hidden;
            animation: buttonSlide 1s ease-out 1.2s both;
        }

        @keyframes buttonSlide {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .back-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .back-btn:hover::before {
            left: 100%;
        }

        .back-btn:active {
            transform: translateY(-1px);
        }

        .back-icon {
            transition: transform 0.3s ease;
        }

        .back-btn:hover .back-icon {
            transform: translateX(-3px);
        }

        /* Logout button styling */
        .logout-btn {
            background: linear-gradient(135deg, #ef4444, #f87171);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-top: 1rem;
            opacity: 0.8;
        }

        .logout-btn:hover {
            opacity: 1;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
        }

        @media (max-width: 480px) {
            .success-container {
                margin: 1rem;
                padding: 2rem 1.5rem;
            }
            
            .success-title {
                font-size: 2rem;
            }
            
            .success-message {
                font-size: 1.1rem;
            }
            
            .back-btn {
                padding: 14px 28px;
                font-size: 1rem;
            }
        }
    </style>
</head>

@php
    use Illuminate\Support\Facades\Auth;
@endphp

<body>
    <div class="success-container">
        <div class="success-icon">
            <svg class="checkmark" width="45" height="45" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h1 class="success-title">Welcome!</h1>
        
        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @else
            <p class="success-message">You have successfully logged in to your account.</p>
        @endif

        @if(Auth::check())
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>
            <div class="user-email">{{ Auth::user()->email }}</div>
        </div>
        @endif
        
        <a href="{{ route('home') }}" class="back-btn">
            <svg class="back-icon" width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
            </svg>
            Back to Login
        </a>

        <!-- Optional logout button -->
        <br>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                </svg>
                Logout
            </button>
        </form>
    </div>
</body>
</html>