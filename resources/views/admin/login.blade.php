<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e2937 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px 35px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .login-card h1 {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-card p {
            text-align: center;
            color: #94a3b8;
            margin-bottom: 30px;
            font-size: 15px;
        }

        .admin-badge {
            text-align: center;
            margin-bottom: 20px;
        }

        .admin-badge span {
            background: #3b82f6;
            color: white;
            padding: 5px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        input {
            width: 100%;
            padding: 16px 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            color: white;
            font-size: 15px;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        button {
            height: 56px;
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.4);
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
            color: #94a3b8;
            font-size: 14px;
        }

        .signup-link a {
            color: #60a5fa;
            text-decoration: none;
        }

        .error-box {
            background: rgba(248, 113, 113, 0.15);
            border: 1px solid rgba(248, 113, 113, 0.3);
            color: #f87171;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            
            <div class="admin-badge">
                <span>🔐 ADMIN LOGIN</span>
            </div>

            <h1>Welcome Back</h1>
            <p>Sign in to access admin dashboard</p>

            <!-- Error Messages -->
            @if(session('error'))
                <div class="error-box">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-box">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}">
                @csrf

                <input 
                    type="email" 
                    name="email" 
                    placeholder="Admin Email Address" 
                    value="{{ old('email') }}" 
                    required>

                <input 
                    type="password" 
                    name="password" 
                    placeholder="Password" 
                    required>

                <button type="submit">
                    Login to Dashboard
                </button>
            </form>

           
        </div>
    </div>

    <script>
        // Auto hide error message after 5 seconds
        setTimeout(() => {
            const errorBox = document.querySelector('.error-box');
            if (errorBox) {
                errorBox.style.transition = 'opacity 0.5s';
                errorBox.style.opacity = '0';
                setTimeout(() => errorBox.remove(), 500);
            }
        }, 5000);
    </script>

</body>
</html>