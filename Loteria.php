<?php

namespace Monetizze;

class Loteria{
 
    private $dezenas; 
    private $resultado; 
    private $totalJogos;
    private $jogos;

    
    function __construct($qtdJogos, $qtdDezenas){
        
        //Menor que 6 e maior que 10, o padrão de qtd dezendas serão 6
        if($qtdDezenas < 6 && $qtdDezenas > 10){
            $qtdDezenas = 6; 
        }

        $this->setDezenas($qtdDezenas);
        $this->setTotal($qtdJogos);
    }

   /*Método para geração aleatório de dezenas entre 1 e 60*/

    private function gerarDezenas(){
        
        $valores = array();
        
        for($i=0; $i<$this->getDezenas(); $i++){
            $num = rand(1,60);
            //Evitar repetições    
            while(in_array($num, $valores)){ 
                $num = rand(1,60);
            }

            $valores[$i] = $num;
        }
        //SORT_NUMERIC - compara os items numericamente
        sort($valores, SORT_NUMERIC);
        return $valores;
    }

    /*Método para criação de jogos */

    public function criarJogos(){
    
        $valores = array();

        for($i=0; $i<$this->getTotal(); $i++){
            $valores[$i] = $this->gerarDezenas();
        }

        $this->setJogos($valores);
    }

    /* Método que confere os jogos, respeitando a quantidade máxima de jogos */

    public function jogosConferencia(){
        
        $valores = array();

        for($i=0; $i<count($this->jogos); $i++){
            foreach($this->resultado as $key => $valor){
                if(in_array($valor, $this->jogos[$i])){
                    $valores[$i][array_search($valor, $this->jogos[$i])] = $valor;
                } 
            }
        }

        return $valores; 
    }

    /*Método que sorteia o jogo, respeitando a quantia de dezenas informada no construtor*/

    private function sortear(){
    
        $qtd = $this->getDezenas();
        $valores = array();
    
        for($i=0; $i<$qtd ; $i++){
            $num = rand(1,60);
            
            while(in_array($num, $valores)){ 
                $num = rand(1,60);
            }

            $valores[$i] = $num;
        }
        sort($valores, SORT_NUMERIC);
        $this->setFinal($valores);
    }
    
    public function realizarSorteio(){
        $this->criarJogos();
        $this->sortear();
        return $this->jogosConferencia();;
    }
    
    public function numeroSorteado($valor, $key, $jogo){
        if(key_exists($key, $jogo)){
            if(array_search($valor, $jogo[$key])){
                return true;
            } 
        } 
        return false;
    }
    
    public function getDezenas(){
        return $this->dezenas;
    }

      public function setDezenas($valoresDezenas){
        $this->dezenas = $valoresDezenas;
        return $this;
    }

    public function getTotal(){
        return $this->total;
    }

    public function setTotal($total){
        $this->total = $total;
        return $this;
    }

    public function getJogos(){
        return $this->jogos;
    }

    public function setJogos($jogos){
        $this->jogos = $jogos;
        return $this;
    }
   
    public function getFinal(){
        return $this->resultado;
    }

    public function setFinal($resultado){
        $this->resultado = $resultado;
        return $this;
    }
  
}
?>