<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ContactResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'birthday' => $this->birthday->format('d.m.Y'),
                'company' => $this->company,
                'last_updated' => $this->updated_at->diffForHumans(),   
            ],
            'links' =>  [
                'self' => $this->path()
            ]
        ];
    }
}
