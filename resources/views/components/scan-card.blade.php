<div class='card bg-dark flex-grow-1 scan-card' style='max-width:300px; max-height:300px'>
  <div class='card-body d-flex flex-column'>
    <div class='card-title mb-3'>
      <button class='btn btn-outline-danger float-right' data-name="{{ $scan['file'] }}" data-url="{{ env('BASE_PATH') }}/delete/{{ $scan['file']}}" title='Удалить' data-bs-toggle="modal" data-bs-target="#deleteModal">
        <i class="bi-trash" style="font-size:1.3rem"></i>
      </button>
      <h4 class='mt-1'>{{ $scan['file'] }}</h4>
    </div>

    <div class='card-text flex-fill d-flex flex-column'>
      <a class='d-flex flex-fill' href="{{ env('BASE_PATH') }}/preview/{{ $scan['file']}}" target='_blank'>
        @if($scan['is_pdf'])
        @if($scan['prev'])
        <div class='preview' style="background-image: url({{ env('BASE_PATH') }}/preview/{{ $scan['prev']}})"></div>
        @else
        <div class='preview my-4 mx-4' style="background-image: url({{ env('BASE_PATH') }}/pdf.png"></div>
        @endif
        @else
        <div class='preview' style="background-image: url({{ env('BASE_PATH') }}/preview/{{ $scan['file']}})"></div>
        @endif
      </a>

      <div class='mt-3 d-flex justify-content-between'>
        <div class='datetime'>
          <div>{{ $scan['date'] }}</div>
          <div>{{ $scan['time'] }}</div>
        </div>

        <div>
          <a class='btn btn-outline-info' href="{{ env('BASE_PATH') }}/download/{{ $scan['file']}}" title='Скачать'>
            <i class="bi-download" style="font-size:1.3rem"></i>
          </a>

          <button class='btn btn-outline-info share' data-name="{{ $scan['file'] }}" data-url="{{ env('BASE_PATH') }}/download/{{ $scan['file']}}" title='Поделиться'>
            <i class="bi-share" style="font-size:1.3rem"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>