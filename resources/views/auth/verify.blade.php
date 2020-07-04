@extends('layouts.app_pages')



@section('header')
@parent
<link href='{{asset($asset."/css/pages/auth_pages.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>
<title>{{__('auth.email_verification')}}</title>
@endsection



@section('content')

<!-- SECTION HEADLINE -->
<div class="section-headline-wrap">
    <div class="section-headline">
        <h2>{{__('auth.email_verification')}}</h2>
        <p>{{__('auth.home')}}<span class="separator">/</span><span
                class="current-section">{{__('auth.verification')}}</span></p>
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


                <form id="verify-form" method="POST" action="{{ route('account.email_verification') }}">
                    <div class="form-anchor"><a href="{{url('/users/login')}}">{{__('auth.account_login')}}</a></div>
                    @csrf


                    <label for="email" class="rl-label required">{{__('auth.email')}}</label>
                    <input type="email" id="email" name="email" class="" placeholder="{{__('auth.email_placeholder')}}"
                        value="{{ $email }}" readonly>


                    <label for="verification_key" class="rl-label required">{{__('auth.verification_key')}}</label>
                    <input type="text" id="verification_key" name="verification_key"
                        placeholder="{{__('auth.verification_key_placeholder')}}"
                        value="{{ (request('code')) ? request('code') : ''}}" />

                    <p class="highlighted"><span>{{__('auth.registration_thank')}}</span> {{__('auth.check_mail')}}</p>



                    <button class="button mid dark">{{__('auth.verify')}} <span class="primary">{{__('auth.now')}}
                            !</span></button>
                </form>

                <!-- LINE SEPARATOR -->
                <hr class="line-separator">
                <!-- /LINE SEPARATOR -->

                <a href="/users/register/email/verification/{{$email}}/resend" id="resend-verification"
                    class="resend-verification-link"><span class="icon-envelope"></span> &nbsp;
                    {{__('auth.click_here_to_resend_verification')}}</a>


            </div>
            <!-- /FORM POPUP CONTENT -->
        </div>
        <!-- /FORM POPUP -->


    </div>




    <div class="check-mail-icon"></div>



    <img src='{{asset($asset."/images/dashboard/alert-logo.png?ver=".$ver)}}' alt='' style="display: none">
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
    var verification_code = '{!! request("code") !!}';
    var verification_errors = '{!! count($errors) !!}';
 


    

    $(document).ready(function(){


        if( verification_code ){

            var img = new Image();
            img.src = "/images/dashboard/alert-logo.png";
            
            img.onload = function() {
                $('body').xmalert({
                    x: 'right',
                    y: 'top',
                    xOffset: 30,
                    yOffset: 30,
                    alertSpacing: 40,
                    lifetime: 20000,
                    fadeDelay: 0.3,
                    template: 'item',
                    title: '{!! __("auth.please_wait") !!}',
                    timestamp: '{!! __("auth.email_check_in_progress") !!}',
                    imgSrc: img.src,
                    iconClass: 'icon-envelope',
                });
                
                $("#verify-form").submit();
            };

        } else {

            if( verification_errors == 0 ){
                $('body').xmalert({
                    x: 'right',
                    y: 'top',
                    xOffset: 30,
                    yOffset: 30,
                    alertSpacing: 40,
                    lifetime: 5000,
                    fadeDelay: 0.3,
                    template: 'item',
                    title: '{!! __("auth.activating_email") !!}',
                    timestamp: '{!! __("auth.check_your_email_for_code") !!}',
                    imgSrc: '/images/dashboard/alert-logo.png',
                    iconClass: 'icon-user',
                });
            }
            
        }

        



        $("#verify-form button").on('click', function(e){
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
                    timestamp: '{!! __("auth.checking_verification_code") !!}',
                    imgSrc: '/images/dashboard/alert-logo.png',
                    iconClass: 'icon-user',
                });
                $("#verify-form").submit();
            };
        });


























        $("#resend-verification").click(function(e){
            
            e.preventDefault();
            var newLocation = $(this).attr('href');

            

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
                    timestamp: '{!! __("auth.resend_verification_code_in_progress") !!}',
                    imgSrc: img.src,
                    iconClass: 'icon-envelope',
                });
                window.location.href = newLocation;
            };
            
           

        });

    });/* /ready() */

</script>




@endsection