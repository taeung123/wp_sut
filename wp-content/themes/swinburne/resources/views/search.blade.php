@extends('layouts.app')

@section('content')

    @include('partials.page-header')

    @if (!have_posts())
        <div class="alert alert-warning">
            {{ __( pll_current_language('slug')==='vi' ? 'Xin lỗi, không có kết quả nào được tìm thấy.' : 'Sorry, no results were found.', 'vicoders') }}
        </div>
    @endif

    @while(have_posts())

        {!! the_post() !!}

        @include('partials.content-search')

    @endwhile

   {{--  {!! get_the_posts_navigation() !!} --}}

@endsection
