<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Myth\Auth\Config\Auth as AuthConfig;
use Google_Client;
use Google_Service_Oauth2;

class Auth extends AuthConfig
{

    /**
     * --------------------------------------------------------------------
     * Require Confirmation Registration via Email
     * --------------------------------------------------------------------
     *
     * When enabled, every registered user will receive an email message
     * with an activation link to confirm the account.
     *
     * @var string|null Name of the ActivatorInterface class
     */
    public $defaultUserGroup = '';

    public $requireActivation = null;

    public $allowRemembering = true;

    public $validFields = [
        'email',
        'username',
    ];


    public $personalFields = [
        'level',
        'fullname',
        'user_image',
        'city',
        'address',
        'contact',
    ];

    public $views = [
        'login'           => 'admin/auth/login',
        'register'        => 'admin/auth/register',
        'forgot'          => 'admin/auth/forgot',
        'emailForgot'     => 'admin/auth/forgot',
        'reset'           => 'admin/auth/reset',
    ];
    // private function clientgoogle()
    // { 
    //     $client = new Google_Client();
    //     $client->setClientId($clientID);
    //     $client->setClientSecret($clientSecret);
    //     $client->setRedirectUri($redirectUri);
    //     $client->addScope("email");
    //     $client->addScope("profile");
    //     return $client;
    // }
    // public function getUrlgoogle(){
    //     return $this->clientgoogle()->createAuthUrl();
    // }
    // public function getGoogle($code){
    //     $client = $this->clientgoogle();
    //     $token = $client->fetchAccessTokenWithAuthCode($code);
    //     if(isset($token['access_token'])){
    //         $client->setAccessToken($token['access_token']);							
    //         $Oauth = new Google_Service_Oauth2($client);
    //         $userInfo = $Oauth->userinfo->get();  
    //         return $userInfo; 
    //     }
    // }
    public $authenticationLibs = [
        'local' => 'App\Authentication\LocalAuthenticator',
    ];

    public $reservedRoutes = [
        'login'                   => 'login',
        'logout'                  => 'logout',
        'register'                => 'register',
        'activate-account'        => 'activate-account',
        'resend-activate-account' => 'resend-activate-account',
        'forgot'                  => 'forgot',
        'reset-password'          => 'reset-password',
        'google-auth'             => 'google-auth',
    ];
}
