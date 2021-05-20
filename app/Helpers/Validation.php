<?php

namespace app\Helpers;

class Validation {
    
    /**
     * FUNÇÃO DE VALIDAÇÃO DO NOME CADASTRADO 
     * @param string $nome
     * @return boolean
     */
    public static function validateName($nome){

        // APENAS LETRAS
        if(!preg_match('/^[a-zA-Z\s]*$/', $nome)):
            return true;
        else:
            return false;
        endif;
    }

    
    /**
     * FUNÇÃO DE VALIDAÇÃO DE EMAIL CADASTRADO
     *
     * @param string $email
     * @return boolean
     */
    public static function validateEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false):
            return true;
        else:
            return false;
        endif;
    }

    
    /**
     * FUNÇÃO DE VALIDAÇÃO DE SENHA CADASTRADA
     * @param string $senha
     * @return boolean
     */
    public static function validatePass($senha){

        // APENAS SENHAS MAIORES QUE 5 DÍGITOS
        if (strlen($senha)>5):
            return true;
        else:
            return false;
        endif;
    }

}