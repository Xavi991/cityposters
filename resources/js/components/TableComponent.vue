<template>
    <div class="container">
        <div class="icon-options">
            <span class="icon-custom pdf">
                <a :href="parentRoute" target="_blank"><img :src="imgPDF"></a>
            </span>

            <span class="icon-custom add" data-toggle="modal" data-target="#insert-offer" @click="resetInsert">
                <img :src="imgADD" >
            </span>
        </div>

        <div class="table-responsive">  
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">DESDE</th>
                        <th class="text-center">HASTA</th>
                        <th class="text-center">DESCRIPCION</th>
                        <th class="text-center">PRECIO ANTES</th>
                        <th class="text-center">PRECIO AHORA</th>
                        <th class="text-center">% DESCUENTO</th>
                        <th class="text-center">GRUPO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="(item, index) in offers">
                        <td class="text-center">{{item.date_from}}</td>
                        <td class="text-center">{{item.date_to}}</td>
                        <td class="text-center">{{item.description}}</td>
                        <td class="text-center">{{item.before_price}}</td>
                        <td class="text-center">{{item.after_price}}</td>
                        <td class="text-center">{{item.descount_porcentage}}</td>
                        <td class="text-center">{{item.group}}</td>
                        <td class="text-center">

                            <i class="fa fa-edit fa-2x text-success action" data-toggle="modal" data-target="#edit-offer" @click="editOffer(index)"></i>

                            <i class="fa fa-times-rectangle fa-2x text-danger action" data-toggle="tooltip" data-placement="top" title="Eliminar" @click="deleteOffer(item.id)"></i>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>  

        <!--UPDATE AN OFFER -->
        <div class="modal fade" id="edit-offer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <!--header -->
              <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Editar una oferta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
               <!--body -->
              <div class="modal-body">
                <form  method="POST" @submit.prevent="updateOffer">

                     <!--FECHA-->
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label for="dateFrom">Fecha Desde <span class="text-danger">(*)</span></label>

                            <input type="date" class="form-control" id="dateFrom" placeholder="Escriba la fecha dd/mm/yyyy" :min="today"  v-model="date_from">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="dateTo">Fecha Hasta <span class="text-danger">(*)</span></label>

                            <input type="date" class="form-control" id="dateTo" placeholder="Escriba la fecha dd/mm/yyyy" :min="today" v-model="date_to">
                        </div>
                    </div>

                     <!--DESCRIPTION-->
                    <div class="form-group">
                        <label for="description">Description <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control" id="description" placeholder="Escriba una description" v-model="description">
                    </div>

                    <!--BEFORE PRICE AND AFTER PRICE-->
                    <div class="form-row">
                        <div class="col-md-6 mb-2">

                             <label for="beforePrice">Precio Antes <span class="text-danger">(*)</span></label>
                            <input type="number" class="form-control" id="beforePrice" placeholder="Escriba un precio" min="0" v-model="before_price">

                        </div>

                        <div class="col-md-6 mb-2">

                            <label for="afterPrice">Precio Despues</label>
                            <input type="number" class="form-control" id="afterPrice" placeholder="Escriba  un precio" min="0" v-model="after_price">

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-2">

                            <label for="descount">% Descuento</label>
                            <input type="number" class="form-control" id="descount" placeholder="Escriba un pocentaje" min="0" v-model="descount_porcentage">

                        </div>

                        <div class="col-md-6 mb-2">

                            <label for="quantity">X por precio</label>
                            <input type="number" class="form-control" id="quantity" placeholder="Escriba  un numero" min="0" v-model="quantity_promo">

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-2">

                            <label for="design_type">Tipo diseño <span class="text-danger">(*)</span></label>
                            <select class="form-control" id="design_type" v-model="design_type">
                              <option value="" selected disabled hidden>...</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>

                        </div>

                        <div class="col-md-4 mb-2">

                            <label for="group">Grupo <span class="text-danger">(*)</span></label>
                            <input type="number" class="form-control" id="group" placeholder="Escriba  un numero" min="0" v-model="group">

                        </div>

                        <div class="col-md-4 mb-2">

                            <label for="group_tittle">Titulo grupo <span class="text-danger">(*)</span></label>
                            <select class="form-control" id="group_tittle" v-model="group_tittle">
                              <option value="" selected disabled hidden>...</option>
                              <option value="N">N</option>
                              <option value="T">T</option>
                            </select>

                        </div>
                    </div>

                </form>
              </div>
               <!--footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-custom btn-exta" @click="updateOffer">Actualizar</button>
              </div>
            </div>
          </div>
        </div>

        <!--INSERT AN OFFER -->
        <div class="modal fade" id="insert-offer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <!--header -->
              <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Insertar una oferta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
               <!--body -->
              <div class="modal-body">
                <form  method="POST" @submit.prevent="insertOffer">

                     <!--FECHA-->
                    <div class="form-row">
                        <div class="col-md-4 mb-2">
                            <label for="dateFrom2">Fecha Desde <span class="text-danger">(*)</span></label>

                            <input type="date" class="form-control" id="dateFrom2" placeholder="Escriba la fecha dd/mm/yyyy" :min="today"  v-model="date_from2">
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="dateTo2">Fecha Hasta <span class="text-danger">(*)</span></label>

                            <input type="date" class="form-control" id="dateTo2" placeholder="Escriba la fecha dd/mm/yyyy" :min="today" v-model="date_to2">
                        </div>

                        <div class="col-md-4 mb-2">

                             <label for="ean">Ean <span class="text-danger">(*)</span></label>
                            <input type="number" class="form-control" id="ean" placeholder="Escriba el número" min="0" v-model="ean">

                        </div>
                    </div>

                     <!--DESCRIPTION-->
                    <div class="form-group">
                        <label for="description2">Description <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control" id="description2" placeholder="Escriba una description" v-model="description2">
                    </div>

                    <!--BEFORE PRICE AND AFTER PRICE-->
                    <div class="form-row">
                        <div class="col-md-6 mb-2">

                             <label for="beforePrice2">Precio Antes <span class="text-danger">(*)</span></label>
                            <input type="number" class="form-control" id="beforePrice2" placeholder="Escriba un precio" min="0" v-model="before_price2">

                        </div>

                        <div class="col-md-6 mb-2">

                            <label for="afterPrice2">Precio Despues</label>
                            <input type="number" class="form-control" id="afterPrice2" placeholder="Escriba  un precio" min="0" v-model="after_price2">

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-2">

                            <label for="descount2">% Descuento</label>
                            <input type="number" class="form-control" id="descount2" placeholder="Escriba un número" min="0" v-model="descount_porcentage2">

                        </div>

                        <div class="col-md-6 mb-2">

                            <label for="quantity2">X por precio</label>
                            <input type="number" class="form-control" id="quantity2" placeholder="Escriba  un número" min="0" v-model="quantity_promo2">

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-2">

                            <label for="design_type2">Tipo diseño <span class="text-danger">(*) (por defecto 1)</span></label>
                            <select class="form-control" id="design_type2" v-model="design_type2">
                              <option value="" selected disabled hidden>...</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>

                        </div>

                        <div class="col-md-4 mb-2">

                            <label for="group2">Grupo <span class="text-danger">(*) (por defecto 0)</span></label>
                            <input type="number" class="form-control" id="group2" placeholder="Escriba  un numero" min="0" v-model="group2">

                        </div>

                        <div class="col-md-4 mb-2">

                            <label for="group_tittle">Titulo grupo <span class="text-danger">(*) (por defecto N)</span></label>
                            <select class="form-control" id="group_tittle" v-model="group_tittle2">
                              <option value="" selected disabled hidden>...</option>
                              <option value="N" selected>N</option>
                              <option value="T">T</option>
                            </select>

                        </div>
                    </div>

                </form>
              </div>
               <!--footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-custom btn-exta" @click="insertOffer">Insertar</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios'

    //PARA USAR TOASTR
    import Vue from 'vue';
    import VueToast from 'vue-toast-notification';
    import 'vue-toast-notification/dist/theme-default.css';
    Vue.use(VueToast);


    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    export default {
        props: ['parentRoute'],
        data(){
            return {
                imgPDF:'img/pdf.png',
                imgADD:'img/add.png',
                offers:[],
                today: this.currentDate(),
                //for update
                id:null,
                date_from: null,
                date_to: null,
                description: null,
                before_price: null,
                after_price: null,
                design_type: null,
                descount_porcentage: null,
                quantity_promo: null,
                group: null,
                group_tittle: null,
                //for insert
                date_from2: null,
                date_to2: null,
                ean: null,
                description2: null,
                before_price2: null,
                after_price2: null,
                design_type2: null,
                descount_porcentage2: null,
                quantity_promo2: null,
                group2: null,
                group_tittle2: null
                
            }
        },

        mounted(){
            this.getOfferPoster();
            this.currentDate();
        },

        methods:{
            currentDate: function(){
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); 
                var yyyy = today.getFullYear();

                today = yyyy+ '-' + mm + '-' + dd;
                return today;
            },

            getOfferPoster: function(){
                let url='posters';

                axios.get(url).then(response=>{

                    for(let i=0; i<response.data.length; i++){
                        this.offers.push(response.data[i]);
                    }

                    console.log(response.data);

                }).catch(err=>{
                    console.log(err);
                })
            },

            editOffer: function($event){

                this.reset();
                this.id=                    this.offers[$event].id;
                this.date_from=             this.dateFormat(this.offers[$event].date_from);
                this.date_to=               this.dateFormat(this.offers[$event].date_to);
                this.description=           this.offers[$event].description;
                this.before_price=          this.offers[$event].before_price;
                this.after_price=           this.offers[$event].after_price;
                this.design_type=           this.offers[$event].design_type;
                this.descount_porcentage=   this.offers[$event].descount_porcentage;
                this.quantity_promo=        this.offers[$event].quantity_promo;
                this.group=                 this.offers[$event].group;
                this.group_tittle=          this.offers[$event].group_tittle;

            },

            insertOffer: function(){
                if(!this.date_from2 || !this.date_to2 || !this.ean || !this.description2 
                    || !this.before_price2 || !this.design_type2 || !this.group2 
                    || !this.group_tittle2){

                    this.showToastr('Debes de completar todos los campos (*) obligatorios!','error');

                }else{

                    if(!this.descount_porcentage2){
                        this.descount_porcentage2=0;
                    }

                    if(!this.quantity_promo2){
                        this.quantity_promo2=0;
                    }

                    if(!this.after_price2){
                        this.after_price2=0;
                    }

                    this.description2= this.description2.toUpperCase();

                    const offer_poster= {
                        date_from:              this.date_from2,
                        date_to:                this.date_to2,
                        ean:                    this.ean,
                        description:            this.description2,
                        before_price:           this.before_price2,
                        after_price:            this.after_price2,
                        design_type:            this.design_type2,
                        descount_porcentage:    this.descount_porcentage2,
                        quantity_promo:         this.quantity_promo2,
                        group:                  this.group2,
                        group_tittle:           this.group_tittle2    
                    };

                    var url = 'offerPoster'; 

                    axios.post(url,  offer_poster).then(response => {
                       if(response.data){
                            this.offers=[];
                            this.getOfferPoster();
                            $('#insert-offer').modal('hide');

                       }
                        
                    }).catch(error => {
                        console.log('Error inserting')
                    });
                }
                
            },

            updateOffer: function(){

                if(!this.date_from || !this.date_to || !this.description 
                    || !this.before_price || !this.design_type || !this.group 
                    || !this.group_tittle){

                    this.showToastr('Debes de completar todos los campos (*) obligatorios!','error');

                }else{

                    this.description= this.description.toUpperCase();

                    const offer_poster= {
                        date_from:              this.date_from,
                        date_to:                this.date_to,
                        description:            this.description,
                        before_price:           this.before_price,
                        after_price:            this.after_price,
                        design_type:            this.design_type,
                        descount_porcentage:    this.descount_porcentage,
                        quantity_promo:         this.quantity_promo,
                        group:                  this.group,
                        group_tittle:           this.group_tittle    
                    };

                    var url = 'offerPoster/'+this.id; 

                    axios.put(url,  offer_poster).then(response => {
                       if(response.data){
                            this.offers=[];
                            this.getOfferPoster();
                            $('#edit-offer').modal('hide');

                       }
                        
                    }).catch(error => {
                        console.log('Error updating')
                    });

                }

            },

            deleteOffer: function($event){

                const url= 'delete-offer/'+$event;

                axios.delete(url).then(response => {
                    this.offers=[];
                    this.getOfferPoster();
                    this.showToastr('Se eliminó correctamente!','success');
                });
            },

            dateFormat: function(defaultDate){

                let date = defaultDate;
                date = date.split("/").reverse().join("-");

                return date;
            },

            reset: function(){
                this.date_from=             null; 
                this.date_to=               null; 
                this.description=           null; 
                this.before_price=          null; 
                this.after_price=           null; 
                this.design_type=           null; 
                this.descount_porcentage=   null; 
                this.quantity_promo=        null;
                this.group=                 null; 
                this.group_tittle=          null; 
            },

            resetInsert: function(){
                this.date_from2=             null; 
                this.date_to2=               null;
                this.ean=                    null;
                this.description2=           null; 
                this.before_price2=          null; 
                this.after_price2=           null; 
                this.design_type2=           "1"; 
                this.descount_porcentage2=   null; 
                this.quantity_promo2=        null;
                this.group2=                 "0"; 
                this.group_tittle2=          "N"; 
            },

            showToastr: function(mensaje, tipo){
                Vue.$toast.open({
                    message: mensaje,
                    type: tipo,
                    position: 'top',
                    duration: 3000
                 
                });
            }

        }
    }
</script>

<style scoped>

img{
    width: 100%
}
    .action{
        cursor: pointer;
    }

    .btn-exta{
        margin-top: 0;
    }
    
    .modal-dialog{
        max-width: 700px;
    }

    .icon-options{
        width: 100%; 
        height: 40px; 
        position: relative;
    }

        .icon-custom{
            display: inline-block; 
            width: 40px; 
            height: 100%; 
            position: absolute; 
            cursor: pointer;
        }

        .pdf{
            right: 60px; 
        }

        .add{
            right: 0; 
        }


</style>