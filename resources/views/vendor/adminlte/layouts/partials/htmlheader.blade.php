<head>
    <meta charset="UTF-8">
    <title> ViaductWEB </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<meta name="_token" content="{{ csrf_token() }}">--}}

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    {{--<link href="/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="/css/select2.min.css" rel="stylesheet">

    <link href="/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/libs/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <link href="/libs/animate.css/animate.min.css" rel="stylesheet" />
    <link href="/libs/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="/libs/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="/libs/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="/libs/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet" />
    <link href="/libs/raty/lib/jquery.raty.css" rel="stylesheet">
    <link href="/libs/datatables/css/data-table.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/libs/fontIconPicker/css/jquery.fonticonpicker.min.css" />
    <link rel="stylesheet" type="text/css" href="/libs/fontIconPicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css" />
    <link rel="stylesheet" type="text/css" href="/libs/fontIconPicker/themes/bootstrap-theme/jquery.fonticonpicker.bootstrap.min.css" />

    <link href="/libs/fontawesome/css/font-awesome.min.css" rel="stylesheet" />

    <link href="/css/admin.css" rel="stylesheet">
    <link href="/libs/fontawesome/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <script>
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
            echo json_encode($trans);
        @endphp
    </script>
</head>