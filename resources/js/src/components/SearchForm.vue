<script setup>
defineProps({
  name: String,
})

defineEmits(['update:name',])
</script>

<template>
<div class="row searc-form">
    <div class="col">
        <h5>Сокращенное название</h5>
        <input
            placeholder="BTCUSDT"
            type="text"
            :value="name"
            @input="$emit('update:name', $event.target.value)"
        />
    </div>
</div>
</template>

<style>
.searc-form{
    margin-bottom: 10px;
}
</style>