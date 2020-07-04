$(document).ready(function () {

  


  // save changes
  $("#save_changes").on('click', function(e){


    ToastLoading.fire({
      icon: 'info',
      html: '<div class="lds-ring"><div></div><div></div><div></div><div></div></div>'
    });


    var fb_url = $("#social_fb_link").val();
    var twt_url = $("#social_twt_link").val();
    var gplus_url = $("#social_gplus_link").val();
    var rss_url = $("#social_rss_link").val();
    var db_url = $("#social_db_link").val();
    var be_url = $("#social_be_link").val();
    var de_url = $("#social_de_link").val();
    
    
    var acc_name = $("#acc_name").val();
    var new_pwd = $("#new_pwd").val();
    var new_pwd2 = $("#new_pwd2").val();
    var website_url = $("#website_url").val();
    var country = $("#country_selector").countrySelect("getSelectedCountryData").name;

    


    axios.post('/users/update-settings', {
      fb_url: fb_url,
      twt_url: twt_url,
      gplus_url: gplus_url,
      rss_url: rss_url,
      db_url: db_url,
      be_url: be_url,
      de_url: de_url,
      acc_name: acc_name,
      new_pwd: new_pwd,
      new_pwd2: new_pwd2,
      website_url: website_url,
      country: country,
    })
      .then(function (response) {

        console.log(JSON.stringify(response.data.message));
        

        if (response.data.error == 0) {

          Toast.fire({
            icon: 'success',
            title: response.data.message
          })

        } else {

          Toast.fire({
            icon: 'error',
            title: response.data.message
          })

        }

      });



  });






  // change profile picture
  $('#upload_image_btn').on('click', function () {
    var compClass = 'change_profile_picture';
    Swal.fire({
      title: "تغيير صورة الحساب",
      showCancelButton: true,
      confirmButtonText: "حفظ",
      cancelButtonText: "إلغاء",
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-cancel',
        header: 'hdr hdr-m',
      },
      buttonsStyling: false,
      showLoaderOnConfirm: true,

      html:
        `
        <form class='`+ compClass + `'>
          <div class="input-file-style">
            <input type="file"/>
          </div>
        </form>
        `,

      preConfirm: () => {

        //$("#change-profile-picture-form .progress > div").css({ width: '0%' });

        var form = new FormData();
        form.append('image', $('.' + compClass + ' input[type="file"]').prop('files')[0]);

        if (!$('.' + compClass + ' input[type="file"]').prop('files')[0]) {
          Swal.showValidationMessage(translation.please_choose_image)
        } else {

          return axios.post('/users/profile-picture', form, {
            headers: {
              'Content-Type': 'multipart/form-data'
            },
            onUploadProgress: (progressEvent) => {
              if (progressEvent.lengthComputable) {

                //console.log(progressEvent.loaded + ' ' + progressEvent.total);
                var progress = ((progressEvent.loaded / progressEvent.total) * 100) + '%';

                //$("#change-profile-picture-form .progress").addClass('d-block');

                //$("#change-profile-picture-form .progress > div").css({ width: progress });

              }
            }
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
        
        
        Toast.fire({
          icon: 'success',
          title: result.value.message
        });

        $(".user-avatar img").attr('src', result.value.thumb);

      }
    })

  });/* /upload_profile image */



});/* /ready() */