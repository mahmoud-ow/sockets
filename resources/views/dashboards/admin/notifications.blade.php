@extends('dashboards.layouts.master-dashboard')


@section('header')
@parent

<title>Dashboard - Notifications</title>

<link href='{{asset($asset."/css/app.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>
<link href='{{asset($asset."/css/dashboards/dashboards.css?ver=".$ver)}}' rel='stylesheet' type='text/css'>



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
      <!-- HEADLINE -->
      <div class="headline buttons primary">
        <h4>{{__('dashboard.notifications')}}</h4>
        <a href="#" id="add_notification" class="button mid-short primary">{{__('dashboard.add_notification')}}</a>
      </div>
      <!-- /HEADLINE -->


      <table id="notifications_table" class="display responsive nowrap" width="100%" cellspacing="0" width="100%">
        <thead class="thead-dark">
          <tr>

            <th>notification_token</th>
            <th>{{__('dashboard.the_notification')}}</th>
            <th>{{__('dashboard.audience_language')}}</th>
            <th>{{__('dashboard.views')}}</th>
            <th>{{__('dashboard.time')}}</th>
            <th>{{__('dashboard.operations')}}</th>

          </tr>
        </thead>
      </table>





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


<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.js"></script>

<script src='{{asset($asset."/js/dashboards/admin/settings.js?ver=".$ver)}}' type='text/javascript'></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />


<script>
  $(document).ready(function(){
    
    const TRANSLATION = {

      language : "{!! \App::getLocale() !!}",
      please_wait: "{!! trans('dashboard.please_wait') !!} ",
      count_notified: "{!! trans('dashboard.count_notified') !!} ",

      add: "{!! trans('dashboard.add') !!} ",
      cancel: "{!! trans('dashboard.cancel') !!} ",
      save: "{!! trans('dashboard.save') !!} ",
      add_notification: "{!! trans('dashboard.add_notification') !!} ",
      accounts_types : "{!! trans('dashboard.accounts_types') !!}",
      accounts_languages : "{!! trans('dashboard.accounts_languages') !!}",
      notification_field_required : "{!! trans('dashboard.notification_field_required') !!}",
      notification_here : "{!! trans('dashboard.notification_here') !!}",

      all : "{!! trans('dashboard.all') !!}",
      buyers : "{!! trans('dashboard.buyers') !!}",
      sellers : "{!! trans('dashboard.sellers') !!}",
      stores : "{!! trans('dashboard.stores') !!}",
      drivers : "{!! trans('dashboard.drivers') !!}",
      arabic : "{!! trans('dashboard.arabic') !!}",
      english : "{!! trans('dashboard.english') !!}",
      loading_data : "{!! trans('dashboard.loading_data') !!}",
      edit_notification : "{!! trans('dashboard.edit_notification') !!}",
      are_you_sure : "{!! trans('dashboard.are_you_sure') !!}",
      cant_revert : "{!! trans('dashboard.cant_revert') !!}",
      yes_delete : "{!! trans('dashboard.yes_delete') !!}",

    };/* TRANSLATION */




    //$('.tooltip').tooltipster();

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
              <button class="dt-btn dt-btn-success" onclick="window.editNotification('`+full.notification_token+`')">
                <svg><use xlink:href="#edit-icon"></use></svg> 
              </button>
              <button class="dt-btn dt-btn-danger" onclick="window.deleteNotification('`+full.notification_token+`')">
                <svg><use xlink:href="#delete-icon"></use></svg> 
              </button>
              `;
              

          }
        },


      ],
      "order": [[ 0, "desc" ]],
      "deferRender": true,
      "initComplete": function() {
        
      },
      "drawCallback": function() {
        
        

        tippy('.myButton', {
          content: TRANSLATION.count_notified,
          onMount(instance) {
          const box = instance.popper.firstElementChild;
            requestAnimationFrame(() => {
              box.classList.add('animate__animated');
              box.classList.add('animate__pulse');
              box.classList.add('custom-tooltip');
            });
          },
          onHidden(instance) {
            const box = instance.popper.firstElementChild;
            box.classList.remove('animate__animated');
            box.classList.remove('animate__pulse');
          },
        });



      },
      
    });


    









    // add notification
    $("#add_notification").on('click', function(){
      Swal.fire({
        title: TRANSLATION.add_notification,
        showCancelButton: true,
        confirmButtonText: TRANSLATION.add,
        cancelButtonText: TRANSLATION.cancel,
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
          <textarea class="form-control" id="add_notification_textarea" placeholder="`+TRANSLATION.notification_here+`"></textarea>
          
          
          <table>
          
            <tr>
              <td>
                `+TRANSLATION.accounts_types+`
              </td>
              <td>
                <label for="notification_accounts" class="select-block">
                  <select form="profile-info-form" name="notification_accounts" id="notification_accounts">
                    <option value="all">`+TRANSLATION.all+`</option>
                    <option value="buyer"> `+TRANSLATION.buyers+`</option>
                    <option value="seller"> `+TRANSLATION.sellers+`</option>
                    <option value="store">`+TRANSLATION.stores+`</option>
                    <option value="driver">`+TRANSLATION.drivers+`</option>
                  </select>
                
                  <svg class="svg-arrow">
                    <use xlink:href="#svg-arrow"></use>
                  </svg>
            </label>
              </td>
            </tr>



            <tr>
              <td>
                `+TRANSLATION.accounts_languages+`
              </td>
              <td>
                <label for="notification_language" class="select-block">
                  <select form="profile-info-form" name="notification_language" id="notification_language">
                    <option value="all">`+TRANSLATION.all+`</option>
                    <option value="ar">`+TRANSLATION.arabic+`</option>
                    <option value="en">`+TRANSLATION.english+`</option>
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
            Swal.showValidationMessage(TRANSLATION.notification_field_required);
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
      $("#add_notification_textarea").focus();
    });


    
    
    
    
    
    
    
    
    
    
    
    
    // edit notification
    window.editNotification = function  (notification_token) {

      var notification_token = notification_token;

      Swal.fire({
        html:
        '<p>'+TRANSLATION.loading_data+'</p><div class="lds-ring"><div></div><div></div><div></div><div></div></div>',
        showConfirmButton: false,
      })
     


      axios.get('/notifications/' + notification_token)
        .then(function (response) {

          if (response.data.error == 0) {

            console.log(response.data);

            Swal.fire({
              title: TRANSLATION.edit_notification,
              showCancelButton: true,
              confirmButtonText: TRANSLATION.save,
              cancelButtonText: TRANSLATION.cancel,
              customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-cancel',
                header: 'hdr hdr-m',
              },
              buttonsStyling: false,
              showLoaderOnConfirm: true,
              html: response.data.edit_html,
              preConfirm: () => {

                if (!$("#edit_notification_textarea").val()) {
                  Swal.showValidationMessage(window.translation.fields_required);
                } else {


                  return axios.put('/notifications/' + notification_token, {
                    notification_content: $("#edit_notification_textarea").val(),
                    notification_accounts: $('#edit_notification_accounts').val(),
                    notification_language : $("#edit_notification_language").val(),
                  })
                    .then(function (response) {
                      console.log( JSON.stringify(response.data) );
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
    window.deleteNotification = function(notification_token){
      Swal.fire({
        title: TRANSLATION.are_you_sure,
        text: TRANSLATION.cant_revert,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: TRANSLATION.yes_delete,
        cancelButtonText: TRANSLATION.cancel,
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-cancel',
        },
        buttonsStyling: false,
      }).then((result) => {
        if (result.value) {
          axios.delete('/notifications/' + notification_token)
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

  
 


</script>

@parent

@endsection