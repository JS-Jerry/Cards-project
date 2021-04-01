<template>
    <div class="row">
        <div class="col-12">
            <!-- back button -->
            <div class="col-12 mb-2 text-end">
                <button @click="$router.go(-1)" class="btn btn-primary">Back</button>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Add Card</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <!--Card number -->
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Card number</label>
                                    <input type="number" required length="20" class="form-control" v-model="cards.card">
                                    <small class="text-danger">{{ error_card }}</small>
                                </div>
                            </div>

                            <!--Pin -->
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Pin</label>
                                    <input type="number" required minlength="4" length="4" class="form-control" v-model="cards.pin">
                                    <small class="text-danger">{{ error_pin }}</small>
                                </div>
                            </div>

                            <!--Activation -->
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Activation</label>
                                    <input type="datetime-local" required  class="form-control" v-model="cards.activation">
                                    <small class="text-danger">{{ error_activation }}</small>
                                </div>
                            </div>

                            <!--Expiration -->
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Expiration</label>
                                    <input type="date" required  class="form-control" v-model="cards.expiration">
                                    <small class="text-danger">{{ error_expiration }}</small>
                                </div>
                            </div>

                            <!--Balance -->
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Balance</label>
                                    <input type="number" step="0.01" class="form-control" v-model="cards.balance">
                                    <small class="text-danger">{{ error_balance }}</small>
                                </div>
                            </div>

                            <!--save button -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"add-card",
        data(){
            return {
                cards:{
                    card:"",
                    pin:"",
                    activation:"",
                    expiration:"",
                    balance:""
                },

                error_card:"",
                error_pin:"",
                error_activation:"",
                error_expiration:"",
                error_balance:""
            }
        },
        methods:{
            async create(){
                // reset error info
                this.error_card = ""
                this.error_pin = ""
                this.error_activation = ""
                this.error_expiration = ""
                this.error_balance = ""

                // first validation
                if(this.cards.card.length == 20 && this.cards.pin.length == 4) {
                    await this.axios.post('/api/cards',this.cards).then(response=>{
                        this.$router.push({name:"cardsList"})
                    }).catch(error=>{
                        // error info
                        this.error_card = error.response.data.errors.card
                        this.error_pin = error.response.data.errors.pin
                        this.error_activation = error.response.data.errors.activation
                        this.error_expiration = error.response.data.errors.expiration
                        this.error_balance = error.response.data.errors.balance
                    })
                } else {
                    // error info
                    if(this.cards.card.length != 20) {
                        this.error_card = 'A card number must have 20 digits'
                    }
                    if(this.cards.pin.length != 4) {
                        this.error_pin = 'A pin must have 4 digits'
                    }
                }
            }
        }
    }
</script>