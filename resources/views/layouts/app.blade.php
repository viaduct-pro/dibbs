<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<?php
        $app_name = \App\Models\GlobalConfig::where(['name' => 'PROJECT_NAME'])->first();
        ?>
    <title>{{ ($app_name) ? $app_name->value : config('app.name', 'ICO-project') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/icon.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/comment.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/form.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/button.min.css" rel="stylesheet">
    <link href="{{ asset('/vendor/laravelLikeComment/css/style.css') }}" rel="stylesheet">
    <link href="/libs/datatables/css/data-table.css" rel="stylesheet">
    {{--<link href="/css/select2.min.css" rel="stylesheet">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/2.1.0/select2.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2.0/select2.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/libs/tooltipster/dist/css/tooltipster.bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="/libs/tooltipster/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/social-likes/dist//social-likes_flat.css">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ ($app_name) ? $app_name->value : config('app.name', 'ICO-project') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li><a href="{{route('coins-front')}}">Coins</a></li>
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <script>
      var AdminLTEOptions = {
        //Enable sidebar expand on hover effect for sidebar mini
        //This option is forced to true if both the fixed layout and sidebar mini
        //are used together
        sidebarExpandOnHover: true,
        //BoxRefresh Plugin
        enableBoxRefresh: true,
        //Bootstrap.js tooltip
        enableBSToppltip: true
      };
    </script>

    <!-- Scripts -->
    <script src="{{ asset('js/site.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="/libs/jqueryui/jquery-ui.min.js"></script>
    <script src="{{ asset('/vendor/laravelLikeComment/js/script.js') }}" type="text/javascript"></script>
    <script src="/js/translit.js"></script>
    {{--<script src="/js/select2.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/2.1.0/select2.js"></script>

    <script src="/libs/datatables/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/libs/tooltipster/dist/js/tooltipster.bundle.min.js"></script>
    <script async src="https://static.addtoany.com/menu/page.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/social-likes/dist/social-likes.min.js"></script>
    {{--<script src="/libs/tinymce/tinymce.min.js"></script>--}}
<?php
        $count_symbols = \App\Models\GlobalConfig::where(['name' => 'symbol_count'])->first();

        if($count_symbols){
            $count_symbols = $count_symbols->value;
        }
        ?>
    <script>
      $(document).ready(function() {
        $('.tooltiped').tooltipster({
          theme: 'tooltipster-shadow',
        });
      });


  $("#item-form").validate();
  ( $('#slug').val()=='undefined' || $('#slug').val()==null || $('#slug').val()=="" )
  {
    $('#name').transliterate();
  }

  var count_sym = {{$count_symbols ? $count_symbols : 200}};

  $(document).ready(function(){
    var maxCount = count_sym;

    $("#counter").html(maxCount);

    $("#my_editor").keyup(function() {
      var revText = this.value.length;

      if (this.value.length > maxCount)
      {
        this.value = this.value.substr(0, maxCount);
      }
      var cnt = (maxCount - revText);
      if(cnt <= 0)
      {
        $("#red").css('color', 'red');
//        $("#red").effect('highlight');
        $("#counter").html('0');
      }
      else {
        $("#red").css('color', '');
        $("#counter").html(cnt);
      }

    });
  });

  if ($(".table-list").length !== 0) {
    var table = $(".table-list").DataTable()

  }

      var lastResults = [];
  // SELECT2 STANDARD

      $(".select-coin").select2({
        multiple: false,
        ajax: {
          url: '/ajax-coins',
          dataType: 'json',
          type: "GET",
          quietMillis: 50,
          data: function (term) {
            return {
              term: term
            };
          },
          results: function (data) {
            return {
              results: $.map(data, function (item) {
                return {
                  text: item.symbol+' ('+item.name+')',
                  slug: item.name,
                  id: item.value
                }
              })
            };
          }
        }
      });


  // SELECT2 COSTOM
//      $(".select-coin").select2({
//        createSearchChoice:function(term, data) {
//          if ( $(data).filter( function() {
//              return this.text.localeCompare(term)===0;
//            }).length===0) {
//            return {id:term, text:term};
//          }
//        },
//        multiple: false,
//        ajax: {
//          url: '/ajax-coins',
//          dataType: 'json',
//          type: "GET",
//          quietMillis: 50,
//          data: function (term) {
//            return {
//              term: term
//            };
//          },
//          results: function (data) {
//            return {
//              results: $.map(data, function (item) {
//                return {
//                  text: item.symbol+' ('+item.name+')',
//                  slug: item.name,
//                  id: item.value
//                }
//              })
//            };
//          }
//        }
//      });
//
//        $( ".select-coin" ).change(function() {
//          console.log(this.value);
//        });




      $('#item-form').on('submit', function(e) {
        e.preventDefault();
        var name = $('#name').val();
        var description = $('#my_editor').val();
        var coins = $('#coins').val();
        var slug = $('#slug').val();
        $.ajax({
          beforeSend: function(request) {  // нужно для защиты от CSRF
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
          },
          type: "POST",
          url: '/ico-item',
          data: {
            name: name,
            description: description,
            coins: coins,
            slug: slug
          },
          success: function( msg ) {
            if(msg.status == 'success') {
              $("#form-block").fadeOut('fast', function(){
                $('#status').html(msg.html);
                $('#status').fadeIn('fast');
                setTimeout(function () {
                  $('#status').fadeOut('fast', function () {
                    $("#form-block").fadeIn('fast');
                    $('input[type="text"], input[type="hidden"], textarea, #coins').val('');
                    $('.select2-choice>span').text('');
                  });
                }, 2000);
              });
            }
          }
        });
      });

      //Socket

        var conn = new WebSocket('ws://104.237.155.197:8088');
        conn.onopen = function (e) {
          console.log('Connection established!');
        }
        conn.onmessage = function (e) {
          console.log('New message: ' + e.data);
          $("#content").load("/ajax-items");
        }
</script>

    {{--<script src="/js/autobahn.min.js"></script>--}}
    {{--<script src="http://requirejs.org/docs/release/2.1.11/minified/require.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/when/2.7.1/when.js"></script>--}}
    {{--<script>--}}

      {{--require.config({--}}
        {{--baseUrl: ".",--}}
        {{--paths: {--}}
          {{--"autobahn":--}}
            {{--"/js/autobahn.min",--}}
          {{--"when": "https://cdnjs.cloudflare.com/ajax/libs/when/2.7.1/when"--}}
        {{--},--}}
        {{--shim: {--}}
          {{--"autobahn": {--}}
            {{--deps: ["when"]--}}
          {{--}--}}
        {{--}--}}
      {{--});--}}
      {{--require(["autobahn", "when"], function(autobahn) {--}}
        {{--console.log("Ok, Autobahn loaded", autobahn.version);--}}
        {{--console.log(autobahn.when);--}}
        {{--var conn = autobahn.Connection({--}}
          {{--url: 'ws://127.0.0.1',--}}
          {{--realm: 'votes'--}}
        {{--});--}}
{{--//        conn.onopen = function (session, details) {--}}
{{--//          session.subscribe('onNewData', function (topic, data) {--}}
{{--//            console.info('New data: topic_id: "' + topic + '"');--}}
{{--//            console.log(data.data);--}}
{{--//          });--}}
{{--//        }--}}
{{--//        conn.open();--}}
        {{--try {--}}
          {{--// for Node.js--}}
          {{--var autobahn = require('autobahn');--}}
        {{--} catch (e) {--}}
          {{--console.log(e.msg);--}}
          {{--// for browsers (where AutobahnJS is available globally)--}}
        {{--}--}}
      {{--});--}}
    {{--</script>--}}
<script>

//      'ws://localhost:8050',
//      function (session) {
//        session.subscribe('onNewData', function (topic, data) {
//          console.info('New data: topic_id: "' + topic + '"');
//          console.log(data.data);
//        });
//      },
//
//      function(code, reason, detail) {
//        console.warn('WebSoket connection closed: code - ' + code + '; reason - ' + reason + '; detail - ' + detail)
//      },
//
//      {
//        'maxRetries': 60,
//        'retryDelay': 4000,
//        'skipSubprotocolCheck': true
//      }
//    )

</script>

</body>
</html>
