<!DOCTYPE html>
<html {!! language_attributes() !!}>

  @include('partials.head')

    <body {!! body_class() !!}>
		<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PLP2466"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    {!! do_action('get_header') !!}

    @include('partials.header')

    <div class="wrap" role="document">
      <div class="content">
        <main class="main">
            @yield('content')
        </main>
      </div>
    </div>

    {!! do_action('get_footer') !!}

    @include('partials.footer')

    {!! wp_footer() !!}

    </body>
</html>
