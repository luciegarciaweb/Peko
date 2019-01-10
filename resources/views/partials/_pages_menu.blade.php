<div class="card mb-3">
    <div class="list-group list-group-flush">
        @foreach ($pages as $page)
        <a class="list-group-item list-group-item-action @if (Request::is('pages/'.$page->slug)) active @endif" 
            href="{{ route('pages.show', $page) }}">
            {{ $page->title }}
        </a>      
        @endforeach
        
        <a class="list-group-item list-group-item-action @if (Request::is('contact')) active @endif" 
            href="{{ route('contacts.create') }}">
            Nous contacter
        </a>
    </div>
</div>