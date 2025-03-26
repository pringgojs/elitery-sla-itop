<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserCpanel;
use Illuminate\Support\Facades\Http;

class CpanelService
{
    private $base_url;

    private $headers;

    public function __construct()
    {
        $this->base_url = env('WHM_BASE_URL');
        $this->headers = [
            'Authorization' => 'whm '.env('WHM_USERNAME').':'.env('WHM_USERNAME_TOKEN'),
        ];
    }

    public function createAccount(User $user, string $username, string $domain, string $contact_email, string $password, string $package_name = 'all website')
    {
        $params = [
            'api.version' => 1,
            'domain' => $domain.'.ponorogo.go.id',
            'username' => $username,
            'contactemail' => $contact_email,
            'password' => $password,
            'pkgname' => $package_name,
        ];

        $response = $this->get('/createacct', $params);

        /* remove unused key */
        unset($params['api.version'], $params['contactemail']);

        $params['user_id'] = $user->id;
        $params['password'] = EncryptService::encrypt($password);

        $model = UserCpanel::create($params);

        return $model;
    }

    public function get($url, $params = null)
    {
        if ($params) {
            return $response = Http::withOptions([
                'verify' => false,
            ])->withHeaders($this->headers)->withQueryParameters($params)->get($this->base_url.$url);
        }

        return $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders($this->headers)->get($this->base_url.$url);
    }

    public function post($url, $params = null)
    {
        if ($params) {
            return $response = Http::withOptions([
                'verify' => false,
            ])->withHeaders($this->headers)->post($this->base_url.$url, $params);
        }

        return $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders($this->headers)->post($this->base_url.$url);
    }
}
