<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Bezeroa;
use App\Models\BezeroLiga;
use App\Models\Taldea;
use App\Models\Gidaria;
use App\Models\GrandPrix;
use App\Models\Liga;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'izena' => 'Iker Atxaga',
            'email' => 'formulafury@gmail.com',
            'password' => 'formulafury',
            'mota' => 'bezero',
        ]);

        User::create([
            'izena' => 'Ramiro santos',
            'email' => 'ramirosantos@gmail.com',
            'password' => 'ramirosantos',
            'mota' => 'admin',
        ]);

        User::create([
            'izena' => 'Bittor',
            'email' => 'btellecheael22wg@ikzubirimanteo.com',
            'password' => 'btellecheael22wg',
            'mota' => 'bezero',
        ]);
        
        User::create([
            'izena' => 'Bittor2',
            'email' => 'bittortelletxea@gmail.com',
            'password' => 'bittortelletxea',
            'mota' => 'bezero',
        ]);

        Liga::create([
            'izena' => 'proba1',
            'kodea' => 'HGA6DG',
            'deskribapena' => 'ghfdhfd',
            'klausulak' => 1,
        ]);

        Bezeroa::create([
            'puntuak' => 0,
            'premium' => 0,
            'user_id' => 1
        ]);

        Bezeroa::create([
            'puntuak' => 0,
            'premium' => 0,
            'user_id' => 2
        ]);

        Bezeroa::create([
            'puntuak' => 0,
            'premium' => 0,
            'user_id' => 3
        ]);


        BezeroLiga::create([
            'puntuak' => 0,
            'bezeroa_id' => 1,
            'liga_id' => 1,
            'dirua' => 25000000,
        ]);

        Taldea::create([
            'izena' => 'Scuderia Ferrari',
            'kotxea' => 'sf24',
            'puntuak' => 0,
            'jabea' => 1,
            'balioa' => 40000000,
            'foto' => '/images/ferrari.png'
        ]);

        Taldea::create([
            'izena' => 'Mclaren',
            'kotxea' => 'MCL38',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 45000000,
            'foto' => '/images/mclaren.png'

        ]);

        Taldea::create([
            'izena' => 'Red Bull Racing',
            'kotxea' => 'RB20',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 40000000,
            'foto' => '/images/redbull.png'

        ]);

        Taldea::create([
            'izena' => 'Mercedes-AMG PETRONAS',
            'kotxea' => 'W15',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 35000000,
            'foto' => '/images/mercedes.png'

        ]);

        Taldea::create([
            'izena' => 'Aston Martin Aramco',
            'kotxea' => 'AMR25',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 19000000,
            'foto' => '/images/astonmartin.png'

        ]);

        Taldea::create([
            'izena' => 'Alpine',
            'kotxea' => 'A524',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 22000000,
            'foto' => '/images/alpine.png'

        ]);


        Taldea::create([
            'izena' => 'Haas',
            'kotxea' => 'VF-25',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 5000000,
            'foto' => '/images/haas.png'

        ]);

        Taldea::create([
            'izena' => 'RB',
            'kotxea' => 'VCARB 01',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 10000000,
            'foto' => '/images/rb.png'

        ]);

        Taldea::create([
            'izena' => 'Williams',
            'kotxea' => 'FW46',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 20000000,
            'foto' => '/images/williams.png'

        ]);

        Taldea::create([
            'izena' => 'Kick Sauber',
            'kotxea' => 'C44',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 7500000,
            'foto' => '/images/kick.png'

        ]);

        Taldea::create([
            'izena' => 'F2',
            'kotxea' => 'F2',
            'puntuak' => 0,
            'jabea' => null,
            'balioa' => 0,
            'foto' => '/images/kick.png'
        ]);

        

        

       
       



        // Crea un registro en la tabla Gidaria
        Gidaria::create([
            'izena' => 'Charles Leclerc',
            'taldea' => 1,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 35000000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/leclerc.png'
        ]);

        Gidaria::create([
            'izena' => 'Lewis Hamilton',
            'taldea' => 1,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 22000000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/hamilton.png'

        ]);

        Gidaria::create([
            'izena' => 'Lando Norris',
            'taldea' => 2,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 33500000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/norris.png'


        ]);

        Gidaria::create([
            'izena' => 'Oscar Piastri',
            'taldea' => 2,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 15000000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/piastri.png'


        ]);

        Gidaria::create([
            'izena' => 'Max Verstappen',
            'taldea' => 3,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 40000000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/verstappen.png'


        ]);

        Gidaria::create([
            'izena' => 'Liam Lawson',
            'taldea' => 3,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 2000000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/lawson.png'


        ]);

        Gidaria::create([
            'izena' => 'George Russel',
            'taldea' => 4,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 25000000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/russell.png'


        ]);

        Gidaria::create([
            'izena' => 'Kimi Antonelli',
            'taldea' => 4,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 11500000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/antonelli.png'


        ]);

        Gidaria::create([
            'izena' => 'Fernando Alonso',
            'taldea' => 5,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 17000000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/alonso.png'


        ]);

        Gidaria::create([
            'izena' => 'Lance Stroll',
            'taldea' => 5,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 6000000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/stroll.png'


        ]);

        Gidaria::create([
            'izena' => 'Pierre Gasly',
            'taldea' => 6,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 9300000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/gasly.png'


        ]);

        Gidaria::create([
            'izena' => 'Jack Doohan',
            'taldea' => 6,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 2300000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/doohan.png'


        ]);

        Gidaria::create([
            'izena' => 'Esteban Ocon',
            'taldea' => 7,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 8900000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/ocon.png'


        ]);

        Gidaria::create([
            'izena' => 'Oliver Bearman',
            'taldea' => 7,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 3200000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/bearman.png'


        ]);

        Gidaria::create([
            'izena' => 'Yuki Tsunoda',
            'taldea' => 8,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 8500000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/tsunoda.png'


        ]);

        Gidaria::create([
            'izena' => 'Isack Hadjar',
            'taldea' => 8,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 1500000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/hadjar.png'


        ]);

        Gidaria::create([
            'izena' => 'Carlos Sainz',
            'taldea' => 9,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 15000000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/sainz.png'


        ]);

        Gidaria::create([
            'izena' => 'Alex Albon',
            'taldea' => 9,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 9700000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/albon.png'


        ]);

        Gidaria::create([
            'izena' => 'Nico Hulkenberg',
            'taldea' => 10,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 5500000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/hulkenberg.png'


        ]);

        Gidaria::create([
            'izena' => 'Gabriel Bortoleto',
            'taldea' => 10,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f1',
            'balioa' => 2300000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/bortoleto.png'


        ]);

        Gidaria::create([
            'izena' => 'Leonardo Fornaroli',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 990000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/fornaroli.png'


        ]);

        Gidaria::create([
            'izena' => 'Roman Staněk',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 980000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/stanek.png'
            

        ]);

        Gidaria::create([
            'izena' => 'Arvid Lindblad',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 8000000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/lindbland.png'


        ]);

        Gidaria::create([
            'izena' => 'Pepe Martí',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 1500000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/pepemarti.png'

            

        ]);

        Gidaria::create([
            'izena' => 'Oliver Goethe',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 700000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/goethe.png'


        ]);

        Gidaria::create([
            'izena' => 'Richard Verschoor',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 800000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/verschoor.png'

            

        ]);

        Gidaria::create([
            'izena' => 'Luke Browning',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 700000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/browning.png'


        ]);

        Gidaria::create([
            'izena' => 'Dino Beganovic',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 803000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/beganovic.png'


        ]);

        Gidaria::create([
            'izena' => 'Gabriele Minì',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 700000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/mini.png'


        ]);

        Gidaria::create([
            'izena' => 'Sebastián Montoya',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 860000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/montoya.png'


        ]);

        Gidaria::create([
            'izena' => 'Jak Crawford',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 600000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/crawford.png'


        ]);

        Gidaria::create([
            'izena' => 'Kush Maini',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 670000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/maini.png'


        ]);

        Gidaria::create([
            'izena' => 'Ritomo Miyata',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 720000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/miyata.png'


        ]);

        Gidaria::create([
            'izena' => 'Christian Mansell',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 800000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/mansell.png'


        ]);

        Gidaria::create([
            'izena' => 'Joshua Dürksen',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 750000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/durksen.png'


        ]);

        Gidaria::create([
            'izena' => 'Cian Shields',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 640000,
            'disponibilitatea' => 'No Disponible',
            'foto' => '/images/shields.png'

        ]);

        Gidaria::create([
            'izena' => 'Max Esterson',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 700000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/esterson.png'


        ]);

        Gidaria::create([
            'izena' => 'Sami Meguetounif',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 600000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/sami.png'


        ]);

        Gidaria::create([
            'izena' => 'John Bennett',
            'taldea' => 11,
            'puntuak' => '0',
            'jabea' => null,
            'kategoria' => 'f2',
            'balioa' => 750000,
            'disponibilitatea' => 'Disponible',
            'foto' => '/images/bennet.png'
            

        ]);

        GrandPrix::create([
            'izena' => 'Australia',
            'data' => '2025-03-14',
            'zirkuitua' => 'Albert Park',
        ]);
        
        GrandPrix::create([
            'izena' => 'China',
            'data' => '2025-03-21',
            'zirkuitua' => 'Shanghai',
        ]);

        GrandPrix::create([
            'izena' => 'Japón',
            'data' => '2025-04-04',
            'zirkuitua' => 'Suzuka',
        ]);

        GrandPrix::create([
            'izena' => 'Bahréin',
            'data' => '2025-04-11',
            'zirkuitua' => 'Sakhir',
        ]);

        GrandPrix::create([
            'izena' => 'Arabia Saudí',
            'data' => '2025-04-18',
            'zirkuitua' => 'Jeddah',
        ]);

        GrandPrix::create([
            'izena' => 'Miami',
            'data' => '2025-05-02',
            'zirkuitua' => 'Miami',
        ]);

        GrandPrix::create([
            'izena' => 'Emilia Romaña',
            'data' => '2025-05-16',
            'zirkuitua' => 'Imola',
        ]);

        GrandPrix::create([
            'izena' => 'Mónaco',
            'data' => '2025-05-23',
            'zirkuitua' => 'Montecarlo',
        ]);

        GrandPrix::create([
            'izena' => 'España',
            'data' => '2025-05-30',
            'zirkuitua' => 'Montmeló',
        ]);

        GrandPrix::create([
            'izena' => 'Canadá',
            'data' => '2025-06-13',
            'zirkuitua' => 'Montreal',
        ]);

        GrandPrix::create([
            'izena' => 'Austria',
            'data' => '2025-06-27',
            'zirkuitua' => 'Red Bull Ring',
        ]);

        GrandPrix::create([
            'izena' => 'Gran Bretaña',
            'data' => '2025-07-05',
            'zirkuitua' => 'Silverstone',
        ]);

        GrandPrix::create([
            'izena' => 'Bélgica',
            'data' => '2025-07-25',
            'zirkuitua' => 'Spa-Francorchamps',
        ]);

        GrandPrix::create([
            'izena' => 'Hungría',
            'data' => '2025-08-01',
            'zirkuitua' => 'Hungaroring',
        ]);

        GrandPrix::create([
            'izena' => 'Países Bajos',
            'data' => '2025-08-29',
            'zirkuitua' => 'Zandvoort',
        ]);

        GrandPrix::create([
            'izena' => 'Italia',
            'data' => '2025-09-05',
            'zirkuitua' => 'Monza',
        ]);

        GrandPrix::create([
            'izena' => 'Azerbaiyán',
            'data' => '2025-09-19',
            'zirkuitua' => 'Bakú',
        ]);

        GrandPrix::create([
            'izena' => 'Singapur',
            'data' => '2025-10-03',
            'zirkuitua' => 'Marina Bay',
        ]);

        GrandPrix::create([
            'izena' => 'Estados Unidos',
            'data' => '2025-10-17',
            'zirkuitua' => 'Circuito de las Américas',
        ]);

        GrandPrix::create([
            'izena' => 'México',
            'data' => '2025-10-24',
            'zirkuitua' => 'Hermanos Rodríguez',
        ]);

        GrandPrix::create([
            'izena' => 'Sao Paulo',
            'data' => '2025-11-07',
            'zirkuitua' => 'Interlagos',
        ]);

        GrandPrix::create([
            'izena' => 'Las Vegas',
            'data' => '2025-11-20',
            'zirkuitua' => 'Las Vegas',
        ]);

        GrandPrix::create([
            'izena' => 'Qatar',
            'data' => '2025-11-28',
            'zirkuitua' => 'Losail',
        ]);

        GrandPrix::create([
            'izena' => 'Abu Dhabi',
            'data' => '2025-12-05',
            'zirkuitua' => 'Yas Marina',
        ]);

        $gidariak = Gidaria::all();

        $pivotData = $gidariak->mapWithKeys(function ($gidariak) {
            return [
                $gidariak->id => [
                    'erabilgarritasuna' => 1, 
                    'erositako_prezioa' => 0,
                    'saldutako_prezioa' => 0,
                ]
            ];
        })->toArray();

        $liga = Liga::find(1);

        $liga->gidariak()->attach($pivotData);

    }
}
