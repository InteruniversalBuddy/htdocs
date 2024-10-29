<?php
namespace app\app;
use lib\response;
class app{
    public function __construct(string $methode = "", string $parameter = "") {
        if (!empty($methode) && method_exists(object_or_class: $this, method: $methode)) {
            try {
                $this->$methode($parameter);
            } catch (\Exception $e) {
                response::errorJSON(array: ["error" => $e->getMessage()]);
            }
        } else {
            response::errorJSON(array: ["error" => true]);
        }
    }

    public function setStufe($nummer){
        if($nummer == 1 OR $nummer == 2 OR $nummer == 3) {
            try{
                $_SESSION['stufe'] = $nummer;
                return true;
            } catch (\Exception $e) {
                return false;
            }
        }  else {
            return false;
        }
    }
    public function login(){
        $_SESSION['user'] = 'admin';
        $_SESSION['stufe'] = 1;
        /*
        // 1 = admins (delete)
        // 2 = powerUser (editieren)
        // 3 = user angemeldet (lesen)
        // 0 = niiiix
        */
    }
    public function logout(){
        $_SESSION['user'] = '';
        $_SESSION['stufe'] = 0;
    }
    public function status(){
        // Falls $_SESSION['user'] && $_SESSION['stufe'] nicht vorhanden, dann setzen
        if(!isset($_SESSION['user'])) $_SESSION['user'] = "";
        if(!isset($_SESSION['stufe'])) $_SESSION['stufe'] = 0;

        $data['session'] = $_SESSION;
        response::successJSON($data);
    }
}