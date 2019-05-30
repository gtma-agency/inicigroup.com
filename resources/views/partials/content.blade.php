<article @php(post_class('d-flex'))>
    <div class="card">
        @if(has_post_thumbnail())
            <a href="{{ the_permalink() }}" aria-label="{{ the_title() }}">
                {!! the_post_thumbnail('basis-flex', ['class' => 'img-fluid']) !!}
            </a>
        @endif
        <div class="card-body">
            <a href="{{ the_permalink() }}" aria-label="{{ the_title() }}">
                <h4 class="post-card-title">
                    {{ the_title() }}
                </h4>
            </a>
            <div class="post-date">{{ apply_filters( 'the_date', get_the_date(), get_option( 'date_format' ), '', '' ) }}</div>
            <div class="card-text">{{ the_excerpt() }}</div>
        </div>
        <div class="card-footer">
            <a href="{{ the_permalink() }}" class="card-link link-arrow" aria-label="{{ the_title() }}">Read More</a>
        </div>
    </div>
</article>
