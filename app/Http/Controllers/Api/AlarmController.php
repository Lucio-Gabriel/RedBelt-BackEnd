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

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
