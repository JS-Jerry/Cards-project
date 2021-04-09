<template>
    <div class="row">
        <div class="col-12">
            <!-- back button -->
            <div class="col-12 mb-2 text-end">
                <button @click="$router.go(-1)" class="btn btn-primary">Back</button>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Edit Card</h4>
                </div>
                <div class="card-body">
                    <div>
                        <div class="row">
                            <!--Card number -->
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Card number</label>
                                    <p>{{ cards.expiration }}</p>
                                </div>
                            </div>

                            <!--Pin -->
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Pin</label>
                                    <p>{{ cards.pin }}</p>
                                </div>
                            </div>

                            <!--Activation -->
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Activation</label>
                                    <p>{{ cards.activation }}</p>
                                </div>
                            </div>

                            <!--Expiration -->
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Expiration</label>
                                    <p>{{ cards.expiration }}</p>
                                </div>
                            </div>

                            <!--Balance -->
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Balance</label>
                                    <p>{{ cards.balance }}</p>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    export default {
        name:"show-card",
        data(){
            return {
                cards:{
                    card:"",
                    pin:"",
                    activation:"",
                    expiration:"",
                    balance:"",
                }
            }
        },
        mounted(){
            this.showCards()
        },
        methods:{
            async showCards(){
                await this.axios.get(`/api/cards/${this.$route.params.id}`).then(response=>{
                    const { card, pin, activation, expiration, balance } = response.data
                    this.cards.card = card
                    this.cards.pin = pin
                    this.cards.activation = moment(activation).format('YYYY-MM-DD') + " " + moment(activation).format('HH:mm')
                    this.cards.expiration = expiration
                    this.cards.balance = balance / 100
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
</script>