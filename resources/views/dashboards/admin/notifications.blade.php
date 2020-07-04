@extends('dashboards.layouts.master-dashboard')


@section('header')
@parent

<title>Dashboard - Notifications</title>

<link href='{{asset($asset."/css/app.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>
<link href='{{asset($asset."/css/dashboards/admin/settings.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>

<link href='{{asset($asset."/plugins/country-picker-flags/build/css/countrySelect.min.css?ver=".$ver)}}'
  rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.css" />


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" />
<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.css" rel="stylesheet"
  type="text/css" />
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css" />


@endsection




@section('body')
@parent


<div class="dashboard_content dashboard_notifications_page">





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
      <li class="dropdown-item">
        <a href="/dashboard">
          <span class="sl-icon icon-settings"></span>
          {{__('dashboard.account_settings')}}
        </a>
      </li>
      <!-- /DROPDOWN ITEM -->

      <!-- DROPDOWN ITEM -->
      <li class="dropdown-item active">
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




    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
      <!-- HEADLINE -->
      <div class="headline buttons primary">
        <h4>Your Notifications</h4>
        <a href="#" id="add_notification" class="button mid-short primary">إضافة إشعار</a>
      </div>
      <!-- /HEADLINE -->





      <table id="notifications_table" class="display responsive nowrap" width="100%" cellspacing="0" width="100%">
        <thead class="thead-dark">
          <tr>

            <th>delete_token</th>
            <th>الإشعار</th>
            <th>الجمهور/اللغة</th>
            <th>مشاهدات</th>
            <th>التوقيت</th>
            <th>عمليات</th>

          </tr>
        </thead>
        <tbody>



        </tbody>

      </table>





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


<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://rawgit.com/Danielku15/FixedHeader/master/js/dataTables.fixedHeader.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.js"></script>

<script src='{{asset($asset."/js/dashboards/admin/settings.js?ver=".$ver)}}' type='text/javascript'></script>


<script>
  $(document).ready(function(){












    window.notificationsTable = $("#notifications_table").DataTable({
      language: dt_lang[language],
      "pageLength": 50,

      "pagingType": "full_numbers",
      "ajax": {
        url: "/notifications/all",
        type: 'GET',
      },
      "columnDefs": [
        { targets: [0],  orderable: true },
      ],
      columns: [

        {data: 'id', name: 'id', 'visible': false },
        {data: 'content', name: 'content' },
        {data: 'audience', name: 'audience' },
        {data: 'views', name: 'views'  },
        {data: 'created_at', name: 'created_at' },
        
        {
          sortable: false,
          className: "tabel-actions",
          "render": function ( data, type, full, meta ) {
              return `
              <button class="dt-btn dt-btn-success" onclick="window.editNotification('`+full.id+`')">
                <svg><use xlink:href="#edit-icon"></use></svg> 
              </button>
              <button class="dt-btn dt-btn-danger" onclick="window.deleteNotification('`+full.delete_token+`')">
                <svg><use xlink:href="#delete-icon"></use></svg> 
              </button>

              `;
              
              
             /*  '<button class="bg-primary dt-btn" onclick="App.NotificationController().editNotification(\''+full.delete_token+'\')"><i class="material-icons">edit</i></button><button class="bg-danger dt-btn" onclick="App.NotificationController().deleteNotification(\''+full.delete_token+'\')"><i class="material-icons">delete_forever</i></button>';
               */

          }
        },


      ],
      "order": [[ 0, "desc" ]],
      "deferRender": true,
      "initComplete": function() {
        
      },
      
    });


    









    // ad notification
    $("#add_notification").on('click', function(){
      Swal.fire({
        title: 'إضافة إشعار',
        showCancelButton: true,
        confirmButtonText: 'إضافة',
        cancelButtonText: 'إالغاء',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-cancel',
          header: 'hdr hdr-m',
        },
        footer: false,
        buttonsStyling: false,
        showLoaderOnConfirm: true,
        html:
          `
        <div id="add_notification_modal">
          <textarea class="form-control" id="add_notification_textarea" placeholder="إكتب الإشعار هنا"></textarea>
          
          
          <table>
          
            <tr>
              <td>
                نوع الحسابات
              </td>
              <td>
                <label for="notification_accounts" class="select-block">
                  <select form="profile-info-form" name="notification_accounts" id="notification_accounts">
                    <option value="all">الجميع</option>
                    <option value="buyers"> المشترين</option>
                    <option value="sellers"> البائعين</option>
                    <option value="stores">المتاجر</option>
                    <option value="drivers">السائقين</option>
                  </select>
                
                  <svg class="svg-arrow">
                    <use xlink:href="#svg-arrow"></use>
                  </svg>
            </label>
              </td>
            </tr>



            <tr>
              <td>
                لغة الحسابات
              </td>
              <td>
                <label for="notification_language" class="select-block">
                  <select form="profile-info-form" name="notification_language" id="notification_language">
                    <option value="all">الجميع</option>
                    <option value="ar">العربية</option>
                    <option value="en">الإنجليزية</option>
                  </select>
                
                  <svg class="svg-arrow">
                    <use xlink:href="#svg-arrow"></use>
                  </svg>
                </label>
              </td>
            </tr>



          </table>



         
     
    

     
          

        </div>
        `,
        preConfirm: () => {

          if (!$("#add_notification_textarea").val()) {
            Swal.showValidationMessage("حقل الإشعار مطلوب");
          } else {

            return axios.post('/notifications', {
              notification_content: $("#add_notification_textarea").val(),
              notification_accounts: $('#notification_accounts').val(),
              notification_language : $("#notification_language").val(),
            })
              .then(function (response) {

                if (response.data.error == 1) {
                  throw new Error(response.data.message)
                }
                return response.data;
              }).catch(error => {
                Swal.showValidationMessage(
                  `${error}`
                )
              });
          }
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {

        if (result.value) {
          if (result.value.error == 1) {

            window.Toast.fire({
              icon: 'error',
              title: result.value.message
            })


          } else {
            window.Toast.fire({
              icon: 'success',
              title: result.value.message
            })

            window.notificationsTable.ajax.reload(null, false);
          }
        }


      })
    });


    // edit notification
    window.editNotification = function  (id) {

      var id = id;

      Swal.fire({
        html:
        '<p>جارى جلب البيانات ...</p><div class="lds-ring"><div></div><div></div><div></div><div></div></div>',
        showConfirmButton: false,
      })
     


      axios.get('/notifications/' + id)
        .then(function (response) {

          if (response.data.error == 0) {

            console.log(response.data);

            Swal.fire({
              title: 'تعديل إشعار',
              showCancelButton: true,
              confirmButtonText: "حفظ",
              cancelButtonText: "إلغاء",
              customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-cancel',
        },
        buttonsStyling: false,
              showLoaderOnConfirm: true,
              html:
                `
            <div id="edit_notification_modal">
              <textarea class="form-control" style="direction:rtl;text-align:center;min-height:100px;" id="edit_notification_textarea">`+ response.data.content + `</textarea>
            </div>
            `,
              preConfirm: () => {

                if (!$("#edit_notification_textarea").val()) {
                  Swal.showValidationMessage(window.translation.fields_required);
                } else {


                  return axios.put('/notifications/' + id, {
                    notification: $("#edit_notification_textarea").val(),
                  })
                    .then(function (response) {

                      if (response.data.error == 1) {
                        throw new Error(response.data.message)
                      }
                      return response.data;
                    }).catch(error => {
                      Swal.showValidationMessage(
                        `${error}`
                      )
                    });
                }
              },
              allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {

              if (result.value) {
                if (result.value.error == 1) {

                  window.Toast.fire({
                    icon: 'error',
                    title: result.value.message
                  })


                } else {
                  window.Toast.fire({
                    icon: 'success',
                    title: result.value.message
                  })

                  window.notificationsTable.ajax.reload(null, false);
                }
              }


            })



          } else {

            window.Toast.fire({
              icon: 'error',
              title: response.data.message,
            })

          }
        });

      }/* /editNotification() */




    
    
    
      // delete notification
    window.deleteNotification = function(delete_token){
      Swal.fire({
        title: 'هل أنت متأكد',
        text: "لن تساطيع إستعادة المحذوف",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "نعم إحذف",
        cancelButtonText: "إلغاء",
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-cancel',
        },
        buttonsStyling: false,
      }).then((result) => {
        if (result.value) {
          axios.delete('/notifications/' + delete_token)
            .then(function (response) {
              if (response.data.error == 0) {

                window.Toast.fire({
                  icon: 'success',
                  title: response.data.message,
                })

                window.notificationsTable.ajax.reload(null, false);
              } else {

                window.Toast.fire({
                  icon: 'error',
                  title: response.data.message,
                })

              }
            });
        }
      })
    }




    
  });

  
  window.translation = {

    'please_choose_image': "{!! __('dashboard.please_choose_image') !!} ",

  };


</script>

@parent

@endsection