<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Http;

class CheckPermission
{
    /**
     * Handle the incoming request.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @param $request
     * @param Closure $next
     * @param string $params
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next, string $params)
    {
        $permissions = array_unique(array_filter(array_map('trim', explode('|', $params))));

        $url = config('app.url_msas') . '/api/oauth/verify';
        $token = $request->bearerToken() ?? $request->api_key;

        try
        {
            $newEncrypter = new Encrypter(config('app.key'), config('app.cipher'));
            $encryptedBearerToken = $newEncrypter->encrypt($token);

            $client = new Client([
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ],
                'verify' => false
            ]);

            $response = $client->post($url, ['json' => ['token' => $encryptedBearerToken]])->getBody()->getContents();
            $response = json_decode($response);

            $user = User::where('id', $response->_id)->firstOrFail();

            $user->id = $user->user_smsto->id; // match the user id on SMSto DB (in model_has_roles table)

            foreach ($permissions as $permission)
            {
                if ($user->hasPermissionTo($permission))
                {
                    $request->user = $response;
                    return $next($request);
                }
            }

            return response()->json([
                'success' => false,
                'status' => 403,
                'message' => "Access Denied. You do not have permission to {$params}."
            ], 403);
        }
        catch (Exception $e)
        {
            throw $e;
            return response()->json([
                'success' => false,
                'status' => $e->getCode(),
                'message' => $e->getCode() === 401 ? 'Invalid API Key or Token' : $e->getMessage()
            ], $e->getCode() === 0 ? 500 : $e->getCode());
        }
    }
}
