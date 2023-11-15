<template>
    <div class="row">
        <SearchForm
            v-model:name="name"
            v-model:limit="limit"
            v-model:sort="sort"
        />
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for="item in data">
            <div class="card crypto-table__cell">
                <div class="card-body">
                    <h5 class="card-title">{{ item['name'] }}</h5>
                    <p class="card-text">{{ item['price'] }}$</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import axios from "axios"
import {ref, watchEffect, computed} from 'vue'
import SearchForm from './SearchForm.vue'

const limit = ref(100)
const name = ref("")
const sort = ref("-price")

const data = ref([])

const apiUrl = computed(()=>{
    return `api/cryptorank_home_data?name=${name.value}&limit=${limit.value}&sort=${sort.value}`
})

const getData = () => {
    axios.get(apiUrl.value)
    .then(res => data.value = res.data)
    .catch(error => console.log(error));
}

watchEffect(() => {getData()})



</script>