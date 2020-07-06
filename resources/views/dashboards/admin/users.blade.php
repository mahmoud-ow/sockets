@extends('dashboards.layouts.master-dashboard')


@section('header')
@parent

<title>Dashboard - Users</title>

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

      <table id="users_table" class="display responsive nowrap" width="100%" cellspacing="0" width="100%">
        <thead class="thead-dark">
          <tr>

            <th>ID</th>
            <th>الإسم</th>
            <th>البريد الإلكترونى</th>
            <th>الحساب</th>
            <th>نوع الحساب</th>
            <th>عمليات</th>

          </tr>
        </thead>

      </table>


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
    
    

    window.TRANSLATION = {

      language : "{!! \App::getLocale() !!}",
      please_wait: "{!! trans('dashboard.please_wait') !!} ",
      edit_account_type: "{!! trans('dashboard.edit_account_type') !!} ",
      update: "{!! trans('dashboard.update') !!} ",
      cancel: "{!! trans('dashboard.cancel') !!} ",
      
    };/* window.TRANSLATION */



    window.usersTable = $('#users_table').DataTable({
          
          responsive: true,
          language: dt_lang[language],
          "pageLength": 25,
          "pagingType": "full_numbers",


          "ajax": {
            url: "/fetch-users",
            type: 'GET',
          },
          "columnDefs": [
            { "orderable": true, "targets": 0 },
           /*  { className: "text-center", "targets": [3] },
            { className: "no-pd", "targets": [4] }, */
            
          ],
          columns: [
            { data: 'id', name: 'id', 'visible': false },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            {
              sortable: false,

              "render": function (data, type, full, meta) {
                var state = '';
                var changeState;
                if (full.banned == 0) { state = 'checked'; changeState = 1;  } else { changeState = 0; }
                return '<div style="direction:ltr;"><input onchange="changeUserState(' + full.id + ', ' + changeState + ')" id="checkbox_' + full.id + '" type="checkbox" class="checkbox" style="display:none;" ' + state + '/><label for="checkbox_' + full.id + '" class="switch" style="margin:auto;"><span class="switch__circle"><span class="switch__circle-inner"></span></span><span class="switch__left">Off</span><span class="switch__right">On</span></label></div>';

              }
            },
            {
              sortable: false,

              "render": function (data, type, full, meta) {
                
                var account_type = '';

                if (full.account_type == 'admin') {
                   account_type = "{!! trans('dashboard.admin') !!} "; 
                } else if( full.account_type == 'buyer' ) {
                   account_type = "{!! trans('dashboard.buyer') !!}"; 
                } else if( full.account_type == 'seller' ){
                   account_type = "{!! trans('dashboard.seller') !!}"; 
                } else if( full.account_type == 'store' ){
                   account_type = "{!! trans('dashboard.store') !!}"; 
                } else if( full.account_type == 'driver' ){
                   account_type = "{!! trans('dashboard.driver') !!}"; 
                }


                return `
                <div class="account-type" onclick="changeAccountType(` + full.id + `, '`+full.email+`', '`+full.account_type+`' )">
                  <svg><use xlink:href="#change_state_svg"></use></svg> | `+ account_type +` 
                </div>`;


              }
            },

            
            


            {
              sortable: false,
              className: "tabel-actions",
              "render": function ( data, type, full, meta ) {

                
                var newContact = {name: 'mahmoud', age: 18};
                return `
                <button class="dt-btn dt-btn-chat" onclick='window.App.$refs.ChatApp.$refs.form.viewOpenChat(`+ JSON.stringify(full) +`)'>
                  <svg><use xlink:href="#msg-icon"></use></svg> 
                </button>
                <button class="dt-btn dt-btn-success" onclick="window.editNotification('`+full.notification_token+`')">
                  <svg><use xlink:href="#user-icon"></use></svg> 
                </button>
                <button class="dt-btn dt-btn-danger" onclick="deleteUser('`+full.id+`')">
                  <svg><use xlink:href="#delete-icon"></use></svg> 
                </button>
                `;
                  

              }
            },

          ],
          "order": [[0, 'desc']],
          "deferRender": true,
          "initComplete": function () {

          },
        });

    
  });

  

  
  function deleteUser(id){
    Swal.fire({
      icon: 'warning',
      title: "{!! trans('dashboard.are_you_sure') !!}",
      text: "{!! trans('dashboard.cant_revert') !!}",
      cancelButtonText: "{!! trans('dashboard.cancel') !!}",
      confirmButtonText: "{!! trans('dashboard.yes_delete') !!}",
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-cancel',
      },
      showCancelButton: true,
      buttonsStyling: false,
      
    }).then((result) => {
      if (result.value) {
        axios.delete('/users/' + id)
          .then(function (response) {
            if (response.data.error == 0) {

              window.Toast.fire({
                icon: 'success',
                title: response.data.message
              })

              window.usersTable.ajax.reload(null, false);
            } else {

              window.Toast.fire({
                icon: 'error',
                title: response.data.message
              })

            }
          });
      }
    })
  }
  // /deleteUser()




  function changeAccountType(id, email, account_type){

    // select user account type option
    var account_types = [
      ['admin',  "{!! trans('dashboard.admin') !!}"],
      ['buyer',  "{!! trans('dashboard.buyer') !!}"],
      ['seller', "{!! trans('dashboard.seller') !!}"],
      ['store', "{!! trans('dashboard.store') !!}"],
      ['driver', "{!! trans('dashboard.driver') !!}"],
    ];
    var options = '';
    account_types.forEach(function(item){
      var selectedOption = '';
      if(item[0] == account_type){
        selectedOption = 'selected';
      }
      options += '<option '+selectedOption+' value="'+item[0]+'" >'+item[1]+'</option>';
    });

    Swal.fire({
      title: "{!! trans('dashboard.edit_account_type') !!}",
      confirmButtonText: "{!! trans('dashboard.update') !!}",
      cancelButtonText: "{!! trans('dashboard.cancel') !!}",
      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-cancel',
        header: 'hdr hdr-m',
      },
      buttonsStyling: false,
      showLoaderOnConfirm: true,
      html:
        `
      <h3 style="color: #2b373a;direction: ltr;display: flex;justify-content: center;align-items: center;margin-bottom: 25px;"><svg style="height:30px;width:30px;font-size:30px;"><use xlink:href="#user-icon"></use></svg> &nbsp;&nbsp; `+ email + `</h3>
      <div>
        <label for="choose-account-type" class="select-block">
          <select id="choose-account-type" class="form-control">
          `+options+`
          </select>
        
          <svg class="svg-arrow">
            <use xlink:href="#svg-arrow"></use>
          </svg>
        </label>
        
      </div>
      `,
      preConfirm: () => {

        if (!$("#choose-account-type").val()) {
          Swal.showValidationMessage("{!! trans('dashboard.fields_required') !!}");
        } else {

          return axios.post('/users/' + id + '/account_type', {
            account_id: id,
            account_email: email,
            account_type: $("#choose-account-type").val(),
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

          window.usersTable.ajax.reload(null, false);
        }
      }


    })
  }
  // /changeAccountType()




  // change user state ( banned or not )
  function changeUserState(id, newState){
    axios.put('/users/' + id + '/state', {
      new_state: newState,
    })
    .then(function (response) {
      if (response.data.error == 0) {

        window.Toast.fire({
          icon: 'success',
          title: response.data.message
        })

      } else {

        window.Toast.fire({
          icon: 'error',
          title: response.data.message
        })

      }
      window.usersTable.ajax.reload(null, false);
    });
  }
  // change user state
 


</script>

@parent

@endsection