<?php
require_once __DIR__."/vendor/autoload.php";
$festas = Festa::findAllProximas();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Página de Festas</title>
</head>
<style>
    a{
        text-decoration: none;
    }
    .edit{
        color: black;
    }

    .delete{
        color:red;
    }

</style>
<body>
    <div class="container">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Endereco</th>
              <th scope="col">Cidade</th>
              <th scope="col">Dia</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach($festas as $festa){
                echo "<tr>";
                echo "<td>{$festa->getNome()}</td>";
                echo "<td>{$festa->getEndereco()}</td>";
                echo "<td>{$festa->getCidade()}</td>";
                //Formatação da data para exibir como dia, mês e ano.
                $dataFormatada = new DateTime($festa->getData());
                echo "<td>{$dataFormatada->format('d/m/Y')}</td>";
                echo "<td>
                        <a href='formEdit.php?idFesta={$festa->getIdFesta()}'><span class='material-symbols-outlined edit'>edit</span></a>
                        <a href='excluir.php?idFesta={$festa->getIdFesta()}'><span class='material-symbols-outlined delete'>delete</span></a> 
                     </td>";
                echo "</tr>";
            }
            ?>
          </tbody>
        </table>

        <div class="btn">
            <a href='index.php'>Voltar</a>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
