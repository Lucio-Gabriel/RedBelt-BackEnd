<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlarmResource;
use App\Models\Alarm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlarmController extends Controller
{
    public function index()
    {
        return AlarmResource::collection(Alarm::with('alarmType')->get());
    }

    public function store(Request $request)
    {
        // TODO verificar por que as validações ainda não estão depedente - Melhorar essas validações

        $validator = Validator::make($request->all(), [
            'alarms_types_id' => 'required',
            'criticality'     => 'required',
            'status'          => 'required',
            'active'          => 'required',
            'date_occurred'   => 'required',
        ])->stopOnFirstFailure();

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $created = Alarm::create($validator->validated());

        return (new AlarmResource($created))
            ->additional(['message' => 'Alarme cadastrado com sucesso!'])
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $alarm = Alarm::with('alarmType')->findOrFail($id);

        return new AlarmResource($alarm);
    }

    public function update(Request $request, Alarm $alarm)
    {
        // TODO Colocar o format date time para receber certo no meu edit

        $validator = Validator::make($request->all(), [
            'alarms_types_id' => 'required',
            'criticality'     => 'required',
            'status'          => 'required',
            'active'          => 'required',
            'date_occurred'   => 'required',
        ])->stopOnFirstFailure();

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $validated = $validator->validated();

        $alarm->update([
            'alarms_types_id' => $validated['alarms_types_id'],
            'criticality'     => $validated['criticality'],
            'status'          => $validated['status'],
            'active'          => $validated['active'],
            'date_occurred'   => $validated['date_occurred'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        return (new AlarmResource($alarm))
            ->additional(['message' => 'Alarme atualizado com sucesso!'])
            ->response()
            ->setStatusCode(201);
    }

    public function destroy(Alarm $alarm)
    {
        // TODO preciso usar o SOFT-DELETE - E quando eu deletar um ALarmType preciso deletar o alarm
        // Aqui ele apaga o alarme pois ele tem o relacionamento na migrations, tenho que fazer o mesmo no AlarmType

        $delete = $alarm->delete();

        if ($delete) {
            return response()->json(['message' => 'Alarme deletado com sucesso!'], 200);
        }

        return response()->json(['message' => 'Tipo de alarme não foi deletado!'], 400);
    }
}
