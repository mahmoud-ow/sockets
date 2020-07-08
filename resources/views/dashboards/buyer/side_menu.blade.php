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
    <li class="dropdown-item <?= ($_SERVER['REQUEST_URI']=='/dashboard') ? 'active': ''; ?>">
      <a href="/dashboard">
        <span class="sl-icon icon-settings"></span>
        {{__('dashboard.account_settings')}}
      </a>
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
  <p class="side-menu-title">{{__('dashboard.audience')}}</p>
  <!-- /SIDE MENU TITLE -->

  <!-- DROPDOWN -->
  <ul class="dropdown dark hover-effect">
    <!-- DROPDOWN ITEM -->
    <li class="dropdown-item <?= ($_SERVER['REQUEST_URI']=='/users') ? 'active': ''; ?>">
      <a href="/users">
        <span class="sl-icon icon-people"></span>
        {{__('dashboard.users')}}
      </a>
    </li>
    <!-- /DROPDOWN ITEM -->

    <!-- DROPDOWN ITEM -->
    <li class="dropdown-item <?= ($_SERVER['REQUEST_URI']=='/notifications') ? 'active': ''; ?>">
      <a href="/notifications">
        <span class="sl-icon icon-bell"></span>
        {{__('dashboard.notifications')}}
      </a>
      <!-- PIN -->
      <span class="pin soft-edged big primary" style="opacity: 0">49</span>
      <!-- /PIN -->
    </li>
    <!-- /DROPDOWN ITEM -->

    <!-- DROPDOWN ITEM -->
    <li class="dropdown-item <?= ($_SERVER['REQUEST_URI']=='/conversations') ? 'active': ''; ?>">
      <a href="/conversations">
        <span class="sl-icon icon-bubbles"></span>
        {{__('dashboard.conversations')}}
      </a>
    </li>
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