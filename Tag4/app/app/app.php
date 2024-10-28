<?php

namespace app\app;

class app {
    public function __construct(string $methode = "", string $parameter = "") {
        if (!empty($methode) && method_exists(object_or_class: $this, method: $methode)) {
            try {
                $this->$methode($parameter);
            } catch (\Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            \lib\response::errorJSON();
        }
    }

    public function login() {
        $_SESSION['user'] = 'admin';
        $_SESSION['stufe'] = 1;

        // 1 = admins (delete)
        // 2 = powerUser (editieren)
        // 3 = user angemeldet (lesen)
        // 0 = nix
    }

    public function logout() {
        $_SESSION['user'] = '';
        $_SESSION['stufe'] = 0;

    }

    public function status() {
        $_SESSION['user'] ?? $_SESSION['user'] = '' ;
        $_SESSION['stufe'] ?? $_SESSION['stufe'] = '';
        $data['session'] = $_SESSION;
        \lib\response::successJSON($data);
    }

    public function setStufe(int $stufe=0) {
        if ($stufe > 0 && $stufe < 4) {
            try{
                $_SESSION['stufe'] = $stufe;
                return true;
            }catch(\Exception $e){
                return false;
            }
        }else{
            return false;
        }
    }
}