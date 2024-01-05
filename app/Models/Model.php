<?php
    // STEP 1I : Database Model
    namespace App\Models;

    use mysqli;

    class Model {
        // PROPERTIES --------------------
        protected $db_host = DB_HOST;
        protected $db_user = DB_USER;
        protected $db_pass = DB_PASS;
        protected $db_name = DB_NAME;

        protected $conn;
        protected $query;

        // METHODS -----------------------
        public function __construct(){
            $this->connection();
        }

        public function connection(){
            $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
            if($this->conn->connect_error){
                die('Connection Failed : '.$this->conn->connect_error);
            }
        }

        // 1J : Database CRUD Methods

        // ------------------------------
        // Avoid SQL Injection
        // $this->conn->real_escape_string($string);
        // ------------------------------
        
        public function query($sql){
            $this->query = $this->conn->query($sql);
            // For method concatenation
            return $this;
        }

        public function get_first(){
            return $this->query->fetch_assoc();
        }

        public function get_all(){
            return $this->query->fetch_all(MYSQLI_ASSOC);
        }

        // CRUD --------------------------
        public function select_all(){
            // dynamic table name
            $sql = "SELECT * FROM {$this->table}";
            return $this->query($sql)->get_all();
        }

        public function find_by_id($id){
            $sql = "SELECT * FROM {$this->table} WHERE id = {$id}";
            return $this->query($sql)->get_first();
        }

        public function filter_by($column, $value){
            $sql = "SELECT * FROM {$this->table} WHERE {$column} = '{$value}'";
            return $this->query($sql)->get_all();
        }

        public function insert($data){
            // array_keys() : Returns all the keys of an array
            // implode() : Joins array elements with a string with a specified separator
            $columns = implode(', ', array_keys($data));
            // array_keys() : Returns all the keys of an array
            $values = implode("' , '", array_values($data));
            $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ('{$values}')";
            $this->query($sql);
            // Returns last inserted id
            $last_data = $this->conn->insert_id;
            return $this->find_by_id($last_data);
        }

        public function update($id, $data){
            $updated_data = array();
            foreach($data as $column => $value){
                $updated_data[] = "{$column} = '{$value}'";
            }
            $updated_data = implode(', ', $updated_data);
            $sql = "UPDATE {$this->table} SET {$updated_data} WHERE id = {$id}";
            $this->query($sql);
            return $this->find_by_id($id);
        }

        public function delete($id){
            $sql = "DELETE FROM {$this->table} WHERE id = {$id}";
            $this->query($sql);
        }
    }
?>