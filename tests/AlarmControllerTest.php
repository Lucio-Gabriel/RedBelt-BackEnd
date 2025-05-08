<?php

use App\Models\Alarm;
use App\Models\AlarmType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlarmControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function it_creates_a_new_alarm()
    {
        $alarmType = AlarmType::create([
            'name'        => 'Alarm 1',
            'description' => 'Alarm 1',
            'active'      => 1,
        ]);

        $data = [
            'alarms_types_id' => 1,
            'criticality'     => 1,
            'status'          => 1,
            'active'          => 1,
            'date_occurred'   => '2019-01-01 00:00:00',
        ];

        $response = $this->postJson('/api/alarms', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Alarme cadastrado com sucesso!']);
    }

    /** @test  */
    public function it_validates_required_fields_when_creating_an_alarm()
    {
        $response = $this->postJson('/api/alarms', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'alarms_types_id',
                'criticality',
                'status',
                'active',
                'date_occurred',
            ]);
    }

    /** @test  */
    public function it_updates_an_alarm_type()
    {
        $alarmType = AlarmType::factory()->create();

        $alarm = Alarm::factory()->create();

        $updatedAlarm = [
            'alarms_types_id' => $alarmType->id,
            'criticality'     => 2,
            'status'          => 2,
            'active'          => 2,
            'date_occurred'   => '2020-01-01 00:00:00',
        ];

        $response = $this->putJson("/api/alarms/{$alarm->id}", $updatedAlarm);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Alarme atualizado com sucesso!']);
    }

    /** @test  */
    public function it_deletes_an_alarm()
    {
        $alarm = Alarm::factory()->create();

        $response = $this->deleteJson("/api/alarms/{$alarm->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Alarme deletado com sucesso!']);
    }
}
