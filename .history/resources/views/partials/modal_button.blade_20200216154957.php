@section('modal_button')
<button type="button" class="btn {{ $btn_class or "btn-primary"}}" data-toggle="modal" data-target="{{ $btn_target }}">
  {{ $btn_text}}
</button>