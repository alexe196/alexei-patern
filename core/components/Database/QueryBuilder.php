<?php


namespace Alexei\core\components\Database;

use Alexei\core\contracts\QueryBuilderInterface;

class QueryBuilder implements QueryBuilderInterface
{

    protected $pdo;

    protected $table;

    protected $select = '*';

    protected $where = [];

    protected $andWhere = [];

    protected $orWhere = [];

    protected $wherArray = [];

    protected $limit;

    protected $offset;

    protected $order = [];

    protected $sql;

    protected $typeQuery;


    public function __construct(Db $db)
    {
        $this->pdo = $db;
    }


    /**
     * @param $table
     * @return QueryBuilderInterface
     */
    public function table($table): QueryBuilderInterface
    {
        if ( !empty($select) ) {
            $this->table = $table;
        }
        return $this;
    }

    /**
     * @param array $select
     * @return QueryBuilderInterface
     */
    public function select($select = []): QueryBuilderInterface
    {

        if ( !empty($select) ) {
           $this->select = implode(",", $select);
        }
        return $this;
    }

    /**
     * @param array $conditions
     * @return QueryBuilderInterface
     */
    public function where($conditions = []): QueryBuilderInterface
    {
        if ( !empty($conditions) ) {

            if (count($conditions) == 2) {

                $this->where['name'][] = $conditions[0].'='.':'.$conditions[0];
                $this->where['value'][] = array($conditions[0] => $conditions[1]);
            }
            if (count($conditions) == 3) {

                $this->where['name'][] = $conditions[1].$conditions[0].':'.$conditions[0];
                $this->where['value'][] = array($conditions[0] => $conditions[1]);
            }
        }

        return $this;
    }

    /**
     * @param array $andWhere
     * @return QueryBuilderInterface
     */
    public function AndWhere($andWhere= []): QueryBuilderInterface
    {
        if ( !empty($andWhere) ) {

            if (count($andWhere) == 2) {

                $this->andWhere['name'][] = ' AND '.$andWhere[0].'='.':'.$andWhere[0];
                $this->andWhere['value'][] = array($andWhere[0] => $andWhere[1]);
            }
            if (count($andWhere) == 3) {

                $this->andWhere['name'][] = ' AND '.$andWhere[1].$andWhere[0].':'.$andWhere[0];
                $this->andWhere['value'][] = array($andWhere[0] => $andWhere[1]);
            }
        }

        return $this;
    }

    /**
     * @param array $orWhere
     * @return QueryBuilderInterface
     */
    public function orWhere($orWhere= []): QueryBuilderInterface
    {
        if ( !empty($orWhere) ) {

            if (count($orWhere) == 2) {

                $this->orWhere['name'][] = ' OR '.$orWhere[0].'='.':'.$orWhere[0];
                $this->orWhere['value'][] = array($orWhere[0] => $orWhere[1]);
            }
            if (count($orWhere) == 3) {

                $this->orWhere['name'][] = ' OR '.$orWhere[1].$orWhere[0].':'.$orWhere[0];
                $this->orWhere['value'][] = array($orWhere[0] => $orWhere[1]);
            }
        }

        return $this;
    }

    /**
     * @param $limit
     * @return QueryBuilderInterface
     */
    public function limit($limit): QueryBuilderInterface
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param $offset
     * @return QueryBuilderInterface
     */
    public function offset($offset): QueryBuilderInterface
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param array $order
     * @return QueryBuilderInterface
     */
    public function order($order = []): QueryBuilderInterface
    {
        if ( !empty($order) ) {

            if (count($order) == 2) {

                $this->order[] = 'ORDER BY '.$order[0] . ' '.$order[1];
            }
        }
    }

    private function buildLimit()
    {
        if($this->typeQuery == 'all') {
            if (empty($this->limit)) {
                if (!empty($this->offset)) {
                    $this->sql .= 'LIMIT ' . $this->offset . ' ' . $this->limit;
                } else {
                    $this->sql .= 'LIMIT ' . $this->offset . ' ' . $this->limit;
                }
            }
        }
        else{
            $this->sql .= 'LIMIT 1';
        }
    }

    public function build(): string
    {

        if (!empty($table)) {

            $this->sql = 'SELECT '.$this->select.' '.$this->table;

            if (empty($this->where)) {
                $this->sql .= $this->getArrayForStrSql($this->where['name']);
            }

            if (empty($this->andWhere)) {
                $this->sql .= $this->getArrayForStrSql($this->andWhere['name']);
            }

            if (empty($this->orWhere)) {
                $this->sql .= $this->getArrayForStrSql($this->orWhere['name']);
            }

            if (empty($this->order)) {
                $this->sql .= $this->getArrayForStrSql($this->order);
            }

            $this->wherArray = array_merge($this->where['value'], $this->andWhere['value'], $this->andWhere['value']);

            $this-> buildLimit();
        }
    }


    function getArrayForStrSql( array $params = []) : string
    {
        if (!empty($params)) {
           return implode(",", $params);
        }
    }

    public function one(): QueryBuilderInterface
    {
        $this->typeQuery = 'one';
        $this->build();

        if(!empty($this->sql)) {

            $this->pdo->prepare($this->sql);

            if (!empty($this->where) && !empty($this->wherArray)) {
                $this->pdo->execute(array($this->wherArray));
            }
            return $this->pdo->fetch(PDO::FETCH_ASSOC);
        }

        return $this;

    }

    public function all(): QueryBuilderInterface
    {
        $this->typeQuery = 'all';
        $this->build();

        if(!empty($this->sql)) {

            $this->pdo->prepare($this->sql);

            if (!empty($this->where) && !empty($this->wherArray)) {
                $this->pdo->execute(array($this->wherArray));
            }
            return $this->pdo->fetch(PDO::FETCH_ASSOC);
        }

        return $this;
    }

}