@if($announcement['query'])

    <section class="announcement {{ $announcement['background_color'] }}  {{ $announcement['color']}}"
             @if( $announcement['background_image']['url'] ) style="background: url('{!! $announcement['background_image']['url'] !!}') center center; background-size: cover;" @endif
    >
        <div class="container">
                <div class="row">
                    <div class="col use_case-title">
                        {!! $announcement['heading'] !!}
                        <div class="h3">Announcements</div>
                    </div>
                </div>
            <div class="row articles">
                @while( $announcement['query']->have_posts() )
                    {{ $announcement['query']->the_post() }}
                    <article @php(post_class('col-md-3 cards'))>
                        <div class="card">
                            @if(has_post_thumbnail())
                            <a href="{{ the_permalink() }}">
                                {!! the_post_thumbnail('medium-large', ['class' => 'img-fluid']) !!}
                            </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ the_permalink() }}">
                                    <a href="{{ the_permalink() }}">
                                        <h5 class="card-title">{{ the_title() }}</h5>
                                    </a>
                                </a>
                                <div class="text-center small">
                                    {{ apply_filters( 'the_date', get_the_date(), get_option( 'date_format' ), '', '' ) }}
                                </div>
                            </div>
                        </div>
                    </article>
                @endwhile
                {{ wp_reset_query() }}
            </div>
            <div class="row">
                <div class="col text-center p-3">
                    <a href="/news/" class="btn btn-outline-light text-primary">View All</a>
                </div>
            </div>
        </div>
    </section>
@else
    <p class="alert-danger text-center m-5">There are no related articles to display</p>
@endif
