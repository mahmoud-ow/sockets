@extends('layouts.app_pages')



@section('header')
@parent
<link href='{{asset($asset."/css/pages/auth_pages.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>
<title>{{__('auth.register_account')}}</title>
@endsection



@section('content')

<!-- SECTION HEADLINE -->
<div class="section-headline-wrap">
    <div class="section-headline">
        <h2>{{__('auth.register_account')}}</h2>
        <p>{{__('auth.home')}}<span class="separator">/</span><span class="current-section">{{__('auth.register')}}</span></p>
    </div>
</div>
<!-- /SECTION HEADLINE -->

<div id="content-wrapper">

    <div>


        <!-- FORM POPUP -->
        <div class="form-popup">

            

            <!-- FORM POPUP CONTENT -->
            <div class="form-popup-content">
              

                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="form-error">{{$error}}</div>
                <?php break; ?>
                @endforeach
                @endif


                <form id="register-form" method="POST" action="{{ route('account.register') }}">
                    <div class="form-anchor"><a href="{{url('/users/login')}}">{{__('auth.account_login')}}</a></div>
                    @csrf


                    <label for="email" class="rl-label required">{{__('auth.email')}}</label>
                    <input type="email" id="email" name="email" class="" placeholder="{{__('auth.email_placeholder')}}"
                        value="{{old('email')}}">


                    <label for="username" class="rl-label">{{__('auth.username')}}</label>
                    <input type="text" id="username" name="username" placeholder="{{__('auth.username_placeholder')}}" value="{{old('username')}}">


                    <label for="password" class="rl-label required">{{__('auth.password')}}</label>
                    <input type="password" id="password" name="password"
                        placeholder="{{__('auth.password_placeholder')}}">


                    <label for="password_confirmation" class="rl-label required">{{__('auth.repeat_password')}}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="{{__('auth.repeat_password_placeholder')}}">



                    <label for="account_type" class="rl-label required">{{__('auth.account_type')}}</label>
                    <label for="account_type" class="select-block">
                        <select name="account_type" id="account_type">
                            <option value="buyer">{{__('auth.buyer')}}</option>
                            <option value="seller">{{__('auth.seller')}}</option>
                            <option value="shop">{{__('auth.shop')}}</option>
                            <option value="driver">{{__('auth.driver')}}</option>
                        </select>
                        <!-- SVG ARROW -->
                        <svg class="svg-arrow">
                            <use xlink:href="#svg-arrow"></use>
                        </svg>
                        <!-- /SVG ARROW -->
                    </label>



                    <button class="button mid dark">{{__('auth.register')}} <span class="primary">{{__('auth.now')}}
                            !</span></button>
                </form>
            </div>
            <!-- /FORM POPUP CONTENT -->
        </div>
        <!-- /FORM POPUP -->


    </div>




    <div class="register-icon"></div>




</div>
<!-- /#content-wrapper -->


@endsection




@section('footer')
@parent

<!-- jQuery -->
<script src="/js/vendor/jquery-3.1.0.min.js"></script>
<!-- Tweet -->
<script src="/js/vendor/twitter/jquery.tweet.min.js"></script>
<!-- Side Menu -->
<script src="/js/side-menu.js"></script>
<!-- User Quickview Dropdown -->
<script src="/js/user-board.js"></script>
<!-- Footer -->
<script src="/js/footer.js"></script>
<!-- xmAlert -->
<script src="/js/vendor/jquery.xmalert.min.js"></script>



<script type="text/javascript">


    $(document).ready(function(){
        $("#register-form button").on('click', function(e){
            e.preventDefault();
            


            var img = new Image();
            img.src = "/images/dashboard/alert-logo.png";

            img.onload = function() {

                $('body').xmalert({
                    x: 'right',
                    y: 'top',
                    xOffset: 30,
                    yOffset: 30,
                    alertSpacing: 40,
                    lifetime: 200000,
                    fadeDelay: 0.3,
                    template: 'item',
                    title: '{!! __("auth.please_wait") !!}',
                    timestamp: '{!! __("auth.creating_account") !!}',
                    imgSrc: '/images/dashboard/alert-logo.png',
                    iconClass: 'icon-user',
                });

                $("#register-form").submit();
            };
            

            
        });
    });


</script>

@endsection