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





  <!-- SIDE MENU -->
  <div id="dashboard-options-menu" class="side-menu dashboard left closed">
    <!-- SVG PLUS -->
    <svg class="svg-plus">
      <use xlink:href="#svg-plus"></use>
    </svg>
    <!-- /SVG PLUS -->

    <!-- SIDE MENU HEADER -->
    <div class="side-menu-header">
      <!-- USER QUICKVIEW -->
      <div class="user-quickview">
        <!-- USER AVATAR -->
        <a href="author-profile.html">
          <div class="outer-ring">
            <div class="inner-ring"></div>
            <figure class="user-avatar">
              <img
                src="{{ ( auth()->user()->getMedia('avatar')->first() ) ? auth()->user()->getMedia('avatar')->first()->getUrl('thumb') : 'images/avatars/avatar_01.jpg' }}"
                alt="avatar">
            </figure>
          </div>
        </a>
        <!-- /USER AVATAR -->

        <!-- USER INFORMATION -->
        <p class="user-name" style="text-transform: capitalize;">{{auth()->user()->username}}</p>
        <p class="user-money">${{auth()->user()->balance}}</p>
        <!-- /USER INFORMATION -->
      </div>
      <!-- /USER QUICKVIEW -->
    </div>
    <!-- /SIDE MENU HEADER -->

    <!-- SIDE MENU TITLE -->
    <p class="side-menu-title">{{__('dashboard.your_account')}}</p>
    <!-- /SIDE MENU TITLE -->

    <!-- DROPDOWN -->
    <ul class="dropdown dark hover-effect interactive">
      <!-- DROPDOWN ITEM -->
      <li class="dropdown-item active">
        <a href="/dashboard">
          <span class="sl-icon icon-settings"></span>
          {{__('dashboard.account_settings')}}
        </a>
      </li>
      <!-- /DROPDOWN ITEM -->

      <!-- DROPDOWN ITEM -->
      <li class="dropdown-item">
        <a href="/notifications">
          <span class="sl-icon icon-star"></span>
          {{__('dashboard.notifications')}}
        </a>
        <!-- PIN -->
        <span class="pin soft-edged big primary" style="opacity: 0">49</span>
        <!-- /PIN -->
      </li>
      <!-- /DROPDOWN ITEM -->

      <!-- DROPDOWN ITEM -->
      {{-- <li class="dropdown-item interactive">
      <a href="#">
        <span class="sl-icon icon-envelope"></span>
        Messages
        <!-- SVG ARROW -->
        <svg class="svg-arrow">
          <use xlink:href="#svg-arrow"></use>
        </svg>
        <!-- /SVG ARROW -->
      </a>

      <!-- INNER DROPDOWN -->
      <ul class="inner-dropdown">
        <!-- INNER DROPDOWN ITEM -->
        <li class="inner-dropdown-item">
          <a href="dashboard-inbox.html">Your Inbox (36)</a>
          <!-- PIN -->
          <span class="pin soft-edged secondary">2</span>
          <!-- /PIN -->
        </li>
        <!-- /INNER DROPDOWN ITEM -->

        <!-- INNER DROPDOWN ITEM -->
        <li class="inner-dropdown-item">
          <a href="dashboard-inbox-v2.html">Your Inbox (36) V2</a>
        </li>
        <!-- /INNER DROPDOWN ITEM -->

        <!-- INNER DROPDOWN ITEM -->
        <li class="inner-dropdown-item">
          <a href="dashboard-openmessage.html">Open Message</a>
        </li>
        <!-- /INNER DROPDOWN ITEM -->

        <!-- INNER DROPDOWN ITEM -->
        <li class="inner-dropdown-item">
          <a href="dashboard-inbox.html">Starred Message</a>
        </li>
        <!-- /INNER DROPDOWN ITEM -->

        <!-- INNER DROPDOWN ITEM -->
        <li class="inner-dropdown-item">
          <a href="dashboard-inbox.html">Deleted Messages</a>
        </li>
        <!-- /INNER DROPDOWN ITEM -->
      </ul>
      <!-- INNER DROPDOWN -->

      <!-- PIN -->
      <span class="pin soft-edged big secondary">!</span>
      <!-- /PIN -->
    </li> --}}
      <!-- /DROPDOWN ITEM -->

      <!-- DROPDOWN ITEM -->
      {{-- <li class="dropdown-item">
      <a href="dashboard-purchases.html">
        <span class="sl-icon icon-tag"></span>
        Your Purchases
      </a>
    </li> --}}
      <!-- /DROPDOWN ITEM -->

      <!-- DROPDOWN ITEM -->
      {{-- <li class="dropdown-item">
      <a href="dashboard-buycredits.html">
        <span class="sl-icon icon-credit-card"></span>
        Buy Credits
      </a>
    </li> --}}
      <!-- /DROPDOWN ITEM -->
    </ul>
    <!-- /DROPDOWN -->

    <!-- SIDE MENU TITLE -->
    <p class="side-menu-title">{{__('dashboard.info_statics')}}</p>
    <!-- /SIDE MENU TITLE -->

    <!-- DROPDOWN -->
    <ul class="dropdown dark hover-effect">
      <!-- DROPDOWN ITEM -->
      <li class="dropdown-item">
        <a href="dashboard-statement.html">
          <span class="sl-icon icon-layers"></span>
          {{__('dashboard.sales_statment')}}
        </a>
      </li>
      <!-- /DROPDOWN ITEM -->

      <!-- DROPDOWN ITEM -->
      <li class="dropdown-item">
        <a href="dashboard-statistics.html">
          <span class="sl-icon icon-chart"></span>
          {{__('dashboard.statics')}}
        </a>
      </li>
      <!-- /DROPDOWN ITEM -->
    </ul>
    <!-- /DROPDOWN -->

    <!-- SIDE MENU TITLE -->
    <p class="side-menu-title">{{__('dashboard.author_tools')}}</p>
    <!-- /SIDE MENU TITLE -->

    <!-- DROPDOWN -->
    <ul class="dropdown dark hover-effect">
      <!-- DROPDOWN ITEM -->
      <li class="dropdown-item">
        <a href="dashboard-uploaditem.html">
          <span class="sl-icon icon-arrow-up-circle"></span>
          {{__('dashboard.upload_item')}}
        </a>
      </li>
      <!-- /DROPDOWN ITEM -->

      <!-- DROPDOWN ITEM -->
      <li class="dropdown-item">
        <a href="dashboard-manageitems.html">
          <span class="sl-icon icon-folder-alt"></span>
          {{__('dashboard.manage_items')}}
        </a>
      </li>
      <!-- /DROPDOWN ITEM -->

      <!-- DROPDOWN ITEM -->
      <li class="dropdown-item">
        <a href="dashboard-withdrawals.html">
          <span class="sl-icon icon-wallet"></span>
          {{__('dashboard.withdrawal')}}
        </a>
      </li>
      <!-- /DROPDOWN ITEM -->
    </ul>
    <!-- /DROPDOWN -->

    {{-- <a href="#" class="button medium secondary">Logout</a> --}}
    <form action="/users/logout" method="POST">
      @csrf
      <button class="button medium secondary">{{__('dashboard.logout')}} </button>
    </form>



  </div>
  <!-- /SIDE MENU -->

  <!-- DASHBOARD BODY -->
  <div class="dashboard-body">
    <!-- DASHBOARD HEADER -->
    <div class="dashboard-header retracted">
      <!-- DB CLOSE BUTTON -->
      <a href="/" class="db-close-button">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor"
          xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
            d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
          <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
        </svg>
      </a>
      <!-- DB CLOSE BUTTON -->

      <!-- DB OPTIONS BUTTON -->
      <div class="db-options-button">
        <img src="images/dashboard/db-list-right.png" alt="db-list-right">
        <img src="images/dashboard/close-icon.png" alt="close-icon">
      </div>
      <!-- DB OPTIONS BUTTON -->

      <!-- DASHBOARD HEADER ITEM -->
      <div class="dashboard-header-item title">
        <!-- DB SIDE MENU HANDLER -->
        <div class="db-side-menu-handler">
          <img src="images/dashboard/db-list-left.png" alt="db-list-left">
        </div>
        <!-- /DB SIDE MENU HANDLER -->
        <h6>{{__('dashboard.dashboard')}}</h6>
      </div>
      <!-- /DASHBOARD HEADER ITEM -->

      <!-- DASHBOARD HEADER ITEM -->
      {{-- <div class="dashboard-header-item form">
      <form class="dashboard-search">
        <input type="text" name="search" id="search_dashboard" placeholder="Search on dashboard...">
        <input type="image" src="images/dashboard/search-icon.png" alt="search-icon">
      </form>
    </div> --}}
      <!-- /DASHBOARD HEADER ITEM -->

      <!-- DASHBOARD HEADER ITEM -->
      <div class="dashboard-header-item stats">
        <!-- STATS META -->
        <div class="stats-meta">
          <div class="pie-chart pie-chart1">
            <!-- SVG PLUS -->
            <svg class="svg-plus primary">
              <use xlink:href="#svg-plus"></use>
            </svg>
            <!-- /SVG PLUS -->
          </div>
          <h6>64.579</h6>
          <p>{{__('dashboard.new_original_visits')}}</p>
        </div>
        <!-- /STATS META -->
      </div>
      <!-- /DASHBOARD HEADER ITEM -->

      <!-- DASHBOARD HEADER ITEM -->
      <div class="dashboard-header-item stats">
        <!-- STATS META -->
        <div class="stats-meta">
          <div class="pie-chart pie-chart2">
            <!-- SVG PLUS -->
            <svg class="svg-minus tertiary">
              <use xlink:href="#svg-minus"></use>
            </svg>
            <!-- /SVG PLUS -->
          </div>
          <h6>20.8</h6>
          <p>{{__('dashboard.less_sales_than_last_month')}}</p>
        </div>
        <!-- /STATS META -->
      </div>
      <!-- /DASHBOARD HEADER ITEM -->

      <!-- DASHBOARD HEADER ITEM -->
      <div class="dashboard-header-item stats">
        <!-- STATS META -->
        <div class="stats-meta">
          <div class="pie-chart pie-chart3">
            <!-- SVG PLUS -->
            <svg class="svg-plus primary">
              <use xlink:href="#svg-plus"></use>
            </svg>
            <!-- /SVG PLUS -->
          </div>
          <h6>322k</h6>
          <p>{{__('dashboard.total_visits_this_month')}}</p>
        </div>
        <!-- /STATS META -->
      </div>
      <!-- /DASHBOARD HEADER ITEM -->

      <!-- DASHBOARD HEADER ITEM -->
      <div class="dashboard-header-item back-button">
        <a href="/" class="button mid dark-light">{{__('dashboard.back_to_home_page')}}</a>
      </div>
      <!-- /DASHBOARD HEADER ITEM -->
    </div>
    <!-- DASHBOARD HEADER -->

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

  <!-- SVG ARROW -->
  <svg style="display: none;">
    <symbol id="svg-arrow" viewBox="0 0 3.923 6.64014" preserveAspectRatio="xMinYMin meet">
      <path
        d="M3.711,2.92L0.994,0.202c-0.215-0.213-0.562-0.213-0.776,0c-0.215,0.215-0.215,0.562,0,0.777l2.329,2.329
L0.217,5.638c-0.215,0.215-0.214,0.562,0,0.776c0.214,0.214,0.562,0.215,0.776,0l2.717-2.718C3.925,3.482,3.925,3.135,3.711,2.92z" />
    </symbol>
  </svg>
  <!-- /SVG ARROW -->

  <!-- SVG PLUS -->
  <svg style="display: none;">
    <symbol id="svg-plus" viewBox="0 0 13 13" preserveAspectRatio="xMinYMin meet">
      <rect x="5" width="3" height="13" />
      <rect y="5" width="13" height="3" />
    </symbol>
  </svg>
  <!-- /SVG PLUS -->

  <!-- SVG MINUS -->
  <svg style="display: none;">
    <symbol id="svg-minus" viewBox="0 0 13 13" preserveAspectRatio="xMinYMin meet">
      <rect y="5" width="13" height="3" />
    </symbol>
  </svg>
  <!-- /SVG MINUS -->




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