<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Guitars N Gears</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    @stack('styles')

<style type="text/css">
    .navbar {
        background-color: white;
    }
    .navbar-top {
        background: #4D5061;
        border-bottom: 4px solid #60B078;
        color: #FFF;
    }
    .text-white{
        color:#fff;
    }
    .navbar-doublerow > .navbar{
        display: block;
        padding: 0px auto;
        margin: 0px auto;
        min-height: 25px;
    }

    /*Down nav*/
    .navbar-doublerow .navbar-down .navbar-brand {
        /*navbar brand*/
        padding: 0px auto;
        float: left;
        color: #60B078;
        font-size: 30px;
    }
    .navbar-doublerow .navbar-down ul>li>a{
        /*Menu items*/
        font-size: 17px;
        font-weight: 550;
        color: #000;
        padding-top: 40px;
    }
    .navbar-down{
        background-color: #f5f5f0;
    }
    .navbar-doublerow .navbar-down ul>li>a:hover{
        /*menu hover*/
        border-bottom: 1px solid #60B078;
        color: #60B078;
    }

}

</style>

</head>
<body>
    <div id="app">
    <nav class="navbar navbar-default navbar-doublerow navbar-trans navbar-static-top">
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
                    <div class="navbar-header flex-item navbar-left">
                        <div class="navbar-brand"><a href="{{ url('/') }}"><img src="/uploads/logo.gif"></a></div>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <form action="{{ url('query') }}" method="GET" style="display: inline; padding-top: 20px; margin-top: 5px;">
                        <!--<div class="row">
                              <div class="input-field col s12">-->
                                <input type="text" class="validate" name="q" placeholder="Search...">
                                
                              
                               <button type="submit" class="btn btn-flat pink accent-3 waves-effect waves-light white-text right">Product <i class="material-icons right">search</i></button>
                               <!--</div>
                        </div>-->
                     </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="dropdown">
                                <a href="{{ url('/') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                     Shop <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Guitar', 'subName' => 'All']) }}">Guitars</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Amplifier', 'subName' => 'All']) }}">Amplifiers</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Stomp', 'subName' => 'All']) }}">Stomp Boxes & Effects</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'String', 'subName' => 'All']) }}">Strings</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'All']) }}">Accessories</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Livepro', 'subName' => 'All']) }}">Live-Pro Audio</a></li>
                                    <li><a href="{{ url('/category') }}">Special Order</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @elseif (Auth::user()->type == 'user')
                            <li class="dropdown">
                                <a href="{{ url('/') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                     Shop <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Guitar', 'subName' => 'All']) }}">Guitars</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Amplifier', 'subName' => 'All']) }}">Amplifiers</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Stomp', 'subName' => 'All']) }}">Stomp Boxes & Effects</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'String', 'subName' => 'All']) }}">Strings</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'All']) }}">Accessories</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Livepro', 'subName' => 'All']) }}">Live-Pro Audio</a></li>
                                    <li><a href="{{ url('/category') }}">Special Order</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/cart') }}">Cart ({{ Auth::user()->cart[0]['count'] }})</a></li>
                            <li><a href="{{ url('/profile') }}">Profile</a></li>

                                <li class="dropdown">
                                <a href="{{ url('/profile') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
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
                        @elseif(Auth::check() && Auth::user()->type == 'admin')

                            <li class="dropdown">
                                <a href="{{ url('/') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                     Shop <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Guitar', 'subName' => 'All']) }}">Guitars</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Amplifier', 'subName' => 'All']) }}">Amplifiers</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Stomp', 'subName' => 'All']) }}">Stomp Boxes & Effects</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'String', 'subName' => 'All']) }}">Strings</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'All']) }}">Accessories</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Livepro', 'subName' => 'All']) }}">Live-Pro Audio</a></li>
                                    <li><a href="{{ url('/category') }}">Special Order</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/cart') }}">Cart ({{ Auth::user()->cart[0]['count'] }})</a></li>
                            <li><a href="{{ url('/home') }}">Dashboard</a></li>

                                <li><a href="{{ url('/profile') }}">Profile</a></li>

                                <li class="dropdown">
                                <a href="{{ url('/profile') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
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
        <nav class="navbar navbar-down">
            <div class="container">
                <div class="flex-container collapse navbar-collapse">
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="{{ route('getCategory', ['catName' => 'Guitar', 'subName' => 'All']) }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 Guitars <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('getCategory', ['catName' => 'Guitar', 'subName' => 'All']) }}">All</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Guitar', 'subName' => 'Acoustic']) }}">Acoustic Guitars</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Guitar', 'subName' => 'Electric']) }}">Electric Guitars</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Guitar', 'subName' => 'Bass']) }}">Bass Guitars</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('getCategory', ['catName' => 'Amplifier', 'subName' => 'All']) }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 Amplifiers <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('getCategory', ['catName' => 'Amplifier', 'subName' => 'All']) }}">All</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Amplifier', 'subName' => 'Guitar']) }}">Guitar Amps</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Amplifier', 'subName' => 'Bass']) }}">Bass Guitar Amps</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('getCategory', ['catName' => 'Stomp', 'subName' => 'All']) }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Stomp Boxes & Effects <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('getCategory', ['catName' => 'Stomp', 'subName' => 'All']) }}">All</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Stomp', 'subName' => 'Guitar']) }}">Guitar Pedals & Effects</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Stomp', 'subName' => 'Bass']) }}">Bass Guitar Pedals & Effects</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('getCategory', ['catName' => 'String', 'subName' => 'All']) }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Strings <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('getCategory', ['catName' => 'String', 'subName' => 'All']) }}">All</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'String', 'subName' => 'Guitar']) }}">Guitar Strings</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'String', 'subName' => 'Bass']) }}">Bass Guitar Strings</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'All']) }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Accessories <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'All']) }}">All</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'Cables']) }}">Cables, Snakes & Adapters</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'Stands']) }}">Stands</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'Harmonicas']) }}">Harmonicas</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'Blank']) }}">Blank Media</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'Books']) }}">Books & Videos</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'Other']) }}">Other Accessories</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'Guitar']) }}">Guitar Accessories</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'Bass']) }}">Bass Guitar Accessories</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'Keyboard']) }}">Keyboard Accessories</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('getCategory', ['catName' => 'Livepro', 'subName' => 'All']) }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Live-Pro Audio <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('getCategory', ['catName' => 'Livepro', 'subName' => 'All']) }}">All</a></li>
                                <li><a href="{{ route('getCategory', ['catName' => 'Livepro', 'subName' => 'Live']) }}">Live Pro-Audio</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/special') }}">Special Order</a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </nav>    


        
        


    </div>

    
@yield('content')


        <footer style="border-top: 2px solid grey; background-color: #f5f5f0;">
            
    
   
        <div class="col-lg-3">
                    
            <h3 style="border-top:2px solid white; border-bottom:2px solid white; padding:10px;">About GNG</h3>
            <p style="font-size: 12px;">guitarNgears was founded back in early, 2010. The company mostly focuses into importing reputed musical instruments in Bangladesh and market them, with proper after sales service.</p>

            <p style="font-size: 12px;">There are a handful of companies dealing musical instruments in Bangladesh. But most of them lack after sales service and proper knowledge about the products. guitarsNgears is the first of it’s kind, as it was founded and is run by an active and a senior rock musician of this country. All the employees are mostly musicians, which adds a lot of value to provide the customers with proper advice and care.</p>
                
        </div>
       <div class="col-lg-3">
                    
            <h3 style="border-top:2px solid white; border-bottom:2px solid white; padding:10px;">Key Features</h3>
            <h5><h3 style="display: inline;"><span class="glyphicon glyphicon-fire"></span></h3> Unique Collection of Musical Instruments</h5><br>
            <h5><h3 style="display: inline;"><span class="glyphicon glyphicon-globe"></span></h3> Authentic Dealer of Each Available Brands</h5><br>
            <h5><h3 style="display: inline;"><span class="glyphicon glyphicon-certificate"></span></h3> Total Maintenance Support of Musical Instruments</h5><br>
            <h5><h3 style="display: inline;"><span class="glyphicon glyphicon-tree-deciduous"></span></h3> Active Online Store with all new Updates & Newsletters</h5>
                            
                
        </div>
            

            <div class="col-lg-3 col-md-6">
            <h3 style="border-top:2px solid white; border-bottom:2px solid white; padding:10px;">Categories:</h3>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Guitar', 'subName' => 'All']) }}">Guitars</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Amplifier', 'subName' => 'All']) }}">Amplifiers</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Stomp', 'subName' => 'All']) }}">Stomp Boxes & Effects</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'String', 'subName' => 'All']) }}">Strings</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Accessory', 'subName' => 'All']) }}">Accessories</a></li>
                                    <li><a href="{{ route('getCategory', ['catName' => 'Livepro', 'subName' => 'All']) }}">Live-Pro Audio</a></li>

                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h3 style="border-top:2px solid white; border-bottom:2px solid white; padding:10px;">Contact:</h3>
                <span class="glyphicon glyphicon-earphone"></span>  +88 01770552402<br>
                   <span class="glyphicon glyphicon-send"></span>  sales@guitarsngears.com<br>
                    <span class="glyphicon glyphicon-send"></span>  support@guitarsngears.com<br>
                <p><a href="" title="Contact me!"><i class="fa fa-envelope"></i> Contact</a></p>
                <h3>Follow:</h3>
                
                
                <a href="" id="gh" target="_blank" title="Twitter"><span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-twitter fa-stack-1x"></i>
                </span>
                Twitter</a>
                <a href=""  target="_blank" title="Instagram"><span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-github fa-stack-1x"></i>
                </span>
                Instagram</a>
            
            </div>

            <br/>
            
<div id="fb-root"></div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<br>
<div class="fb-like" data-href="https://www.facebook.com/guitarsNgears/" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>



<a href="https://twitter.com/share" class="twitter-share-button" data-url="">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<div class="g-plusone" data-annotation="inline" data-width="300" data-href=""></div>

<!-- Helyezd el ezt a címkét az utolsó +1 gomb címke mögé. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
            <br/>
            
                <!--<hr>-->
                    <!--<p>Copyright © Your Website | <a href="">Privacy Policy</a> | <a href="">Terms of Use</a></p>-->
                    
         <hr>
<p style="text-align: center; background-color: #f5f5f0;">Copyright © GuitarsNGears | <a href="">Privacy Policy</a> | <a href="">Terms of Use</a></p>         
                    
        </footer>
        


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
