<?php

namespace App\Http\Traits;

use App\UserStockLogs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

trait UserLoginLogsTrait
{
    public function store_user_login_logs(Request $request, $user=null, $stock=null){

        $session_id = Session::getId();
        $ip = Null;
        $deep_detect = TRUE;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
//         $ip = '202.163.113.36';

        $xml = @simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);

        $MAC = exec('getmac');
        $user_mac = strtok($MAC, ' ');


        $country = (string) $xml->geoplugin_countryName;
        $city =  (string) $xml->geoplugin_city;
        $area =  (string) $xml->geoplugin_areaCode;
        $code =  (string) $xml->geoplugin_countryCode;
        $long =  (string) $xml->geoplugin_longitude;
        $lat =  (string) $xml->geoplugin_latitude;


        $user_agent = $request->header('User-Agent');
        $os_platform = "Unknown OS Platform";
        $os_array = array(
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        );
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }
        }
        $browser = "Unknown Browser";
        $browser_array = array(
            '/msie/i' => 'Internet Explorer',
            '/firefox/i' => 'Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Chrome',
            '/edge/i' => 'Edge',
            '/opera/i' => 'Opera',
            '/netscape/i' => 'Netscape',
            '/maxthon/i' => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i' => 'Handheld Browser'
        );
        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $browser = $value;
            }
        }
        $userLoginLog = new UserStockLogs();
        $userLoginLog->user_id = $user->id ?? 0;
        $userLoginLog->user_ip =  $ip;
        $userLoginLog->user_mac =  $user_mac;
        $userLoginLog->longitude = $long ;
        $userLoginLog->latitude =  $lat;
        $userLoginLog->location =  $city .','. $country .','. $code;
        $userLoginLog->country_code = $code;
        $userLoginLog->country_code = $code;
        $userLoginLog->machine_name = gethostname();
        $userLoginLog->browser = $browser;
        $userLoginLog->os = $os_platform;
        $userLoginLog->country =  $country;
        $userLoginLog->save_time =  Carbon::now();
        $userLoginLog->session_id =  Session::getId();
        $userLoginLog->stock_id =  $stock->id ?? 0;

        $userLoginLog->save();
    }

}
