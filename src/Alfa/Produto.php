<?php 
namespace Alfa;

class Produto extends Entidade{

	public function getNome()
	{
		return $this->nomeTabela;
	}
	public function setNome($nome)
	{
		$this->nomeTabela = $nome;
	}
	public function create ($colunas, $valores){
		//echo __CLASS__."<hr>";
		//CLASS É O NOME DA CLASS, PARA REFERENCIAR NA TABELA
		//strtolower deixar as letras minusculas
		//substr = retornar uma parte da string
		//strrpos remover antes da
		//$entidade = strtolower(substr(__CLASS__, strrpos(__CLASS__, '\\') + 1));
		//$atributos=get_object_vars($this);
		//$atributos=array_diff_key($atributos,$this->atributosIgnorados);
		//$colunas=array_keys($colunas);
		//$valores=array_keys($valores);
		$entidade = $this->getNome();
		$sql = "INSERT INTO $entidade (".implode(',',$colunas).")VALUES('".implode("','",$valores)."')";
		var_dump($sql);
		if(!mysqli_query(self::$dependencia->conexao, $sql)){
			throw new \Exception(mysqli_error(self::$dependencia->conexao));
		}
	}
    public function retrieve($colunas, $clausula)
   	{
   		$entidade = $this->getNome();
		$sql = "SELECT  $colunas FROM $entidade "." $clausula";
		$t = array();
		if($t = mysqli_query(self::$dependencia->conexao,$sql)){
			   return $t;
		} else {
            throw new \Exception(mysqli_error(self::$dependencia->conexao));
        }
    }

    public function update($colunas, $valores, $clausula){
   	    $entidade = $this->getNome();
		$sql = "UPDATE $entidade
				SET $colunas = $valores
				WHERE $clausula";
				if(!mysqli_query(self::$dependencia->conexao, $sql)){
			throw new \Exception(mysqli_error(self::$dependencia->conexao));
			
		}
    }
    public function delete($clausula){
   		$entidade = $this->getNome();
		$sql = "DELETE FROM $entidade WHERE $clausula";
		if(!mysqli_query(self::$dependencia->conexao, $sql)){
			throw new \Exception(mysqli_error(self::$dependencia->conexao));
		}
    }
}