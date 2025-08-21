<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="صفحة دخول/تسجيل">
    <title>تسجيل الدخول | لوحة التحكم</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:400;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --accent1: #ff7f32;
            --accent2: #ffb347;
            --bg-gradient-start: #fff7ef;
            --card-bg: #ffffff;
            --muted: #6b6b6b;
            --radius-lg: 18px;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: "Inter", "Poppins", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(135deg, rgba(255,179,71,0.12) 0%, rgba(255,127,50,0.06) 100%);
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            direction: rtl;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px;
            box-sizing: border-box;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            box-shadow: 0 10px 30px rgba(16,16,16,0.08);
            padding: 32px;
            box-sizing: border-box;
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .auth-card:hover{
            transform: translateY(-4px);
            box-shadow: 0 18px 46px rgba(16,16,16,0.12);
        }

        .auth-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
            margin-bottom: 18px;
        }

        .auth-logo {
            width: 72px;
            height: 72px;
            border-radius: 14px;
            object-fit: cover;
            box-shadow: 0 6px 20px rgba(255,127,50,0.08);
            border: 2px solid rgba(255,127,50,0.06);
            background: linear-gradient(180deg, rgba(255,127,50,0.06), rgba(255,183,71,0.03));
            padding: 8px;
        }

        .brand-text {
            text-align: center;
        }

        .brand-name {
            font-weight: 700;
            color: var(--accent1);
            font-size: 1.2rem;
            letter-spacing: .2px;
        }

        .brand-tag {
            display:block;
            font-size: 0.85rem;
            color: var(--muted);
            margin-top: 2px;
            font-weight: 500;
        }

        .auth-title {
            font-size: 1.18rem;
            font-weight: 700;
            color: #222;
            margin: 6px 0 18px 0;
            text-align: center;
        }
        .auth-sub {
            text-align:center;
            color: var(--muted);
            font-size: .95rem;
            margin-bottom: 18px;
        }

        .auth-card form {
            display: grid;
            gap: 12px;
        }

        .form-group { width: 100%; }

        .form-control {
            border-radius: 10px;
            border: 1px solid #eef0f2;
            background: #fbfbfb;
            color: #222;
            font-size: 0.975rem;
            padding: 12px 14px;
            width: 100%;
            box-sizing: border-box;
            transition: border-color .16s, box-shadow .16s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent2);
            box-shadow: 0 6px 20px rgba(255,183,71,0.08);
            background: #fff;
        }

        .btn-auth {
            background: linear-gradient(90deg, var(--accent1) 0%, var(--accent2) 100%);
            color: #fff;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 1rem;
            cursor: pointer;
            transition: transform .12s ease;
        }
        .btn-auth:hover { transform: translateY(-2px); }

        .auth-links {
            display:flex;
            justify-content: space-between;
            align-items: center;
            gap:12px;
            margin-top:6px;
            font-size: .95rem;
            color: var(--muted);
        }

        .auth-links a {
            color: var(--accent1);
            text-decoration: none;
            font-weight: 600;
        }
        .auth-links a:hover { color: var(--accent2); text-decoration: underline; }

        .divider {
            display:flex;
            align-items:center;
            gap:12px;
            margin: 14px 0;
            color: #adb0b6;
            font-size: .9rem;
        }
        .divider::before, .divider::after {
            content: "";
            flex:1;
            height:1px;
            background: linear-gradient(90deg, rgba(0,0,0,0.04), rgba(0,0,0,0.02));
            border-radius: 2px;
        }

        /* footer small note */
        .auth-footer {
            text-align:center;
            margin-top: 10px;
            font-size: .87rem;
            color: #9aa0a6;
        }

        /* responsive */
        @media (max-width: 520px){
            .auth-card { padding: 22px; border-radius: 14px; }
            .auth-logo { width: 60px; height: 60px; }
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="auth-card" role="main" aria-labelledby="auth-heading">
            <div class="auth-brand">
                <a href="/">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="auth-logo">
                </a>
            </div>

            <header>
                <h1 id="auth-heading" class="auth-title">مرحبًا بعودتك</h1>
                <div class="auth-sub">سجّل دخولك لبدء إدارة متجرك الإلكتروني</div>
            </header>

            @yield('content')

            <div class="auth-footer">
                © {{ date('Y') }} حقوق الملكية محفوظة
            </div>
        </div>
    </div>
</body>

</html>
