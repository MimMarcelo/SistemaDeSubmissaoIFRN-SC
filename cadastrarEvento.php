<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Fernanda Guilherme, Jhonatas Costa, Juliana Dias, Marcelo Júnior, Matheus Emanuel, Ranna Raabe">
        <meta name="keywords" content="ifrn , eventos,  subimissao, Santa Cruz">
        <meta name="description" content="Formulario para fazer os cadastros de eventos para o IFRN-SC">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SS IFRN-SC - Cadastrar evento</title>
        <?php include './includes/css.php'; ?>
        <?php include './includes/javascript.php'; ?>
    </head>
    <body>
        <?php include './includes/cabecalho.php'; ?>
        <?php include './includes/menu.php'; ?>
        
        <section id="conteudo">
            <?php include './includes/popup.php'; 
                /*
                 * TODA PÁGINA QUE POSSUIR UM FORMULÁRIO PRECISA DESSE INCLUDE
                 */
            ?>
                
        <form action="php/CadastrarEvento.php" method="post">
            <h2>Cadastro de Eventos</h2>
            <label for="txtNome">Nome do Evento:</label>
            <input type="text" id="txtNome" name="pNome" placeholder="Evento">
            <label for="txtDescricao">Descrição</label>
            <textarea id="txtDescricao" name="pDescricao" title="Faça um resumo curto sobre o evento..." rows="10"></textarea>
            <label for="txtLocal">Local do evento</label>
            <input type="text" id="txtLocal" name="plocal" placeholder="local">
            <label for="txtLogo">Logo do evento</label>
            <input name="imagem" type="file" id="txtLogo"  name="pLogo" size="30">
            <label for="txtNumeroVagas">Numero de vagas</label>
            <input type="number" id="txtNumeroVagas" name="pNumeroVagas" placeholder="Numero de Vagas">

            <!-- inicio das inscriçoes -->
            <label for="sltII">Data de inicio das inscrições:</label>
            <!-- diaII é o Dia em que Inicia as Inscriçoes-->
            <select id="sltdiaII"  name="pdiaII">
                <?php
                    for($i = 1; $i <= 31; $i++){
                        echo "<option value=\"$i\">$i</option>";                            
                    }
                ?>
            </select>
            <select id="sltMesII"  name="pMesII">
                <!-- mesII é o Mes em que Inicia as Inscriçoes-->
                <?php
                    $mesesII = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

                    for($i = 1; $i <= 12; $i++){
                        echo "<option value=\"$i\">".$mesesII[$i-1]."</option>";                            
                    }
                ?>
            </select>
            <select id="sltAnoII" name="pAnoII">
                <!-- anoII é o Ano em que Inicia as Inscriçoes-->
                <?php
                    for($i = 2017; $i <= 2020; $i++){
                        echo "<option value=\"$i\">$i</option>";                            
                    }
                ?>
            </select>
            <!-- fim das inscriçoes -->
            <label for="sltFI">Data de termino das inscrições:</label>
            <!-- diaFI é o Dia em que terminam as Inscriçoes-->
            <select id="sltdiaFI"  name="pdiaFI">
                <?php
                    for($i = 1; $i <= 31; $i++){
                        echo "<option value=\"$i\">$i</option>";                            
                    }
                ?>
            </select>
            <select id="sltMesFI" name="pMesFI">
                <!-- mesFI é o Mes em que Terminam as Inscriçoes-->
                <?php
                    $mesesFI = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

                    for($i = 1; $i <= 12; $i++){
                        echo "<option value=\"$i\">".$mesesFI[$i-1]."</option>";                            
                    }
                ?>
            </select>
            <select id="sltAnoFI" name="pAnoFI">
                <!-- anoFI é o Ano em que Inicia as Inscriçoes-->
                <?php
                    for($i = 2017; $i <= 2020; $i++){
                        echo "<option value=\"$i\">$i</option>";                            
                    }
                ?>
            </select>
            <!-- inicio das submissão -->
            <label for="sltIS">Data de inicio da submissão:</label>
            <!-- diaII é o Dia em que Inicia a submissão -->
            <select id="sltdiaIS" name="pdiaIS">
                <?php
                    for($i = 1; $i <= 31; $i++){
                        echo "<option value=\"$i\">$i</option>";                            
                    }
                ?>
            </select>
            <select id="sltMesIS" name="pMesIS">
                <!-- mesIS é o Mes em que Inicia a submissao-->
                <?php
                    $mesesIS = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

                    for($i = 1; $i <= 12; $i++){
                        echo "<option value=\"$i\">".$mesesIS[$i-1]."</option>";                            
                    }
                ?>
            </select>
            <select id="sltAnoIS" name="pAnoIS">
                <!-- anoII é o Ano em que Inicia a Submissao-->
                <?php
                    for($i = 2017; $i <= 2020; $i++){
                        echo "<option value=\"$i\">$i</option>";                            
                    }
                ?>
            </select>
            <!-- fim das inscriçoes -->
            <label for="sltFS">Data de termino da submissão:</label>
            <!-- diaFI é o Dia em que terminam as Inscriçoes-->
            <select id="sltdiaFS" name="pdiaFS">
                <?php
                    for($i = 1; $i <= 31; $i++){
                        echo "<option value=\"$i\">$i</option>";                            
                    }
                ?>
            </select>
            <select id="sltMesFS" name="pMesFS">
                <!-- mesFI é o Mes em que Terminam as Inscriçoes-->
                <?php
                    $mesesFS = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

                    for($i = 1; $i <= 12; $i++){
                        echo "<option value=\"$i\">".$mesesFS[$i-1]."</option>";                            
                    }
                ?>
            </select>
            <select id="sltAnoFI" name="pAnoFI">
                <!-- anoFI é o Ano em que Inicia as Inscriçoes-->
                <?php
                    for($i = 2017; $i <= 2020; $i++){
                        echo "<option value=\"$i\">$i</option>";                            
                    }
                ?>
            </select>
            <!-- inicio do Evento -->
            <label for="sltIE">Data de inicio do evento:</label>
            <!-- diaIE é o Dia em que Inicia o Evento-->
            <select id="sltdiaIE" name="pdiaIE">
                <?php
                    for($i = 1; $i <= 31; $i++){
                        echo "<option value=\"$i\">$i</option>";                            
                    }
                ?>
            </select>
            <select id="sltMesIE" name="pMesIE">
                <!-- mesIE é o Mes em que Inicia o evento-->
                <?php
                    $mesesIE = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

                    for($i = 1; $i <= 12; $i++){
                        echo "<option value=\"$i\">".$mesesIE[$i-1]."</option>";                            
                    }
                ?>
            </select>
            <select id="sltAnoIE" name="pAnoIE">
                <!-- anoIE é o Ano em que Inicia o Evento-->
                <?php
                    for($i = 2017; $i <= 2020; $i++){
                        echo "<option value=\"$i\">$i</option>";                            
                    }
                ?>
            </select>
            <!-- fim das inscriçoes -->
            <label for="sltFE">Data de termino do evento:</label>
            <!-- diaFI é o Dia em que terminam as Inscriçoes-->
            <select id="sltdiaFE" name="pdiaFE">
                <?php
                    for($i = 1; $i <= 31; $i++){
                        echo "<option value=\"$i\">$i</option>";                            
                    }
                ?>
            </select>
            <select id="sltMesFE" name="pMesFE">
                <!-- mesFE é o Mes em que Termina o Evento-->
                <?php
                    $mesesFE= array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

                    for($i = 1; $i <= 12; $i++){
                        echo "<option value=\"$i\">".$mesesFE[$i-1]."</option>";                            
                    }
                ?>
            </select>
            <select id="sltAnoFE" name="pAnoFE">
                <!-- anoFE é o Ano em que Inicia as Eevento-->
                <?php
                    for($i = 2017; $i <= 2020; $i++){
                        echo "<option value=\"$i\">$i</option>";                            
                    }
                ?>
            </select>
            <input type="submit" value="Passo seguinte">
         </form>
        </section>
        <?php include './includes/rodape.php'; ?>
    </body>
</html>