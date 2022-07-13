<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-secondary">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Подтверждение</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Вы точно хотите удалить файл<span class='multiple'>ы:</span> <span class='filenames'></span>?
        <form id='dm_form' method='POST' action="{{ env('BASE_PATH') }}/delete">
          <input type='hidden' name='csrf_name' value='{{ $csrf_name }}' />
          <input type='hidden' name='csrf_value' value='{{ $csrf_value }}' />
          <input type='hidden' name='names' value='' />
        </form>
      </div>
      <div class="modal-footer">
        <button form="dm_form" type="submit" class="btn btn-dark">Удалить</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('deleteModal').addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;

    document.querySelector('#deleteModal input[name=names]').value = button.dataset.names;

    const names = JSON.parse(button.dataset.names);
    document.querySelector('#deleteModal .multiple').classList.toggle('d-none', names.length === 1);

    let filenames = names[0];
    for (let i = 1; i < names.length; i++) {
      filenames += ', ' + names[i];
    }
    document.querySelector('#deleteModal .filenames').textContent = filenames;
  });
</script>