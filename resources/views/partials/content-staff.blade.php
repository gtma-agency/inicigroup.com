<article @php post_class() @endphp>
    <header>
        <a href="{{ get_permalink() }}" aria-label="{{ the_title() }}">
        @if( has_post_thumbnail() )
            {{ the_post_thumbnail('medium', ['class' => 'img-fluid']) }}
        @else
            <img src="{{ \App\asset_path('/images/Profile_avatar_placeholder_large.png') }}" class="img-fluid">
        @endif
        </a>
        <h5 class="entry-title mb-0"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h5>
            <div>{{ the_field('position') }}</div>
    </header>
</article>
