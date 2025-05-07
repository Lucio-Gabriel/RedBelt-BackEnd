<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlarmTypeResource;
use App\Models\AlarmType;
use Illuminate\Http\Request;

class AlarmTypeController extends Controller
{
    public function index()
    {
        return AlarmTypeResource::collection(AlarmType::with('alarms')->get());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $alarmType = AlarmType::with('alarms')->findOrFail($id);

        return new AlarmTypeResource($alarmType);
    }

    public function edit(string $id)
    {
        //
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
