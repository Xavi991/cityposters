<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Offer_Poster extends JsonResource
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
            'id'                    => $this->id, 
            'date_from'             => $this->date_from->format('d/m/Y'),
            'date_to'               => $this->date_to->format('d/m/Y'),
            'description'           => $this->description,
            'before_price'          => $this->before_price,
            'after_price'           => $this->after_price,
            'design_type'           => $this->design_type,
            'descount_porcentage'   => $this->descount_porcentage,
            'quantity_promo'        => $this->quantity_promo,
            'group'                 => $this->group,
            'group_tittle'          => $this->group_tittle
            
        ];
    }
}
