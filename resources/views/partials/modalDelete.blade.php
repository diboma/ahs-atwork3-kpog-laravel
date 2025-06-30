<div class="modal" id="modal-delete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('Delete') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-delete" action="" method="post">
        @csrf
        @method('DELETE')
        <div class="modal-body" id="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
          <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    // Listen for delete action
    const buttons = document.querySelectorAll('.btn-delete');
    const modalBody = document.getElementById('modal-body');
    const form = document.getElementById('form-delete');

    for (const button of buttons) {
      button.addEventListener('click', (e) => {
        // Get data
        const action = e.currentTarget.dataset.formAction;
        const resourceName = e.currentTarget.dataset.resourceName;

        // Set form action
        form.action = action;

        // Set modal body
        modalBody.innerHTML = "{{ __('Delete') }} <b>:resourceName</b> <br> {{ __('Are you sure?') }}";
        modalBody.innerHTML = modalBody.innerHTML.replace(':resourceName', resourceName);
      });
    }

    // Listen for modal close
    const modalDelete = document.getElementById('modal-delete');
    modalDelete.addEventListener('hidden.bs.modal', () => {
      form.action = '';
      modalBody.innerHTML = '';
    });
  });
</script>
