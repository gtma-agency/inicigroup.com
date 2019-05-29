@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    <div class="container">
        <div class="row">
            <div class="col resource-filter justify-content-center d-flex">
                {!! do_shortcode( '[searchandfilter slug="staff"]' ) !!}
                </div>
        </div>
        <div class="row">
            @if (!have_posts())
                <div class="alert alert-warning">
                    {{ __('Sorry, no results were found.', 'sage') }}
                </div>
                {!! get_search_form(false) !!}
            @endif

            @while (have_posts()) @php the_post() @endphp
            <div class="col-lg-2 col-md-3 col-sm-4">
                @include('partials.content-'.get_post_type())
            </div>
            @endwhile
        </div>
    </div>

    {!! get_the_posts_navigation() !!}
@endsection
