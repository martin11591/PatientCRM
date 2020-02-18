@section('modal_button')
<button type="button" class="btn {{ $btn_class ?? 'btn-primary'}}" data-toggle="modal" data-target="{{ $btn_target ?? '#example1' }}">
  {{ $btn_text }}
</button>