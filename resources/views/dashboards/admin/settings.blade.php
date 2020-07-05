@extends('dashboards.layouts.master-dashboard')


@section('header')
@parent

<title>Admin Dashboard</title>

<link href='{{asset($asset."/css/app.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>
<link href='{{asset($asset."/css/dashboards/admin/settings.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>

<link href='{{asset($asset."/plugins/country-picker-flags/build/css/countrySelect.min.css?ver=".$ver)}}'
  rel='stylesheet' type='text/css'>
@endsection




@section('body')
@parent


<div class="dashboard_content dashboard_settings_page">





  @include('/dashboards.admin.side_menu')

  <!-- DASHBOARD BODY -->
  <div class="dashboard-body">
   
   
    @include('/dashboards.admin.header')


    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
      <!-- HEADLINE -->
      <div class="headline buttons primary">
        <h4>{{__('dashboard.account_settings')}}</h4>
        <button id="save_changes" form="profile-info-form"
          class="button mid-short primary">{{__('dashboard.save_changes')}}</button>
      </div>
      <!-- /HEADLINE -->

      <!-- FORM BOX ITEMS -->
      <div class="form-box-items">
        <!-- FORM BOX ITEM -->
        <div class="form-box-item">
          <h4>{{__('dashboard.profile_information')}}</h4>
          <hr class="line-separator">
          <!-- PROFILE IMAGE UPLOAD -->
          <div class="profile-image">
            <div class="profile-image-data">
              <figure class="user-avatar medium">
                <img
                  src="{{ ( auth()->user()->getMedia('avatar')->first() ) ? auth()->user()->getMedia('avatar')->first()->getUrl('thumb') : 'images/dashboard/profile-default-image.png' }}"
                  alt="profile-default-image">
              </figure>
              <p class="text-header">{{__('dashboard.profile_photo')}}</p>
              <p class="upload-details">Minimum size 70x70px</p>
            </div>
            <a href="#" id="upload_image_btn"
              class="button mid-short dark-light">{{__('dashboard.upload_image_dotted')}}</a>
          </div>
          <!-- PROFILE IMAGE UPLOAD -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <label for="acc_name" class="rl-label required">{{__('dashboard.account_name')}}</label>
            <input type="text" id="acc_name" name="acc_name" value="{{ auth()->user()->username }}"
              placeholder="{{__('dashboard.enter_account_name')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container half">
            <label for="new_pwd" class="rl-label">{{__('dashboard.new_password')}}</label>
            <input type="password" id="new_pwd" name="new_pwd" placeholder="{{__('dashboard.enter_password_here')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container half">
            <label for="new_pwd2" class="rl-label">{{__('dashboard.repeat_password')}}</label>
            <input type="password" id="new_pwd2" name="new_pwd2" placeholder="{{__('dashboard.repeat_password_here')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <label for="new_email" class="rl-label">{{__('dashboard.email')}}</label>
            <input readonly disabled type="email" id="new_email" name="new_email"
              placeholder="{{__('dashboard.enter_email_here')}}" value="{{ auth()->user()->email }}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container half">
            <label for="website_url" class="rl-label">{{__('dashboard.website')}}</label>
            <input type="text" id="website_url" name="website_url" value="{{auth()->user()->website}}" placeholder="{{__('dashboard.enter_website')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container half">

            <label for="country1" class="rl-label required">{{__('dashboard.country')}}</label>
            <input type="text" id="country_selector" style="width: 100%;">


            {{-- <label for="country1" class="select-block">
              <select name="country1" id="country1">
                <option value="0">{{__('dashboard.select_your_country')}}</option>
            <option value="1">United States</option>
            <option value="2">Argentina</option>
            <option value="3">Brasil</option>
            <option value="4">Japan</option>
            </select>
            <!-- SVG ARROW -->
            <svg class="svg-arrow">
              <use xlink:href="#svg-arrow"></use>
            </svg>
            <!-- /SVG ARROW -->
            </label> --}}


          </div>
          <!-- /INPUT CONTAINER -->

        </div>
        <!-- /FORM BOX ITEM -->












        <!-- FORM BOX ITEM -->
        <div class="form-box-item spaced">
          <h4>{{__('dashboard.social_media')}}</h4>
          <hr class="line-separator">

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="fb"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_fb_link" name="social_fb_link"
          value="{{$social->fb_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="twt"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_twt_link" name="social_twt_link"
              value="{{$social->twt_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="gplus"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_gplus_link" name="social_gplus_link"
              value="{{$social->gplus_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="rss"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_rss_link" name="social_rss_link"
              value="{{$social->rss_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="db"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_db_link" name="social_db_link"
              value="{{$social->db_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="be"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_be_link" name="social_be_link"
              value="{{$social->be_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->

          <!-- INPUT CONTAINER -->
          <div class="input-container">
            <ul class="share-links">
              <li><a href="#" class="de"></a></li>
            </ul>
            <input form="profile-info-form" type="text" id="social_de_link" name="social_de_link"
              value="{{$social->de_url}}" placeholder="{{__('dashboard.enter_social_link')}}">
          </div>
          <!-- /INPUT CONTAINER -->
        </div>
        <!-- /FORM BOX ITEM -->








      </div>
      <!-- /FORM BOX -->
    </div>
    <!-- DASHBOARD CONTENT -->
  </div>
  <!-- /DASHBOARD BODY -->

  <div class="shadow-film closed"></div>



</div>
<!-- /.dashboard_content -->

@endsection




@section('footer')


<!-- XM Pie Chart -->
<script src="js/vendor/jquery.xmpiechart.min.js"></script>
<!-- Side Menu -->
<script src="js/side-menu.js"></script>
<!-- Dashboard Header -->
<script src="js/dashboard-header.js"></script>

<script src='{{asset($asset."/js/dashboards/admin/settings.js?ver=".$ver)}}' type='text/javascript'></script>
<script src='{{asset($asset."/plugins/country-picker-flags/build/js/countrySelect.js?ver=".$ver)}}'
  type='text/javascript'></script>


<script>
  $(document).ready(function(){

    window.TRANSLATION = {

      change_profile_picture : "{!! trans('dashboard.change_profile_picture') !!}",
      save : "{!! trans('dashboard.save') !!}",
      cancel : "{!! trans('dashboard.cancel') !!}",

    };/* TRANSLATION */


    $("#country_selector").countrySelect({
      preferredCountries: ['iq'],
    });

    $("#country_selector").countrySelect("setCountry", '{!! (auth()->user()->country) ? auth()->user()->country : "Iraq (‫العراق‬‎)" !!}');
  });

  
  window.translation = {

    'please_choose_image': "{!! __('dashboard.please_choose_image') !!} ",

  };


</script>

@parent

@endsection