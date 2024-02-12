<?php

class ProdutoRepositorio
{
    private PDO $pdo;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById(int $id)
    {
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->formarObjeto($dados);
    }

    public function formarObjeto($dados): Produto
    {
        return new Produto($dados['id'], $dados['tipo'], $dados['nome'], $dados['descricao'],
         floatval($dados['preco']), $dados['imagem']);
    }

    public function findAll()
    {
        $sql = "SELECT * FROM produtos ORDER BY preco";
        $dados = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $produtos = array_map(function ($produto){
            return $this->formarObjeto($produto);
        }, $dados);

        return $produtos;
    }

    public function findProdutosByTipo(string $tipo): array
    {
        $sql = "SELECT * FROM produtos WHERE tipo = '$tipo' ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $produtos = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dados = array_map(function ($cafe){
            return $this->formarObjeto($cafe);
        },$produtos);

        return $dados;
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
    }

    public function create(Produto $produto)
    {
        $sql = "INSERT INTO produtos(tipo,nome,descricao,preco,imagem) 
            VALUES (?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4, $produto->getPreco());
        $statement->bindValue(5, $produto->getImagem());
        $statement->execute();
    }

    public function update(Produto $produto)
    {
        $sql = "UPDATE produtos SET tipo = ?, nome = ?, descricao = ?, preco = ?
            WHERE id = ? ";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4, $produto->getPreco());
        $statement->bindValue(5, $produto->getId());
        $statement->execute();

        if($produto->getImagem() !== 'logo-serenatto.png'){

            $this->atualizarFoto($produto);
        }
    }

    private function atualizarFoto(Produto $produto)
    {
        $sql = "UPDATE produtos SET imagem = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getImagem());
        $statement->bindValue(2, $produto->getId());
        $statement->execute();
    }

}
