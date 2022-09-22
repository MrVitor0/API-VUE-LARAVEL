<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center" >
                    <div class="card-header">
                        <h3 class="card-title">Listagem de Produtos</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table  table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products" :key="product.id">
                                    <th scope="row">#{{ product.id }}</th>
                                    <td>{{ product.desname }}</td>
                                    <td>{{ product.desprice }}</td>
                                    <td>
                                        <a class="btn btn-danger" v-on:click='delete_product(product.id)'>Excluir</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Swal from 'sweetalert2'
export default {
    data() {
        return {
            title: 'Listagem de produtos',
            products: []
        }
    },
    mounted() {
        this.getproducts();
    },
    methods: {
        delete_product(id){
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/product/delete/' + id)
                    .then(response => {
                        Swal.fire(
                            'Excluído!',
                            'O produto foi excluído com sucesso.',
                            'success'
                        )
                        this.getproducts();
                    })
                    .catch(error => {
                        Swal.fire(
                            'Erro!',
                            'Ocorreu um erro ao excluir este produto.',
                            'error'
                        )
                    })
                }
            })
        },
      
        /**
         * @author Vitor Hugo
         * @version 1.0
         * @description Método responsável por listar os productes
        */
        getproducts() {
            Swal.fire({
                title: 'Carregando..',
                html: 'Aguarde enquanto recebemos as informações.',
                didOpen: () => {
                    Swal.showLoading()
                        axios.get('/api/product/list')
                        .then(response => {
                            //stop loading
                            Swal.close();
                            this.products = response.data;
                            console.log(response.data);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }})
        }
    }
}
</script>
