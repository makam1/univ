<?php

    class Base_de_donnees{
        private $db_host;
        private $db_pass;
        private $db_user;
        private $selection;
        private $table;
        private $condition;
        private $con;
        private $res;
        public function __construct(){
            $this->db_host="mysql:host=localhost;dbname=universite;charset=utf8";
            $this->db_pass="passer";
            $this->db_user="root";
        }
        public function getDb_host()
        {
                return $this->db_host;
        }

        /**
         * Set the value of db_host
         *
         * @return  self
         */ 
        public function setDb_host($db_host)
        {
                $this->db_host = $db_host;

                return $this;
        }

        /**
         * Get the value of db_pass
         */ 
        public function getDb_pass()
        {
                return $this->db_pass;
        }

        /**
         * Set the value of db_pass
         *
         * @return  self
         */ 
        public function setDb_pass($db_pass)
        {
                $this->db_pass = $db_pass;

                return $this;
        }

        /**
         * Get the value of db_user
         */ 
        public function getDb_user()
        {
                return $this->db_user;
        }

        /**
         * Set the value of db_user
         *
         * @return  self
         */ 
        public function setDb_user($db_user)
        {
                $this->db_user = $db_user;

                return $this;
        }

        /**
         * Get the value of selection
         */ 
        public function getSelection()
        {
                return $this->selection;
        }

        /**
         * Set the value of selection
         *
         * @return  self
         */ 
        public function setSelection($selection)
        {
                $this->selection = $selection;

                return $this;
        }

        /**
         * Get the value of table
         */ 
        public function getTable()
        {
                return $this->table;
        }

        /**
         * Set the value of table
         *
         * @return  self
         */ 
        public function setTable($table)
        {
                $this->table = $table;

                return $this;
        }

        /**
         * Get the value of condition
         */ 
        public function getCondition()
        {
                return $this->condition;
        }

        /**
         * Set the value of condition
         *
         * @return  self
         */ 
        public function setCondition($condition)
        {
                $this->condition = $condition;

                return $this;
        }
        /**
         * Get the value of condition
         */ 
        public function getCon()
        {
                return $this->con;
        }

        /**
         * Set the value of condition
         *
         * @return  self
         */ 
        public function setCon($con)
        {
                $this->con = $con;

                return $this;
        }
        /**
         * Get the value of res
         */ 
        public function getRes()
        {
                return $this->res;
        }

        /**
         * Set the value of res
         *
         * @return  self
         */ 
        public function setRes($res)
        {
                $this->res = $res;

                return $this;
        }
        public function connexion(){
                return $con=new PDO($this->getDB_host(),$this->getDb_user(),$this->getDb_pass(),array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        }
 
       /* public function select(){
                $res=('SELECT * FROM etudiants');
                return $res;
               $req =$con->query("SELECT * FROM bourse");
                $result = $req->fetchAll();
             foreach ($result as $req)
             {
                 echo $req['Montant']."<br/>";
             }
        }*/
 

        
    }

?>