@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="container p-5 text-center">
      <h1 class="text-size-xl">OOPS!</h1>
      <p class="message"><strong>404 Error:</strong> <?php _e("This page can't be found. You're welcome to browse
      around and see if you can't find what you were looking for."); ?></p>
      <a class="btn" href="{{ home_url() }}">Let's go home</a>
      {{--{!! get_search_form(false) !!}--}}
    </div>
  @endif
  
@endsection
