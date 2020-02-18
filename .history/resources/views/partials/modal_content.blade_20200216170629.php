<div class="modal fade" id="{{ $id ?? 'example1' }}" tabindex="-1" role="dialog" aria-labelledby="{{ $label ?? 'test1' }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $label ?? 'test1' }}">{{ $title ?? 'test'}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $slot }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('profile.close') }}</button>
        <button type="button" class="btn btn-danger">{{ __('profile.confirm') }}</button>
      </div>
    </div>
  </div>
</div>