<div class='card bg-dark flex-grow-1 scan-card'>
  <div class='card-body d-flex flex-column'>
    <div class='card-title d-flex mb-3'>
      <div class='form-check align-self-center'>
        <input class="form-check-input check" type="checkbox" id="{{ $scan['file'] }}" autocomplete="off">
        <label for="{{ $scan['file'] }}">{{ $scan['file'] }}</h4>
      </div>

      <button class='btn btn-outline-danger float-right ms-auto' data-names='["{{ $scan["file"] }}"]' title='Удалить' data-bs-toggle="modal" data-bs-target="#deleteModal">
        <i class="bi-trash" style="font-size:1.3rem"></i>
      </button>
    </div>

    <div class='card-text flex-fill d-flex flex-column'>
      <div class='d-flex flex-fill align-items-center align-self-center'>
        <a href="{{ env('BASE_PATH') }}/preview/{{ $scan['file']}}" target='_blank' title="Просмотр">
          @if($scan['is_pdf'])
          @if(isset($scan['prev']))
          <img class='preview' src="{{ env('BASE_PATH') }}/preview/{{ $scan['prev']}}" />
          @else
          <img class='preview' src="{{ env('BASE_PATH') }}/pdf.png" />
          @endif
          @else
          <img class='preview' src="{{ env('BASE_PATH') }}/preview/{{ $scan['file']}}" />
          @endif
        </a>
      </div>

      <div class='mt-3 d-flex justify-content-between'>
        <div class='datetime'>
          <div>{{ $scan['date'] }}</div>
          <div>{{ $scan['time'] }}</div>
        </div>

        <div>
          <a class='btn btn-outline-info me-1' href="{{ env('BASE_PATH') }}/download/{{ $scan['file']}}" title='Скачать'>
            <i class="bi-download" style="font-size:1.3rem"></i>
          </a>

          <button class='btn btn-outline-info share d-none' data-name="{{ $scan['file'] }}" data-url="{{ env('BASE_PATH') }}/download/{{ $scan['file']}}" title='Поделиться'>
            <i class="bi-share" style="font-size:1.3rem"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>