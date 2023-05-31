
<?php
//Filmess.php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
//GET recebe/pega informaçõe
//POST envia informações
//PUT edita informações "update"
//DELETE deleta informações
//OPTIONS  é a  relação de methodos disponiveis para uso
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}
//  else {
//     echo "erro de requisição";
// }

include 'conexao.php';

//Rota para obter TODOS os filmes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //aqui eu crio o comando de select para consultar o banco
    $stmt = $conn->prepare("SELECT * FROM filmes");
    //aqui eu executo o select
    $stmt->execute();
    //aqui eu recebo os dados do banco por meio do PDO
    $filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //transformo os dados da variave $filmes em um JSON valido
    echo json_encode($filmes);
}

//Rota para criar filmes
//Rota para inserir filmes
//Utilizando o POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titulo = $_POST['titulo'];
    $diretor = $_POST['diretor'];
    $ano_publicacao = $_POST['ano_publicacao'];
    //inserir outros campos caso necessario ....

    $stmt = $conn->prepare("INSERT INTO filmes (titulo, diretor, ano_publicacao) VALUES (:titulo, :diretor, :ano_publicacao)");
    $stmt -> bindParam(':titulo', $titulo);
    $stmt -> bindParam(':diretor', $diretor);
    $stmt -> bindParam(':ano_publicacao', $ano_publicacao);
    //Outros bindParams ....

    if($stmt->execute()){
        echo "Filme criado com sucesso!!";
    }else{
        echo "Erro ao criar filme";
    }
}

// rota para excluir um filme

if($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM filmes WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if($stmt->execute()){
        echo "Filme excluido com sucesso !!!";
    }else{
        echo "Erro ao excluir Filme ";
    }

}

//Rota para atualizar um filme existente
if($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])){
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_GET['id'];
    $novoTitulo = $_PUT['titulo'];
    $novoAutor = $_PUT['diretor'];
    $novoAno = $_PUT['ano_publicacao'];
    //add novos campos caso necessario
    $stmt = $conn->prepare("UPDATE filmes SET titulo = :titulo, diretor = :diretor, ano_publicacao = :ano_publicacao WHERE id = :id");
    $stmt->bindParam(':titulo', $novoTitulo);
    $stmt->bindParam(':diretor', $novoAutor);
    $stmt->bindParam(':ano_publicacao', $novoAno);
    $stmt->bindParam(':id', $id);
    //add novos campos caso necessario
    if($stmt->execute()){
        echo "Filmes atualizado!!";
    }else {
        echo "erro ao atualizar filmes :(";
    }
}