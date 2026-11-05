<?php

namespace Database\Seeders;

use App\Models\Promocao;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PromocaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $createdAt = Carbon::now()->toDateTimeString();
            $promocoes = [
                [
                    'nome'      =>  'Dia das Mães',
                    'inicio'    =>  Carbon::create(null, 05, 4, 0, 0, 0)->toDateTimeString(),
                    'fim'       =>  Carbon::create(null, 05, 15, 20, 0, 0)->toDateTimeString(),
                    'created_at'=>  $createdAt,
                    'updated_at'=>  $createdAt
                ],
                [
                    'nome'      =>  'Black Friday',
                    'inicio'    =>  Carbon::create(null, 11, 14, 8, 0, 0)->toDateTimeString(),
                    'fim'       =>  Carbon::create(null, 11, 25, 0, 0, 0)->toDateTimeString(),
                    'created_at'=>  $createdAt,
                    'updated_at'=>  $createdAt,
                ],
                [
                    'nome'      =>  'Cyber Monday',
                    'inicio'    =>  Carbon::create(null, 11, 25, 13, 0, 0)->toDateTimeString(),
                    'fim'       =>  Carbon::create(null, 11, 30, 0, 0, 0)->toDateTimeString(),
                    'created_at'=>  $createdAt,
                    'updated_at'=>  $createdAt,
                ],
                [
                    'nome'      =>  'Natal',
                    'inicio'    =>  Carbon::create(null, 12, 20, 8, 0, 0)->toDateTimeString(),
                    'fim'       =>  Carbon::create(null, 12, 26, 0, 0, 0)->toDateTimeString(),
                    'created_at'=>  $createdAt,
                    'updated_at'=>  $createdAt,
                ],
            ];

            $date = Carbon::create(null, 02, 8, 12, 0, 0);
            $formatDtFim = $date->toDateTimeString();
            $formatDtInicio = $date->subDays(7)->toDateTimeString();
            $promocoes[] = [
                'nome'      => 'Carnaval',
                'inicio'    => $formatDtInicio,
                'fim'       => $formatDtFim,
                'createdAt'=> $createdAt,
                'updated_at'=> $createdAt,
            ];

            Promocao::insert($promocoes)
                ? Log::channel('stderr')->info("Promocoes criadas!")
                : throw new Exception("Erro ao criar promoções!");

        } catch(Exception $error) {
            Log::debug($error->getMessage());
            Log::channel('stderr')->error($error->getMessage());
        }
    }
}
