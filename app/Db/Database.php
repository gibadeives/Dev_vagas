<?php

namespace App\Db;

use \PDO;
use PDOException;
use PDOStatement;

class Database
{

    /**
     * Host de conexão com o Banco de Dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do Banco de Dados
     * @var string
     */
    const NAME = 'Dev_vagas';

    /**
     * Usuário do Banco de Dados
     * @var string
     */
    const USER = 'root';

    /**
     * Senha do Banco de Dados
     * @var string
     */
    const PASS = '';

    /**
     * Nome da Tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instância de Conexão com o Banco de Dados (PDO)
     * @var PDO
     */
    private $connection;

    /**
     * Define a Tabela e instância a Conexão com o Banco de Dados
     * @var string
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Método responsável por criar uma Conexão com o Banco de Dados
     */
    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Método responsável por executar queries dentro do Banco de Dados
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }


    /**
     * Método responsável por inserir dados no Banco de Dados
     * @param array $values [field => value]
     * @return integer ID inserido
     */
    public function insert($values)
    {
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        //MONTANDO A QUERY
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';
        //EXECUTA O INSERT
        $this->execute($query, array_values($values));
        //RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsável por executar uma consulta no Banco de Dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        //EXECUTA A QUERY
        return $this->execute($query);
    }

    /**
     * Método responsável por executar atualizações no Banco de Dados
     * @param string $where
     * @param array $values [field=> value]
     * @return boolean
     */
    public function update($where, $values)
    {
        //DADOS DA QUERY
        $fields = array_keys($values);

        //MONTA A QUERY
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;

        //EXECUTA A QUERY
        $this->execute($query, array_values($values));

        //RETORNA SUCESSO
        return true;
    }

    /**
     * Método responsável por excluir dados no Banco de Dados
     * @param string $where
     * @return boolean
     */
    public function delete($where)
    {
        //MONTA A QUERY
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' .$where;

        //EXECUTA A QUERY
        $this->execute($query);

        //RETORNA SUCESSO
        return true;
    }
}
