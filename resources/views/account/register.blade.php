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

                                <div class="form-group row" id="div_phone_number">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input id="phone_no" type="text"
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
                                            <div class="input-group mb-3">
                                                <input id="verify_phone_number_code" type="number"
                                                       class="form-control bg-info "
                                                       name="verify_phone_number_code"
                                                       placeholder="Enter verification code"
                                                       value="{{ old('verify_phone_number_code') }}"
                                                       autocomplete="verify_phone_number_code">

                                                <div class="input-group-append">
                                                    <button type="button" id="verify_phone_otp"
                                                            class="btn btn-primary input-group-text">Verify OTP
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
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
                            </div>
                            <div id="step2" class="div-hidden">
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
                                            <div class="input-group mb-3">
                                                <input id="verify_email_code" type="number"
                                                       class="form-control  bg-info"
                                                       placeholder="Enter verification code"
                                                       name="verify_email_code" value="{{ old('verify_email_code') }}"
                                                       autocomplete="verify_email_code">
                                                <div class="input-group-append">
                                                    <button type="button" id="verify_email_otp"
                                                            class="btn btn-primary input-group-text">Verify OTP
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
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
                                    <label for="own_verify"
                                           class="col-md-4 col-form-label  text-md-right">{{ __('Verify Shares') }}</label>
                                    <div class="col-md-6">
                                        <input id="own_verify" type="text"
                                               class="form-control bg-info"
                                               placeholder="Enter OTP to verify share "
                                               name="own_verify" value="{{ old('own_verify') }}"
                                               autocomplete="own_verify">

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
                                <div class="form-group row">
                                    <label for="image"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Image of Your Brokage App ') }}</label>

                                    <div class="col-md-6">
                                        <input id="image" type="file"
                                               class="form-control "
                                               name="image" value="{{ old('image') }}">
                                        <input id="image_base_64" type="hidden">
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
                let cell_number = $('#phone_no').val()
                if (cell_number == "") {
                    show_response_message("Phone number field is required")
                    return false
                }
                disable_button("phone_number_send_verify_code")
                var formData = {
                    phone_no: cell_number,
                    "_token": "{{ csrf_token() }}",
                };
                var type = "POST";
                $.ajax({
                    type: type,
                    url: "{{route('phone_number_verification_code')}}",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status_code == 200) {
                            show_response_message("please write otp code to verify phone number", 1)
                            input_read_only("phone_no")
                            show_fields('div_phone_number_verification')
                        } else if (data.message == "phone_format") {
                            show_response_message("Invalid phone number")
                        } else if (data.status_code != 200 && data.message != "phone_format") {
                            show_response_message('OTP code not send, try again later')
                        } else {
                            input_read_only("phone_no")
                            if (data.message == "user") {
                                $("#div_phone_number_verification").hide();

                                $("#email").val(data.user.email);
                                $("#first_name").val(data.user.first_name);
                                $("#last_name").val(data.user.last_name);
                                input_read_only("email")
                                disable_button("first_name")
                                disable_button("last_name")

                                if (data.user.phone_no_verify == 0) {
                                    $("#div_phone_number_verification").removeClass('div-hidden');
                                    var errorString = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Please write OTP code to verify phone number <div>';
                                    $("#show_response_message").empty();
                                    $("#show_response_message").append(errorString);
                                } else {
                                    $("#phone_number_send_verify_code").addClass('div-hidden');
                                }
                            } else if (data.message == "code") {
                                $("#div_phone_number_verification").removeClass('div-hidden');
                                var errorString = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Please write OTP code to verify phone number <div>';
                                $("#show_response_message").empty();
                                $("#show_response_message").append(errorString);
                            }
                        }
                        enable_button("phone_number_send_verify_code")
                    },
                    error: function (reject) {
                        var errorString = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Phone no format is invalid <div>';
                        $("#show_response_message").empty();
                        $("#show_response_message").append(errorString);
                    }
                });
            });

            // AJAX call for Phone no OTP Verification
            $("#verify_phone_otp").click(function (e) {
                e.preventDefault();
                let cell_number = $('#phone_no').val()
                let otp = $('#verify_phone_number_code').val()
                if (cell_number == "") {
                    show_response_message("Phone number field is required")
                    return false
                }
                if (otp == "") {
                    show_response_message("OTP field is required")
                    return false
                }
                disable_button("phone_number_send_verify_code")
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
                            show_response_message("OTP verify", 1)
                            hide_fields('div_phone_number_verification')
                            show_fields("step2")
                        } else {
                            show_response_message("OTP not valid", 1)
                            hide_fields("step2")
                        }

                    },
                    error: function (reject) {
                        var errorString = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Phone no format is invalid <div>';
                        $("#show_response_message").empty();
                        $("#show_response_message").append(errorString);
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
                input_read_only("email")
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
                        show_response_message("Please check your email for otp", 1)
                        show_fields("div_email_verification")
                    },
                });
                enable_button("email_send_verify_code")
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

            /* Register User AJAX Call */
            $('#register_form').submit(function (e) {
                e.preventDefault();
                var formData = {
                    first_name: $("#first_name").val(),
                    last_name: $("#last_name").val(),
                    email: $("#email").val(),
                    phone_no: $("#phone_no").val(),
                    no_shares_own: $("#no_shares_own").val(),
                    own_verify: $('#own_verify').val(),
                    brokage_name: $("#brokage_name").val(),
                    company_id: $("#company_id").val(),
                    country_list: $("#country_list").val(),
                    image: $("#image_base_64").val(),
                    date_purchase: $('#date_purchase').val(),
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

            /* Phone No On Change AJAX Call */
            $('#phone_no').change(function () {
                var formData = {
                    phone_no: $('#phone_no').val(),
                    "_token": "{{ csrf_token() }}",
                };
                var type = "POST";
                $.ajax({
                    type: type,
                    url: "{{route('check_phone_number')}}",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.message == "user_exists") {
                            $("#div_phone_number_verification").hide();
                            $("#email").val(data.user.email);
                            $("#first_name").val(data.user.first_name);
                            $("#last_name").val(data.user.last_name);
                            input_read_only("email")
                            input_read_only("first_name")
                            input_read_only("last_name")
                            input_read_only("phone_no")

                            if (data.user.phone_no_verify == "0") {
                                hide_fields('div_phone_number_verification')
                            } else {
                                show_fields('phone_number_send_verify_code')
                            }
                            hide_fields('phone_number_send_verify_code')
                            hide_fields('email_send_verify_code')
                            show_response_message('User found',1)
                            show_fields("step2")
                            show_fields("step3")
                        }
                    }

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

        function readFile() {
            if (this.files && this.files[0]) {
                var FR = new FileReader();
                FR.addEventListener("load", function (e) {
                    document.getElementById("image_base_64").value = e.target.result;
                });
                FR.readAsDataURL(this.files[0]);
            }
        }

        document.getElementById("image").addEventListener("change", readFile);
    </script>
@endsection
