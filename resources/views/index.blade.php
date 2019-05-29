@extends('layouts.app')

@section('content')
    @include('partials.page-header')

    <div class="row">
        @if (!have_posts())
            <div class="alert alert-warning">
                {{ __('Sorry, no results were found.', 'sage') }}
            </div>
            {!! get_search_form(false) !!}
        @endif

        @while (have_posts()) @php the_post() @endphp
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 align-items-stretch d-flex">
            @include('partials.content-'.get_post_type())
        </div>
        @endwhile
    </div>

    {!! get_the_posts_navigation() !!}
@endsection
