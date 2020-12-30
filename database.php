<?php
class database
{
    private $conn=false;
    private $mysqli="";
    private $result;
     function __construct(){
         if(!$this->conn)
         {
             $this->mysqli=new mysqli("localhost","root","","fbdb");
             if($this->mysqli->connect_error)
             {
                die("connection failed".$this->mysqli->connect_error);
               
             }
             else
             {
                $this->conn=true;
             }
         }
     }
     public function getresult()
     {
         $val=$this->result;
         $this->result=array();
         return $val;
     }
     public function insert($table,$val)
     {
         $col=implode(",",array_keys($val));;
         $value=implode("','",$val);
         $q="insert into $table($col) values('$value')";
         $r=$this->mysqli->query($q) or die("query faild".$this->mysqli->error);
         if($r)
         {
             return true;
         }
         else
         {
             return false;
         }
     }
    public function select($sql)
    {
        $r=$this->mysqli->query($sql);
        $row=$this->mysqli->affected_rows;
        if($row>0)
        {
            $this->result=$r->fetch_all(MYSQLI_ASSOC);
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function update($table,$value,$where=null)
    {
        $val=array();
        foreach($value as $key=>$v)
        {
           $val[]="$key = '$v'";
        }
        $fr=implode(",",$val);
        $q="update $table set $fr";
        if($where != null)
        {
            $q .="where $where";
        }
        if($this->mysqli->query($q))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function delete($table,$where=null)
    {
        $q="delete from $table";
        if($where != null)
        {
            $q .=" where $where";
        }
        $r=$this->mysqli->query($q) or die("query faild");
        if($r)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
     function __destruct()
     {
         if($this->conn)
         {
             $this->mysqli->close();
             $this->conn=false;
         }
     }
}
  
?>