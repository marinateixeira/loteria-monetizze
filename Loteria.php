<?php

/**
 * Description of Loteria
 *
 * @author marina
 */
class Loteria {

    private $quantidade_dezenas, $resultado, $total_jogos, $jogos;

    public function __construct($quantidade_dezenas, $total_jogos)
    {
        if (isset($quantidade_dezenas))
        {
            $this->quantidade_dezenas = $quantidade_dezenas;
        }
        if (isset($total_jogos))
        {
            $this->total_jogos = $total_jogos;
        }
    }

    /*Cria um vetor de dezenas com números aleatórios, que representa um jogo*/
    private function criaDezenas($quantidade_dezenas)
    {
        $dezenas = [];
        for ($i = 0; $i < $quantidade_dezenas; $i++)
        {
            do
            {
                $num = random_int(1, 60);
            }
            while (in_array($num, $dezenas));
            $dezenas[$i] = $num;
        }
        sort($dezenas);

        return $dezenas;
    }

    /*Cria os jogos da loteria, de acordo com a quantidade total de jogos que foi definida*/
    public function criaJogos()
    {
        $jogosCriados = new SplFixedArray($this->getTotalDeJogos());

        for ($i = 0; $i < $this->getTotalDeJogos(); $i++)
        {
            $jogosCriados[$i] = $this->criaDezenas($this->getQuantidadeDeDezenas());
        }
        
        $this->jogos = $jogosCriados;
    }

    /*Gera as seis dezenas sorteadas na loteria*/
    public function realizaSorteio()
    {
//        $sorteio = [];
        for ($i = 0; $i < 6; $i++)
        {
            do
            {
                $num = random_int(1, 60);
            }
            while (in_array($num, $sorteio));
            $sorteio[$i] = $num;
        }
        sort($sorteio);
        $this->resultado = $sorteio;
    }

    /*Verifica a quantidade de acertos dos jogos*/
    public function verificaResultado()
    {
        $num_acertos_por_jogo = new SplFixedArray($this->getTotalDeJogos());

        for ($i = 0; $i < $this->getTotalDeJogos(); $i++)
        {
            $acertos = 0;
            for ($j = 0; $j < $this->quantidade_dezenas; $j++)
            {
                if (in_array($this->jogos[$i][$j], $this->resultado))
                {
                    $acertos++;
                }
            }
            $num_acertos_por_jogo[$i] = $acertos;
        }
        
        return $num_acertos_por_jogo;
    }

    /*Realiza as etapas da loteria e retorna o vetor de quantidade de acertos de cada jogo*/
    public function executaLoteria()
    {
        $this->criaJogos();
        $this->realizaSorteio();
        $resultadoLoteria = $this->verificaResultado();
        
       return $resultadoLoteria;
    }

    public function getQuantidadeDeDezenas()
    {
        return $this->quantidade_dezenas;
    }

    public function getTotalDeJogos()
    {
        return $this->total_jogos;
    }

    public function setResultado($result)
    {
        $this->resultado = $result;
    }

    public function getResultado()
    {
        return $this->resultado;
    }

    public function setJogos($jgs)
    {
        $this->jogos = $jgs;
    }

    public function getJogos()
    {
        return $this->jogos;
    }

}
