<template>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for="item in data">
            <div class="crypto-table__cell">
                <p>{{ item['name'] }}</p>
                <p>{{ item['price'] }}$</p>
            </div>
        </div>
    </div>
</template>
<script setup>
import axios from "axios"
import {ref, onMounted} from 'vue'

const data = ref([])
const getData = () => {
    axios.get('api/cryptorank')
    .then(res => data.value = res.data)
    .catch(error => console.log(error))
}
onMounted(() => getData())

</script>