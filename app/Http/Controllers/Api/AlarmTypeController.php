<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlarmTypeResource;
use App\Models\AlarmType;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlarmTypeController extends Controller
{
    public function index()
    {
        return AlarmTypeResource::collection(AlarmType::with('alarms')->get());
    }

    public function store(Request $request)
    {
        // TODO verificar por que as validações ainda não estão depedente - Melhorar essas validações

        $validator = Validator::make($request->all(), [
            'name'        => 'required|max:255',
            'description' => 'max:255',
            'active'      => 'required',
        ])->stopOnFirstFailure();

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $created = AlarmType::create($validator->validated());

        $created->load('alarms');

        return (new AlarmTypeResource($created))
            ->additional(['message' => 'Tipo de alarme criado com sucesso!'])
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $alarmType = AlarmType::with('alarms')->findOrFail($id);

        return new AlarmTypeResource($alarmType);
    }

    public function update(Request $request, AlarmType $alarmType)
    {
        $validator = Validator::make($request->all(), [
           'name'        => 'required|max:255',
           'description' => 'max:255',
           'active'      => 'required',
        ])->stopOnFirstFailure();

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $validated = $validator->validated();

        $alarmType->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'active' => $validated['active'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        return (new AlarmTypeResource($alarmType))
            ->additional(['message' => 'Tipo de alarme atualizado com sucesso!'])
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(AlarmType $alarmType)
    {
        //TODO preciso usar o SOFT-DELETE - E quando eu deletar um ALarmType preciso deletar o alarm

        $deleted = $alarmType->delete();

        if ($deleted) {
            return response()->json(["message" => "Tipo de alarme deletado com sucesso!"], 200);
        }
        return response()->json(["message" => "Tipo de alarme não foi deletado!"], 400);
    }
}
