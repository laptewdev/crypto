<script setup>
defineProps({
  name: String,
  limit: Number,
  sort: String
})

defineEmits(['update:name', 'update:limit', 'update:sort'])
</script>

<template>
<div class="row">
    <div class="col">
        <p>Сокращенное название</p>
        <input
            placeholder="BTC,LTC,BNB"
            type="text"
            :value="name"
            @input="$emit('update:name', $event.target.value)"
        />
    </div>
    <div class="col">
        <p>Сортировка</p>
        <select 
            :value="sort"
            @click="$emit('update:sort', $event.target.value)"
        >
            <option value="-price">Цена</option>
            <option value="rank">Ранг</option>
            <option value="-volume24h">24-часовой объем</option>
        </select>
    </div>
    <div class="col">
        <p>Количество</p>
        <input
            type="number"
            :value="limit"
            @input="$emit('update:limit', $event.target.value)"
        />
    </div>
</div>
</template>