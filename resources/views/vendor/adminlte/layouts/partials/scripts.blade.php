
<script src="{{ mix('/js/app.js') }}" type="text/javascript"></script>
<script src="/libs/jquery-migrate/jquery-migrate.min.js"></script>
<script src="/libs/jqueryui/jquery-ui.min.js"></script>
<script src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="/libs/html5shiv/dist/html5shiv.min.js"></script>
<script src="/libs/Respond/dest/respond.min.js"></script>
<script src="/libs/excanvas/excanvas.js"></script>
<![endif]-->
<script src="/libs/slimScroll/jquery.slimscroll.min.js"></script>
<script src="/libs/pace/pace.min.js"></script>
<script src="/libs/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>
<script src="/libs/moment/min/moment-with-locales.min.js"></script>
<script src="/libs/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/libs/datatables/js/jquery.dataTables.js"></script>
<script src="/libs/bootstrap3-wysiwyg/dist/bootstrap3-wysihtml5.all.min.js"></script>
{{--<script src="/libs/bootstrap-select/dist/js/bootstrap-select.min.js"></script>--}}
<script src="/libs/switchery/dist/switchery.min.js"></script>
<script src="/libs/jquery-tag-it/js/tag-it.min.js"></script>
<script src="/libs/raty/lib/jquery.raty.js"></script>
<script src="/libs/fontIconPicker/jquery.fonticonpicker.min.js"></script>
<script src="/libs/tinymce/tinymce.min.js"></script>

<script src="/js/select2.min.js"></script>
<script src="/js/translit.js"></script>

<script src="/js/purify.min.js"></script>
<script src="/js/fileinput.min.js"></script>
<script src="/libs/bootstrap-fileinput/js/fileinput_locale_ru.js"></script>
<script src="/libs/ckeditor/ckeditor.js"></script>
<script src="/js/jquery.mask.min.js"></script>

<script src="/js/translit.js"></script>
<script src="/js/jquery.validate.min.js"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>



<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->

<script>
    jQuery('.select_b').select2();
//    $('.select_d').select2();
//    $('.select_s').select2();
//    $('.select_sub').select2();
//    $('.building_id').select2();

    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
    tinymce.init({
        selector: '#my_editor',
        plugins: [ "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor image"],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ],
        language: 'en'
    });
    tinymce.init({
        selector: '#my_editor1',
        plugins: [ "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor image"],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ],
        language: 'en'
    });
    tinymce.init({
        selector: '#my_editor2',
        plugins: [ "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor image"],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ],
        language: 'en'
    });
</script>
<script src="/js/admin.js"></script>
<script>

    $(document).ready(function () {
      App.init();

      //Socket

      var conn = new WebSocket('ws://104.237.155.197:8088');
      conn.onopen = function (e) {
        console.log('Connection established!');
      }
      conn.onmessage = function (e) {
        console.log('New message: ' + e.data);
      }

      function send () {
        var data = 1;
        conn.send(data);

        console.log('Sended: ' + data);
      }
      var check = 0;
      $('.publish').on('click', function () {
        if (check == 0){
          send();
          console.log($(this).parent().attr('link-data'));
          window.location.href = $(this).parent().attr('link-data');
        }
      });
      $('.paginate_button').on('click', function () {
        $('.publish').on('click', function () {
          send();
          console.log($(this).parent().attr('link-data'));
          window.location.href = $(this).parent().attr('link-data');
        });
      });
      $('input[type=search]').keyup(function () {
        $('.publish').on('click', function () {
          send();
          console.log($(this).parent().attr('link-data'));
          window.location.href = $(this).parent().attr('link-data');
        });
      });
      setInterval(function () {
        console.log(1);
        $('.publish').on('click', function () {
          send();
          console.log($(this).parent().attr('link-data'));
          window.location.href = $(this).parent().attr('link-data');
        });
      }, 2000);
    });
</script>

