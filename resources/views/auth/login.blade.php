@extends('layouts.app_pages')



@section('header')
@parent
<link href='{{asset($asset."/css/pages/auth_pages.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>
<title>{{__('auth.user_login')}}</title>
@endsection



@section('content')

<!-- SECTION HEADLINE -->
<div class="section-headline-wrap">
    <div class="section-headline">
        <h2>{{__('auth.user_login')}}</h2>
        <p>{{__('auth.home')}}<span class="separator">/</span><span class="current-section">{{__('auth.login')}}</span>
        </p>
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

                @if (\Session::has('verification_success'))
                <div class="form-success">{!! \Session::get('verification_success') !!}</div>
                @endif

               
                <form id="register-form" method="POST" action="{{ route('account.login') }}">
                    <div class="form-anchor"><a href="{{url('/users/register')}}">{{__('auth.register_an_account')}}</a></div>
                    @csrf

                    <label for="email" class="rl-label required">{{__('auth.email')}}</label>
                    <input type="email" id="email" name="email" class="" placeholder="{{__('auth.email_placeholder')}}"
                        value="{{old('email')}}">


                    <label for="password" class="rl-label required">{{__('auth.password')}}</label>
                    <input type="password" id="password" name="password"
                        placeholder="{{__('auth.password_placeholder')}}">
                    <!-- CHECKBOX -->
                    <input type="checkbox" id="remember" name="remember" checked>
                    <label for="remember" class="label-check">
                        <span class="checkbox primary primary"><span></span></span>
                        {{__('auth.remeber_auth')}}
                    </label>
                    <!-- /CHECKBOX -->
                    <p>{{__('auth.forget_password')}} <a href="{{ url('/users/login/forget-password') }}" class="primary">{{__('auth.click_here')}}</a></p>


                    <button class="button mid dark">{{__('auth.login')}} <span class="primary">{{__('auth.now')}}
                            !</span></button>

                    <!-- LINE SEPARATOR -->
                    <hr class="line-separator double">
                    <!-- /LINE SEPARATOR -->
                    <div id="login-social">
                        <a href="#" class="button mid fb half login-link">{{__('auth.login_facebook')}}</a>
                        <a href="#" class="button mid twt half login-link">{{__('auth.login_twitter')}}</a>
                    </div>

                </form>
            </div>
            <!-- /FORM POPUP CONTENT -->
        </div>
        <!-- /FORM POPUP -->


    </div>




    <div class="login-icon"></div>




</div>
<!-- /#content-wrapper -->


@endsection




@section('footer')
@parent


<!-- Tweet -->
<script src="/js/vendor/twitter/jquery.tweet.min.js"></script>
<!-- Side Menu -->
<script src="/js/side-menu.js"></script>
<!-- User Quickview Dropdown -->
<script src="/js/user-board.js"></script>
<!-- Footer -->
<script src="/js/footer.js"></script>





@endsection