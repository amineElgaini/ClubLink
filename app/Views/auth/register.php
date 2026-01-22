<style>
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .register-container {
            width: 100%;
            max-width: 420px;
        }

        .register-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        .register-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .register-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .register-header h2 {
            color: #fff;
            font-size: 1.75rem;
            font-weight: 900;
            margin: 0 0 8px 0;
            letter-spacing: -0.033em;
        }

        .register-header p {
            color: #94a3b8;
            margin: 0;
            font-size: 0.9rem;
        }

        .register-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            color: #cbd5e1;
            font-size: 0.875rem;
            font-weight: 600;
            margin-left: 4px;
        }

        .form-group input {
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 10px;
            padding: 12px 16px;
            color: #fff;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-group input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-group input::placeholder {
            color: #64748b;
        }

        .register-button {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border: none;
            border-radius: 10px;
            padding: 14px 24px;
            color: #fff;
            font-size: 0.9375rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }

        .register-button:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            padding: 16px;
            background: rgba(13, 127, 242, 0.05);
            border: 1px solid rgba(13, 127, 242, 0.1);
            border-radius: 10px;
            margin-top: 24px;
        }

        .login-link p {
            margin: 0;
            color: #94a3b8;
            font-size: 0.875rem;
        }

        .login-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s ease;
        }

        .login-link a:hover {
            color: #60a5fa;
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 32px 24px;
            }

            .register-header h2 {
                font-size: 1.5rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>

<div class="container">
        <div class="register-container">
            <div class="register-card">
                <div class="register-header">
                    <div class="register-icon">✨</div>
                    <h2>Create Account</h2>
                    <p>Join us today and get started</p>
                </div>

                <form method="POST" action="./register" class="register-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" placeholder="John" required>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" placeholder="Doe" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="you@example.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Create a strong password" required>
                    </div>

                    <button type="submit" class="register-button">Create Account</button>
                </form>

                <div class="login-link">
                    <p>Already have an account? <a href="./login">Sign in here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>