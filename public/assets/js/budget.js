document.addEventListener("DOMContentLoaded", () => {
    const tabelaSelecionados = document.querySelector("#tabelaSelecionados tbody");
    const precoTotalEl = document.getElementById("precoTotal");

    // FILTRO DE CATEGORIAS
    const filtro = document.getElementById('categoryFilter');
    const categoriasDivs = document.querySelectorAll('#listaServicos .categoria');

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

        let dadosTabela = [];

        document.querySelectorAll(".servico").forEach(servico => {
            let quantidade = parseInt(servico.querySelector(".quantidade").value) || 0;
            if (quantidade > 0) {
                let descricao = servico.childNodes[0].textContent.trim();
                let preco = parseFloat(servico.dataset.preco);
                let desconto = parseFloat(servico.dataset.desconto) || 0;

                let precoSemDesconto = preco * quantidade;
                let valorComDesconto = precoSemDesconto - (precoSemDesconto * (desconto / 100));
                total += valorComDesconto;

                dadosTabela.push({
                    descricao,
                    quantidade,
                    precoSemDesconto,
                    desconto,
                    valorComDesconto
                });

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

        // Atualiza inputs hidden do form
        document.getElementById("tabelaSelecionadosJSON").value = JSON.stringify(dadosTabela);
        document.getElementById("precoTotalPost").value = total.toFixed(2);

        // Atualiza visual do total
        precoTotalEl.textContent = total.toFixed(2);
    }

    // Delegação de eventos para + / - (funciona mesmo com serviços dinâmicos)
    document.getElementById("listaServicos").addEventListener("click", function(e) {
        if (e.target.classList.contains("btn-plus")) {
            let input = e.target.closest(".input-group").querySelector(".quantidade");
            input.value = parseInt(input.value) + 1;
            atualizarTabela();
        } else if (e.target.classList.contains("btn-minus")) {
            let input = e.target.closest(".input-group").querySelector(".quantidade");
            let atual = parseInt(input.value);
            if (atual > 0) input.value = atual - 1;
            atualizarTabela();
        }
    });

    // Input manual de quantidade
    document.getElementById("listaServicos").addEventListener("input", function(e) {
        if (e.target.classList.contains("quantidade")) {
            let val = parseInt(e.target.value);
            e.target.value = isNaN(val) || val < 0 ? 0 : val;
            atualizarTabela();
        }
    });

    // Atualiza inputs hidden antes do submit
    const form = document.getElementById("orcamentoForm");
    form.addEventListener("submit", function(e) {
        atualizarTabela(); // garante que o JSON e total estão preenchidos
    });

});






