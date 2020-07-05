window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.tippy = require('tippy.js').default;
    
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
} catch (e) { }





import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css'; // optional for styling






















window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';





















import PerfectScrollbar from 'perfect-scrollbar';




window.Swal = require('sweetalert2')



import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    //cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    //forceTLS: true,
    wsHost: window.location.hostname,
    wsPort: 6001,
    wssPort: 6001,
    disableStats: true,
    encrypted: true,
    enabledTransports: ['ws', 'wss'],
});










/* 


// worked online at do with ssl

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    //cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    //forceTLS: true,
    wsHost: window.location.hostname,
    wsPort: 6001,
    wssPort: 6001,
    disableStats: true,
    encrypted: true,
    enabledTransports: ['ws', 'wss'],
});
 */












window.dt_lang = {

    // arabic
    'ar': {

        "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
        "sLoadingRecords": "جارٍ التحميل...",
        "sProcessing": "جارٍ التحميل...",
        "sLengthMenu": "أظهر _MENU_ مدخلات",
        "sZeroRecords": "لم يعثر على أية سجلات",
        "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
        "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
        "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
        "sInfoPostFix": "",
        "sSearch": "ابحث:",
        "sUrl": "",
        "oPaginate": {
            "sFirst": "الأول",
            "sPrevious": "السابق",
            "sNext": "التالي",
            "sLast": "الأخير"
        },
        "oAria": {
            "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
            "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
        }
    },



    'en': '',

};
