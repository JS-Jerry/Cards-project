<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"cardsAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Cards</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Card Number</th>
                                    <th>Expiration</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="cards.length > 0">
                                <tr v-for="(card,key) in cards" :key="key">
                                    <td>{{ card.id }}</td>
                                    <td>{{ card.card }}</td>
                                    <td>{{ card.expiration }}</td>
                                    <td>
                                        <router-link :to='{name:"cardsEdit",params:{id:card.id}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteCard(card.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Cards Found</td>
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
export default {
    name:"cards",
    data(){
        return {
            cards:[]
        }
    },
    mounted(){
        this.getCards()
    },
    methods:{
        async getCards(){
            await this.axios.get('/api/cards').then(response=>{
                this.cards = response.data
            }).catch(error=>{
                console.log(error)
                this.cards = []
            })
        },
        deleteCard(id){
            if(confirm("Are you sure to delete this card?")){
                this.axios.delete(`/api/cards/${id}`).then(response=>{
                    this.getCards()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>