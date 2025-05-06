<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlarmResource;
use App\Models\Alarm;
use Illuminate\Http\Request;

class AlarmController extends Controller
{
    public function index()
    {
        return AlarmResource::collection(Alarm::with('alarmType')->get());
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
        $alarm = Alarm::with('alarmType')->findOrFail($id);

        return new AlarmResource($alarm);
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
