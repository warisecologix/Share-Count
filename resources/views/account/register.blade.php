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
                            <div id="error_message"></div>

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
                                                    class="btn btn-primary input-group-text">Verify Phone
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row div-hidden" id="div_phone_number_verification">
                                <label for="verify_phone_number_code"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Verification Code') }}</label>
                                <div class="col-md-6">
                                    <input id="verify_phone_number_code" type="number"
                                           class="form-control "
                                           name="verify_phone_number_code"
                                           placeholder="Enter verification code"
                                           value="{{ old('verify_phone_number_code') }}"
                                           autocomplete="verify_phone_number_code">

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
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input id="email" type="email"
                                               class="form-control " name="email"
                                               placeholder="Enter valid email address"
                                               value="{{ old('email') }}" autocomplete="email">
                                        <div class="input-group-append">
                                            <button type="button" id="email_send_verify_code"
                                                    class="btn btn-primary input-group-text">Verify Email
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row " id="div_email_verification">
                                <label for="verify_email_code"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Email Verification Code') }}</label>
                                <div class="col-md-6">
                                    <input id="verify_email_code" type="number"
                                           class="form-control"
                                           placeholder="Enter verification code"
                                           name="verify_email_code" value="{{ old('verify_email_code') }}"
                                           autocomplete="verify_email_code">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_shares_own"
                                       class="col-md-4 col-form-label text-md-right">{{ __('No of Share Own') }}</label>

                                <div class="col-md-6">
                                    <input id="no_shares_own" type="number"
                                           class="form-control "
                                           placeholder="Enter No of Share Own"
                                           name="no_shares_own" value="{{ old('no_shares_own') }}">
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

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        $(document).ready(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /* Register User AJAX Call */
            $('#register_form').submit(function (e) {
                e.preventDefault();
                var formData = {
                    first_name: $("#first_name").val(),
                    last_name: $("#last_name").val(),
                    email: $("#email").val(),
                    verify_email_code: $("#verify_email_code").val(),
                    phone_no: $("#phone_no").val(),
                    verify_phone_number_code: $("#verify_phone_number_code").val(),
                    no_shares_own: $("#no_shares_own").val(),
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
                        var successMessage = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Your stock has been added<div>';
                        $("#error_message").empty();
                        $("#error_message").append(successMessage);
                        setTimeout(() => {
                            window.location.href = window.location.href
                        }, 3000)
                    },
                    error: function (reject) {
                        if (reject.status === 400) {
                            var response = JSON.parse(reject.responseText);
                            var errorString = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><ul>';
                            $.each(response.errors, function (key, value) {
                                errorString += '<li>' + value[0] + '</li>';
                            });
                            errorString += '</ul><div>';
                            $("#error_message").append(errorString);
                        }
                    },

                });
            });

            /* Phone No Send Verification Code AJAX Call */


            /* Phone No Send Verification Code AJAX Call */
            $("#phone_number_send_verify_code").click(function (e) {
                e.preventDefault();
                var formData = {
                    phone_no: $('#phone_no').val(),
                    "_token": "{{ csrf_token() }}",
                };
                var type = "POST";
                $.ajax({
                    type: type,
                    url: "{{route('phone_number_verification_code')}}",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.message == "phone_format") {
                            var errorString = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Invalid phone number<div>';
                            $("#error_message").empty();
                            $("#error_message").append(errorString);
                        }
                        else if(data.message == "sms_code_send"){
                            $("#div_phone_number_verification").removeClass('div-hidden');

                            var errorString = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>please write otp code to verify phone number<div>';
                            $("#error_message").empty();
                            $("#error_message").append(errorString);
                        }
                        else {
                            $("#phone_no").prop("readonly", true);
                            if (data.message == "user") {
                                $("#div_phone_number_verification").hide();

                                $("#email").val(data.user.email);
                                $("#first_name").val(data.user.first_name);
                                $("#last_name").val(data.user.last_name);

                                $("#email").prop("readonly", true);
                                $("#first_name").prop("readonly", true);
                                $("#last_name").prop("readonly", true);


                                if (data.user.phone_no_verify == 0) {
                                    $("#div_phone_number_verification").removeClass('div-hidden');
                                    var errorString = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Please write OTP code to verify phone number <div>';
                                    $("#error_message").empty();
                                    $("#error_message").append(errorString);
                                } else {
                                    $("#phone_number_send_verify_code").addClass('div-hidden');
                                }
                            } else if (data.message == "code") {
                                $("#div_phone_number_verification").removeClass('div-hidden');
                                var errorString = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Please write OTP code to verify phone number <div>';
                                $("#error_message").empty();
                                $("#error_message").append(errorString);
                            }
                        }


                    },
                    error: function (reject) {
                        // var errorString = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Phone no format is invalid <div>';
                        // $("#error_message").empty();
                        // $("#error_message").append(errorString);
                    }
                });
            });

            /* Email Send Verification Code AJAX Call */

            /* Phone No Send Verification Code AJAX Call */
            $("#email_send_verify_code").click(function (e) {
                e.preventDefault();
                var formData = {
                    email: $('#email').val(),
                    "_token": "{{ csrf_token() }}",
                };
                var type = "POST";
                $.ajax({
                    type: type,
                    url: "{{route('email_verification_code')}}",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var successMessage = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Please check your email for otp<div>';
                        $("#error_message").empty();
                        $("#error_message").append(successMessage);
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
                            $("#email").prop("readonly", true);
                            $("#first_name").prop("readonly", true);
                            $("#last_name").prop("readonly", true);
                            $("#phone_no").prop("readonly", true);
                            if (data.user.phone_no_verify == "0") {
                                $("#div_phone_number_verification").removeClass('div-hidden');
                                $("#div_phone_number_verification").css('display', '');
                            } else {
                                $("#phone_number_send_verify_code").addClass('div-hidden');
                            }
                            var errorString = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>User found <div>';
                            $("#error_message").empty();
                            $("#error_message").append(errorString);
                        }
                    }
                });
            });
        });


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
