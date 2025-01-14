<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Bezeroa;
use App\Models\Taldea;
use App\Models\Gidaria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crea un usuario
        User::create([
            'izena' => 'Iker Atxaga',
            'email' => 'iachagaro22wg@ikzubirimanteo.com',
            'password' => 'iachagaro22wg',
            'mota' => 'bezero',
        ]);

        // Crea un registro en la tabla Bezeroa
        Bezeroa::create([
            'puntuak' => 0,
            'premium' => 0,
            'dirua' => 100000000,
            'user_id' => 1
        ]);

        Taldea::create([
            'izena' => 'Scuderia Ferrari',
            'kotxea' => 'sf24',
            'puntuak' => 0,
            'jabea' => 1,
            'balioa' => 50000000
        ]);

        Taldea::create([
            'izena' => 'Mclaren',
            'kotxea' => 'MCL38',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 0
        ]);

        Taldea::create([
            'izena' => 'Red Bull Racing',
            'kotxea' => 'RB20',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 0
        ]);

        Taldea::create([
            'izena' => 'Mercedes-AMG PETRONAS',
            'kotxea' => 'W15',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 0
        ]);

        Taldea::create([
            'izena' => 'Aston Martin Aramco',
            'kotxea' => 'AMR25',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 0
        ]);

        Taldea::create([
            'izena' => 'Alpine',
            'kotxea' => 'A524',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 0
        ]);


        Taldea::create([
            'izena' => 'Haas',
            'kotxea' => 'VF-25',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 0
        ]);

        Taldea::create([
            'izena' => 'RB',
            'kotxea' => 'VCARB 01',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 0
        ]);

        Taldea::create([
            'izena' => 'Williams',
            'kotxea' => 'FW46',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 0
        ]);

        Taldea::create([
            'izena' => 'Kick Sauber',
            'kotxea' => 'C44',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 0
        ]);

        Taldea::create([
            'izena' => 'F2',
            'kotxea' => 'F2',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 0
        ]);

        

        

       
       



        // Crea un registro en la tabla Gidaria
        Gidaria::create([
            'izena' => 'Charles Leclerc',
            'taldea' => 1,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'
        ]);

        Gidaria::create([
            'izena' => 'Lewis Hamilton',
            'taldea' => 1,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Lando Norris',
            'taldea' => 2,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Oscar Piastri',
            'taldea' => 2,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Max Verstappen',
            'taldea' => 3,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Liam Lawson',
            'taldea' => 3,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'George Russel',
            'taldea' => 4,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Kimi Antonelli',
            'taldea' => 4,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Fernando Alonso',
            'taldea' => 5,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Lance Stroll',
            'taldea' => 5,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Pierre Gasly',
            'taldea' => 6,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Jack Doohan',
            'taldea' => 6,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Esteban Ocon',
            'taldea' => 7,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Oliver Bearman',
            'taldea' => 7,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Yuki Tsunoda',
            'taldea' => 8,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Isack Hadjar',
            'taldea' => 8,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Carlos Sainz',
            'taldea' => 9,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Alex Albon',
            'taldea' => 9,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Nico Hulkenberg',
            'taldea' => 10,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Gabriel Bortoleto',
            'taldea' => 10,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Leonardo Fornaroli',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Roman Staněk',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Arvid Lindblad',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Pepe Martí',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Oliver Goethe',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Luke Browning',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Luke Browning',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Dino Beganovic',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Gabriele Minì',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Sebastián Montoya',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Jak Crawford',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Kush Maini',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Ritomo Miyata',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Por anunciar',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Christian Mansell',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Por anunciar',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Joshua Dürksen',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Por anunciar',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'No Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Max Esterson',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Sami Meguetounif',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'John Bennett',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'Disponible'

        ]);

        Gidaria::create([
            'izena' => 'Por anunciar',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 0,
            'disponibilitatea' => 'No Disponible'

        ]);




        


    }
}
