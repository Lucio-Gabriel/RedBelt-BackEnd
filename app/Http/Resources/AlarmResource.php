<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlarmResource extends JsonResource
{
    protected function mapCriticalityToString($criticality): string
    {
        $mapString = [
            0 => 'Info',
            1 => 'Baixo',
            2 => 'Médio',
            3 => 'Alto',
            4 => 'Crítico',
        ];

        return $mapString[$criticality] ?? 'Info';
    }

    protected function mapStatusToString($status): string
    {
        $mapString = [
            1 => 'Aberto',
            2 => 'Em Andamento',
            0 => 'Fechado',
        ];

        return $mapString[$status] ?? 'Aberto';
    }

    protected function mapActiveToString($active): string
    {
        $mapString = [
            1 => 'Ativo',
            0 => 'Desativado',
        ];

        return $mapString[$active] ?? 'Ativo';
    }

    public function toArray(Request $request): array
    {
        return [
            'Criticidade'        => $this->mapCriticalityToString($this->criticality),
            'Status'             => $this->mapStatusToString($this->status),
            'Ativo'              => $this->mapActiveToString($this->active),
            'data_da_ocorrencia' => Carbon::parse($this->date_occurred)->format('d/m/Y'),
            'data_da_criacao'    => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
            'data_da_delecao'    => $this->deleted_at,
            'Tipo_de_Alarme'     => $this->alarmType ? [
                'ID'        => $this->alarmType->id,
                'Nome'      => $this->alarmType->name,
                'Descricao' => $this->alarmType->description,
            ] : null,
        ];
    }
}
