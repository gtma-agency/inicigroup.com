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
            {!!  single_taxonomy_terms_link( get_the_ID(), 'client') !!}
            {!!  single_taxonomy_terms_link( get_the_ID(), 'industry') !!}
        </div>
    </div>
</article>
