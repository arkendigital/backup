<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Maintenance - GameFront.com</title>
        <style>
            .right, .left {
              position: absolute;
              width: 33px;
              height: 30px;
            }

            .right div, .left div {
              position: absolute;
              opacity: 1;
              z-index: 20;
              background: #385f85;
            }

            .left .body1 {
              top: 10px;
              right: 1px;
              width: 16px;
              height: 19px;
              border-bottom-right-radius: 50px 60px;
            }

            .bird {
              -webkit-animation: bubble1-h-movement 10s ease-in infinite, bubble1-v-movement 10s ease-in-out infinite alternate, bubble-scale-movement 3s ease-in-out infinite alternate;
                      animation: bubble1-h-movement 10s ease-in infinite, bubble1-v-movement 10s ease-in-out infinite alternate, bubble-scale-movement 3s ease-in-out infinite alternate;
            }
            .bird:first-child {
              z-index: -1;
            }

            .right div, .left div {
              position: absolute;
              opacity: 1;
              z-index: 20;
              background: #e38229;
            }

            .left .body2 {
              top: 17px;
              right: 17px;
              width: 12px;
              height: 12px;
              border-bottom-left-radius: 50px 50px;
            }

            .right div, .left div {
              position: absolute;
              opacity: 1;
              z-index: 20;
              background: #e38229;
            }

            .left .body3 {
              top: 12px;
              right: 19px;
              width: 13px;
              height: 9px;
              border-top-left-radius: 50px 50px;
              border-top-right-radius: 50px 50px;
            }

            .left .body4 {
              background: transparent !important;
              z-index: 21 !important;
              top: 1px;
              right: 0px;
              width: 26px;
              height: 16px;
              border-bottom-left-radius: 50px 50px;
              border-bottom-right-radius: 50px 50px;
            }

            .left .body5 {
              background: transparent !important;
              top: 12px;
              right: 22px;
              width: 4px;
              height: 1px;
              border: 4px solid transparent;
              border-bottom: 4px solid #e38229;
            }

            .left .wing {
              background: transparent !important;
              z-index: 22 !important;
              width: 15px;
              height: 18px;
              bottom: 4px;
              right: 5px;
              -webkit-animation: 'flutter2' 0.5s linear;
              -webkit-animation-iteration-count: infinite;
            }

            .left .wing1 {
              width: 12px;
              height: 12px;
              border-radius: 6px;
            }

            .left .wing2 {
              width: 4px;
              height: 12px;
              margin-top: -6px;
              margin-left: 8px;
              border-top-right-radius: 5px 15px;
            }

            .left .wing3crop {
              background: transparent !important;
              overflow: hidden;
              width: 4px;
              height: 8px;
              margin-top: -6px;
              margin-left: 4px;
            }

            .left .wing3 {
              background: transparent !important;
              width: 10px;
              height: 10px;
              margin-top: -8px;
              margin-left: -10px;
              border: 4px solid #e38229;
              border-radius: 12px;
            }

            .left .wing4 {
              background: #fff;
              width: 6px;
              height: 7px;
              margin-left: 3px;
              margin-top: 3px;
              border-radius: 6px 2px;
            }

            .left .eye {
              background: #fff !important;
              top: 15px;
              right: 26px;
              width: 3px;
              height: 3px;
              border-radius: 2px;
            }

            body {
              background: #385f85 !important;
              min-height: 800px;
              position: relative;
            }

            .cloud {
              width: 350px;
              height: 120px;
              background: #F2F9FE;
              border-radius: 100px;
              -webkit-border-radius: 100px;
              -moz-border-radius: 100px;
              position: absolute;
              margin: 120px auto 20px;
              float: left;
            }
            .cloud:before {
              width: 180px;
              height: 180px;
              top: -90px;
              right: 50px;
              border-radius: 200px;
              -webkit-border-radius: 200px;
              -moz-border-radius: 200px;
            }
            .cloud:after, .cloud:before {
              content: '';
              position: absolute;
              background: #f2f9fe;
              z-index: -1;
            }
            .cloud:after {
              width: 100px;
              height: 100px;
              top: -50px;
              left: 50px;
              border-radius: 100px;
              -webkit-border-radius: 100px;
              -moz-border-radius: 100px;
            }
            .cloud.sm {
              width: 250px;
              height: 70px;
            }
            .cloud.sm:before {
              width: 130px;
              height: 130px;
              right: 40px;
              top: -60px;
            }
            .cloud.sm:after {
              width: 70px;
              height: 70px;
              top: -50px;
              left: 27px;
            }
            .cloud.xs {
              width: 150px;
              height: 50px;
            }
            .cloud.xs:before {
              width: 80px;
              height: 80px;
              right: 20px;
              top: -40px;
            }
            .cloud.xs:after {
              width: 40px;
              height: 40px;
              top: -30px;
              left: 18px;
            }
            .cloud .shadow {
              width: 100%;
              position: absolute;
              bottom: -10px;
              background: #000;
              z-index: -1;
              box-shadow: 0 0 25px 8px rgba(0, 0, 0, 0.4);
              -moz-box-shadow: 0 0 25px 8px rgba(0, 0, 0, 0.4);
              -webkit-box-shadow: 0 0 25px 8px rgba(0, 0, 0, 0.4);
              border-radius: 50%;
              -moz-border-radius: 50%;
              -webkit-border-radius: 50%;
            }

            @-webkit-keyframes hover {
              0% {
                top: 0;
              }
              50% {
                top: -10px;
              }
              100% {
                top: 0;
              }
            }
            @-webkit-keyframes flutter2 {
              0% {
                -webkit-transform: rotate(0deg);
              }
              50% {
                -webkit-transform: rotate(25deg);
              }
              100% {
                -webkit-transform: rotate(0deg);
              }
            }
            @-webkit-keyframes bubble1-h-movement {
              0% {
                margin-left: 80%;
              }
              100% {
                margin-left: -100%;
              }
            }
            @keyframes bubble1-h-movement {
              0% {
                margin-left: 80%;
              }
              100% {
                margin-left: -100%;
              }
            }

        </style>
    </head>
    <body>
        <div class='container'>
            <div class="cloud" style='left : 10%;top:10%;z-index:9999;'><span class="shadow"></span></div>
          <div class="cloud sm" style='left: 30%;'><span class="shadow"></span></div>
            <div class="cloud" style='right : 15%;z-index:9999;'><span class="shadow"></span></div>
          <div class="cloud xs" style='right: 40%; top: -10%;'><span class="shadow"></span></div>
        </div>
          
          
          
          <div class="bird left" style="top: 135px; left: 277px;">
                        <div class="body1"></div>
                        <div class="body2"></div>
                        <div class="body3"></div>
                        <div class="body4"></div>
                        <div class="body5"></div>

                        <div class="wing">
                            <div class="wing1"></div>
                            <div class="wing2"></div>
                            <div class="wing3crop">
                                <div class="wing3"></div>
                            </div>
                            <div class="wing4"></div>
                        </div>

                        <div class="eye"></div>
                    </div>

        <div class="bird left" style="top: 35px; left: 200px;">
                        <div class="body1"></div>
                        <div class="body2"></div>
                        <div class="body3"></div>
                        <div class="body4"></div>
                        <div class="body5"></div>

                        <div class="wing">
                            <div class="wing1"></div>
                            <div class="wing2"></div>
                            <div class="wing3crop">
                                <div class="wing3"></div>
                            </div>
                            <div class="wing4"></div>
                        </div>

                        <div class="eye"></div>
                    </div>

        <div class="bird left" style="top: 100px; left: 300px;">
                        <div class="body1"></div>
                        <div class="body2"></div>
                        <div class="body3"></div>
                        <div class="body4"></div>
                        <div class="body5"></div>

                        <div class="wing">
                            <div class="wing1"></div>
                            <div class="wing2"></div>
                            <div class="wing3crop">
                                <div class="wing3"></div>
                            </div>
                            <div class="wing4"></div>
                        </div>

                        <div class="eye"></div>
                    </div>

        <div class="bird left" style="top: 35px; left: 275px;">
                        <div class="body1"></div>
                        <div class="body2"></div>
                        <div class="body3"></div>
                        <div class="body4"></div>
                        <div class="body5"></div>

                        <div class="wing">
                            <div class="wing1"></div>
                            <div class="wing2"></div>
                            <div class="wing3crop">
                                <div class="wing3"></div>
                            </div>
                            <div class="wing4"></div>
                        </div>

                        <div class="eye"></div>
                    </div>

        <div style="display:flex; align-items: center; justify-content: center;flex-direction: column;padding-top: 350px;">
            <img src="{{ asset('images/logo.svg') }}" alt="">
            <h1 style="font-size: 50px;font-family: sans-serif;font-weight: 100;color: #e38229;">We'll be back soon</h1>
        </div>
    </body>
</html>
