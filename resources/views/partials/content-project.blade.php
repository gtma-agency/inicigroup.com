<article @php(post_class('d-flex'))>
    <div class="card">
        @if(has_post_thumbnail())
            <a href="{{ the_permalink() }}">
                {!! the_post_thumbnail('large', ['class' => 'img-fluid']) !!}
            </a>
        @endif
        <div class="card-body">
            <a href="{{ the_permalink() }}">
                <h4 class="post-card-title">
                    {{ the_title() }}
                </h4>
            </a>
            {!!  single_taxonomy_terms_link( get_the_ID(), 'client') !!}
            {!!  single_taxonomy_terms_link( get_the_ID(), 'industry') !!}
        </div>
    </div>
</article>
