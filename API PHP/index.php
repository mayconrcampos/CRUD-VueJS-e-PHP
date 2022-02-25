<?php

// Cabeçalhos obrigatórios

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Incluir conexão

include_once("./conexao.php");



$select = "SELECT * FROM produtos ORDER BY id DESC";

$resultado = $conn->prepare($select);

$resultado->execute();


if($resultado and $resultado->rowCount() > 0){
    
    while($linha_produto = $resultado->fetch(PDO::FETCH_ASSOC)){
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

