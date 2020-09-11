<template>
    <div class="container">
        
        <div class="table-responsive" v-show="isOffer">  
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">DESDE</th>
                        <th class="text-center">HASTA</th>
                        <th class="text-center">DESCRIPCION</th>
                        <th class="text-center">PRECIO ANTES</th>
                        <th class="text-center">PRECIO AHORA</th>
                        <th class="text-center">% DESCUENTO</th>
                        <th class="text-center">X POR PRECIO</th>
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
                        <td class="text-center">{{item.quantity_promo}}</td>
                    </tr>
                </tbody>
            </table>
        </div>  

        <div v-show="!isOffer">
            <div class="no-offers-container">
                <img :src="imgEmpty">
            </div>
             <h2 class="display-5 text-center no-offers-msg">AÚN NO SE HA IMPORTADO NADA</h2>
        </div>

    </div>
    
</template>

<script>

    import axios from 'axios'

    export default{
        props: ['offerId'],
        data(){
            return{
                isOffer:false,
                imgEmpty: 'http://cityposters.com/img/cart.png',
                offers:[]
            }
        },

        mounted(){
            this.getOfferPoster();
        },

        methods:{

            getOfferPoster: function(){
                let url= '/offer-items/'+this.offerId;

                axios.get(url).then(response=>{

                    for(let i=0; i<response.data.length; i++){
                        if(response.data.length > 0){
                            this.offers.push(response.data[i]);
                            this.isOffer= true;
                        }else{
                            this.isOffer= false;
                        }
                        
                    }


                }).catch(err=>{
                    console.log("Error getting data :(");
                })
            },
        }

    }
</script>