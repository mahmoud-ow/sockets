@extends('layouts.app_pages')



@section('header')
@parent
<link href='{{asset($asset."/css/pages/auth_pages.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>
<title>{{__('auth.password_reset')}}</title>
@endsection



@section('content')

<!-- SECTION HEADLINE -->
<div class="section-headline-wrap">
    <div class="section-headline">
        <h2>{{__('auth.password_reset')}}</h2>
        <p>{{__('auth.home')}}<span class="separator">/</span><span
                class="current-section">{{__('auth.password')}}</span>
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


                <form id="register-form" method="POST" action="{{ route('password.update') }}">
                    @csrf


                    <label for="email" class="rl-label required">{{__('auth.email')}}</label>
                    <input type="email" id="email" name="email" class="" placeholder="{{__('auth.email_placeholder')}}"
                        value="{{(old('email'))?old('email'): $email}}">

                    <input type="hidden" name="key" value="{{ ( old('key') ) ? old('key') : $key }}">

                    <label for="password" class="rl-label required">{{__('auth.new_password')}}</label>
                    <input type="password" id="password" name="password"
                        placeholder="{{__('auth.new_password_placeholder')}}">




                    <label for="password_confirmation"
                        class="rl-label required">{{__('auth.new_password_repeat')}}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="{{__('auth.new_password_repeat_placeholder')}}">



                    <button class="button mid dark">{{__('auth.update')}} <span class="primary">{{__('auth.password')}}
                            !</span></button>



                </form>
            </div>
            <!-- /FORM POPUP CONTENT -->
        </div>
        <!-- /FORM POPUP -->


    </div>




    <div class="update-password-icon"></div>




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





@endsection