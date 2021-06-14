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
                    <div id="step1">
                    <div class="card">
                        <div class="card-header text-center">{{ __('Step 1: User Information') }}</div>
                        <div class="card-body">

                            <div id="show_response_message">
                            </div>

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
									<option data-countryCode="GB" value="44" Selected>UK</option>
									<option data-countryCode="US" value="1">USA</option>
									<option data-countryCode="DZ" value="213">Algeria</option>
									<option data-countryCode="AD" value="376">Andorra</option>
									<option data-countryCode="AO" value="244">Angola</option>
									<option data-countryCode="AI" value="1264">Anguilla</option>
									<option data-countryCode="AG" value="1268">Antigua &amp; Barbuda</option>
									<option data-countryCode="AR" value="54">Argentina</option>
									<option data-countryCode="AM" value="374">Armenia</option>
									<option data-countryCode="AW" value="297">Aruba</option>
									<option data-countryCode="AU" value="61">Australia</option>
									<option data-countryCode="AT" value="43">Austria</option>
									<option data-countryCode="AZ" value="994">Azerbaijan</option>
									<option data-countryCode="BS" value="1242">Bahamas</option>
									<option data-countryCode="BH" value="973">Bahrain</option>
									<option data-countryCode="BD" value="880">Bangladesh</option>
									<option data-countryCode="BB" value="1246">Barbados</option>
									<option data-countryCode="BY" value="375">Belarus</option>
									<option data-countryCode="BE" value="32">Belgium</option>
									<option data-countryCode="BZ" value="501">Belize</option>
									<option data-countryCode="BJ" value="229">Benin</option>
									<option data-countryCode="BM" value="1441">Bermuda</option>
									<option data-countryCode="BT" value="975">Bhutan</option>
									<option data-countryCode="BO" value="591">Bolivia</option>
									<option data-countryCode="BA" value="387">Bosnia Herzegovina</option>
									<option data-countryCode="BW" value="267">Botswana</option>
									<option data-countryCode="BR" value="55">Brazil</option>
									<option data-countryCode="BN" value="673">Brunei</option>
									<option data-countryCode="BG" value="359">Bulgaria</option>
									<option data-countryCode="BF" value="226">Burkina Faso</option>
									<option data-countryCode="BI" value="257">Burundi</option>
									<option data-countryCode="KH" value="855">Cambodia</option>
									<option data-countryCode="CM" value="237">Cameroon</option>
									<option data-countryCode="CA" value="1">Canada</option>
									<option data-countryCode="CV" value="238">Cape Verde Islands</option>
									<option data-countryCode="KY" value="1345">Cayman Islands</option>
									<option data-countryCode="CF" value="236">Central African Republic</option>
									<option data-countryCode="CL" value="56">Chile</option>
									<option data-countryCode="CN" value="86">China</option>
									<option data-countryCode="CO" value="57">Colombia</option>
									<option data-countryCode="KM" value="269">Comoros</option>
									<option data-countryCode="CG" value="242">Congo</option>
									<option data-countryCode="CK" value="682">Cook Islands</option>
									<option data-countryCode="CR" value="506">Costa Rica</option>
									<option data-countryCode="HR" value="385">Croatia</option>
									<option data-countryCode="CU" value="53">Cuba</option>
									<option data-countryCode="CY" value="90392">Cyprus North</option>
									<option data-countryCode="CY" value="357">Cyprus South</option>
									<option data-countryCode="CZ" value="42">Czech Republic</option>
									<option data-countryCode="DK" value="45">Denmark</option>
									<option data-countryCode="DJ" value="253">Djibouti</option>
									<option data-countryCode="DM" value="1809">Dominica</option>
									<option data-countryCode="DO" value="1809">Dominican Republic</option>
									<option data-countryCode="EC" value="593">Ecuador</option>
									<option data-countryCode="EG" value="20">Egypt</option>
									<option data-countryCode="SV" value="503">El Salvador</option>
									<option data-countryCode="GQ" value="240">Equatorial Guinea</option>
									<option data-countryCode="ER" value="291">Eritrea</option>
									<option data-countryCode="EE" value="372">Estonia</option>
									<option data-countryCode="ET" value="251">Ethiopia</option>
									<option data-countryCode="FK" value="500">Falkland Islands</option>
									<option data-countryCode="FO" value="298">Faroe Islands</option>
									<option data-countryCode="FJ" value="679">Fiji</option>
									<option data-countryCode="FI" value="358">Finland</option>
									<option data-countryCode="FR" value="33">France</option>
									<option data-countryCode="GF" value="594">French Guiana</option>
									<option data-countryCode="PF" value="689">French Polynesia</option>
									<option data-countryCode="GA" value="241">Gabon</option>
									<option data-countryCode="GM" value="220">Gambia</option>
									<option data-countryCode="GE" value="7880">Georgia</option>
									<option data-countryCode="DE" value="49">Germany</option>
									<option data-countryCode="GH" value="233">Ghana</option>
									<option data-countryCode="GI" value="350">Gibraltar</option>
									<option data-countryCode="GR" value="30">Greece</option>
									<option data-countryCode="GL" value="299">Greenland</option>
									<option data-countryCode="GD" value="1473">Grenada</option>
									<option data-countryCode="GP" value="590">Guadeloupe</option>
									<option data-countryCode="GU" value="671">Guam</option>
									<option data-countryCode="GT" value="502">Guatemala</option>
									<option data-countryCode="GN" value="224">Guinea</option>
									<option data-countryCode="GW" value="245">Guinea - Bissau</option>
									<option data-countryCode="GY" value="592">Guyana</option>
									<option data-countryCode="HT" value="509">Haiti</option>
									<option data-countryCode="HN" value="504">Honduras</option>
									<option data-countryCode="HK" value="852">Hong Kong</option>
									<option data-countryCode="HU" value="36">Hungary</option>
									<option data-countryCode="IS" value="354">Iceland</option>
									<option data-countryCode="IN" value="91">India</option>
									<option data-countryCode="ID" value="62">Indonesia</option>
									<option data-countryCode="IR" value="98">Iran</option>
									<option data-countryCode="IQ" value="964">Iraq</option>
									<option data-countryCode="IE" value="353">Ireland</option>
									<option data-countryCode="IL" value="972">Israel</option>
									<option data-countryCode="IT" value="39">Italy</option>
									<option data-countryCode="JM" value="1876">Jamaica</option>
									<option data-countryCode="JP" value="81">Japan</option>
									<option data-countryCode="JO" value="962">Jordan</option>
									<option data-countryCode="KZ" value="7">Kazakhstan</option>
									<option data-countryCode="KE" value="254">Kenya</option>
									<option data-countryCode="KI" value="686">Kiribati</option>
									<option data-countryCode="KP" value="850">Korea North</option>
									<option data-countryCode="KR" value="82">Korea South</option>
									<option data-countryCode="KW" value="965">Kuwait</option>
									<option data-countryCode="KG" value="996">Kyrgyzstan</option>
									<option data-countryCode="LA" value="856">Laos</option>
									<option data-countryCode="LV" value="371">Latvia</option>
									<option data-countryCode="LB" value="961">Lebanon</option>
									<option data-countryCode="LS" value="266">Lesotho</option>
									<option data-countryCode="LR" value="231">Liberia</option>
									<option data-countryCode="LY" value="218">Libya</option>
									<option data-countryCode="LI" value="417">Liechtenstein</option>
									<option data-countryCode="LT" value="370">Lithuania</option>
									<option data-countryCode="LU" value="352">Luxembourg</option>
									<option data-countryCode="MO" value="853">Macao</option>
									<option data-countryCode="MK" value="389">Macedonia</option>
									<option data-countryCode="MG" value="261">Madagascar</option>
									<option data-countryCode="MW" value="265">Malawi</option>
									<option data-countryCode="MY" value="60">Malaysia</option>
									<option data-countryCode="MV" value="960">Maldives</option>
									<option data-countryCode="ML" value="223">Mali</option>
									<option data-countryCode="MT" value="356">Malta</option>
									<option data-countryCode="MH" value="692">Marshall Islands</option>
									<option data-countryCode="MQ" value="596">Martinique</option>
									<option data-countryCode="MR" value="222">Mauritania</option>
									<option data-countryCode="YT" value="269">Mayotte</option>
									<option data-countryCode="MX" value="52">Mexico</option>
									<option data-countryCode="FM" value="691">Micronesia</option>
									<option data-countryCode="MD" value="373">Moldova</option>
									<option data-countryCode="MC" value="377">Monaco</option>
									<option data-countryCode="MN" value="976">Mongolia</option>
									<option data-countryCode="MS" value="1664">Montserrat</option>
									<option data-countryCode="MA" value="212">Morocco</option>
									<option data-countryCode="MZ" value="258">Mozambique</option>
									<option data-countryCode="MN" value="95">Myanmar</option>
									<option data-countryCode="NA" value="264">Namibia</option>
									<option data-countryCode="NR" value="674">Nauru</option>
									<option data-countryCode="NP" value="977">Nepal</option>
									<option data-countryCode="NL" value="31">Netherlands</option>
									<option data-countryCode="NC" value="687">New Caledonia</option>
									<option data-countryCode="NZ" value="64">New Zealand</option>
									<option data-countryCode="NI" value="505">Nicaragua</option>
									<option data-countryCode="NE" value="227">Niger</option>
									<option data-countryCode="NG" value="234">Nigeria</option>
									<option data-countryCode="NU" value="683">Niue</option>
									<option data-countryCode="NF" value="672">Norfolk Islands</option>
									<option data-countryCode="NP" value="670">Northern Marianas</option>
									<option data-countryCode="NO" value="47">Norway</option>
									<option data-countryCode="OM" value="968">Oman</option>
									<option data-countryCode="PK" value="92">Pakistan</option>
									<option data-countryCode="PW" value="680">Palau</option>
									<option data-countryCode="PA" value="507">Panama</option>
									<option data-countryCode="PG" value="675">Papua New Guinea</option>
									<option data-countryCode="PY" value="595">Paraguay</option>
									<option data-countryCode="PE" value="51">Peru</option>
									<option data-countryCode="PH" value="63">Philippines</option>
									<option data-countryCode="PL" value="48">Poland</option>
									<option data-countryCode="PT" value="351">Portugal</option>
									<option data-countryCode="PR" value="1787">Puerto Rico</option>
									<option data-countryCode="QA" value="974">Qatar</option>
									<option data-countryCode="RE" value="262">Reunion</option>
									<option data-countryCode="RO" value="40">Romania</option>
									<option data-countryCode="RU" value="7">Russia</option>
									<option data-countryCode="RW" value="250">Rwanda</option>
									<option data-countryCode="SM" value="378">San Marino</option>
									<option data-countryCode="ST" value="239">Sao Tome &amp; Principe</option>
									<option data-countryCode="SA" value="966">Saudi Arabia</option>
									<option data-countryCode="SN" value="221">Senegal</option>
									<option data-countryCode="CS" value="381">Serbia</option>
									<option data-countryCode="SC" value="248">Seychelles</option>
									<option data-countryCode="SL" value="232">Sierra Leone</option>
									<option data-countryCode="SG" value="65">Singapore</option>
									<option data-countryCode="SK" value="421">Slovak Republic</option>
									<option data-countryCode="SI" value="386">Slovenia</option>
									<option data-countryCode="SB" value="677">Solomon Islands</option>
									<option data-countryCode="SO" value="252">Somalia</option>
									<option data-countryCode="ZA" value="27">South Africa</option>
									<option data-countryCode="ES" value="34">Spain</option>
									<option data-countryCode="LK" value="94">Sri Lanka</option>
									<option data-countryCode="SH" value="290">St. Helena</option>
									<option data-countryCode="KN" value="1869">St. Kitts</option>
									<option data-countryCode="SC" value="1758">St. Lucia</option>
									<option data-countryCode="SD" value="249">Sudan</option>
									<option data-countryCode="SR" value="597">Suriname</option>
									<option data-countryCode="SZ" value="268">Swaziland</option>
									<option data-countryCode="SE" value="46">Sweden</option>
									<option data-countryCode="CH" value="41">Switzerland</option>
									<option data-countryCode="SI" value="963">Syria</option>
									<option data-countryCode="TW" value="886">Taiwan</option>
									<option data-countryCode="TJ" value="7">Tajikstan</option>
									<option data-countryCode="TH" value="66">Thailand</option>
									<option data-countryCode="TG" value="228">Togo</option>
									<option data-countryCode="TO" value="676">Tonga</option>
									<option data-countryCode="TT" value="1868">Trinidad &amp; Tobago</option>
									<option data-countryCode="TN" value="216">Tunisia</option>
									<option data-countryCode="TR" value="90">Turkey</option>
									<option data-countryCode="TM" value="7">Turkmenistan</option>
									<option data-countryCode="TM" value="993">Turkmenistan</option>
									<option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands</option>
									<option data-countryCode="TV" value="688">Tuvalu</option>
									<option data-countryCode="UG" value="256">Uganda</option>
									<option data-countryCode="UA" value="380">Ukraine</option>
									<option data-countryCode="AE" value="971">United Arab Emirates</option>
									<option data-countryCode="UY" value="598">Uruguay</option>
									<option data-countryCode="UZ" value="7">Uzbekistan</option>
									<option data-countryCode="VU" value="678">Vanuatu</option>
									<option data-countryCode="VA" value="379">Vatican City</option>
									<option data-countryCode="VE" value="58">Venezuela</option>
									<option data-countryCode="VN" value="84">Vietnam</option>
									<option data-countryCode="VG" value="84">Virgin Islands - British</option>
									<option data-countryCode="VI" value="84">Virgin Islands - US</option>
									<option data-countryCode="WF" value="681">Wallis &amp; Futuna</option>
									<option data-countryCode="YE" value="969">Yemen (North)</option>
									<option data-countryCode="YE" value="967">Yemen (South)</option>
									<option data-countryCode="ZM" value="260">Zambia</option>
									<option data-countryCode="ZW" value="263">Zimbabwe</option>
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

                                    <!-- <div class="input-group-append">
                                        <button type="button" id="no_shares_own_send_verify_code"
                                                class="btn btn-primary input-group-text">Verify shares
                                        </button>
                                    </div> -->
                                </div>
                            </div>
                           <!--  <div class="form-group row div-hidden " id="div_for_own_otp_verify">
                                <label for="Verify_Share"
                                       class="col-md-4 col-form-label  text-md-right">{{ __('Verify Shares') }}</label>
                                <div class="col-md-6">
                                    <input id="Verify_Share" type="number"
                                           class="form-control bg-info"
                                           placeholder="Enter One Time Passcode"
                                           name="Verify_Share" value="{{ old('Verify_Share') }}"
                                           autocomplete="Verify_Share">

                                </div>
                            </div> -->
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
                            <div id="show_response_message_verify_stock" style="text-align:center;">
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
                                // $('#step2 input[type="text"]').val('');
                                $("#register_form")[0].reset();
                                change_text("phone_number_send_verify_code", "Verify Number")
                                reset_background_color("phone_number_send_verify_code")
                                enable_button("phone_number_send_verify_code")
                                hide_fields('div_phone_number_verification')
                                input_field_set_value('user_exists')
                                change_text("email_send_verify_code", "Verify Email")
                                enable_button("email_send_verify_code")
                                reset_background_color("email_send_verify_code")
                                enabled_or_disabled("step2", 0)
                                hide_fields("show_response_message")
                                show_fields("step3")
                                hide_fields("step1")
                                hide_fields("step2")

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
                                hide_fields("show_response_message")
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
                    hide_fields("show_response_message")
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
                function reset_background_color(id) {
                    $("#" + id).css("background-color", "");
                    $("#" + id).css("color", "");

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
