<?php

namespace CSTSI\Dbe2\models;

class Produto
{
	private ?int $id_prod;
	private string $nome;
	private string $descricao;
	private int $qtd_estoque;
	private float $preco;
	private bool $importado;

	public function __construct(
		?int $id_prod = null,
		string $nome = '',
		string $descricao = '',
		int $qtd_estoque = 0,
		float $preco = 0.0,
		bool $importado = false
	) {

		$this->id_prod = $id_prod;
		$this->nome = $nome;
		$this->descricao = $descricao;
		$this->qtd_estoque = $qtd_estoque;
		$this->preco = $preco;
		$this->importado = $importado;
	}

	public function getIdProd(): ?int
	{
		return $this->id_prod;
	}

	public function setIdProd(?int $id_prod): self
	{
		$this->id_prod = $id_prod;
		return $this;
	}

	public function getNome(): string
	{
		return $this->nome;
	}

	public function setNome(string $nome): self
	{
		$this->nome = $nome;
		return $this;
	}

	public function getDescricao(): string
	{
		return $this->descricao;
	}

	public function setDescricao(string $descricao): self
	{
		$this->descricao = $descricao;
		return $this;
	}

	public function getQtdEstoque(): int
	{
		return $this->qtd_estoque;
	}

	public function setQtdEstoque(int $qtd_estoque): self
	{
		$this->qtd_estoque = $qtd_estoque;
		return $this;
	}

	public function getPreco(): float
	{
		return $this->preco;
	}

	public function setPreco(float $preco): self
	{
		$this->preco = $preco;
		return $this;
	}

	public function isImportado(): bool
	{
		return $this->importado;
	}

	public function setImportado(bool $importado): self
	{
		$this->importado = $importado;
		return $this;
	}

	public function __get(mixed $name)
	{
		return $this->$name;
	}

	public function __set(string $name,  mixed $value)
	{
		$this->$name=$value;
	}

}