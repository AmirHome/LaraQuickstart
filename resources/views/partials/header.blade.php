<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

{!! SEO::generate() !!}

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Styles -->
{{-- Bootstrap --}}
<link href="{{url('resources/assets')}}/css/app.css" rel="stylesheet">
{{-- AmirHome.com --}}
<link href="{{url('resources/assets')}}/css/amirhome.com.css" rel="stylesheet">
