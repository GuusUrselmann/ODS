<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$page['props']['options']['website_title']->value}}</title>
    {{-- Scripts --}}
    <script type="text/javascript">
        function url() {
            return '<?= url('') ?>';
        }
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- Fonts --}}
    <link href="{{ asset('fonts/fontawesome-free-5.13.1-web/css/all.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('fonts/icofont/icofont.min.css') }}" rel="stylesheet" type="text/css" >
    {{-- Styles --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/guestPages.css')}}">
</head>
</head>
<body>
    @inertia
    <script src="{{ url('/js/utilities/form-validation.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>
</html>
