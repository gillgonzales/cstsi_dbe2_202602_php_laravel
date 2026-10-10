<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
</head>

<body>
    <h1>Produtos</h1>
    <a href={{ '/produto' }} target="_blank">
        <h3>+Adicionar Produto!!</h3>
    </a>
    @if ($produtos->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>qtd_estoque</th>
                    <th>preco</th>
                    <th>Importado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <td>
                            <a href={{ route('produto.show', $produto->id) }} target="_blank">
                                {{-- <a href={{"/produtos/$produto->id"}} target="_blank"> --}}
                                {{ $produto->id }}
                            </a>
                        </td>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->qtd_estoque }}</td>
                        <td>{{ $produto->preco }}</td>
                        <td>{{ $produto->importado ? 'Sim' : 'Não' }}</td>
                        <td>
                            <a href={{ route('produto.edit', $produto->id) }} target="_blank">
                                {{-- <a href={{"/produtos/$produto->id"}} target="_blank"> --}}
                                Editar
                            </a>
                            <a href={{ route('produto.remove', $produto->id) }} target="_blank">
                                {{-- <a href={{"/produtos/$produto->id"}} target="_blank"> --}}
                                Remover
                            </a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">{{$produtos->count()}} resultados de {{$produtos->total()}}</td>
                    <td>
                        <a href="{{$produtos->url(1)}}"><<</a>
                        <a href="{{$produtos->previousPageUrl()}}">< </a>
                        @foreach ($produtos->getUrlRange(1,$produtos->lastPage()) as $pagina=>$url)
                            @if($pagina === $produtos->currentPage())
                                <b>[ {{$pagina}} ]</b>
                            @else
                                <a href="{{$url}}">{{$pagina}}</a>
                            @endif
                        @endforeach
                        <a href="{{$produtos->nextPageUrl() }}"> > </a>
                        <a href="{{$produtos->url($produtos->lastPage()) }}"> >> </a>
                    </td>
                    <td colspan="2">Página {{$produtos->currentPage()}} de {{$produtos->lastPage()}}</td>
                </tr>
            </tbody>
        </table>
    @else
        <p>Produtos não encontrados! </p>
    @endif
</body>

</html>
