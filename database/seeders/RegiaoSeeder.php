<?php

namespace Database\Seeders;

use App\Models\Regiao;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RegiaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         try {
            if (Regiao::all()->count()) {
                Log::channel('stderr')->info("O banco já possui regioes!");
                print_r(Regiao::all()->pluck('nome','id'));
                return;
            }

            $jsonUrl = 'https://servicodados.ibge.gov.br/api/v1/localidades/regioes';
            $response = Http::get($jsonUrl);
            $regioes = $response->json();

            if (!$regioes)
                throw new \Exception("Erro ao carregar arquivo JSON de Regioes!\nURL:$jsonUrl");

            Log::channel('stderr')->info("Regiões obtidas com sucesso!");
            print_r($regioes);

            $listRegioes = [];
            foreach ($regioes as $regiao)
                $listRegioes[] = [
                                    "nome" => $regiao['nome'],
                                    "created_at" => Carbon::now(),
                                    "updated_at" => Carbon::now()
                                ];

            if (!Regiao::insert($listRegioes))
                throw new \Exception("Erro ao inserir Regioes!", 1);

            Log::channel('stderr')->info("Regiões inseridas com sucesso!");
            print_r(Regiao::all()->pluck('nome','id'));
        } catch (Exception $error) {
            throw new Exception("Erro ao processar o seed de Regioes!\n {$error->getMessage()}");
        }
    }
}
