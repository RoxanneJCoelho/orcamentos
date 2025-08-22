// filtro por categoria
document.addEventListener('DOMContentLoaded', function() {
    const filtro = document.getElementById('categoriaFiltro');
    const categorias = document.querySelectorAll('#listaServicos .categoria');

    filtro.addEventListener('change', function() {
        const valor = this.value;

        categorias.forEach(categoria => {
            if (valor === '' || categoria.dataset.id === valor) {
                categoria.style.display = 'block';
            } else {
                categoria.style.display = 'none';
            }
        });
    });
});

// Seleciona todos os botões de adicionar serviço
const tabela = document.querySelector('#tabelaSelecionados tbody');
const precoTotal = document.getElementById('precoTotal');

let total = 0;
const carrinho = {}; // {id: {nome, preco, quantidade}}

// Função para atualizar tabela e total
function atualizarTabela() {
    tabela.innerHTML = '';
    total = 0;

    Object.keys(carrinho).forEach(id => {
        const item = carrinho[id];
        total += item.preco * item.quantidade;

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${item.nome}</td>
            <td>${item.quantidade}</td>
            <td>€${(item.preco * item.quantidade).toFixed(2)}</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm btn-remover" data-id="${id}">
                    🗑️
                </button>
            </td>
        `;
        tabela.appendChild(tr);
    });

    precoTotal.textContent = total.toFixed(2);

    // Evento remover
    document.querySelectorAll('.btn-remover').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            delete carrinho[id];
            const servicoDiv = document.querySelector(`.servico[data-id="${id}"]`);
            servicoDiv.querySelector('.quantidade').value = 0;
            atualizarTabela();
        });
    });
}

// Configurar botões + e -
document.querySelectorAll('.servico').forEach(servicoDiv => {
    const id = servicoDiv.dataset.id;
    const nome = servicoDiv.querySelector('.flex-grow-1').textContent.split(' - ')[0].trim();
    const preco = parseFloat(servicoDiv.dataset.preco);

    const input = servicoDiv.querySelector('.quantidade');
    const btnPlus = servicoDiv.querySelector('.btn-plus');
    const btnMinus = servicoDiv.querySelector('.btn-minus');

    btnPlus.addEventListener('click', () => {
        let qtd = parseInt(input.value);
        qtd++;
        input.value = qtd;
        carrinho[id] = { nome, preco, quantidade: qtd };
        atualizarTabela();
    });

    btnMinus.addEventListener('click', () => {
        let qtd = parseInt(input.value);
        if (qtd > 0) qtd--;
        input.value = qtd;

        if (qtd === 0) delete carrinho[id];
        else carrinho[id].quantidade = qtd;

        atualizarTabela();
    });

    // Input manual
    input.addEventListener('input', () => {
        let qtd = parseInt(input.value);

        // Corrige valores inválidos
        if (isNaN(qtd) || qtd < 0) {
            input.value = 0;
            delete carrinho[id];
        } else if (qtd === 0) {
            delete carrinho[id];
        } else {
            carrinho[id] = { nome, preco, quantidade: qtd };
        }

        atualizarTabela();
    });
});
