<div class="modal fade" id="{{ $modal_id ?? 'example1' }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modal_label ?? 'test1' }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $modal_label ?? 'test1' }}">{{ $modal_title ?? 'test'}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $modal_content ?? 'test' }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('profile.close') }}</button>
        <button type="button" class="btn btn-primary">{{ __('profile.confirm') }}</button>
      </div>
    </div>
  </div>
</div>