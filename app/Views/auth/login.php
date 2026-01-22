<style>
    .container {
        /* background: #0f172a !important;
        color: #fff;
        min-height: 100vh; */
        display: flex;
        align-items: center;
        justify-content: center;
        /* margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; */
    }
    
    .login-container {
        width: 100%;
        max-width: 420px;
        padding: 20px;
    }

    .login-card {
        background: #1e293b;
        border: 1px solid #334155;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    }

    .login-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .login-icon {
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

    .login-header h2 {
        color: #fff;
        font-size: 1.75rem;
        font-weight: 900;
        margin: 0 0 8px 0;
        letter-spacing: -0.033em;
    }

    .login-header p {
        color: #94a3b8;
        margin: 0;
        font-size: 0.9rem;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
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

    .login-button {
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

    .login-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
    }

    .login-button:active {
        transform: translateY(0);
    }

    .divider {
        text-align: center;
        margin: 24px 0;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background: #334155;
    }

    .divider span {
        background: #1e293b;
        padding: 0 16px;
        color: #64748b;
        font-size: 0.8125rem;
        position: relative;
        z-index: 1;
    }

    .register-link {
        text-align: center;
        padding: 16px;
        background: rgba(13, 127, 242, 0.05);
        border: 1px solid rgba(13, 127, 242, 0.1);
        border-radius: 10px;
        margin-top: 24px;
    }

    .register-link p {
        margin: 0;
        color: #94a3b8;
        font-size: 0.875rem;
    }

    .register-link a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 700;
        transition: color 0.2s ease;
    }

    .register-link a:hover {
        color: #60a5fa;
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 32px 24px;
        }

        .login-header h2 {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container">

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <div class="login-icon">🔐</div>
            <h2>Welcome Back</h2>
            <p>Sign in to your account to continue</p>
        </div>

        <form method="POST" action="./login" class="login-form">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="login-button">Sign In</button>
        </form>

        <div class="register-link">
            <p>Don't have an account? <a href="./register">Create one now</a></p>
        </div>
    </div>
</div>
</div>
