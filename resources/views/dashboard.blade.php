@extends('layouts.app')

@section('content')
  <h1>لوحة التحكم</h1>

  @if(session('status'))
    <div class="card">{{ session('status') }}</div>
  @endif

  <div class="card">
    <h3>إرسال إشعار إنشاء مستخدم</h3>
    <form method="POST" action="{{ route('users.store') }}">
      @csrf
      <div style="display:grid; grid-template-columns:1fr 1fr; gap: 12px">
        <div>
          <label>الاسم</label>
          <input name="name" required>
        </div>
        <div>
          <label>البريد</label>
          <input name="email" type="email" required>
        </div>
      </div>
      <div style="margin-top:8px">
        <label>كلمة المرور</label>
        <input name="password" type="password" required>
      </div>
      <button class="btn" type="submit" style="margin-top:10px">إنشاء</button>
    </form>
  </div>

  <div class="card">
    <h3>آخر الإشعارات</h3>
    <div id="notifications"></div>
  </div>

  <div class="card">
    <a class="btn" href="{{ route('posts.create') }}">إنشاء منشور جديد</a>
  </div>

  @push('scripts')
  <script>
    const list = document.getElementById('notifications');
    const pushNotif = (payload) => {
      const el = document.createElement('div');
      el.className = 'card';
      el.innerHTML = '<span class="badge">جديد</span> ' + (payload.message || JSON.stringify(payload));
      list.prepend(el);
    };

    // Listen for admin and user channels
    @auth
      @if(auth()->user()->isAdmin())
        window.Echo.private('admins')
          .notification((payload) => pushNotif(payload));
      @endif

      window.Echo.private('users.{{ auth()->id() }}')
        .notification((payload) => pushNotif(payload));
    @endauth
  </script>
  @endpush
@endsection
