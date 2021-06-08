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
        $("#phone_number_send_verify_code").prop("disabled", true);
        var formData = {
            phone_no: cell_number,
            "_token": "{{ csrf_token() }}",
        };
        var type = "POST";
        $.ajax({
            type: type,
            url: "/phone_number_verification_code",
            data: formData,
            dataType: 'json',
            success: function (data) {
                if (data.status_code == 200) {
                    show_response_message("please write otp code to verify phone number", 1)
                }
                if (data.message == "phone_format") {
                    show_response_message("Invalid phone number")
                } else {
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
                $("#phone_number_send_verify_code").prop("disabled", false);

            },
            error: function (reject) {
                var errorString = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Phone no format is invalid <div>';
                $("#show_response_message").empty();
                $("#show_response_message").append(errorString);
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
