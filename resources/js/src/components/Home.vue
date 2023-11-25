<template>
    <div class="row">
        <div class="col-3">
            <div class="row">
                <div class="row">
                    <SearchForm
                        v-model:name="name"
                        v-model:limit="limit"
                        v-model:sort="sort"
                    />
                </div>
            
                <div class="row crypto-list">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="item in data">
                            <div class="list-group-item-button" @click="afterCryptoId=cryptoId;cryptoId=$event.target.id; crytpoIdActive(cryptoId, afterCryptoId)" :id="item['id']"></div>
                            <div class="list-group-item-text">
                                <h5 class="card-title">{{ item['name'] }}</h5>
                                <p class="card-text">{{ item['price'] }}$</p>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="col">
            {{ cryptoId }}
        </div>
    </div>
    
</template>
<script setup>
import axios from "axios"
import {ref, watchEffect, computed} from 'vue'
import SearchForm from './SearchForm.vue'

const cryptoId = ref()
const afterCryptoId = ref()

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

const crytpoIdActive = (id, afterId) =>{
    if (afterId != null){
        document.getElementById(afterId).parentNode.classList.remove('active')
    }
    document.getElementById(id).parentNode.classList.add('active')
}

</script>

<style>
    .crypto-list{
        height: 500px;
        overflow: hidden;
        overflow-y: scroll;
    }
    .crypto-list::-webkit-scrollbar{
        width: 6px;
    }
    .crypto-list::-webkit-scrollbar-track{
        background-color: #000000;
    }
    .crypto-list::-webkit-scrollbar-thumb{
        background-color: #7cfaa2;
        border-radius: 20px;
    }

    .list-group-item-button{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        
    }

    .list-group-item.active{
        background-color: #7cfaa27a;
        border-color: #7cfaa2;
    }
</style>