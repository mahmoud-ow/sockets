@extends('dashboards.layouts.master-dashboard')


@section('header')
@parent

<title>Dashboard - Notifications</title>

<link href='{{asset($asset."/css/app.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>
<link href='{{asset($asset."/css/dashboards/admin/settings.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>



<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" />
<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.css" rel="stylesheet"
  type="text/css" />


@endsection




@section('body')
@parent


<div class="dashboard_content dashboard_notifications_page">





  @include('/dashboards.admin.side_menu')



  <!-- DASHBOARD BODY -->
  <div class="dashboard-body">



    @include('/dashboards.admin.header')



    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">



    </div>
    <!-- DASHBOARD CONTENT -->




  </div>
  <!-- /DASHBOARD BODY -->




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


<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.js"></script>


<script>
  $(document).ready(function(){
    
    const TRANSLATION = {

      language : "{!! \App::getLocale() !!}",
      please_wait: "{!! trans('dashboard.please_wait') !!} ",
      
    };/* TRANSLATION */





    
  });

  
 


</script>

@parent

@endsection