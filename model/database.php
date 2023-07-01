<?php

$hostname = "http://localhost/books_store";

class DataBase{
    private $db_host = "localhost";
    private $db_name = "books_store";
    private $db_user = "root";
    private $db_pass = "";

    private $mysql = "";
    private $result = array();
    private $image_name=array();
    private $conn = false;

// pdo connection function ---------------------------------
    public function __construct(){
        if(!$this->conn){
            $this->mysql = new pdo("mysql:host=$this->db_host;dbname=$this->db_name","$this->db_user","$this->db_pass");
            // var_dump($this->mysql);

            $this->conn = true;
            if($this->mysql->errorInfo()){
                array_push($this->result,$this->mysql->errorInfo());
                return false;
            }

        }else{
            return true;
        }
    }

    // function for chak existing table in data base

    public function table_ex($table){

        $tableInDb = $this->mysql->prepare("SHOW TABLES LIKE '$table' ");
        $tableInDb->execute();

        $count=$tableInDb->rowCount();
        

        if($tableInDb){
            if($tableInDb){
                if($count == 1){
                    // echo "tablae exist";
                    return true;
                }else{
                    return false;
                    array_push($this->result,$table . "dose not exist in this data base .");
                    echo "<pre>";
                    echo($this->result);
                    echo "</pre>";
                   
                    
                }
            }
        }

    }


    // function for insert data into data base ------------

    public function insert($table,$params=array()){

        if($this->table_ex($table)){
            // echo "<pre>";
            // print_r($params);
            // echo "</pre>";

            $table_colum = implode(",",array_keys($params));
            $table_valu = implode("','",$params);

            // echo $table_colum ."<br>";
            // echo $table_valu;

            $ins = $this->mysql->prepare("INSERT INTO $table ($table_colum) VALUES ('$table_valu')");

            if($ins->execute()){
                
                return true;
            }else{
                array_push($this->result,$this->mysql->errorInfo());
                return false;
            }
        }

    }


    // function for update data from data base 

    public function update($table,$params = array(),$where = null){

        if($this->table_ex($table)){
            $args = array();

            foreach($params as $key => $value){
                $args[] = "$key = '$value'";
            }
            $sql = "UPDATE $table SET " . implode(', ' , $args) ;
            if($where != null){
                $sql .= " WHERE $where";
            }
            // echo $sql;
            $sql = $this->mysql->prepare($sql);
            if($sql->execute()){
                // echo " update success";
            array_push($this->result ,$sql->rowCount());
            return true;
            }else{
            array_push($this->result , $sql->errorInfo());
            }
                
        }else{
            return false;
        }
    }

    // function for delete table or row from database   ===

    public function delete($table,$where = null){

        if($this->table_ex($table)){

            $query = "DELETE FROM $table " ;

            if($where != null){
                $query .= " WHERE $where";
            }
            // echo $query;
        
            $sql = $this->mysql->prepare("$query");

            if($sql->execute()){
                // echo "delete susseccfull";
                array_push($this->result, $sql->rowCount());
                return true;
            }else{
                // echo "delete unsuccessfull";
                array_push($this->result,$sql->errorInfo());
                return false;
            }
            
            
        }else{
            return false;
        }
    }

    // function for select from data base --------------------

    public function select($table , $row="*" , $join = null , $where = null , $order = null , $limit = null,$pages = null){
        if($this->table_ex($table)){
            // echo $limit;
            $query = "SELECT $row FROM $table";
            if($join != null){
                $query .= " $join";
            }
            if($where != null){
                $query .= " WHERE $where";
            }
            if($order != null){
                $query .= " ORDER BY $order";
            }
            if($limit != null){
                // var_dump($_GET) or die;
                if($pages != null){
                    $page = $pages;
                }elseif(isset($_GET['page'])){
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = 1;
                    }
                }else{
                    $page = 1;
                }

                

                $start = ($page - 1)* $limit;
                $query .= " LIMIT $start, $limit";
            }
            // echo $query."<br>";


            $sql = $this->mysql->prepare("$query");

            if($sql->execute()){
                $this->result = $sql->fetchall();
                return true;
            }
            else{
                array_push($this->result,$sql->errorInfo());
                return false;
            }

        } else{
        return false;
        }   
    }

    // function for pagination ===================

    public function pagination($table,$join = null,$where = null,$limit,$id = null,$pages= null){
        if($this->table_ex($table)){
            if($limit != null){
                $query = "SELECT COUNT(*) FROM $table";
                if($join != null){
                    $query .= " $join";
                }
                if($where != null){
                    $query .= " WHERE $where";
                }
                // echo $query;

                $sql = $this->mysql->prepare("$query");
                // print_r ($sql);
                
                $sql->execute();
                $total_record = $sql->fetchAll();
                $total_record= $total_record[0];
                $total_record = $total_record[0];

                // echo $total_record;
                $total_page = ceil($total_record / $limit);

                // $url = basename($_SERVER['PHP_SELF']);
                $url = "index.php";

                if($pages != null){
                    $page = $pages;
                }else{
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = 1;
                    }
                }

                $output = " <div class='pagination_box'>
                <ul class = 'pagination' >";

                if($id !=null){
                    if($page>1){
                        $output .= "<li><a href = '$url?$id&page=".($page-1)."'>Prev</a></li>";
                    }
                    if($total_record > $limit){
                        for( $i=1; $i <= $total_page; $i++){
                            if($i==$page){
                                $class = "class = 'active'";
                            }else{
                                $class = '';
                            }
                            $output .= "<li><a $class href = '$url?$id&page=$i'>$i</a></li>";
                        }
    
                    }
                    if($total_page > $page){
                        $output .= "<li><a href = '$url?$id&page=".($page+1)."'>Next</a></li>";
                    }
                }else{
                    if($page>1){
                        $output .= "<li><a href = '$url?page=".($page-1)."'>Prev</a></li>";
                    }
                    if($total_record > $limit){
                        for( $i=1; $i <= $total_page; $i++){
                            if($i==$page){
                                $class = "class = 'active'";
                            }else{
                                $class = '';
                            }
                            $output .= "<li $class><a  href = '$url?page=$i'>$i</a></li>";
                        }
    
                    }
                    if($total_page > $page){
                        $output .= "<li><a href = '$url?page=".($page+1)."'>Next</a></li>";
                    }
                }
                $output .= "</ul>
                </div>";

                echo $output;


                
               
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // pagination ajex-------------------------------------------
    public function pagination_ajex($table,$join = null,$where = null,$limit,$id = null,$pages= null){
        if($this->table_ex($table)){
            if($limit != null){
                $query = "SELECT COUNT(*) FROM $table";
                if($join != null){
                    $query .= " $join";
                }
                if($where != null){
                    $query .= " WHERE $where";
                }
                // echo $query;

                $sql = $this->mysql->prepare("$query");
                // print_r ($sql);
                
                $sql->execute();
                $total_record = $sql->fetchAll();
                $total_record= $total_record[0];
                $total_record = $total_record[0];

                // echo $total_record;
                $total_page = ceil($total_record / $limit);

                // $url = basename($_SERVER['PHP_SELF']);
                $url = "index.php";

                if($pages != null){
                    $page = $pages;
                }else{
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = 1;
                    }
                }

                $output = " <div class='pagination_box'>
                <ul class = 'pagination' id='pagination_ajex' >";

                if($id !=null){
                    if($page>1){
                        
                        $output .= "<li><button id ='".($page-1)."' value ='".($page-1)."'>Prev</button></li>";
                    }
                    if($total_record > $limit){
                        for( $i=1; $i <= $total_page; $i++){
                            if($i==$page){
                                $class = "class = 'active'";
                            }else{
                                $class = '';
                            }
                            
                            $output .= "<li><button $class id ='".($i)."' value ='".($i)."'>$i</button></li>";
                        }
    
                    }
                    if($total_page > $page){
                        
                        $output .= "<li><button  id ='".($page+1)."' value ='".($page+1)."'>Next</button></li>";
                    }
                }else{
                    if($page>1){

                        $output .= "<li><button id ='".($page-1)."' value ='".($page-1)."'>Prev</button></li>";
                    }
                    if($total_record > $limit){
                        for( $i=1; $i <= $total_page; $i++){
                            if($i==$page){
                                $class = "class = 'active'";
                            }else{
                                $class = '';
                            }

                            $output .= "<li ><button $class id ='".($i)."'  value ='".($i)."'>$i</button></li>";
                        }
    
                    }
                    if($total_page > $page){
                        $output .= "<li><button id ='".($page+1)."' value ='".($page+1)."'>Next</button></li>";
                    }
                }
                $output .= "</ul>
                </div>";

                echo $output;


                
               
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // function for execute sql sentex===========

    public function sql($sql){
        $query = $this->mysql->prepare($sql);

        if($query->execute()){
            $this->result = $query->fetchall();
            return true;

        }else{
            array_push($this->result,$query->errorInfo());
            return false;
        }
    }





    // get result ================

    public function get_result(){
        $val = $this->result;
        $this->result = array();
        return $val;
    }


// function for image uplode -----------------

    public function Img_Up($fileToUpload,$target){
        // echo $fileToUpload;
        if(isset($_FILES[$fileToUpload])){
            $errors = array();
           
        
            $file_name = $_FILES[$fileToUpload]['name'];
            $file_size = $_FILES[$fileToUpload]['size'];
            $file_tmp = $_FILES[$fileToUpload]['tmp_name'];
            $file_type = $_FILES[$fileToUpload]['type'];
            $tmp_ext = explode('.',$file_name);
            $file_ext = strtolower(end($tmp_ext)) ;
            // echo $file_name;
            // echo $fileToUpload;
        
            $extentions = array("jpeg",'jpg','png');
        
            if(in_array($file_ext,$extentions) ===false){
                $errors[]="This extension file not allowed , please choose jpeg , jpg , png file . ";
            }
            if($file_size > 20971520){
                $errors[]="file size must be 2md or lower .";
        
            }
            $new_name=time()."-".basename($file_name);
            $target = "$target".$new_name;
        
            //echo $target;
        
            if(empty($errors)==true){
                move_uploaded_file($file_tmp,$target);
        
            }else{
                print_r($errors);
                die();
            }
            array_push($this->image_name,$new_name);
        }else{
            // echo $fileToUpload;
        }

    }





    public function Img(){
        $val = $this->image_name;
        $this->image_name = array();
        return $val;
    }

    // function for close data base ---------------------------

    public function __destruct(){
        if($this->conn){
            $this->mysql = null;
            if($this->mysql == null){
                $this->conn = false;
                return true;

            }else{
                echo "Connection is not close .";

            }
        }else{
            return false;
        }
    }

}


// echo "hjfolehfoerfre";

?>