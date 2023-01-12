<!DOCTYPE html>
<html lang="pt-br">
<meta charset="utf-8"/>
    
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processo Seletivo PHP</title>
</head>
<body>
<?php
$host = "107.180.57.185";
$user = "dz_dev";
$pass = "p?%3DY?#*LBW";
$dbname = "dz_dev_test";


 //Inicio de conexao com banco de dados utilizando PDO
try{
   
    $conn = new PDO("mysql:host=". $host .";$dbname=" . $dbname, $user,$pass);
    echo "Conexao com banco de dados <b>" . $dbname . "</b> foi realizada co sucesso!";
}catch(PDOException $err){
    echo "Erro: Conexão com banco de dados não foi realizada com sucesso! Erro gerado:" . $err->getMessage();
}

//Fim da conexao com Banco de Dados

echo "<h2>Lista de Mulheres com idade superior a 20 anos: </h2>";
try{

    //query seleciona mulheres com idade superior a 20 anos
    $query_mulheres = "SELECT nome,sexo,cpf,nascimento,email,celular,profissao_id FROM dz_dev_test.pessoas WHERE TIMESTAMPDIFF(YEAR,nascimento,CURDATE()) >20 AND sexo LIKE 'Feminino'";

    $result_mulheres = $conn->prepare($query_mulheres);
    $result_mulheres->execute();  //executa a query para obter os valores


    while($row_mulheres = $result_mulheres->fetch(PDO::FETCH_ASSOC)){
    echo "Nome: " . $row_mulheres['nome'] . "<br>";
    echo "Sexo: " . $row_mulheres['sexo'] . "<br>";
    echo "CPF: " . $row_mulheres['cpf'] . "<br>";
    echo "Data de Nascimento: " . date('d/m/Y', strtotime( $row_mulheres['nascimento'])) . "<br>";
    echo "Email: " . $row_mulheres['email'] . "<br>";
    echo "Celular: " . $row_mulheres['celular'] . "<br>";
    $profissao_id = $row_mulheres['profissao_id'];
    
    $query_profissao = "SELECT nome FROM dz_dev_test.profissoes WHERE id LIKE $profissao_id";
    $result_profissao = $conn->prepare($query_profissao);
    $result_profissao->execute();
    while($row_profissao = $result_profissao->fetch(PDO::FETCH_ASSOC)){
    echo "Profissao: " . $row_profissao['nome'];
    }
    
    echo "<hr>";
    }
}catch(PDOException $err){
    echo "Erro: Erro ao Listar! Erro gerado:" . $err->getMessage();
}



?>
</body>
</html>
