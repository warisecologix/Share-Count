@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Register Your Account') }}</div>

                    <div class="card-body">

                        <form onsubmit="return submit_form()" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           name="first_name" value="{{ old('first_name') }}" required
                                           autocomplete="first_name" autofocus>

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name" value="{{ old('last_name') }}" required
                                           autocomplete="last_name">

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary input-group-text">Send Code
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row div-hidden" id="div_email_verification">
                                <label for="verify_email_code"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Email Verification Code') }}</label>

                                <div class="col-md-6">
                                    <input id="verify_email_code" type="text"
                                           class="form-control @error('verify_email_code') is-invalid @enderror"
                                           name="verify_email_code" value="{{ old('verify_email_code') }}" required
                                           autocomplete="verify_email_code">

                                    @error('verify_email_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row div-hidden" id="div_phone_number">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input id="phone_number" type="text"
                                               class="form-control @error('phone_number') is-invalid @enderror"
                                               name="phone_number"
                                               value="{{ old('phone_number') }}" required autocomplete="phone_number">

                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <button type="button" id="email_send_verify_code"
                                                    class="btn btn-primary input-group-text">Send Code
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="div-hidden" id="div_phone_number_verification">
                                <div class="form-group row" id="div_phone_number_verification">
                                    <label for="verify_phone_number_code"
                                           class="col-md-4 col-form-label text-md-right">{{ __('SMS Verification Code') }}</label>

                                    <div class="col-md-6">
                                        <input id="verify_phone_number_code" type="text"
                                               class="form-control @error('verify_phone_number_code') is-invalid @enderror"
                                               name="verify_phone_number_code"
                                               value="{{ old('verify_phone_number_code') }}"
                                               required
                                               autocomplete="verify_phone_number_code">

                                        @error('verify_phone_number_code')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="share_own"
                                           class="col-md-4 col-form-label text-md-right">{{ __('No of Own Share') }}</label>

                                    <div class="col-md-6">
                                        <input id="share_own" type="number"
                                               class="form-control @error('share_own') is-invalid @enderror"
                                               name="share_own" value="{{ old('share_own') }}" required>

                                        @error('share_own')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="purchase_date"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Purchase Date') }}</label>

                                    <div class="col-md-6">
                                        <input id="purchase_date" type="date"
                                               class="form-control @error('purchase_date') is-invalid @enderror"
                                               name="purchase_date" value="{{ old('purchase_date') }}">

                                        @error('purchase_date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="brokage_name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Brokage Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="brokage_name" type="text"
                                               class="form-control @error('brokage_name') is-invalid @enderror"
                                               name="brokage_name" value="{{ old('brokage_name') }}" required>

                                        @error('brokage_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="stock_id"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Select Stock') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control" id="stock_id" name="stock_id">
                                            @foreach($stocks as $stock)
                                                <option value="{{$stock->id}}">{{$stock->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('stock_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="country_id"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Select Country') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control" id="country_id" name="country_id">
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Image of Your Brokage App ') }}</label>

                                    <div class="col-md-6">
                                        <input id="image" type="file"
                                               class="form-control @error('image') is-invalid @enderror"
                                               name="image" value="{{ old('image') }}" required>

                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
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
    <script>
        $("#email_send_verify_code").click(function (e) {
            e.preventDefault();
            var formData = {
                phone_number: $('#phone_number').val(),
                "_token": "{{ csrf_token() }}",
            };
            var type = "POST";
            $.ajax({
                type: type,
                url: "{{route('phone_number_verification_code')}}",
                data: formData,
                dataType: 'json',
                success: function (data) {

                }
            });
        });
    </script>
    <script>
        function submit_form() {
            var formData = {
                first_name: $("#first_name").val(),
                last_name: $("#last_name").val(),
                email: $("#email").val(),
                verify_email_code: $("#verify_email_code").val(),
                phone_number: $("#phone_number").val(),
                verify_phone_number_code: $("#verify_phone_number_code").val(),
                share_own: $("#share_own").val(),
                brokage_name: $("#brokage_name").val(),
                stock_id: $("#stock_id").val(),
                country_id: $("#country_id").val(),
                image: $("#image").val(),
                phone_number: $('#phone_number').val(),
                purchase_date: $('#purchase_date').val(),
                "_token": "{{ csrf_token() }}",
            };
            var type = "POST";
            $.ajax({
                url: "{{route('register_post')}}",
                data: JSON.parse(formData),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: type,
                success: function (data) {

                    debugger
                    console.log("-*-*-*-*-*-*-*-*-")
                    console.log(data)
                },
                error: function (reject) {
                    if (reject.status === 422) {
                        var errors = $.parseJSON(reject.responseText);
                        $.each(errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });
                    }
                }
            });
        }
    </script>

@endsection
