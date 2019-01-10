@if ($sliders)
<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($sliders as $slider)
            @if ($slider->picture)
            <li data-target="#carousel" data-slide-to="{{ $loop->index }}" @if ($loop->index === 0) class="active" @endif></li>
            @endif
        @endforeach
    </ol>    
    <div class="carousel-inner">
        @foreach ($sliders as $slider)
        @if ($slider->picture)
        <div class="carousel-item @if ($loop->index === 0) active @endif">
            <img class="d-block w-100 rounded" src="{{ asset('storage/'.$slider->picture) }}" alt="{{ $slider->title }}" height="400px" style="object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <h5>{{ $slider->title }}</h5>
                <p>{{ $slider->body }}</p>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endif