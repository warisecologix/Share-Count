@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <p><b>Company Name: </b> <span id="gme_company_name"> GME </span></p>
                        <p><b>Shareholder Count: </b> <span id="gme_share_holder_count"> - </span></p>
                        <p><b>Verified Members: </b> <span id="gme_verified_members"> - </span></p>
                        <p><b>Total Shares: </b> <span id="gme_total_shares"> - </span></p>
                        <p><b>Verified Shares: </b> <span id="gme_verified_shares"> - </span></p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <p><b>Company Name: </b> <span id="amc_company_name"> AMC </span></p>
                        <p><b>Shareholder Count: </b> <span id="amc_share_holder_count"> - </span></p>
                        <p><b>Verified Members: </b> <span id="amc_verified_members"> - </span></p>
                        <p><b>Total Shares: </b> <span id="amc_total_shares"> - </span></p>
                        <p><b>Verified Shares: </b> <span id="amc_verified_shares"> - </span></p>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" enctype="multipart/form-data" id="register_form"
              action="javascript:void(0)">
            @csrf

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header text-center">{{ __('Step 1: User Information') }}</div>
                        <div class="card-body">

                            <div id="show_response_message">
                            </div>
                            <div id="step1">
                                <input type="hidden" value="0" name="phone_no_verify" id="phone_no_verify">
                                <input type="hidden" value="0" name="email_verify" id="email_verify">
                                <input type="hidden" value="0" name="user_exists" id="user_exists">

                                <div class="form-group row">
                                    <label for="first_name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="first_name" type="text"
                                               class="form-control "
                                               placeholder="Enter first name"
                                               name="first_name" value="{{ old('first_name') }}"
                                               autocomplete="first_name">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="last_name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="last_name" type="text"
                                               class="form-control"
                                               placeholder="Enter last name"
                                               name="last_name" value="{{ old('last_name') }}"
                                               autocomplete="last_name">

                                    </div>
                                </div>

                                <div class="form-group row" id="div_phone_number">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input id="phone_no" type="number"
                                                   class="form-control "
                                                   name="phone_no"
                                                   placeholder="Enter valid phone no"
                                                   value="{{ old('phone_no') }}" autocomplete="phone_no" autofocus>

                                            <div class="input-group-append" id="phone_number_send_verify_code_verify">
                                                <button type="button" id="phone_number_send_verify_code"
                                                        class="btn btn-primary input-group-text">Verify number
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="div_phone_number_verification" class="div-hidden">
                                    <div class="form-group row" id="div_phone_number">
                                        <label for="verify_phone_number_code"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Verification Code') }}</label>
                                        <div class="col-md-6">
                                            <input id="verify_phone_number_code" type="number"
                                                   class="form-control bg-info "
                                                   name="verify_phone_number_code"
                                                   placeholder="Enter verification code"
                                                   value="{{ old('verify_phone_number_code') }}"
                                                   autocomplete="verify_phone_number_code">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0 text-right">
                                        <div class="col-md-10 mb-3">
                                            <button id="verify_phone_otp" class="btn btn-primary">
                                                {{ __('Verify One Time Passcode') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input id="email" type="email"
                                                   class="form-control" name="email"
                                                   placeholder="Enter valid email address"
                                                   value="{{ old('email') }}" autocomplete="email">
                                            <div class="input-group-append">
                                                <button type="button" id="email_send_verify_code"
                                                        class="btn btn-primary input-group-text">Verify email
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="div-hidden" id="div_email_verification">
                                    <div class="form-group row">
                                        <label for="verify_email_code"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Email Verification Code') }}</label>
                                        <div class="col-md-6">
                                            <input id="verify_email_code" type="number"
                                                   class="form-control  bg-info"
                                                   placeholder="Enter verification code"
                                                   name="verify_email_code" value="{{ old('verify_email_code') }}"
                                                   autocomplete="verify_email_code">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0 text-right">
                                        <div class="col-md-10 mb-3">
                                            <button id="verify_email_otp" class="btn btn-primary">
                                                {{ __('Verify One Time Passcode') }}
                                            </button>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row mb-0 div-hidden" id="register_button_div">
                                    <div class="col-md-6 offset-md-6">
                                        <button type="button" id="register-button" class="btn btn-primary">
                                            {{ __('Register User') }}
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group row mb-0 div-hidden" id="next_button_div">
                                    <div class="col-md-6 offset-md-6">
                                        <button type="button" id="next_button" class="btn btn-primary">
                                            {{ __('Next') }}
                                        </button>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>

                    <div class="card mt-5" id="step2">
                        <div class="card-header text-center">{{ __('Step 2: Stock Information') }}</div>
                        <div class="card-body ">

                            <div id="show_response_message_stock">
                            </div>

                            <div class="form-group row">
                                <label for="company_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Stock') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="company_id" name="company_id">
                                        <option value="">Select Stock</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="brokage_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Brokage Name (Optional)') }}</label>

                                <div class="col-md-6">
                                    <input id="brokage_name" type="text"
                                           class="form-control "
                                           placeholder="Enter brokage name (Optional)"
                                           name="brokage_name" value="{{ old('brokage_name') }}">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date_purchase"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Purchased Date (Optional)') }}</label>

                                <div class="col-md-6">
                                    <input id="date_purchase" type="date"
                                           class="form-control "
                                           name="date_purchase" value="{{ old('date_purchase') }}">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country_list"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Country of Residence') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="country_list" name="country_list">
                                        <option data-countryCode="GB" value="44" Selected>UK (+44)</option>
                                        <option data-countryCode="US" value="1">USA (+1)</option>
                                        <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                        <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                        <option data-countryCode="AO" value="244">Angola (+244)</option>
                                        <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                        <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)
                                        </option>
                                        <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                        <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                        <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                        <option data-countryCode="AU" value="61">Australia (+61)</option>
                                        <option data-countryCode="AT" value="43">Austria (+43)</option>
                                        <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                        <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                        <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                        <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                        <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                        <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                        <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                        <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                        <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                        <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                        <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                        <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                        <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                        <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                        <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                        <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                        <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                        <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                        <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                        <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                        <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                        <option data-countryCode="CA" value="1">Canada (+1)</option>
                                        <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                        <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                        <option data-countryCode="CF" value="236">Central African Republic (+236)
                                        </option>
                                        <option data-countryCode="CL" value="56">Chile (+56)</option>
                                        <option data-countryCode="CN" value="86">China (+86)</option>
                                        <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                        <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                        <option data-countryCode="CG" value="242">Congo (+242)</option>
                                        <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                        <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                        <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                        <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                        <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                        <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                        <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                        <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                        <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                        <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                        <option data-countryCode="DO" value="1809">Dominican Republic (+1809)
                                        </option>
                                        <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                        <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                        <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                        <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                        <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                        <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                        <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                        <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                        <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                        <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                        <option data-countryCode="FI" value="358">Finland (+358)</option>
                                        <option data-countryCode="FR" value="33">France (+33)</option>
                                        <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                        <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                        <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                        <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                        <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                        <option data-countryCode="DE" value="49">Germany (+49)</option>
                                        <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                        <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                        <option data-countryCode="GR" value="30">Greece (+30)</option>
                                        <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                        <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                        <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                        <option data-countryCode="GU" value="671">Guam (+671)</option>
                                        <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                        <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                        <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                        <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                        <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                        <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                        <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                        <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                        <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                        <option data-countryCode="IN" value="91">India (+91)</option>
                                        <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                        <option data-countryCode="IR" value="98">Iran (+98)</option>
                                        <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                        <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                        <option data-countryCode="IL" value="972">Israel (+972)</option>
                                        <option data-countryCode="IT" value="39">Italy (+39)</option>
                                        <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                        <option data-countryCode="JP" value="81">Japan (+81)</option>
                                        <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                        <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                        <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                        <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                        <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                        <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                        <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                        <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                        <option data-countryCode="LA" value="856">Laos (+856)</option>
                                        <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                        <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                        <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                        <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                        <option data-countryCode="LY" value="218">Libya (+218)</option>
                                        <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                        <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                        <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                        <option data-countryCode="MO" value="853">Macao (+853)</option>
                                        <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                        <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                        <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                        <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                        <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                        <option data-countryCode="ML" value="223">Mali (+223)</option>
                                        <option data-countryCode="MT" value="356">Malta (+356)</option>
                                        <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                        <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                        <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                        <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                        <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                        <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                        <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                        <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                        <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                        <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                        <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                        <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                        <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                        <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                        <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                        <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                        <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                        <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                        <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                        <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                        <option data-countryCode="NE" value="227">Niger (+227)</option>
                                        <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                                        <option data-countryCode="NU" value="683">Niue (+683)</option>
                                        <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                        <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                        <option data-countryCode="NO" value="47">Norway (+47)</option>
                                        <option data-countryCode="OM" value="968">Oman (+968)</option>
                                        <option data-countryCode="PK" value="92">Pakistan (+92)</option>
                                        <option data-countryCode="PW" value="680">Palau (+680)</option>
                                        <option data-countryCode="PA" value="507">Panama (+507)</option>
                                        <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                        <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                        <option data-countryCode="PE" value="51">Peru (+51)</option>
                                        <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                        <option data-countryCode="PL" value="48">Poland (+48)</option>
                                        <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                        <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                        <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                        <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                        <option data-countryCode="RO" value="40">Romania (+40)</option>
                                        <option data-countryCode="RU" value="7">Russia (+7)</option>
                                        <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                        <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                        <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)
                                        </option>
                                        <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                        <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                        <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                        <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                        <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                        <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                        <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                        <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                        <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                        <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                        <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                        <option data-countryCode="ES" value="34">Spain (+34)</option>
                                        <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                        <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                        <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                        <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                        <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                        <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                        <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                        <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                        <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                        <option data-countryCode="SI" value="963">Syria (+963)</option>
                                        <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                        <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                        <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                        <option data-countryCode="TG" value="228">Togo (+228)</option>
                                        <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                        <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)
                                        </option>
                                        <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                        <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                        <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                        <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                        <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands
                                            (+1649)
                                        </option>
                                        <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                        <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                        <!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
                                        <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                        <option data-countryCode="AE" value="971">United Arab Emirates (+971)
                                        </option>
                                        <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                        <!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
                                        <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                        <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                        <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                        <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                        <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                        <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)
                                        </option>
                                        <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)
                                        </option>
                                        <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)
                                        </option>
                                        <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                        <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                        <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                        <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_shares_own"
                                       class="col-md-4 col-form-label text-md-right">{{ __('No of Share Purchased') }}</label>
                                <div class="col-md-6 input-group mb-3">
                                    <input id="no_shares_own" type="number"
                                           class="form-control "
                                           placeholder="Enter No of Shares Own"
                                           name="no_shares_own" value="{{ old('no_shares_own') }}">

                                    <div class="input-group-append">
                                        <button type="button" id="no_shares_own_send_verify_code"
                                                class="btn btn-primary input-group-text">Verify shares
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row div-hidden " id="div_for_own_otp_verify">
                                <label for="Verify_Share"
                                       class="col-md-4 col-form-label  text-md-right">{{ __('Verify Shares') }}</label>
                                <div class="col-md-6">
                                    <input id="Verify_Share" type="number"
                                           class="form-control bg-info"
                                           placeholder="Enter One Time Passcode"
                                           name="Verify_Share" value="{{ old('Verify_Share') }}"
                                           autocomplete="Verify_Share">

                                </div>
                            </div>
                            <div class="form-group row mt-5  container">
                                @if(App\Constant\RecaptchaConstant::NOCAPTCHA_SITEKEY)
                                    <div class="g-recaptcha"
                                         data-sitekey="{{App\Constant\RecaptchaConstant::NOCAPTCHA_SITEKEY}}">
                                    </div>
                                @endif
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-6">
                                    <button type="submit" id="button_submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5 div-hidden" id="step3">
                        <div class="card-header text-center">{{ __('Step 3: Verify Stock') }}</div>
                        <div class="card-body ">
                            <div id="show_response_message_verify_stock">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endsection
        @section('js')

            <script src="{{asset('js/jquery3.1.min.js')}}"></script>
            <script src='https://www.google.com/recaptcha/api.js'></script>

            <script>
                $(document).ready(function (e) {
                    enabled_or_disabled()
                    load_stats()
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // AJAX call for Send Verification OTP
                    $("#phone_number_send_verify_code").click(function (e) {
                        e.preventDefault();
                        let phone_number = $('#phone_no').val()
                        if (phone_number == "") {
                            show_response_message("Phone number field is required")
                            return false
                        }

                        disable_button("phone_number_send_verify_code")
                        let te = $('.iti__selected-flag').attr('title');
                        var res = te.split("+");
                        var cell_number = '+' + res[1] + phone_number;

                        var formData = {
                            phone_no: cell_number,
                            "_token": "{{ csrf_token() }}",
                        };
                        var type = "POST";
                        $.ajax({
                            type: type,
                            url: "{{route('check_verification')}}",
                            data: formData,
                            dataType: 'json',
                            success: function (data) {
                                if (data.status_code == 200) {
                                    if (data.optional_status == "user_found_code_send") {
                                        show_response_message(data.message, 1)
                                        show_fields('div_phone_number_verification')
                                        input_field_set_value('user_exists', 1)
                                    } else if (data.optional_status == "user_found_cell_verified") {
                                        show_response_message(data.message, 1)
                                        hide_fields('div_phone_number_verification')
                                        input_field_set_value('user_exists', 1)
                                        change_text("phone_number_send_verify_code", "Verified <span>&#10003;</span>")
                                        disable_button("phone_number_send_verify_code")
                                        change_background_color("phone_number_send_verify_code")
                                        $("#phone_no").css("padding-right", "122px")
                                    } else if (data.optional_status == "user_not_found_code_send") {
                                        show_response_message(data.message, 1)
                                        show_fields('div_phone_number_verification')
                                        input_field_set_value('user_exists')
                                    }
                                } else {
                                    show_response_message(data.message)
                                    if (data.optional_status == "user_found_code_not_send") {
                                        show_response_message(data.message)
                                        hide_fields('div_phone_number_verification')
                                        input_field_set_value('user_exists')
                                        enable_button("phone_number_send_verify_code")
                                    }
                                    if (data.optional_status == "user_not_found_code_not_send") {
                                        show_response_message(data.message)
                                        hide_fields('div_phone_number_verification')
                                        input_field_set_value('user_exists')
                                        enable_button("phone_number_send_verify_code")
                                    }
                                }
                            }
                        });
                    });

                    // AJAX call for Phone no OTP Verification
                    $("#verify_phone_otp").click(function (e) {
                        e.preventDefault();
                        let phone_number = $('#phone_no').val()
                        let te = $('.iti__selected-flag').attr('title');
                        var res = te.split("+");
                        $('#country_list').val(res[1]);
                        var cell_number = '+' + res[1] + phone_number;
                        let otp = $('#verify_phone_number_code').val()

                        if (cell_number == "") {
                            show_response_message("Phone number field is required")
                            return false
                        }
                        if (otp == "") {
                            show_response_message("One Time Passcode is required")
                            return false
                        }
                        disable_button("verify_phone_otp")
                        // let recaptcha = $('#g-recaptcha-response').val()
                        // if (recaptcha == "") {
                        //     show_response_message("Please fill reCAPTCHA");
                        //     return false;
                        // }
                        var formData = {
                            phone_no: cell_number,
                            otp: otp,
                            "_token": "{{ csrf_token() }}",
                        };
                        var type = "POST";
                        $.ajax({
                            type: type,
                            url: "{{route('verify_phone_otp')}}",
                            data: formData,
                            dataType: 'json',
                            success: function (data) {
                                if (data.status_code == 200) {
                                    show_response_message(data.message, 1)
                                    hide_fields('div_phone_number_verification')
                                    change_text("phone_number_send_verify_code", "Verified <span>&#10003;</span>")
                                    disable_button("phone_number_send_verify_code")
                                    change_background_color("phone_number_send_verify_code")
                                    $("#phone_no").css("padding-right", "122px")
                                    input_field_set_value("phone_no_verify", 1)
                                } else if (data.optional_status == "phone_number_not_verify") {
                                    show_response_message(data.message)
                                    input_field_set_value("phone_no_verify")
                                } else {
                                    show_response_message(data.message)
                                    input_field_set_value("phone_no_verify")
                                    enable_button("verify_phone_otp")
                                }
                            }
                        });
                    });

                    /* Email Send Verification Code AJAX Call */
                    $("#email_send_verify_code").click(function (e) {
                        e.preventDefault();
                        let email = $('#email').val()
                        if (email == "") {
                            show_response_message("Email field is required")
                            return false
                        }
                        if (!validateEmail(email)) {
                            show_response_message("Email format is invalid")
                            return false
                        }

                        disable_button("email_send_verify_code")
                        var formData = {
                            email: email,
                            "_token": "{{ csrf_token() }}",
                        };
                        var type = "POST";
                        $.ajax({
                            type: type,
                            url: "{{route('email_verification_code')}}",
                            data: formData,
                            dataType: 'json',
                            success: function (data) {
                                show_response_message(data.message, 1)
                                if (data.optional_status == "user_found_code_send" || data.optional_status == "user_found_email_verified") {
                                    let phone_number = $('#phone_no').val()
                                    let te = $('.iti__selected-flag').attr('title');
                                    var res = te.split("+");
                                    $('#country_list').val(res[1]);
                                    var cell_number = '+' + res[1] + phone_number;
                                    if (data.data.phone_no == cell_number) {
                                        user_found(data.data)
                                    }
                                    $('#country_list').val(data.data.phone_code);
                                }
                                if (data.optional_status == "user_found_code_send" || data.optional_status == "user_not_found_code_send") {
                                    show_fields("div_email_verification")
                                }
                                if (data.optional_status == "user_found_email_verified") {
                                    input_field_set_value("email_verify", 1)
                                    input_field_set_value("user_exists", 1)
                                    hide_fields("div_email_verification")
                                    change_text("email_send_verify_code", "Verified <span>&#10003;</span>")
                                    disable_button("email_send_verify_code")
                                    change_background_color("email_send_verify_code")
                                    if ($("#user_exists").val() == 0) {
                                        show_fields("register_button_div")
                                        hide_fields("next_button_div")
                                    } else {
                                        hide_fields("register_button_div")
                                        show_fields("next_button_div")
                                    }
                                }
                            },
                        });
                    });

                    // AJAX call for Email OTP Verification
                    $("#verify_email_otp").click(function (e) {
                        e.preventDefault();
                        // let recaptcha = $('#g-recaptcha-response').val()
                        // if (recaptcha == "") {
                        //     show_response_message("Please fill reCAPTCHA");
                        //     return false;
                        // }
                        let otp = $('#verify_email_code').val()
                        if (otp == "") {
                            show_response_message("One Time Passcode is required")
                            return false
                        }
                        disable_button("email_send_verify_code")
                        var formData = {
                            otp: otp,
                            "_token": "{{ csrf_token() }}",
                        };
                        var type = "POST";
                        $.ajax({
                            type: type,
                            url: "{{route('verify_email_otp')}}",
                            data: formData,
                            dataType: 'json',
                            success: function (data) {
                                if (data.status_code == 200) {
                                    show_response_message("Success! Thanks for verifying your Email", 1)
                                    hide_fields('div_email_verification')
                                    input_field_set_value('email_verify', 1)
                                    change_text("email_send_verify_code", "Verified <span>&#10003;</span>")
                                    disable_button("email_send_verify_code")
                                    change_background_color("email_send_verify_code")
                                    if ($("#user_exists").val() == 0) {
                                        show_fields("register_button_div")
                                        hide_fields("next_button_div")
                                    } else {
                                        hide_fields("register_button_div")
                                        show_fields("next_button_div")
                                    }
                                } else {
                                    show_response_message("Error! Invalid One Time Password")
                                }
                            }
                        });
                        enable_button("email_send_verify_code")

                    });

                    /* no_shares_own_send_verify_code AJAX Call */
                    $("#no_shares_own_send_verify_code").click(function (e) {
                        e.preventDefault();
                        let email = $('#email').val()
                        if (email == "") {
                            show_response_message("Email field is required")
                            return false
                        }
                        disable_button("no_shares_own_send_verify_code")
                        var formData = {
                            email: $('#email').val(),
                            "_token": "{{ csrf_token() }}",
                        };
                        var type = "POST";
                        $.ajax({
                            type: type,
                            url: "{{route('shares_own_verification_code')}}",
                            data: formData,
                            dataType: 'json',
                            success: function (data) {
                                show_response_message_stock("Please Check your email for One Time Passcode to verify share", 1)
                                show_fields("div_share_own_verification")
                                show_fields("div_for_own_otp_verify")
                            },
                        });

                        enable_button("no_shares_own_send_verify_code")
                    });

                    let phone_number = $('#phone_no').val()
                    let te = $('.iti__selected-flag').attr('title');
                    var res = te.split("+");
                    var cell_number = '+' + res[1] + phone_number;
                    /* Register User AJAX Call */
                    $('#register_form').submit(function (e) {
                        e.preventDefault();
                        let recaptcha = $('#g-recaptcha-response').val()
                        if (recaptcha == "") {
                            show_response_message_stock("Please fill reCAPTCHA");
                            return false;
                        }
                        disable_button("button_submit")
                        let phone_number = $('#phone_no').val()
                        let te = $('.iti__selected-flag').attr('title');
                        var res = te.split("+");
                        var cell_number = '+' + res[1] + phone_number;
                        var formData = {
                            email: $("#email").val(),
                            no_shares_own: $("#no_shares_own").val(),
                            Verify_Share: $('#Verify_Share').val(),
                            brokage_name: $("#brokage_name").val(),
                            company_id: $("#company_id").val(),
                            country_list: $("#country_list").val(),
                            date_purchase: $('#date_purchase').val(),
                            phone_no: cell_number,
                            "_token": "{{ csrf_token() }}",
                        };
                        var type = "POST";
                        $.ajax({
                            type: type,
                            url: "{{route('register_post')}}",
                            method: "POST",
                            data: formData,
                            dataType: 'json',
                            success: function (data) {
                                show_fields("step3")
                                show_response_message_verify_stock(data.message)
                                load_stats()
                            },
                            error: function (reject) {
                                enable_button("button_submit")
                                if (reject.status === 400) {
                                    $("#show_response_message_stock").empty();
                                    var response = JSON.parse(reject.responseText);
                                    var errorString = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><ul>';
                                    $.each(response.errors, function (key, value) {
                                        errorString += '<li>' + value[0] + '</li>';
                                    });
                                    errorString += '</ul><div>';
                                    $("#show_response_message_stock").append(errorString);
                                }
                            },

                        });
                    });

                    /* Register Button AJAX Call */

                    $('#register-button').click(function (e) {
                        e.preventDefault();
                        disable_button("register-button")
                        let phone_number = $('#phone_no').val()
                        let te = $('.iti__selected-flag').attr('title');
                        var res = te.split("+");
                        var cell_number = '+' + res[1] + phone_number;
                        var phone_code = res[1];
                        var formData = {
                            first_name: $("#first_name").val(),
                            last_name: $("#last_name").val(),
                            email: $("#email").val(),
                            phone_no: cell_number,
                            phone_no_verify: $("#phone_no_verify").val(),
                            email_verify: $("#email_verify").val(),
                            phone_code: phone_code,
                            "_token": "{{ csrf_token() }}",
                        };
                        var type = "POST";
                        $.ajax({
                            type: type,
                            url: "{{route('register_user')}}",
                            method: "POST",
                            data: formData,
                            dataType: 'json',
                            success: function (data) {
                                show_response_message(data.message, 1)
                                hide_fields("register_button_div")
                                hide_fields("next_button_div")
                                show_fields("step2")
                                enabled_or_disabled("step2", 1)
                                let phone_number = $('#phone_no').val()
                                let te = $('.iti__selected-flag').attr('title');
                                var res = te.split("+");
                                $('#country_list').val(res[1]);
                            },
                            error: function (reject) {
                                enable_button("register-button")
                                if (reject.status === 400) {
                                    $("#show_response_message").empty();
                                    var response = JSON.parse(reject.responseText);
                                    var errorString = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><ul>';
                                    $.each(response.errors, function (key, value) {
                                        errorString += '<li>' + value[0] + '</li>';
                                    });
                                    errorString += '</ul><div>';
                                    $("#show_response_message").append(errorString);
                                }
                            },

                        });
                    });

                });

                function show_response_message(message = '', type = 0) {
                    // type 0 for error & 1 for success
                    $("#show_response_message").empty();
                    let errorString = "";
                    if (type == 0) {
                        errorString = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>' + message + '<div>';
                    } else {
                        errorString = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>' + message + '<div>';
                    }
                    $("#show_response_message").append(errorString);

                }

                function show_response_message_stock(message = '', type = 0) {
                    // type 0 for error & 1 for success
                    $("#show_response_message_stock").empty();
                    let errorString = "";
                    if (type == 0) {
                        errorString = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>' + message + '<div>';
                    } else {
                        errorString = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>' + message + '<div>';
                    }
                    $("#show_response_message_stock").append(errorString);

                }

                function show_response_message_verify_stock(message = '') {
                    $("#show_response_message_verify_stock").empty();
                    message = '<div class="alert alert-success">' + message + '<div>';
                    $("#show_response_message_verify_stock").append(message);

                }

                function show_fields(element) {
                    $("#" + element).removeClass('div-hidden')
                }

                function hide_fields(element) {
                    $("#" + element).addClass('div-hidden')
                }

                function disable_button(button_id) {
                    $("#" + button_id).prop("disabled", true);
                }

                function enable_button(button_id) {
                    $("#" + button_id).prop("disabled", false);
                }

                function input_read_only(button_id) {
                    $("#" + button_id).prop("readonly", true);
                }

                function input_field_set_value(input_field, value = 0) {
                    $("#" + input_field).val(value);
                }

                function user_found(user) {
                    $("#first_name").val(user.first_name);
                    $("#last_name").val(user.last_name);
                }

                $('#next_button').click(function (e) {
                    hide_fields("next_button_div")
                    show_fields("step2")
                    enabled_or_disabled("step2", 1)
                    let phone_number = $('#phone_no').val()
                    let te = $('.iti__selected-flag').attr('title');
                    var res = te.split("+");
                    $('#country_list').val(res[1]);
                });

                function change_text(id, text) {
                    $("#" + id).empty()
                    $("#" + id).append(text)
                }

                function change_background_color(id) {
                    $("#" + id).css("background-color", "green");
                    $("#" + id).css("color", "white");

                }

                function validateEmail(email) {
                    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(email);
                }

                function enabled_or_disabled(id = "step2", status = 0) {
                    if (status == 0) {
                        $("#" + id).css("pointer-events", "none");
                    } else {
                        $("#" + id).css("pointer-events", "all");
                    }
                }

                function load_stats() {
                    var formData = {
                        "_token": "{{ csrf_token() }}",
                    };
                    var type = "POST";
                    $.ajax({
                        type: type,
                        url: "{{route('load_stat')}}",
                        data: formData,
                        dataType: 'json',
                        success: function (data) {
                            for (var i in data) {
                                $("#" + i).text(data[i])
                            }
                        },
                    });
                }
            </script>

@endsection
