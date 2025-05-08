<?php

namespace Feature\Api;

use App\Models\AlarmType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlarmTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function it_creates_a_new_alarm_type()
    {
        $data = [
            'name'        => 'Sensor de fumaça',
            'description' => 'Detecta fumaça',
            'active'      => true,
        ];

        $response = $this->postJson('/api/alarms-types', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Tipo de alarme criado com sucesso!']);
    }

    /** @test  */
    public function it_validates_required_fields_when_creating()
    {
        $response = $this->postJson('/api/alarms-types', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'active']);
    }

    /** @test  */
    public function it_updates_an_alarm_type()
    {
        $alarmType = AlarmType::factory()->create();

        $updatedAlarmType = [
            'name'        => 'Updated alarme',
            'description' => 'Updated alarme',
            'active'      => false,
        ];

        $response = $this->putJson("/api/alarms-types/{$alarmType->id}", $updatedAlarmType);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Tipo de alarme atualizado com sucesso!']);
    }

    /** @test  */
    public function it_deletes_an_alarm_type()
    {
        $alarmType = AlarmType::factory()->create();

        $response = $this->deleteJson("/api/alarms-types/{$alarmType->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Tipo de alarme deletado com sucesso!']);
    }
}
