<?php

namespace App\Http\Resources;

use App\Http\Resources\WalletResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivateUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'name' =>$this->name,
            'email' =>$this->email,
            'twoFaVerified' => $this->twoFactorPendingVerification(),
            'twoFaEnabled' => $this->twoFactorEnabled(),
            'is_admin' => $this->hasRole('admin'),
            'wallets' => WalletResource::collection($this->wallets)
        ];
    }
}
