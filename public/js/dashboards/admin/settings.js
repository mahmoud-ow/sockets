/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/dashboards/admin/settings.js":
/*!***************************************************!*\
  !*** ./resources/js/dashboards/admin/settings.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // save changes
  $("#save_changes").on('click', function (e) {
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
      country: country
    }).then(function (response) {
      console.log(JSON.stringify(response.data.message));

      if (response.data.error == 0) {
        Toast.fire({
          icon: 'success',
          title: response.data.message
        });
      } else {
        Toast.fire({
          icon: 'error',
          title: response.data.message
        });
      }
    });
  }); // change profile picture

  $('#upload_image_btn').on('click', function () {
    var compClass = 'change_profile_picture';
    Swal.fire({
      title: TRANSLATION.change_profile_picture,
      showCancelButton: true,
      confirmButtonText: TRANSLATION.save,
      cancelButtonText: TRANSLATION.cancel,
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-cancel',
        header: 'hdr hdr-m'
      },
      buttonsStyling: false,
      showLoaderOnConfirm: true,
      html: "\n        <form class='" + compClass + "'>\n          <div class=\"input-file-style\">\n            <input type=\"file\"/>\n          </div>\n        </form>\n        ",
      preConfirm: function preConfirm() {
        //$("#change-profile-picture-form .progress > div").css({ width: '0%' });
        var form = new FormData();
        form.append('image', $('.' + compClass + ' input[type="file"]').prop('files')[0]);

        if (!$('.' + compClass + ' input[type="file"]').prop('files')[0]) {
          Swal.showValidationMessage(translation.please_choose_image);
        } else {
          return axios.post('/users/profile-picture', form, {
            headers: {
              'Content-Type': 'multipart/form-data'
            },
            onUploadProgress: function onUploadProgress(progressEvent) {
              if (progressEvent.lengthComputable) {
                //console.log(progressEvent.loaded + ' ' + progressEvent.total);
                var progress = progressEvent.loaded / progressEvent.total * 100 + '%'; //$("#change-profile-picture-form .progress").addClass('d-block');
                //$("#change-profile-picture-form .progress > div").css({ width: progress });
              }
            }
          }).then(function (response) {
            if (response.data.error == 1) {
              throw new Error(response.data.message);
            }

            return response.data;
          })["catch"](function (error) {
            Swal.showValidationMessage("".concat(error));
          });
        }
      },
      allowOutsideClick: function allowOutsideClick() {
        return !Swal.isLoading();
      }
    }).then(function (result) {
      if (result.value) {
        Toast.fire({
          icon: 'success',
          title: result.value.message
        });
        $(".user-avatar img").attr('src', result.value.thumb);
      }
    });
  });
  /* /upload_profile image */
});
/* /ready() */

/***/ }),

/***/ 1:
/*!*********************************************************!*\
  !*** multi ./resources/js/dashboards/admin/settings.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\xampp\htdocs\host\resources\js\dashboards\admin\settings.js */"./resources/js/dashboards/admin/settings.js");


/***/ })

/******/ });