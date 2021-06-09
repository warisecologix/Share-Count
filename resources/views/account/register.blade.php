@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            @foreach($data as $item)
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <p><b>Company Name: </b> <span> {{$item->company_name}} </span></p>
                            <p><b>Shareholder Count: </b> <span> {{$item->Shareholder_Count}} </span></p>
                            <p><b>Verified Members: </b> <span> {{$item->verified_count}} </span></p>
                            <p><b>Total Shares: </b> <span> {{$item->Total_Share}} </span></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">{{ __('Register your count') }}</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" id="register_form"
                              action="javascript:void(0)">
                            @csrf

                            <div id="show_response_message">
                            </div>

                            <div id="step1">
                                <input type="hidden" value="0" name="phone_no_verify" id="phone_no_verify">
                                <input type="hidden" value="0" name="email_verify" id="email_verify">

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

                                            <div class="input-group-append">
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
                                    <div class="form-group row mt-5  container">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-6 mb-3">
                                            <button id="verify_phone_otp" class="btn btn-primary">
                                                {{ __('Verify OTP') }}
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

                                            <div class="form-group row mt-5  container">
                                                {!! NoCaptcha::renderJs() !!}
                                                {!! NoCaptcha::display() !!}
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-6 mb-3">
                                                    <button id="verify_email_otp" class="btn btn-primary">
                                                        {{ __('Verify OTP') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row mb-0 div-hidden">
                                    <div class="col-md-6 offset-md-6">
                                        <button id="register-button" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>


                            </div>

                            <div id="step3" class="div-hidden">
                                <div class="form-group row">
                                    <label for="no_shares_own"
                                           class="col-md-4 col-form-label text-md-right">{{ __('No of Share Own') }}</label>
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
                                        <input id="Verify_Share" type="text"
                                               class="form-control bg-info"
                                               placeholder="Enter OTP to verify share "
                                               name="Verify_Share" value="{{ old('Verify_Share') }}"
                                               autocomplete="Verify_Share">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_purchase"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Purchase Date') }}</label>

                                    <div class="col-md-6">
                                        <input id="date_purchase" type="date"
                                               class="form-control "
                                               name="date_purchase" value="{{ old('date_purchase') }}">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="brokage_name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Brokage Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="brokage_name" type="text"
                                               class="form-control "
                                               placeholder="Enter brokage name"
                                               name="brokage_name" value="{{ old('brokage_name') }}">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="company_id"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Select Stock') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control" id="company_id" name="company_id">
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}">{{$company->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="country_list"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Select Country') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control" id="country_list" name="country_list">
                                            @foreach($countries as $country)
                                                <option value="{{$country->name}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-6">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/jquery3.1.min.js')}}"></script>
    <script>
        $(document).ready(function (e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // AJAX call for Send Verification OTP
            $("#phone_number_send_verify_code").click(function (e) {
                e.preventDefault();
                let phone_number = $('#phone_no').val()
                let te = $('.iti__selected-flag').attr('title');
                var res = te.split("+");
                var cell_number = '+'+res[1]+phone_number;
                if (cell_number == "") {
                    show_response_message("Phone number field is required")
                    return false
                }
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
                        console.log(data)
                        console.log(data.data)
                        if (data.status_code == 200) {
                            show_response_message(data.message, 1)
                            if (data.optional_status == "user_found_code_send") {
                                show_fields('div_phone_number_verification')
                                user_found(data.data)
                            } else if (data.optional_status == "user_found_cell_verified") {
                                hide_fields('div_phone_number_verification')
                                hide_fields('phone_number_send_verify_code')
                                user_found(data.data)
                            } else if (data.optional_status == "user_not_found_code_send") {
                                show_fields('div_phone_number_verification')
                            }
                        } else {
                            show_response_message(data.message)
                            if (data.optional_status == "user_found_code_not_send") {
                                hide_fields('div_phone_number_verification')
                                user_found(data.data)
                            }
                            if (data.optional_status == "user_not_found_code_not_send") {
                                hide_fields('div_phone_number_verification')
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
                var cell_number = '+'+res[1]+phone_number;
                let otp = $('#verify_phone_number_code').val()
                let recaptcha =  $('#g-recaptcha-response').val()

                if (cell_number == "") {
                    show_response_message("Phone number field is required")
                    return false
                }
                if (otp == "") {
                    show_response_message("OTP field is required")
                    return false
                }

                if (recaptcha == "") {
                    show_response_message("Please fill reCAPTCHA");
                    return false;
                }
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
                            input_field_set_value("phone_no_verify", 1)
                        } else {
                            show_response_message(data.message, 1)
                            input_field_set_value("phone_no_verify")
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
                        if(data.optional_status == "user_found_code_send" || data.optional_status){
                            show_fields("div_email_verification")
                        }
                        if(data.optional_status == "user_found_email_verified"){
                            input_field_set_value("email_verify",1)
                            hide_fields("div_email_verification")

                        }
                    },
                });
            });

            // AJAX call for Email OTP Verification
            $("#verify_email_otp").click(function (e) {
                e.preventDefault();
                let otp = $('#verify_email_code').val()
                if (otp == "") {
                    show_response_message("OTP field is required")
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
                            show_response_message("OTP verify", 1)
                            hide_fields('div_email_verification')
                            show_fields("step3")
                        } else {
                            show_response_message("OTP not valid")
                            hide_fields("step3")
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
                        show_response_message("Please check your email for otp", 1)
                        show_fields("div_share_own_verification")
                        show_fields("div_for_own_otp_verify")
                    },
                });

                enable_button("no_shares_own_send_verify_code")
            });

            let phone_number = $('#phone_no').val()
            let te = $('.iti__selected-flag').attr('title');
            var res = te.split("+");
            var cell_number = '+'+res[1]+phone_number;
            /* Register User AJAX Call */
            $('#register_form').submit(function (e) {
                e.preventDefault();
                var formData = {
                    first_name: $("#first_name").val(),
                    last_name: $("#last_name").val(),
                    email: $("#email").val(),
                    phone_no: cell_number,
                    no_shares_own: $("#no_shares_own").val(),
                    Verify_Share: $('#Verify_Share').val(),
                    brokage_name: $("#brokage_name").val(),
                    company_id: $("#company_id").val(),
                    country_list: $("#country_list").val(),
                    date_purchase: $('#date_purchase').val(),
                    g_recaptcha_response: $('#g-recaptcha-response').val(),
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
                        show_response_message('Your stock has been added', 1)
                        setTimeout(() => {
                            window.location.href = window.location.href
                        }, 3000)
                    },
                    error: function (reject) {
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

            /* Register Button AJAX Call */
            $('#register-button').click(function (e) {
                e.preventDefault();
                let phone_number = $('#phone_no').val()
                let te = $('.iti__selected-flag').attr('title');
                var res = te.split("+");
                var cell_number = '+'+res[1]+phone_number;
                var formData = {
                    first_name: $("#first_name").val(),
                    last_name: $("#last_name").val(),
                    email: $("#email").val(),
                    phone_no: cell_number,
                    no_shares_own: $("#no_shares_own").val(),
                    Verify_Share: $('#Verify_Share').val(),
                    brokage_name: $("#brokage_name").val(),
                    company_id: $("#company_id").val(),
                    country_list: $("#country_list").val(),
                    date_purchase: $('#date_purchase').val(),
                    g_recaptcha_response: $('#g-recaptcha-response').val(),
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
                        show_response_message('Your stock has been added', 1)
                        setTimeout(() => {
                            window.location.href = window.location.href
                        }, 3000)
                    },
                    error: function (reject) {
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

    </script>

@endsection
