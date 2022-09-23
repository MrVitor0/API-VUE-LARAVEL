<template>
  
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">
                        <h3 class="card-title text-center">Cadastro de Produtos</h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="form-group ">
                                <label for="desname">Nome</label>
                                <input type="text" class="form-control" id="desname" v-model="desname" placeholder="ex: Produto X">
                            </div>
                            <br>
                            <div class="form-group ">
                                <label for="desprice">Valor Unitário</label>
                                <input type="text" class="form-control" id="desprice" v-on:blur="format_price" v-model="desprice" placeholder="ex: R$20,00">
                            </div>
                            <br>
                            <div class="text-center">
                             <button type="submit" class="btn btn-primary btn-block  ">Cadastrar</button>
                            </div>
                        </form>
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
            desname: '',
            desprice: ''
        }
    },
    methods: {
        /**
         * @author Vitor Hugo
         * @version 1.0
         * @returns {void}
         * @description Format price, string to float
        */
        format_price(){
             this.desprice = parseFloat(this.desprice).toLocaleString('pt', {
                style: 'decimal',
                decimal: ',',
                thousands: '.',
                maximumFractionDigits: 2,
                minimumFractionDigits: 2
            });
            this.desprice == undefined || this.desprice == null || this.desprice == 'NaN' ? this.desprice = '' : this.desprice = this.desprice;
        },
        /**
         * @author Vitor Hugo
         * @version 1.0
         * @returns {void}
         * @description Submit form to register a product
        */
        submit(){
            //verify if the fields are empty
            if (this.desname == '' || this.desprice == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Preencha todos os campos!',
                    })
                } else {
                    //send data to api
                    var that = this;
                    axios.post('/api/product/create', {
                            desname: this.desname,
                            desprice: this.desprice,
                        })
                        .then(function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Produto cadastrado com sucesso!',
                                showConfirmButton: true,
                                timer: 1500
                            })
                            //redirect to client_list
                            that.$router.push({ name: 'product_list' })
                        })
                        .catch(function (error) {
                            //check if has error.response.data.errors
                            if(error.response.data.error){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: error.response.data.error,
                                })
                            }
                        });
                }
        }
    }
}
</script>