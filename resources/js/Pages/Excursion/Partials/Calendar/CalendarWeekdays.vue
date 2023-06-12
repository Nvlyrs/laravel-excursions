<template>
    <ol class="grid grid-cols-7 gap-2 text-center">
        <li class="p-1 bg-gray-100 rounded-md" v-for="weekday in weekdays" :key="weekday">{{ weekday }}</li>
    </ol>
</template>
  
<script>
const WEEKDAYS = ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"];

export default {
    name: "CalendarWeekdays",

    computed: {
        weekdays() {
            return WEEKDAYS;
        }
    }
};
</script>
  
<style scoped>
.day-of-week {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
}

.day-of-week>* {
    text-align: right;
    padding-right: 5px;
}
</style>
  