@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    <section class="project">
        <div class="container">
            @if(get_post_type() === 'project')
                <div class="row">
                    <div class="col resource-filter justify-content-center d-flex">
                        {!! do_shortcode( '[searchandfilter post_types="project" taxonomies="industry,client" empty_search_url="/work/"]' ) !!}
                        <ul>
                            <li>
                                <a class="btn btn-primary" href="/work/">view all</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
            <div class="row">
                @if (!have_posts())
                    <div class="alert alert-warning">
                        {{ __('Sorry, no results were found.', 'sage') }}
                    </div>
                    {!! get_search_form(false) !!}
                @endif

                @while (have_posts()) @php the_post() @endphp
                <div class="col-md-3">
                    @include('partials.content-'.get_post_type())
                </div>
                @endwhile
            </div>
        </div>

        {!! get_the_posts_navigation() !!}
    </section>
@endsection