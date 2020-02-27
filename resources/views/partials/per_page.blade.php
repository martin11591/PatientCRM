    <section class="per-page d-table mx-auto mt-3 text-center">
        <em>{{ __('layout.per_page') }}: {{ request()->perPage }}</em><br>
        <a class="mx-2 @if (!isset(request()->perPage) || request()->perPage == 10) text-bold @endif" href="?perPage=10">10</a>
        <a class="mx-2 @if (isset(request()->perPage) && request()->perPage == 20) text-bold @endif" href="?perPage=20">20</a>
        <a class="mx-2 @if (isset(request()->perPage) && request()->perPage == 50) text-bold @endif" href="?perPage=50">50</a>
        <a class="mx-2 @if (isset(request()->perPage) && request()->perPage == 100) text-bold @endif" href="?perPage=100">100</a>
    </section>