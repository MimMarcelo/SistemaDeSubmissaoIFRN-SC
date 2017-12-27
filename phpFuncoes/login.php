<?php

    require dirname(__FILE__).'/../phpClasses/Usuario.php';
    
    /**
     * PEGA/LIMPA OS VALORES RECEBIDOS VIA POST
     * @param POST $data
     * @return DADOS VALIDADOS
     */
    function get($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $cpf = $senha = "";
    $mensagem = array();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        extract($_POST, EXTR_PREFIX_ALL, "p");//EXTRAI TODOS VALORES DE $_POST PARA VARIÁVEIS "$p_NAME"
        
        if(isset($p_cpf)){// VALIDA CPF
            if(!empty($p_cpf)){
                $cpf = get($p_cpf);
            }
            else{
                $mensagem[] = "O campo: 'CPF' não pode ser vazio!";
            }
        }
        else{
            $mensagem[] = "O campo: 'CPF' não foi informado!";
        }
        
        if(isset($p_senha)){// VALIDA SENHA
            if(!empty($p_senha)){
                $senha = md5(get($p_senha));
            }
            else{
                $mensagem[] = "O campo: 'Senha' não pode ser vazio!";
            }
        }
        else{
            $mensagem[] = "O campo: 'Senha' não foi informado!";
        }
        
    }
    else{
        $mensagem[] = "Requisição inválida!";
    }

    if(count($mensagem) > 0){// SE HOUVER QUALQUER MENSAGEM DE AVISO
        echo json_encode(array("mensagem" => $mensagem, "titulo" => "Atenção"));
    }
    else{// SE NÃO HOUVER MENSAGENS DE AVISO
        
        //CONSULTA O USUÁRIO NO BANCO DE DADOS
        $usuario = Usuario::login($cpf, $senha);

        //SE O USUÁRIO FOR UM ARRAY DE MENSAGENS
        if(is_array($usuario)){
            echo json_encode(array("mensagem" => $usuario, "titulo" => "Atenção"));
        }
        else{
            // SE O USUÁRIO FOR UM OBJETO
            session_start();

            $_SESSION["usuario"] = $usuario;// ARMAZENA O OBJETO NA SESSÃO
            
            echo json_encode(array("redirecionar" => "inicio.php"));//REDIRECIONA PARA A PÁGINA DE INÍCIO
        }
    }
    