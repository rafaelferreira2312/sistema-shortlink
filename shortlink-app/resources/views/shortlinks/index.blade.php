@extends('layouts.app')

@section('content')
  <div id="app" class="flex items-center justify-center h-screen bg-gray-200">
    <div class="w-full max-w-md">
      <shortlink-form></shortlink-form>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="{{ mix('js/app.js') }}" defer></script>
@endpush


