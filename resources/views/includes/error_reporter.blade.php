@foreach($errors->all() as $error)
    <script>
        (function() {
            noty({
                text: '{{$error}}',
                theme: 'bootstrapTheme',
                layout: 'topRight',
                type: 'error',
                timeout: 5000
            });
        })()
    </script>
@endforeach
@if(Session::has('error'))
    @foreach(Session::pull('error') as $error)
        <script>
            (function() {
                noty({
                    text: '{{$error}}',
                    theme: 'bootstrapTheme',
                    layout: 'topRight',
                    type: 'error',
                    timeout: 5000
                });
            })()
        </script>
    @endforeach
@endif
@if(Session::has('messages'))
    @foreach(Session::pull('messages') as $message)
        <script>
            (function() {
                noty({
                    text: '{{$message}}',
                    theme: 'bootstrapTheme',
                    layout: 'topRight',
                    type: 'success',
                    timeout: 5000
                });
            })()
        </script>
    @endforeach
@endif