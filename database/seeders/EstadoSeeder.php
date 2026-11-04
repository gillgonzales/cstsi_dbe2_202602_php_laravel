<?php

namespace Database\Seeders;

use App\Models\Estado;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            if (Estado::all()->count()) {
                Log::channel('stderr')->info("O banco já possui estados cadastrados!");
                print_r(Estado::all()->pluck('nome','id'));
                return;
            }

            $jsonUrl = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados';
            $response = Http::get($jsonUrl);
            $estados = $response->json();

            if (!$estados)
                throw new \Exception("Erro ao carregar arquivo JSON de Estados!\nURL:$jsonUrl");

            $hora_de_criacao = Carbon::now();
            $listEstados = [];
            foreach ($estados as $estado)
                $listEstados[] = [
                    "nome"      =>  $estado['nome'],
                    "uf"        =>  $estado["sigla"],
                    "regiao_id" =>  $estado["regiao"]["id"],
                    "created_at" =>  $hora_de_criacao,
                    "updated_at" =>  $hora_de_criacao
                ];

            if (!Estado::insert($listEstados))
                throw new \Exception("Erro ao inserir estados!", 1);

            Log::channel('stderr')->info("Estados inseridos com sucesso!");
            print_r(Estado::all()->pluck('uf','id'));
        } catch (\Exception $error) {
            throw new \Exception("Erro ao processar o seed de estados!\n {$error->getMessage()}");
        }
    }
}
