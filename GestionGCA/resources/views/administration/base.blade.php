@include('administration.partials.head')

  <body>
    <div class="wrapper">

        @include('administration.partials.side-bar')

        <div class="main-panel">
            @include('administration.partials.header')

        <div class="container">
          @yield('content')
        </div>

        @include('administration.partials.footer')
      </div>

      @include('administration.partials.theme')
    </div>

    @include('administration.partials.javascript_section')
  </body> 
</html>
