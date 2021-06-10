<?php

use App\Constant\RecaptchaConstant;

return [
    'secret' => RecaptchaConstant::NOCAPTCHA_SECRET,
    'sitekey' => RecaptchaConstant::NOCAPTCHA_SITEKEY,
    'options' => [
        'timeout' => 30,
    ],
];
