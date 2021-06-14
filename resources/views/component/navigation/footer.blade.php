<script src="{{asset('js/jquery1.1.min.js')}}"></script>
<script>
    const phoneInputField = document.querySelector("#phone_no");
    const phoneInput = window.intlTelInput(phoneInputField, {
        utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
</script>
@section('js')
@show
</body>
</html>
