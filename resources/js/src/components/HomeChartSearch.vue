<script setup>
defineProps({
  interval: String,
  startTime: String,
  endTime: String,
})

defineEmits(['update:interval', 'update:startTime', 'update:endTime'])
</script>

<template>
<div class="row searc-form">
    <div class="col">
        <h5>Интервал</h5>
        <!-- <input
            placeholder="1m"
            type="text"
            :value="interval"
            @input="$emit('update:interval', $event.target.value)"
        /> -->
        <select name="" id="" :value="interval" @input="$emit('update:interval', $event.target.value)">
            <option value="1m">1m</option>
            <option value="5m">5m</option>
            <option value="1h">1h</option>
            <option value="12h">12h</option>
        </select>
    </div>
    <div class="col">
        <h5>Дата начала торгов</h5>
        <input
            placeholder=""
            type="datetime-local"
            :value="startTime"
            @input="$emit('update:startTime', $event.target.value)"
        />
    </div>
    <div class="col">
        <h5>Конец торгов</h5>
        <input
            placeholder=""
            type="datetime-local"
            :value="endTime"
            @input="$emit('update:endTime', $event.target.value)"
        />
    </div>
</div>
</template>

<style>
.searc-form{
    margin-bottom: 10px;
}
</style>