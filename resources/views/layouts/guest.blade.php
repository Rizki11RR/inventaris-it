<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
            min-height: 100vh;
        }
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .auth-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            padding: 40px;
            width: 100%;
            max-width: 440px;
        }
        .auth-brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .auth-brand img {
            height: 72px;
            width: auto;
            margin-bottom: 16px;
        }
        .auth-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1E293B;
            margin-bottom: 4px;
        }
        .auth-subtitle {
            font-size: 0.875rem;
            color: #64748B;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            {{ $slot }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
