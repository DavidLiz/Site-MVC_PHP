<?php

namespace app\Helpers;

class Alerts{
    
    /**
     * FUNÇÃO DE ALERTS 
     * @param string $name
     * @param string $text
     * @param string $class
     */
    public static function alert($name, $text = null, $class = null){
        if(!empty($name)):
            if(!empty($text) && empty($_SESSION[$name])):
                if(!empty($_SESSION[$name])):
                    unset($_SESSION[$name]);
                endif;
            $_SESSION[$name] = $text;
            $_SESSION[$name.'class'] = $class;

            elseif(!empty($_SESSION[$name]) && empty($text)):
                $class = !empty($_SESSION[$name.'class']) ? $_SESSION[$name.'class'] : 'alert alert-success';
                echo '<div class="'.$class.'">'.$_SESSION[$name].'</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name.'class']);
            endif;
        endif;
    }
    
    /**
     * FUNÇÃO DE VERIFICAÇÃO DE SESSÃO
     * @return boolean
     */
    public static function user_logged(){
        if(isset($_SESSION['user_logged'])):
            return true;
        else:
            return false;
        endif;
    }
}