<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'user',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                $this->mergeWhen($request->routeIs('users.*'), [
                    'emailVerifiedAt' => $this->email_verified_at,
                    'emailUpdatedAt' => $this->email_updated_at,
                    'emailCreatedAt' => $this->email_created_at,
                ]),
                // 'emailVerifiedAt' => $this->when(
                //     $request->routeIs('users.*'),
                //     $this->email_verified_at
                // ),
            ]
        ];
    }
}
