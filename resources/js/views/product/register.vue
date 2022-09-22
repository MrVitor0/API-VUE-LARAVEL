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
                                <input type="text" class="form-control" id="desprice" v-model="desprice" placeholder="ex: R$20,00">
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
        submit(){
            console.log(this.desname)
            console.log(this.desprice)
        }
    }
}
</script>