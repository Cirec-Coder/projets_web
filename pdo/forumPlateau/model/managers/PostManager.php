<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager
{

    protected $className = "Model\Entities\Post";
    protected $tableName = "post";


    public function __construct()
    {
        parent::connect();
    }

    public function findPostsByTopicId($id)
    {
            $sql = "SELECT *
                    FROM " . $this->tableName . " p
                    WHERE p.topic_id = :id";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id], true),
            $this->className
        );
    }

    public function findPostsByUserId($id, $order = null)
    {
            $orderQuery = ($order) ?                 
                    "ORDER BY p.".$order[0]. " ".$order[1] :
                    " ";

        $sql = "SELECT *
                    FROM " . $this->tableName . " p
                    WHERE p.user_id = :id ".$orderQuery;

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id], true),
            $this->className
        );
    }

    public function findPostById($id)
    {
        $sql = "SELECT *
                    FROM " . $this->tableName . " p
                    WHERE p.id_post = :id";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], false),
            $this->className
        );
    }



    public function countPosts($id)
    {
        $sql = "SELECT COUNT(*)
                    FROM " . $this->tableName . " p
                    WHERE p.topic_id = :id";

        return $this->getSingleScalarResult(
            DAO::select($sql, ['id' => $id], false)
        );
    }

    public function countPostsByUserId($userId)
    {
        $sql = "SELECT COUNT(*)
                    FROM " . $this->tableName . " p
                    WHERE p.user_id = :userId";

        return $this->getSingleScalarResult(
            DAO::select($sql, ['userId' => $userId], false)
        );
    }

    public function countTopicsWithPostsByUserId($userId)
    {
        $sql = "SELECT COUNT(*) 
                FROM (SELECT COUNT(*) FROM " . $this->tableName . " p 
                WHERE p.user_id = :userId GROUP BY p.topic_id) AS temp
                ";

        return $this->getSingleScalarResult(
            DAO::select($sql, ['userId' => $userId], false)
        );
    }

    public function deleteAllByTopicId($id)
    { {
            $sql = "DELETE FROM " . $this->tableName . "
                    WHERE topic_id = :id
                    ";

            return DAO::delete($sql, ['id' => $id]);
        }
    }

    public function updatePost($id, $params)
    {
        $sql = "UPDATE ".$this->tableName." p SET ";

        foreach($params as $key => $value){
            $sql.= "p.$key  = :$key ";
        };
        
        $sql .= " WHERE p.id_post = :id";
        $params['id'] = $id;
        // var_dump($sql, $params);
        return DAO::update($sql, $params);
    }

}
