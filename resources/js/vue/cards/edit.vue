<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Card</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Card number</label>
                                    <input type="number" lenght="20" class="form-control" v-model="cards.card">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Pin</label>
                                    <input type="number" lenght="4" class="form-control" v-model="cards.pin">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Activation</label>
                                    <input type="datetime-local" class="form-control" v-model="cards.activation">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Expiration</label>
                                    <input type="date" class="form-control" v-model="cards.expiration">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Balance</label>
                                    <input type="number" class="form-control" v-model="cards.balance">
                                </div>
                            </div>
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
    name:"update-card",
    data(){
        return {
            cards:{
                card:"",
                pin:"",
                activation:"",
                expiration:"",
                balance:"",
                _method:"patch"
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
                this.cards.activation = activation
                this.cards.expiration = expiration
                this.cards.balance = balance
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.post(`/api/cards/${this.$route.params.id}`,this.cards).then(response=>{
                this.$router.push({name:"cardsList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>