<div style="padding:10px 15px 25px 15px;background-color:#EEE;max-width: 500px;margin: 50px auto;border-radius: 10px;">

  <h1
    style="text-align:center;border-bottom:1px solid #DDD;direction:{{__('auth.dir')}};color: #000000;padding-bottom: 15px;text-transform:capitalize;font-size: 18px;">
    {{__('auth.password_reset_request')}} {{env('APP_NAME')}}
  </h1>





  <div style="text-align: center;padding: 25px 0;">
    <p style="font-weight: 600;font-size: 20px;">{{__('auth.click_next_link_to_reset')}}</p>
    <a target="_blank"
      style="font-size: 25px;font-weight: 600;text-decoration: none;display: inline-block;padding: 6px 15px;background-color: #202124;outline: 3px solid #7b7b7b;margin-top: 15px;color: #FFF;"
      href="{{url('/users/login/reset-password/'.$data['email'].'/'.$data['verification_key'])}}">
      {{__('auth.click_to_reset')}}</a>
  </div>

  {{-- 
  <h3 style="text-align: center;padding:5px;direction:rtl;margin-bottom: 20px;color:dimgrey;">طلب إستعادة حساب , كود
    التحقق الخاص بحسابك هو</h3>

  <div style="text-align: center;direction:rtl;">

    <h1
      style="border-radius:5px;text-align: center;padding: 10px 20px;color:#3f51b5;display:inline-block;margin:auto;background-color:#3f51b5;color:#FFF;direction:ltr;margin-bottom: 20px;">
      {{ $data['verification_key'] }}</h1>
</div>
--}}

<p
  style="direction:{{__('auth.dir')}};text-align:center;border-top:1px solid #DDD;padding-top: 15px;color: #607D8B;margin-bottom: 0;">
  {{__('auth.thank_you_for_using_site')}} &nbsp;{{env('APP_NAME')}}</p>

</div>