<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'NotifApp') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Tajawal', sans-serif; background:#0f172a; color:#e2e8f0; }
    .container { max-width: 980px; margin: 2rem auto; padding: 1rem; }
    .card { background:#111827; border:1px solid #1f2937; border-radius: 16px; padding: 1rem 1.25rem; margin-bottom: 1rem; }
    .btn { padding: .6rem 1rem; border-radius: 12px; border:1px solid #334155; background:#1f2937; color:#e2e8f0; cursor:pointer }
    input, textarea { width:100%; padding:.6rem .8rem; border-radius: 12px; background:#0b1220; color:#e2e8f0; border:1px solid #25324a; }
    label { color:#93c5fd; font-size:.95rem }
    h1,h2,h3 { color:#bfdbfe }
    .badge { display:inline-block; background:#0b5; color:white; padding:.25rem .6rem; border-radius:999px; font-size:.75rem }
  </style>
  <!-- Echo & Pusher (client) via CDN -->
  <script src="https://cdn.jsdelivr.net/npm/pusher-js@8.4.0/dist/web/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.16.1/dist/echo.iife.js"></script>
</head>
<body>
  <div class="container">
    @yield('content')
  </div>

  <script>
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Laravel Echo over local WebSockets server
    window.Echo = new Echo({
      broadcaster: 'pusher',
      key: '{{ env('PUSHER_APP_KEY', 'local') }}',
      cluster: '{{ env('PUSHER_APP_CLUSTER', 'mt1') }}',
      wsHost: '{{ env('LARAVEL_WEBSOCKETS_HOST', request()->getHost()) }}',
      wsPort: Number('{{ env('LARAVEL_WEBSOCKETS_PORT', 6001) }}'),
      forceTLS: false,
      disableStats: true,
      enabledTransports: ['ws', 'wss'],
      auth: {
        headers: {
          'X-CSRF-TOKEN': csrf
        }
      }
    });
  </script>
  @stack('scripts')
</body>
</html>
