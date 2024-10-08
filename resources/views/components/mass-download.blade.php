<div id='mass-container' class='d-none fixed-bottom'>
  <form id='form' method='POST' action="{{ env('BASE_PATH') }}/mass" class='d-flex w-100'>
    <button type='button' class='btn btn-danger delete me-auto' data-names="" title='Удалить выбранные' data-bs-toggle="modal" data-bs-target="#deleteModal">
      <i class="bi-trash" style="font-size:1.3rem"></i>
    </button>


    <div class="align-self-center mx-3">
      Выделено: <span class='count'></span>
    </div>

    <input type='hidden' name='csrf_name' value='{{ $csrf_name }}' />
    <input type='hidden' name='csrf_value' value='{{ $csrf_value }}' />
    <input type='hidden' name='files' />

    <button class='btn btn-dark download' title='Скачать выбранные'>
      <i class="bi-download"></i>
    </button>
  </form>
</div>

<script>
  function filesStr(count) {
    if (count % 100 >= 11 && count % 100 <= 14) return 'файлов';

    if (count % 10 === 1) return 'файл';
    if (count % 10 === 2) return 'файла';
    if (count % 10 === 3) return 'файла';
    if (count % 10 === 4) return 'файла';

    return 'файлов';
  }

  // Handle checks
  document.querySelectorAll('input.check').forEach(item => {
    item.addEventListener('change', event => {
      const count = document.querySelectorAll('input.check:checked').length;
      document.querySelector('#mass-container .count').textContent = count + ' ' + filesStr(count);
      document.querySelector('#mass-container').classList.toggle('d-none', !count);
    });
  });

  // Handle mass download
  document.querySelector('#mass-container .download').addEventListener('click', event => {
    const files = [];
    document.querySelectorAll('input.check:checked').forEach(item => {
      files.push(item.id);
    });

    document.querySelector('#mass-container input[name=files]').value = JSON.stringify(files);
  });

  // Handle mass delete
  document.querySelector('#mass-container .delete').addEventListener('mousedown', event => {
    const files = [];
    document.querySelectorAll('input.check:checked').forEach(item => {
      files.push(item.id);
    });

    document.querySelector('#mass-container .delete').setAttribute('data-names', JSON.stringify(files));
  });
</script>