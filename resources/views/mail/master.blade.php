<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title>@yield('title')</title>
    <style type="text/css">
        @media all and (max-width: 769px) {
            .box__content ul {
                width: 60%;
            }
        }
        @media all and (max-width: 769px) {
            .box__content img {
                width: 30%;
            }
        }
        table {
            border: 1px solid #AAA;
            border-top: 0;
            font-family: sans-serif;
            font-size: 13px;
        }
        td, th {
            border-right: 1px solid #AAA;
            border-top: 1px solid #AAA;
            padding: 5px;
            text-align: center;
        }
    </style>
  </head>
  <body style="background-color: #EEE;">
    <div class="wrapper" style="max-width:1450px;width:95%;margin:20px auto;padding: 20px 0;">
      <div class="box box--narrow" style="background-color:#FFF;-webkit-box-shadow:0 0 2px 0 rgba(0, 0, 0, 0.25);box-shadow:0 0 2px 0 rgba(0, 0, 0, 0.25);margin:20px 0;padding:20px;clear:both;float:left;width:65%;margin:20px auto;float:none;">
        <div class="box__container">
          <h1 class="box__title box__title--centered" style="border-bottom:1px solid rgba(18, 18, 18, 0.4);float:left;width:100%;clear:both;text-align:center;">
            Actuaries Online
          </h1>
          <div class="box__content" style="width:100%;float:left;clear:both;margin-bottom:20px;padding:20px 0;width:60%;margin:20px auto;float:none;">
            @yield('content')
                    </div>
        </div>
        <div class="u-text-center" style="text-align:center;">
          @yield('button')
        </div>
      </div>
    </div>
  </body>
</html>
