<?php

use App\Constant\TwilioConstant;

return [
    'secret' => TwilioConstant::NOCAPTCHA_SECRET,
    'sitekey' => TwilioConstant::NOCAPTCHA_SITEKEY,
    'options' => [
        'timeout' => 30,
    ],
];
