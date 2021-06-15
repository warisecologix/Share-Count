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
                disable_button("no_shares_own")
            } else {
                $("#" + id).css("pointer-events", "all");
                enable_button("no_shares_own")
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
