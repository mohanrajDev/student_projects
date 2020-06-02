<?php

namespace App;

use App\Database;
use PDO;
use Exception;

class Model extends Database{

    public $db;
    public $query;

    // Table Name
    protected $table;

    protected $select = '*';
    protected $where = [];
    protected $orwhere = [];
    protected $order_by = '';
    protected $order_direction = 'ASC';

    public function __construct()
    {
        $this->db = parent::getConnection();
        $this->query = "SELECT";
    }

    /**
     * Select Query
     */
    public function select($colums = ['*'])
    {
        $this->select = implode(',', $colums);
        return $this;
    }

    /**
     * Get Single Row
     */
    public function find($id)
    {
        try {
            $this->query = "$this->query $this->select FROM $this->table where id = ". $id;
            $statement = $this->db->prepare($this->query);
            $statement->execute();
            return (object) $statement->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $c) {
            var_dump($c);
        }
    }

    /**
     * Get the all rows
     */
    public function get()
    {
        $this->query = "$this->query $this->select FROM $this->table";

        if ($this->where) {
            $last = count($this->where) - 1;
            foreach($this->where as $index => $w) {
                if ($this->where[$last] == $w) {
                    $this->query = "$this->query WHERE $w[0] $w[1] $w[2]";
                } else {
                    $this->query = "$this->query WHERE $w[0] $w[1] $w[2] AND ";
                }
            }
        }

        if ($this->order_by) {
            $this->query = "$this->query ordey by $this->order_by $this->order_direction";
        }

        $statement = $this->db->prepare($this->query);
        $statement->execute();
        $result  = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (!$result) {
            throw new Exception($this->db->errorInfo());
        }

        return $result;
    }

    /**
     * Where Condition
     */
    public function where($name, $operator = '=', $value)
    {
        $this->where[] = [$name, $operator, $value];
        return $this;
    }

    /**
     * Order By 
     */
    public function orderBy($column, $direction ='ASC')
    {
        $this->order_by = $column;
        $this->order_dirction = $direction;
        return $this;
    }

    /**
     * Inset table data
     */
    public function insert(array $data)
    {
        $columns =  array_keys($data);
        $columns = implode(', ', $columns);
        $values =  array_values($data);
        array_push($values, date('Y-m-d H:i:s'));
        
        $total_columns = rtrim(str_pad('', (count($values) * 2), '?,', STR_PAD_LEFT), ',');

        $data = (object) $data;
        $query = "INSERT INTO $this->table ($columns , created_at) VALUES ($total_columns)";
        $stmt= $this->db->prepare($query);
        $result = $stmt->execute($values);

        if (!$result) {
            throw new Exception($this->db->errorInfo());
        }

        return $result;
    }

    /**
     * Update table data
     */
    public function update($id, array $data)
    {
        $columns =  array_keys($data);
        $values =  array_values($data);
        array_push($values, date('Y-m-d H:i:s'));
        array_push($values, $id);

        $columns = implode('=?, ', $columns);
        $data = (object) $data;
        $sql = "UPDATE $this->table SET $columns =?, updated_at=? WHERE id=?";
        $stmt= $this->db->prepare($sql);
        $result = $stmt->execute($values);

        if (!$result) {
            throw new Exception($this->db->errorInfo());
        }

        return $result;
    }

    /**
     * Delete the row
     */
    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([$id]);

        if (!$result) {
            throw new Exception($this->db->errorInfo());
        }

        return $result;
    }

    /**
     * Pagination 
     */
    public function paginate($per_page = 4)
    {
        $offset = 0;
        $page_no = 1;
            
        if(isset($_GET['page']))
        {
            $page_no = $_GET['page'];

            if($page_no > 1)
            {	
                 $offset = ($page_no - 1) * $per_page;
            }
        }

        $sql_total = "SELECT count(*) FROM $this->table"; 
        $result_total = $this->db->prepare($sql_total); 
        $result_total->execute(); 
        $total_rows = $result_total->fetchColumn();
        $last_page = (int) round(ceil(($total_rows / $per_page)));

        if ($total_rows) {
            $this->query = " select * from $this->table limit $offset, $per_page";
            $statement = $this->db->prepare($this->query);
            $statement->execute();
            $result  = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            if (!$result) {
                throw new Exception($this->db->errorInfo());
            }
        } else {
            $result = [];
        }

        $path = 'http://'.$_SERVER['HTTP_HOST']. '/' . substr(strtolower($this->table), 0 , -1);

        return [
            'data' => $result,
            'next' => ($total_rows > $per_page) ? $page_no + 1 : null,
            'previous' => ($page_no > 1 ) ? $page_no - 1 : null,
            'total' => (int) $total_rows,
            'per_page' => $per_page,
            'current_page' => $page_no,
            'last_page' =>  $last_page,
            'path' => $path,
            "first_page_url" => $path . "?page=1",
            "last_page_url" => $path. "?page=" . $last_page,
            "next_page_url" => ($total_rows > $per_page) ? $path . "?page=" . ($page_no + 1) : null,
            "prev_page_url" => ($page_no > 1 ) ? $path. "?page=" . ($page_no - 1)  : null,

        ];
    }

    public function getStudentCourse( $per_page=5)
    {
        $offset = 0;
        $page_no = 1;       
            
        if(isset($_GET['page']))
        {
            $page_no = $_GET['page'];

            if(!empty($page_no) && $page_no > 1)
            {	
                 $offset = ($page_no - 1) * $per_page;
            }
        }

        $sql_total = "SELECT count(*) FROM students as s 
        JOIN student_courses as sc on sc.student_id = s.id
        JOIN courses as c on sc.course_id = c.id"; 
        $result_total = $this->db->prepare($sql_total); 
        $result_total->execute(); 
        $total_rows = $result_total->fetchColumn();
        $last_page = (int) round(ceil(($total_rows / $per_page)));

        
        $query = 'SELECT s.id as student_id, c.id as course_id,
         s.first_name as student_first_name,
         s.last_name as student_last_name,
         c.name as course_name FROM students as s 
        JOIN student_courses as sc on sc.student_id = s.id
        JOIN courses as c on sc.course_id = c.id
        ';
        $statement = $this->db->prepare($query);
        $statement->execute();
        $result= $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (!$result) {
            throw new Exception($this->db->errorInfo());
        }

        $path = 'http://'.$_SERVER['HTTP_HOST']. '/subscribe';

        return [
            'data' => $result,
            'next' => ($total_rows > $per_page) ? $page_no + 1 : null,
            'previous' => ($page_no > 1 ) ? $page_no - 1 : null,
            'total' => (int) $total_rows,
            'per_page' => $per_page,
            'current_page' => $page_no,
            'last_page' =>  $last_page,
            'path' => $path,
            "first_page_url" => $path . "?page=1",
            "last_page_url" => $path. "?page=" . $last_page,
            "next_page_url" => ($total_rows > $per_page) ? $path . "?page=" . ($page_no + 1) : null,
            "prev_page_url" => ($page_no > 1 ) ? $path. "?page=" . ($page_no - 1)  : null,

        ];
    }
}