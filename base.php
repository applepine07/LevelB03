<?php
date_default_timezone_set("Asia/Taipei");
session_start();

$ss=[1=>'14:00~16:00',
     2=>'16:00~18:00',
     3=>'18:00~20:00',
     4=>'20:00~22:00',
     5=>'22:00~24:00',
];

// $ls=[
//     1=>"普遍級",
//     2=>"輔導級",
//     3=>"保護級",
//     4=>"限制級"
// ];

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function to($url)
{
    header("location:" . $url);
}

class DB
{
    // 前置
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=web03";
    protected $user = "root";
    protected $pw = "";

    protected $table;
    protected $pdo;
    protected $level=[1=>"普遍級",2=>"輔導級",3=>"保護級",4=>"限制級"];
    
    // construct
    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, $this->user, $this->pw);
    }
    // find
    public function find($id)
    {
        $sql = "SELECT * FROM $this->table WHERE ";
        if (is_array($id)) {
            foreach ($id as $key => $value) {
                $tmp[] = "`$key`='$value'";
            }
            $sql .= implode(" AND ", $tmp);
        } else {
            $sql .= " `id`='$id'";
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    // all
    public function all(...$arg)
    {
        $sql = "SELECT * FROM $this->table ";
        switch (count($arg)) {
            case 2:
                foreach ($arg[0] as $key => $value) {
                    $tmp[] = "`$key`='$value'";
                }
                $sql .= " WHERE " . implode(" AND ", $tmp) . " " . $arg[1];
                break;
            case 1:
                if (is_array($arg[0])) {
                    foreach ($arg[0] as $key => $value) {
                        $tmp[] = "`$key`='$value'";
                    }
                    $sql .= " WHERE " . implode(" AND ", $tmp);
                } else {
                    $sql .= $arg[0];
                }
                break;
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    // math
    public function math($method,$col,...$arg)
    {
        $sql = "SELECT $method($col) FROM $this->table ";
        switch (count($arg)) {
            case 2:
                foreach ($arg[0] as $key => $value) {
                    $tmp[] = "`$key`='$value'";
                }
                $sql .= " WHERE " . implode(" AND ", $tmp) . " " . $arg[1];
                break;
            case 1:
                if (is_array($arg[0])) {
                    foreach ($arg[0] as $key => $value) {
                        $tmp[] = "`$key`='$value'";
                    }
                    $sql .= " WHERE " . implode(" AND ", $tmp);
                } else {
                    $sql .= $arg[0];
                }
                break;
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetchColumn();
    }
    public function save($array)
    {
        if(isset($array['id'])){
            foreach($array as $key => $value){
                $tmp[] = "`$key`='$value'";
            }
            $sql="UPDATE $this->table SET ".implode(",",$tmp)." WHERE `id`='{$array['id']}'";
        }else{
            $sql="INSERT INTO $this->table (`".implode("`,`",array_keys($array))."`)
                                    VALUES ('".implode("','",$array)."')";
        }     
        // echo $sql;
        return $this->pdo->exec($sql);
    }
    // del
    public function del($id)
    {
        $sql = "DELETE FROM $this->table WHERE ";
        if (is_array($id)) {
            foreach ($id as $key => $value) {
                $tmp[] = "`$key`='$value'";
            }
            $sql .= implode(" AND ", $tmp);
        } else {
            $sql .= " `id`='$id'";
        }
        // echo $sql;
        return $this->pdo->exec($sql);
    }
    // q
    public function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function level($level){
        return $this->level[$level];
    }
}

$Movie = new DB('movie');
$Ord = new DB('ord');
$Poster = new DB('poster');
// $a=$s->find(1);
// $a=$s->all(['major'=>'美容科']);
// $a=$s->math('count','*',['major'=>'美容科']);
// $s->save(['major'=>'美容科']);
// $s->del(['id'=>'480']);
// $a=$s->q("SELECT * FROM students WHERE `major`='美容科'");
// dd($a);
