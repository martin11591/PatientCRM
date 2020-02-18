<button type="button" class="ml-2 btn{{ $class ? "btn-{$class}" : "btn-primary" }}" data-toggle="modal" data-target="{{ $target ?? '#example1' }}">
  {{ $slot ?? '' }}
</button>