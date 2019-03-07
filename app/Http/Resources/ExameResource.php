<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ExameResource extends Resource
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
            'id' => $this->id,
            'descricao' => $this->descricao,
            'cod_sus' => $this->cod_sus,
            'cod_tipo_exame' => $this->cod_tipo_exame,
            'cod_categoria_exame' => $this->cod_categoria_exame

        ];
    }
}
