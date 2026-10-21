<?php

namespace Tests\Feature;

use App\Models\Apprentice;
use App\Models\Area;
use App\Models\Computer;
use App\Models\Course;
use App\Models\TrainingCenter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComputerCrudTest extends TestCase
{
    use RefreshDatabase;

    /** El formulario de creacion se dibuja y trae los campos esperados. */
    public function test_the_create_page_renders_the_form()
    {
        $response = $this->get(route('computer.create'));

        $response->assertOk();
        $response->assertViewIs('computers.create');
        $response->assertSee('name="number"', false);
        $response->assertSee('name="brand"', false);
    }

    /** El listado se dibuja con los computadores registrados. */
    public function test_the_index_lists_the_computers()
    {
        Computer::create(['number' => 'SENA-010', 'brand' => 'Lenovo']);

        $response = $this->get(route('computers.index'));

        $response->assertOk();
        $response->assertViewIs('computers.index');
        $response->assertSee('SENA-010');
        $response->assertSee('Lenovo');
    }

    /** Un POST valido crea el computador y redirige al listado con mensaje de exito. */
    public function test_it_stores_a_computer()
    {
        $response = $this->post(route('computer.store'), [
            'number' => 'SENA-001',
            'brand' => 'Lenovo',
        ]);

        $response->assertRedirect(route('computers.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('computers', [
            'number' => 'SENA-001',
            'brand' => 'Lenovo',
        ]);
    }

    /** Un POST invalido no crea nada y devuelve los errores al formulario. */
    public function test_it_rejects_invalid_data_and_returns_the_errors()
    {
        $response = $this->from(route('computer.create'))
            ->post(route('computer.store'), [
                'number' => '',
                'brand' => '',
            ]);

        $response->assertRedirect(route('computer.create'));
        $response->assertSessionHasErrors(['number', 'brand']);
        $this->assertDatabaseCount('computers', 0);
    }

    /** El numero no puede superar los 255 caracteres. */
    public function test_the_number_cannot_exceed_255_characters()
    {
        $response = $this->from(route('computer.create'))
            ->post(route('computer.store'), [
                'number' => str_repeat('9', 256),
                'brand' => 'HP',
            ]);

        $response->assertSessionHasErrors('number');
        $this->assertDatabaseCount('computers', 0);
    }

    /** El numero no puede repetirse. */
    public function test_the_number_must_be_unique()
    {
        Computer::create(['number' => 'SENA-001', 'brand' => 'Lenovo']);

        $response = $this->from(route('computer.create'))
            ->post(route('computer.store'), [
                'number' => 'SENA-001',
                'brand' => 'HP',
            ]);

        $response->assertSessionHasErrors('number');
        $this->assertDatabaseCount('computers', 1);
    }

    /** La vista de edicion muestra los valores actuales del registro. */
    public function test_the_edit_page_shows_the_current_values()
    {
        $computer = Computer::create(['number' => 'SENA-003', 'brand' => 'Dell']);

        $response = $this->get(route('computer.edit', $computer->id));

        $response->assertOk();
        $response->assertViewIs('computers.edit');
        $response->assertSee('SENA-003');
        $response->assertSee('Dell');
    }

    /** Un PUT valido actualiza el registro y redirige al listado. */
    public function test_it_updates_a_computer()
    {
        $computer = Computer::create(['number' => 'SENA-004', 'brand' => 'Dell']);

        $response = $this->put(route('computer.update', $computer->id), [
            'number' => 'SENA-005',
            'brand' => 'HP',
        ]);

        $response->assertRedirect(route('computers.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('computers', [
            'id' => $computer->id,
            'number' => 'SENA-005',
            'brand' => 'HP',
        ]);
    }

    /** Al actualizar se ignora el propio registro en la regla de unicidad. */
    public function test_updating_keeps_its_own_number()
    {
        $computer = Computer::create(['number' => 'SENA-006', 'brand' => 'Lenovo']);

        $response = $this->put(route('computer.update', $computer->id), [
            'number' => 'SENA-006',
            'brand' => 'Lenovo ThinkPad',
        ]);

        $response->assertRedirect(route('computers.index'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('computers', [
            'id' => $computer->id,
            'brand' => 'Lenovo ThinkPad',
        ]);
    }

    /** Un PUT invalido no modifica el registro y devuelve los errores. */
    public function test_it_rejects_invalid_updates()
    {
        $computer = Computer::create(['number' => 'SENA-007', 'brand' => 'Lenovo']);

        $response = $this->from(route('computer.edit', $computer->id))
            ->put(route('computer.update', $computer->id), [
                'number' => '',
                'brand' => '',
            ]);

        $response->assertRedirect(route('computer.edit', $computer->id));
        $response->assertSessionHasErrors(['number', 'brand']);
        $this->assertDatabaseHas('computers', [
            'id' => $computer->id,
            'number' => 'SENA-007',
            'brand' => 'Lenovo',
        ]);
    }

    /** Un computador con aprendices asignados no se puede eliminar. */
    public function test_it_cannot_delete_a_computer_with_apprentices()
    {
        $computer = Computer::create(['number' => 'SENA-011', 'brand' => 'Lenovo']);

        $area = Area::create(['name' => 'Tecnologia']);
        $center = TrainingCenter::create(['name' => 'SENA Norte', 'location' => 'Bogota']);
        $course = Course::create([
            'course_number' => 'CF-001',
            'day' => 'Lunes',
            'area_id' => $area->id,
            'training_center_id' => $center->id,
        ]);

        Apprentice::create([
            'name' => 'Daniel',
            'email' => 'daniel@sena.edu.co',
            'cell_number' => '3001234567',
            'course_id' => $course->id,
            'computer_id' => $computer->id,
        ]);

        $response = $this->delete(route('computer.destroy', $computer->id));

        $response->assertRedirect(route('computers.index'));
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('computers', ['id' => $computer->id]);
    }

    /** La API sigue respondiendo JSON cuando el cliente pide application/json. */
    public function test_the_api_endpoint_still_returns_json()
    {
        Computer::create(['number' => 'SENA-008', 'brand' => 'Acer']);

        $response = $this->getJson('/v1/computers');

        $response->assertOk();
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['number' => 'SENA-008', 'brand' => 'Acer']);
    }
}
