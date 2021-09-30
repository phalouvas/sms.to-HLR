<?php

namespace App\Http\Middleware;

use App\Models\ApiCredential;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken() ?? $request->api_key;
        if(empty($token))
        {
            return response()
                ->json([
                    'success' => false,
                    'status' => 401,
                    'message' => 'Invalid API Key or Token'
                ], 401);
        }
        $user = null;
        try {
            $parsedToken = JWTAuth::parseToken();
            $registrationAccessKey = env('REGISTRATION_ACCESS_KEY');

            $fromWeb = false;
            // Ensure that the requesting device has a registration access key
            if (!is_null($registrationAccessKey) &&
                ($registrationAccessKey === $request->header('Registration-Access-Key'))) {
                $fromWeb = true;
                $user = $parsedToken->authenticate();
                if($user->deleted_at)
                {
                    $user = null;
                }
            }
            if (!$fromWeb)
            {
                $tokenArray = $parsedToken->getPayload()->toArray();
                if(isset($tokenArray['kid']))
                {
                    $api = ApiCredential::where('id', $tokenArray['kid'])->first();
                    if(!$api)
                    {
                        throw new TokenInvalidException('Invalid Token');
                    }
                    if(!$api->is_active)
                    {
                        throw new TokenInvalidException('Invalid Token');
                    }
                }
            }

            $user = $parsedToken->authenticate();
            if($user->deleted_at)
            {
                $user = null;
            }
            if(!empty($user))
            {
                $user = User::mapStd($user);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()
                ->json([
                    'success' => false,
                    'status' => 401,
                    'message' => 'Token is expired'
                ], 401);
        }
        catch (\Exception $e)
        {
            $api = ApiCredential::with('user')->where('api_key', $token)->first();
            if($api && $api->is_active)
            {
                $user = $api->user;
            }

        }
        if($user && !$user->is_banned && empty($user->disapproved_at) && $user->is_verified && ($user->twofa_verified || $user->is_approved_by_admin))
        {
            $user = json_decode(json_encode($user));
            $user = User::mapStd($user);
            $user->_id = $user->id;
            $request->user = $user;
            return $next($request);
        }
        return response()
            ->json([
                'success' => false,
                'status' => 401,
                'message' => 'Invalid API Key or Token'
            ], 401);
    }
}
