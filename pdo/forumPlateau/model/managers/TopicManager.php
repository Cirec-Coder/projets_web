<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\PostManager;

class TopicManager extends Manager
{

    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";


    public function __construct()
    {
        parent::connect();
    }


    public function deleteTopic($id)
    {
        $postManager = new PostManager();
        $postManager->deleteAllByTopicId($id);
        return $this->delete($id);
        # code...
    }



    public function updateTopicById($id, $params)
    {
        $sql = "UPDATE " . $this->tableName . " t SET  ";

        foreach ($params as $key => $value) {
            $sql .= "t.$key  = :$key ";
        };


        $sql .= " WHERE t.id_topic = :id";
        // $params = [];
        $params['id'] = $id;
        // var_dump($sql);
        // var_dump($params);
        return DAO::update($sql, $params);
    }


    public function countTopics()
    {
        $sql = "SELECT COUNT(*)
                    FROM " . $this->tableName ;

        return $this->getSingleScalarResult(
            DAO::select($sql, [], false)
        );
    }


    // public function countPosts($id)
    // {
    //     $sql = "SELECT *
    //             FROM ".$this->tableName." u
    //             WHERE u.id_".$this->tableName." = :id";

    //     return $this->getOneOrNullResult(
    //         DAO::select($sql, ['id' => $id], false), 
    //         $this->className
    //     );
    // }
}
