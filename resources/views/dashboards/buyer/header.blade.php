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
    <h6 style="position: relative;top: -8px;">{{__('dashboard.dashboard')}}</h6>
    <p style="color: #06b99b;position: relative;top: -32px;font-size: 12px;">حساب بائع</p>
  </div>
  <!-- /DASHBOARD HEADER ITEM -->

  <!-- DASHBOARD HEADER ITEM -->
  {{-- 
    <div class="dashboard-header-item form">
      <form class="dashboard-search">
        <input type="text" name="search" id="search_dashboard" placeholder="Search on dashboard...">
        <input type="image" src="images/dashboard/search-icon.png" alt="search-icon">
      </form>
    </div> 
   --}}
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