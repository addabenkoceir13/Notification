@extends('layouts.app')

@section('content')
  <h2>إنشاء منشور</h2>
  <form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <div class="card">
      <label>العنوان</label>
      <input name="title" required>
    </div>
    <div class="card">
      <label>المحتوى</label>
      <textarea name="body" rows="5" required></textarea>
    </div>
    <button class="btn" type="submit">حفظ</button>
  </form>
@endsection
