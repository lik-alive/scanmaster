<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-secondary">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Подтверждение</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Вы точно хотите удалить файл <span class='filename'></span>?
        <form id='dm_form' method='POST'>
          <input type='hidden' name='csrf_name' value='{{ $csrf_name }}' />
          <input type='hidden' name='csrf_value' value='{{ $csrf_value }}' />
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

    document.querySelector('#deleteModal .filename').textContent = button.dataset.name;

    document.querySelector('#deleteModal #dm_form').action = button.dataset.url;
  });
</script>