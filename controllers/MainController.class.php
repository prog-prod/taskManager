<?php
namespace Controllers;

use Controllers\Controller\Controller;
use \Models\Task;

class MainController extends Controller{
    public function index(){
        $orderBy = $_GET['orderBy'] ?? 'name';
        $orderByDirection = ($_GET['d'] === 'desc')?'asc':'desc';
        $page = (int)$_GET['page'] ?? 1;
        if($page<=0) $page = 1;

        $task = new Task();
        $result = $task->join("users u", "t.user_id=u.id", "LEFT")
            ->orderBy(''.$orderBy,$orderByDirection)
            ->pagination($page,3);

        $result[] = $page;
       return view("main",[
           'tasks'=>$result[0],
           'page'=>$page,
           'total'=>$result[1],
           'desc'=>$orderByDirection,
           'orderBy' =>$orderBy
       ]);
    }
    public function createTask(){
       return view("createTask");
    }
}