<!DOCTYPE html>
<html lang="en">
<head>

    @include('share.user._head')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="fb-root"></div>
    <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- Navigation -->
    @include('share.user._header')
    <!-- Page Content -->
    @yield('content')
    <!-- end Page Content -->
    @include('share.user._footer')

    <!-- end Footer -->
    <!-- jQuery -->
    <script src="{{asset('js/jquery.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/my.js')}}"></script>
    <script src="{{asset('js/multislider.js')}}"></script>
    <script src="{{asset('js/jquery-validate/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery-validate/additional-methods.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $("#search").validate({
            rules:{
                keyword:{
                    required:true,
                    maxlength:200
                }
            },
            messages:{
                keyword:{
                    required:'Vui lòng nhập tiêu đề tin',
                    maxlength:'Tiêu đề tin quá dài'
                }
            }
        });
    </script>
    @yield('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            $("#keySearch").keyup(function(event) {
                var txt = $("#keySearch").val();
                if (txt != '') {
                    $.ajax({
                        url: '{{route('livesearch.index')}}',
                        type: 'POST',
                        dataType:'text',
                        data:{txt},
                        success:function(data)
                        {
                            if(typeof data != "object"){
                                data = JSON.parse(data);
                            }
                            $('#results').html("");
                            $.each(data,function(i, item) {
                                $('#results').append(`
                                <div class="title_news_search" style="border-bottom:1px solid #000">${data[i].tieude}</div>`);

                                $(".title_news_search").click(function(event) {
                                    var title = $(this).html();
                                    $("#keySearch").val(title);
                                });
                            });
                            
                        }
                    })
                }
                else
                {
                    $("#results").html('');
                }
            });
            
            var quotes = [];
            var links = [];
            $.get('{{route('get.title.slide')}}', function(data) {
                if(typeof data != "object"){
                        data = JSON.parse(data);
                }
                $.each(data,function(index, el) {
                    quotes.push(data[index].tieude);
                    links.push(data[index].link);
                });  
            });  
            var i = 0;
            setInterval(function() {
            $("#textslide").html(quotes[i]);
            $("#textslide").attr('href',links[i]);
            console.log(links[i]);
                if (i == quotes.length) {
                    i = 0;
                }
                else {
                    i++;
                }
            }, 3*1000);
            var dem = 0;
            $("#popup_changepass").click(function(event) {
                dem++;
                if (dem%2==1)
                {
                    $(".popup_content").css({
                        'visibility':'visible',
                        'height': '70px',
                        'transition' : 'all 0.2s',
                        'opacity' : '1'
                    }); 
                }
                else
                {
                    $(".popup_content").css({
                        'visibility':'hidden',
                        'height': '0',
                        'transition' : 'all 0.2s',
                        'opacity' : '0.2'
                    });
                }
            });
        });
    </script>
</body>

</html>
