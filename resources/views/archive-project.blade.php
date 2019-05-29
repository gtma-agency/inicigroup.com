@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    <div class="project">
        <div class="container-fluid">
            <div class="row">
                <div class="col resource-filter justify-content-center d-flex">
                    {!! do_shortcode( '[searchandfilter slug="projects"]' ) !!}
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
                <div class="col-xl-2 col-md-4 d-flex align-items-stretch">
                    @include('partials.content-'.get_post_type())
                </div>
                @endwhile
            </div>
            <div class="row">
                <div class="col">
                    @include('partials.pagination')
                </div>
            </div>
        </div>
    </div>
@endsection
