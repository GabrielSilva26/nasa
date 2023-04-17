class Nasa
{   

    // Método construtor
    constructor()
    {
        console.log ("disparado automaticamente");
    }
    
    /**
     * Método que carrega os conteudos na home
     * @param conteudo - string - caminho do conteúdo
     * @param onde - id do elemento onde será feito o carregamento
     */
    carregaConteudos( conteudo, onde)
    {
        fetch(conteudo).then(response => response.text()).then(html => document.querySelector(onde).innerHTML = html);
    }
}

  // objeto da classe
let nasa = new Nasa();

nasa.carregaConteudos("./public_html/cartao_visitas.html", "#tela");