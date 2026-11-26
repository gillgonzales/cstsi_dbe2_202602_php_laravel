<?php

namespace App\Services;

use Exception;
use App\Models\Produto;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\RepositoryInterface;

class ProdutoService
{
    private $storagePath = 'produtos/';

    public function __construct(
        protected RepositoryInterface $repository
    ){}

    private function handleUploadImage(UploadedFile $produtoImage): string | null
    {
        $hashedImageName = $produtoImage->hashName();
        if (!$produtoImage->store($this->storagePath, 'public'))
            throw new Exception("Erro ao salvar imagem do produto!!");
        if(!Storage::disk('public')->exists($this->storagePath.$hashedImageName))
            return null;
        return $hashedImageName;
    }

    public function create( array $produtoData ): Produto {

        if (isset($produtoData['imagem']))
             $produtoData['imagem'] = $this->handleUploadImage($produtoData['imagem']);

        return $this->repository->create($produtoData);
    }
  }
