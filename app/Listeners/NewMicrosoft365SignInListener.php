<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Dcblogdev\MsGraph\Models\MsGraphToken;
use Illuminate\Support\Facades\Auth;

class NewMicrosoft365SignInListener
{
    public function handle($event)
    {
        $tokenId = $event['token_id'];
        $token = MsGraphToken::find($tokenId);

        if ($token->user_id == null) {
            $user = User::create([
                'name'  => $event['info']['displayName'],
                'email' => $event['info']['mail'],
                'password' => ''
            ]);

            $token->user_id = $user->id;
            $token->save();

            Auth::login($user);

        } 
        else {
            $user = User::findOrFail($token->user_id);
            $user->save();

            Auth::login($user);
        }
    }
}
