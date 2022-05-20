@extends('layouts.app')

@section('content')

<div class='d-flex justify-content-center'>
  <div class='card bg-dark flex-grow-1' style='max-width:350px'>
    <div class='card-body'>
      <h3 class='card-title mb-4 text-center'>Login</h3>
      <div class='card-text'>
        <form id='form' method='POST' action="{{ env('BASE_PATH') }}/login">
          <input type='hidden' name='csrf_name' value='{{ $csrf_name }}' />
          <input type='hidden' name='csrf_value' value='{{ $csrf_value }}' />

          @if($error)
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="bi-exclamation-triangle-fill me-2" style="font-size:1.3rem"></i>
            <div>
              {{$error}}
            </div>
          </div>
          @endif

          <div class=" mb-3">
            <input type='text' class="form-control" name='username' placeholder="Имя пользователя" autocomplete="on" required />
          </div>

          <div class="mb-4">
            <input type='password' class="form-control" name='password' placeholder="Пароль" autocomplete="on" required />
          </div>
        </form>

        <hr class='mx-4' />

        <div class='d-grid mt-4'>
          <button form='form' class='btn btn-light btn-lg btn-block'>Enter</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection