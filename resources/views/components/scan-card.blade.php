<div class='card bg-dark flex-grow-1 scan-card overflow-hidden'>
  <div class='card-body d-flex flex-column overflow-hidden'>
    <div class='card-title mb-3'>
      <button class='btn btn-outline-danger float-right' data-name="{{ $scan['file'] }}" data-url="{{ env('BASE_PATH') }}/delete/{{ $scan['file']}}" title='Удалить' data-bs-toggle="modal" data-bs-target="#deleteModal">
        <i class="bi-trash" style="font-size:1.3rem"></i>
      </button>
      <div class='form-check'>
        <input class="form-check-input check" type="checkbox" id="{{ $scan['file'] }}" autocomplete="off">
        <label for="{{ $scan['file'] }}">{{ $scan['file'] }}</h4>
      </div>
    </div>

    <div class='card-text flex-fill d-flex flex-column overflow-hidden'>
      <div class='d-flex flex-fill align-items-center align-self-center overflow-hidden'>
        <a href="{{ env('BASE_PATH') }}/preview/{{ $scan['file']}}" target='_blank' style='display:contents'>
          @if($scan['is_pdf'])
          @if(isset($scan['prev']))
          <img class='preview' src="{{ env('BASE_PATH') }}/preview/{{ $scan['prev']}}" />
          @else
          <img class='preview' src="{{ env('BASE_PATH') }}/pdf.png" />
          <!-- <div class='preview my-4 mx-4' style="background-image: url({{ env('BASE_PATH') }}/pdf.png"></div> -->
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

          <button class='btn btn-outline-info share' data-name="{{ $scan['file'] }}" data-url="{{ env('BASE_PATH') }}/download/{{ $scan['file']}}" title='Поделиться'>
            <i class="bi-share" style="font-size:1.3rem"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>