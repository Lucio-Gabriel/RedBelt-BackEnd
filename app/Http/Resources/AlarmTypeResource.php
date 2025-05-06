<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlarmTypeResource extends JsonResource
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

        return $mapString[$criticality] ?? 'Desconhecido';
    }

    protected function mapStatusToString($status): string
    {
        $mapString = [
            1 => 'Aberto',
            2 => 'Em Andamento',
            0 => 'Fechado',
        ];

        return $mapString[$status] ?? 'Desconhecido';
    }

    protected function mapActiveToString($active): string
    {
        $mapString = [
            1 => 'Ativo',
            0 => 'Desativado',
        ];

        return $mapString[$active] ?? 'Desconhecido';
    }

    public function toArray(Request $request): array
    {
        return [
            'ID'        => $this->id,
            'Nome'      => $this->name,
            'Descrição' => $this->description,
            'Ativo'     => $this->active ? 'Sim' : 'Não',
            'Alarmes'   => $this->alarms->map(function ($alarm) {
                return [
                    'ID'          => $alarm->id,
                    'Criticidade' => $this->mapCriticalityToString($alarm->criticality),
                    'Status'      => $this->mapStatusToString($alarm->status),
                    'Ativo'       => $this->mapActiveToString($alarm->active),
                    'Data'        => Carbon::parse($alarm->date_occurred)->format('d/m/Y H:i:s'),
                ];
            }),
        ];
    }
}
