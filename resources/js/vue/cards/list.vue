<template>
    <div class="row">
        <div class="col-12">
            <!-- create button -->
            <div class="col-12 mb-2 text-end">
                <router-link :to='{name:"cardsAdd"}' class="btn btn-primary">Create</router-link>
            </div>

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

                            <!-- elemets list -->
                            <tbody v-if="typeof cards !== 'undefined' && typeof cards === 'object' && Object.keys(cards).length > 0">
                                <tr v-for="(card,key) in cards.data" :key="key">
                                    <td>{{ card.id }}</td>
                                    <td>{{ card.card }}</td>
                                    <td>{{ card.expiration }}</td>
                                    <td>
                                        <router-link :to='{name:"cardsEdit",params:{id:card.id}}' class="btn btn-success">Edit</router-link>
                                        <router-link :to='{name:"cardsShow",params:{id:card.id}}' class="btn btn-info">Show</router-link>
                                        <button type="button" @click="deleteCard(card.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>

                            <!-- if 0 elemets -->
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Cards Found</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- pagination -->
                        <div class="d-flex justify-content-center">
                            <pagination :data="cards" :limit="2" :align="center" :show-disabled="true" @pagination-change-page="getResults">
                                <span slot="prev-nav">&lt; Previous</span>
                                <span slot="next-nav">Next &gt;</span>
                            </pagination>
                        </div>
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
            cards:{}
        }
    },
    mounted(){
        this.getResults()
    },
    methods:{
        // get result
        async getResults(page = 1) { // deafault 1 page
            await this.axios.get('/api/cards?page=' + page).then(response=>{
                this.cards = response.data
            }).catch(error=>{
                console.log(error)
                this.cards = {}
            })
        },
        // delete row
        deleteCard(id){
            if(confirm("Are you sure to delete this card?")){
                this.axios.delete(`/api/cards/${id}`).then(response=>{
                    this.getResults()
                    console.log(response.data)
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>