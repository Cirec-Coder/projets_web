<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public static function getByPseudo($pseudo)
        {
            $user = new UserManager();
            return $user->findOneByPseudo($pseudo);
        }

        // public static function getOneByPseudo($data)
        // {
        //     $sql = "SELECT *
        //             FROM ".self::$tableName." u
        //             WHERE u.pseudo = :pseudo";

        //     return self::getOneOrNullResult(
        //         DAO::select($sql, ['pseudo' => $data], false), 
        //         self::$className
        //     );
        // }

        public function findOneByPseudo($data)
        {
            $sql = "SELECT *
                    FROM ".$this->tableName." u
                    WHERE u.pseudo = :pseudo";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['pseudo' => $data], false), 
                $this->className
            );
        }

        public function updateUser($id, $params)
        {
            $sql = "UPDATE ".$this->tableName." u SET ";

            foreach($params as $key => $value){
                $sql.= "u.$key  = :$key ";
            };
            
            $sql .= " WHERE u.id_user = :id";
            $params['id'] = $id;
            return DAO::update($sql, $params);
        }

    }