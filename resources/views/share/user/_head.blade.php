<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="">
<meta name="author" content="">
@yield('meta')
<title>@yield('title')</title>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<!-- Bootstrap Core CSS -->
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{asset('css/shop-homepage.css')}}" rel="stylesheet">
<link href="{{asset('css/my.css')}}" rel="stylesheet">
<link href="{{asset('css/footer.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('css/cong_tac_vien.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
@yield('css')