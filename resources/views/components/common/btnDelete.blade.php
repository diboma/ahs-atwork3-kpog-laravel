@props(['resourceName', 'action'])

<x-far-trash-can class="btn-delete mt-1 text-danger"
                 style="height: 20px"
                 role="button"
                 data-resource-name="{{ $resourceName }}"
                 data-form-action="{{ $action }}"
                 data-bs-toggle="modal"
                 data-bs-target="#modal-delete" />
