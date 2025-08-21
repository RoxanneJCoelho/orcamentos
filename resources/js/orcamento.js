document.addEventListener("DOMContentLoaded", function () {
    let carrinho = [];
    const carrinhoDiv = document.getElementById("carrinho");
    const totalSpan = document.getElementById("total");
    const totalContainer = document.getElementById("totalContainer");

    // Adicionar serviço ao carrinho
    document.querySelectorAll(".addServico").forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const nome = this.dataset.nome;
            const preco = parseFloat(this.dataset.preco);

            // Verificar se já existe no carrinho
            let item = carrinho.find(s => s.id === id);
            if (item) {
                item.qtd++;
            } else {
                carrinho.push({ id, nome, preco, qtd: 1 });
            }
            renderCarrinho();
        });
    });

    // Renderizar carrinho
    function renderCarrinho() {
        carrinhoDiv.innerHTML = "";

        carrinho.forEach((item, index) => {
            const linha = document.createElement("div");
            linha.classList.add("mb-2");

            linha.innerHTML = `
                ${item.nome} - €${item.preco} x
                <button type="button" class="btn btn-sm btn-secondary menos" data-index="${index}">-</button>
                ${item.qtd}
                <button type="button" class="btn btn-sm btn-secondary mais" data-index="${index}">+</button>
                = €${(item.preco * item.qtd).toFixed(2)}
                <button type="button" class="btn btn-sm btn-danger remover" data-index="${index}">Remover</button>
                <input type="hidden" name="servicos[${index}][id]" value="${item.id}">
                <input type="hidden" name="servicos[${index}][qtd]" value="${item.qtd}">
            `;

            carrinhoDiv.appendChild(linha);
        });

        calcularTotal();
        totalContainer.style.display = carrinho.length > 0 ? "block" : "none";

        // Eventos dos botões
        document.querySelectorAll(".menos").forEach(btn => {
            btn.addEventListener("click", function () {
                let idx = this.dataset.index;
                if (carrinho[idx].qtd > 1) carrinho[idx].qtd--;
                renderCarrinho();
            });
        });

        document.querySelectorAll(".mais").forEach(btn => {
            btn.addEventListener("click", function () {
                let idx = this.dataset.index;
                carrinho[idx].qtd++;
                renderCarrinho();
            });
        });

        document.querySelectorAll(".remover").forEach(btn => {
            btn.addEventListener("click", function () {
                let idx = this.dataset.index;
                carrinho.splice(idx, 1);
                renderCarrinho();
            });
        });
    }

    // Calcular total
    function calcularTotal() {
        let total = carrinho.reduce((sum, item) => sum + item.preco * item.qtd, 0);
        totalSpan.textContent = total.toFixed(2);
    }
});
