<?php
class Banco_dados
{
    public function conectar()
    {
        $usuario = "root";
        $senha = "12345";
        $database = "admin";
        $host = "mysql";
        $port = 3306;

        //Criando a conexão
        $mysqli = new mysqli($host, $usuario, $senha, $database, $port);
        if ($mysqli->connect_errno) {
            die("Falha ao conectar ao banco de dados: " . $mysqli->connect_error);
        }

        return $mysqli;
    }

    public function inserirPessoa($nome, $data_nascimento)
    {
        $con = $this->conectar();

        //Convertendo idade e data
        $data_convertida = DateTime::createFromFormat('Y-m-d', $data_nascimento);

        try {
            if ($data_convertida === false) {
                $resultado = "Você digitou no campo data de forma errada";

            } else {
                $data_convertida = $data_convertida->format('Y-m-d');

                //Descubrindo a idade da pessoa
                $date = new DateTime($data_convertida);
                $idade = $date->diff(new DateTime(date('Y-m-d')));
                $idade = $idade->format('%Y');

                //Criando o comando query
                $query = "INSERT INTO Person(nome, idade, data_nascimento) VALUES('$nome', $idade, '$data_convertida')";

                $resultado = mysqli_query($con, $query) ? "Dados inseridos com sucesso!" : "Erro ao inserir os dados! " . $con->error;
            }
        } catch (Exception $ex) {
            $resultado = "Erro ao inserir os dados! " . $ex->getMessage();
        } finally {
            //Fechando a conecção com o banco de dados
            mysqli_close($con);
        }
        return $resultado;
    }

    public function mostrarPessoas()
    {
        //Abrindo conecxão
        $con = $this->conectar();

        try {
            $query = "SELECT * FROM Person";
            $linhas = mysqli_query($con, $query);
            $resultado = [];

            if (!$linhas) {
                die("Erro na consulta: " . $con->error);
            }

            while ($linha = mysqli_fetch_assoc($linhas)) {
                $resultado[] = $linha;
            }
        } catch (Exception $e) {
            $resultado = "Erro ao mostrar os dados! " . $e->getMessage();
        } finally {
            mysqli_close($con);
        }

        return $resultado;
    }

    public function atualizarPessoa($id, $nome, $data_nascimento)
    {
        //Abrindo conexão
        $con = $this->conectar();

        //Validações
        try {
            if ($nome != null) {
                $sql = "UPDATE Person SET nome = '$nome' WHERE id = $id ";

                if (mysqli_query($con, $sql)) {
                    $resultado = "Dados atualizados com sucesso!";
                } else {
                    $resultado = "Erro ao atualizar os dados! " . $con->error;
                }
            }  elseif ($data_nascimento != null) {

                $data_convertida = DateTime::createFromFormat('Y-m-d', $data_nascimento);

                if ($data_convertida !== false) {

                    $data_convertida = $data_convertida->format('Y-m-d');

                    $sql = "UPDATE Person SET data_nascimento = '$data_convertida' WHERE id = $id ";

                    //Descubrindo a idade da pessoa
                    $date = new DateTime($data_convertida);
                    $idade = $date->diff(new DateTime(date('Y-m-d')));
                    $idade = $idade->format('%Y');

                    $sql_idade = "UPDATE Person SET idade = $idade WHERE id = $id ";

                    if (mysqli_query($con, $sql) && mysqli_query($con, $sql_idade)) {
                        $resultado = "Pessoa com ID $id atualizado com sucesso!";
                    }

                } else {
                    $resultado = "No campo Data de Nascimento: você digitou a data de forma errada";
                }
            }
        } catch (Exception $e) {
            $resultado = "Erro ao inserir os dados! " . $e->getMessage();
        } finally {
            mysqli_close($con);
        }
        return $resultado;
    }

    public function deletarPessoa($id)
    {
        //Abrindo a conecção
        $con = $this->conectar();

        try {
            $sql = "DELETE FROM Person WHERE id=$id";

            $resultado = mysqli_query($con, $sql) ? "Pessoa com o ID:$id, excluido com sucesso!" : "Erro ao excluir a pessoa! " . $con->error;
        } catch (Exception $e) {
            $resultado = "Erro ao excluir o pessoa! " . $e->getMessage();
        } finally {
            mysqli_close($con);
        }
        return $resultado;
    }
}