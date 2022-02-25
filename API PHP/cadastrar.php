<?php

//Cabeçalhos obrigatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

// Incluir conexão
include_once("./conexao.php");

$resposta_json = file_get_contents("php://input");

$dados = json_decode($resposta_json, true);

if($dados){
    // INSERT - Gravando no banco de dados

    $query = "INSERT INTO produtos (titulo, descricao) VALUES (?, ?)";
    $cadastra_produto = $conn->prepare($query);
    
    $cadastra_produto->bindValue(1, $dados['produto']['titulo'], PDO::PARAM_STR);
    $cadastra_produto->bindValue(2, $dados['produto']['descricao'], PDO::PARAM_STR);
    $cadastra_produto->execute();

    
    if($cadastra_produto->rowCount()){
        $resposta = [
            "erro" => false,
            "mensagem" => "Produto cadastrado com sucesso;"
        ];
    }else{
        $resposta = [
            "erro" => true,
            "mensagem" => "ERRO! Produto não cadastrado;"
        ];
    }

    

}else{

    $resposta = [
        "erro" => true,
        "mensagem" => "ERRO tudo."
    ];
}


http_response_code(200);
echo json_encode($resposta);