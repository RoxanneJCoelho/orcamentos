document.addEventListener("DOMContentLoaded", () => {
    const tabelaSelecionados = document.querySelector("#tabelaSelecionados tbody");
    const precoTotalEl = document.getElementById("precoTotal");
    let objetoPost = {};
    let countservice =1;
    // cria uma key única para cada clique
    let key ='service';
    // FILTRO DE CATEGORIAS
    const filtro = document.getElementById('categoryFilter'); // corrigido id
    const categoriasDivs = document.querySelectorAll('#listaServicos .categoria');
    const formulario = document.getElementById('orcamentoForm');

    filtro.addEventListener('change', function() {
        const valor = this.value;
        categoriasDivs.forEach(categoria => {
            categoria.style.display = (valor === '' || categoria.dataset.id === valor) ? 'block' : 'none';
        });
    });

    // Função para atualizar tabela e total
    function atualizarTabela() {
        let total = 0;
        tabelaSelecionados.innerHTML = "";


        document.querySelectorAll(".servico").forEach(servico => {
            let quantidade = parseInt(servico.querySelector(".quantidade").value) || 0;
            if (quantidade > 0) {
                // pega o texto do serviço (sem depender de classe extra)
                let descricao = servico.childNodes[0].textContent.trim();

                let preco = parseFloat(servico.dataset.preco);
                let desconto = parseFloat(servico.dataset.desconto) || 0;

                let precoSemDesconto = preco * quantidade;
                let valorComDesconto = precoSemDesconto - (precoSemDesconto * (desconto / 100));

                total += valorComDesconto;


                key = `service_${countservice}`;
                objetoPost[key] = [descricao, quantidade, precoSemDesconto.toFixed(2), desconto, valorComDesconto.toFixed(2), total.toFixed(2) ]
                console.log(objetoPost);
                document.getElementById("objetoPost").value = JSON.stringify(objetoPost);
                countservice++;


                let row = document.createElement("tr");
                row.innerHTML = `
                    <td>${descricao}</td>
                    <td>${quantidade}</td>
                    <td>${precoSemDesconto.toFixed(2)}€</td>
                    <td>${desconto}%</td>
                    <td>${valorComDesconto.toFixed(2)}€</td>
                    <td>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                    </td>
                `;

                // botão remover → zera a quantidade
                row.querySelector(".btn-close").addEventListener("click", () => {
                    servico.querySelector(".quantidade").value = 0;
                    atualizarTabela();
                });

                tabelaSelecionados.appendChild(row);
            }
        });

        precoTotalEl.textContent = total.toFixed(2);
    }

    // botões plus/minus/quantidade
    document.querySelectorAll(".btn-plus").forEach(btn => {
        btn.addEventListener("click", () => {
            let input = btn.closest(".input-group").querySelector(".quantidade");
            input.value = parseInt(input.value) + 1;
            atualizarTabela();
        });
    });

    document.querySelectorAll(".btn-minus").forEach(btn => {
        btn.addEventListener("click", () => {
            let input = btn.closest(".input-group").querySelector(".quantidade");
            let atual = parseInt(input.value);
            if (atual > 0) input.value = atual - 1;
            atualizarTabela();
        });
    });

    document.querySelectorAll(".btn-atualizar").forEach(btn => {
    input.addEventListener("click", () => {

        let input = document.getElementById("quantidade");
        let val = parseInt(input.value);
        if (isNaN(val) || val < 0) {
            input.value = 0;
        } else {
            input.value = val; // força a ser inteiro
        }

        let servicoParaAtualizar = document.querySelector("#listaServicos .servico .quantidade");
        if (servicoParaAtualizar) {
            servicoParaAtualizar.value = val; // seta valor do input interno
        }

        atualizarTabela();
        });
    });

//     document.querySelectorAll(".btn-atualizar").forEach(btn => {
//     btn.addEventListener("click", () => {
//         atualizarTabela();
//     });
// });
console.log(formulario);
formulario.addEventListener('submit', function(event){
event.preventDefault();
console.log('ola');

//formulario.submit()

})

});





