<?php

namespace Laravel\Sanctum;

use DateTimeInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

trait HasApiTokens
{
    /**
     * The access token the user is using for the current request.
     *
     * @var \Laravel\Sanctum\Contracts\HasAbilities
     */
    protected $accessToken;

    /**
     * Get the access tokens that belong to model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function tokens()
    {
        return $this->morphMany(Sanctum::$personalAccessTokenModel, 'tokenable');
    }

    /**
     * Determine if the current API token has a given scope.
     *
     * @param  string  $ability
     * @return bool
     */
    public function tokenCan(string $ability)
    {
        return $this->accessToken && $this->accessToken->can($ability);
    }

    /**
     * Create a new personal access token for the user.
     *
     * @param  string  $name
     * @param  array  $abilities
     * @param  \DateTimeInterface|null  $expiresAt
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function createToken(string $name, array $exp, array $abilities, DateTimeInterface $expiresAt = null)
    {
        log::info('hi im in createToken, and this is expire time :'. $exp['expires_in']);
        $delayed_time = 10;
        // Get the current time
        $currentDateTime = Carbon::now();

        // Add the time stored in $delayed_time (in minutes) to the current time
        $time = $currentDateTime->addMinutes($exp['expires_in']);
       
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(40)),
            'abilities' => $abilities,
            'expires_at' => $time,
        ]);

        return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
    }

    /**
     * Get the access token currently associated with the user.
     *
     * @return \Laravel\Sanctum\Contracts\HasAbilities
     */
    public function currentAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set the current access token for the user.
     *
     * @param  \Laravel\Sanctum\Contracts\HasAbilities  $accessToken
     * @return $this
     */
    public function withAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }
}
