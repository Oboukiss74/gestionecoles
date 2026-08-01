<?php

use App\Models\Matiere;
use App\Models\classes;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class MatiereTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_matiere_and_attaches_selected_classes(): void
    {
        $user = User::create([
            'nom' => 'Test',
            'prenom' => 'User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $classe1 = classes::create([
            'nom' => 'CP1',
            'niveau' => 'Primaire',
            'annee' => '2025-2026',
        ]);
        $classe2 = classes::create([
            'nom' => 'CE1',
            'niveau' => 'Primaire',
            'annee' => '2025-2026',
        ]);

        $response = $this->actingAs($user)->post(route('enregistrer_matiere'), [
            'nom' => 'Mathématiques',
            'classes' => [$classe1->id, $classe2->id],
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('matieres', ['nom' => 'Mathématiques']);

        $matiere = Matiere::where('nom', 'Mathématiques')->first();
        $this->assertTrue($matiere->classes()->pluck('classes.id')->contains($classe1->id));
        $this->assertTrue($matiere->classes()->pluck('classes.id')->contains($classe2->id));
    }
}
