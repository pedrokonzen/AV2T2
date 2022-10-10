<?php

class Festa implements ActiveRecord{

    private int $idFesta;
    
    public function __construct(
        private string $nome,
        private string $endereco,
        private string $cidade,
        private string $data){
    }

    public function setIdFesta(int $idFesta):void{
        $this->idFesta = $idFesta;
    }

    public function getIdFesta():int{
        return $this->idFesta;
    }

    public function setNome(string $nome):void{
        $this->nome = $nome;
    }

    public function getNome():string{
        return $this->nome;
    }

    public function setEndereco(string $endereco):void{
        $this->endereco = $endereco;
    }

    public function getEndereco():string{
        return $this->endereco;
    }
    
    public function setCidade(string $cidade):void{
        $this->cidade = $cidade;
    }

    public function getCidade():string{
        return $this->cidade;
    }

    public function setData(string $data):void{
        $this->data = $data;
    }

    public function getData():string{
        return $this->data;
    }

    public function save():bool{
        $conexao = new MySQL();
        if(isset($this->idFesta)){
            $sql = "UPDATE festas SET nome = '{$this->nome}' ,endereco = '{$this->endereco}',cidade = '{$this->cidade}',data = '{$this->data}' WHERE idFesta = {$this->idFesta}";
        }else{
            $sql = "INSERT INTO festas (nome,endereco,cidade,data) VALUES ('{$this->nome}','{$this->endereco}','{$this->cidade}','{$this->data}')";
        }
        return $conexao->executa($sql);
        
    }
    public function delete():bool{
        $conexao = new MySQL();
        $sql = "DELETE FROM festas WHERE idFesta = {$this->idFesta}";
        return $conexao->executa($sql);
    }

    public static function find($idFesta):Festa{
        $conexao = new MySQL();
        $sql = "SELECT * FROM festas WHERE idFesta = {$idFesta}";
        $resultado = $conexao->consulta($sql);
        $p = new Festa($resultado[0]['nome'],$resultado[0]['endereco'],$resultado[0]['cidade'],$resultado[0]['data']);
        $p->setIdFesta($resultado[0]['idFesta']);
        return $p;
    }
    public static function findall():array{
        $conexao = new MySQL();
        $sql = "SELECT * FROM festas";
        $resultados = $conexao->consulta($sql);
        $festas = array();
        foreach($resultados as $resultado){
            $f = new Festa($resultado['nome'],$resultado['endereco'],$resultado['cidade'],$resultado['data']);
            $f->setIdFesta($resultado['idFesta']);
            $festas[] = $f;
        }
        return $festas;
    }
    public static function findAllPassadas():array{
        $conexao = new MySQL();
        $date = date("Y-m-d");
        $sql = "SELECT * FROM festas WHERE data <= {$date} ORDER BY data DESC, cidade , nome";
        $resultados = $conexao->consulta($sql);
        $festas = array();
        foreach($resultados as $resultado){
            $f = new Festa($resultado['nome'],$resultado['endereco'],$resultado['cidade'],$resultado['data']);
            $f->setIdFesta($resultado['idFesta']);
            $festas[] = $f;
        }
        return $festas;
    }

    public static function findAllProximas():array{
        $conexao = new MySQL();
        $date = date("Y-m-d");
        $sql = "SELECT * FROM festas WHERE data > '{$date}' ORDER BY data DESC, cidade, nome";
        $resultados = $conexao->consulta($sql);
        $festas = array();
        foreach($resultados as $resultado){
            $f = new Festa($resultado['nome'],$resultado['endereco'],$resultado['cidade'],$resultado['data']);
            $f->setIdFesta($resultado['idFesta']);
            $festas[] = $f;
        }
        return $festas;
    }

    public static function findAllPorCidade():array{
        $conexao = new MySQL();
        $sql = "SELECT cidade, COUNT(*) as quantidade FROM festas GROUP BY cidade ORDER BY quantidade DESC, cidade";
        $resultados = $conexao->consulta($sql);
        return $resultados;
    }
    public static function findAllPorMes():array{
        $conexao = new MySQL();
        $sql1 = "SET lc_time_names = 'pt_BR'";
        $conexao->executa($sql1);
        $sql = "SELECT MONTHNAME(data) as mes, COUNT(MONTH(data)) as quantidade FROM festas 
        GROUP BY mes ASC ";
        $resultados = $conexao->consulta($sql);
        return $resultados;
    }
    
    public static function findAllPorAno():array{
        $conexao = new MySql();
        $sql = "SELECT YEAR(data) as Ano, COUNT(YEAR(data)) as quantidade FROM festas GROUP BY Ano desc";
        $resultados = $conexao->consulta($sql);
        return $resultados;
    }

    public static function findAllDiasRestantes():array{
        $conexao = new MySql();
        $sql = "SELECT festas.nome as 'Festa:', DATEDIFF(festas.data , CURRENT_DATE) as 'Dias Restantes:' from festas where DATEDIFF(festas.data , CURRENT_DATE) > 0";
        $resultados = $conexao->consulta($sql);
        return $resultados;
    }
}   