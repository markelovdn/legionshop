<template>
    <div class="accordion" id="accordionAddress">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingAddress">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAddress" aria-expanded="false" aria-controls="collapseAddress">
                    Адреса
                </button>
            </h2>
            <div id="collapseAddress" class="accordion-collapse collapse" aria-labelledby="headingAddress" data-bs-parent="#accordionAddress">
                <div class="accordion-body">
                    <div>
                        <div class="row">
                            <div v-for="address in addresses" :key="address.id" class="card mb-2 mx-1" style="width: 18rem;">
                                <div class="card-body mb-3">
                                    <p class="card-text">{{address.address}}</p>
                                    <div v-if="address.main==1" class="form-check form-switch">
                                        <input  checked class="form-check-input" type="checkbox" role="switch">
                                        <label class="form-check-label">Основной</label>
                                    </div>
                                    <div v-else class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch">
                                        <label class="form-check-label">Сделать основным</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Новый адрес</label>
                                <input v-model="address" class="form-control">
                                <label>Сделать основным</label>
                                <input type="checkbox">
                                <br>
                                <button @click="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddressComponent",
    props: ['addresses', 'user'],
    data () {
        return {
            address: []
        }
    },
    methods: {
        submit () {
            const params = {
                userId: this.user.id,
                address: this.address,
            }
            axios.post('/profile/update', params)
                .catch(error => {

                })
                .finally(() => {
                    console.log(this.address)
                })
        }
    },
    mounted() {
        console.log(this.user)
    }
}
</script>

<style scoped>

</style>
