<?php

// Cabeçalhos obrigatórios

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

// Incluir conexão

include_once("./conexao.php");

$resposta_json = file_get_contents("php://input");

$dados = json_decode($resposta_json, true);

$edita = "UPDATE produtos SET titulo=?, descricao=? WHERE id=?";

$edita_produto = $conn->prepare($edita);
$edita_produto->bindValue(1, $dados['produto']['titulo'], PDO::PARAM_STR);
$edita_produto->bindValue(2, $dados['produto']['descricao'], PDO::PARAM_STR);
$edita_produto->bindValue(3, $dados['produto']['id'], PDO::PARAM_INT);

$edita_produto->execute();

if($edita_produto and $edita_produto->rowCount() > 0){
    
    while($linha_produto = $edita_produto->fetch(PDO::FETCH_ASSOC)){
        extract($linha_produto);

        $lista_produtos["records"][$id] = [
            "id" => $id,
            "titulo" => $titulo,
            "descricao" =>$descricao
        ];
    }

    // resposta com status 200 - tudo certo
    http_response_code(200);

    // Retornar os produtos em formato json
    echo json_encode($lista_produtos);

}

