@extends('layouts.app')

@section('content')

<div class='d-flex flex-wrap gap-3 mx-2 mx-md-5 justify-content-center'>
  @foreach ($scans as $scan)
  @include('components.scan-card', ['scan' => $scan])
  @endforeach
</div>

@include('components.delete-dialog')
@include('components.mass-download')


<script>
  // Enable share buttons
  if (navigator.share) {
    document.querySelectorAll('button.share').forEach(item => {
      item.classList.remove('d-none');
    });
  }

  // Handle share buttons
  document.querySelectorAll('button.share').forEach(item => {
    item.addEventListener('click', event => {
      navigator.share({
        title: item.dataset.name,
        url: item.dataset.url
      });
    });
  });
</script>
@endsection