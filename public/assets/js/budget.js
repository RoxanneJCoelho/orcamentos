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
