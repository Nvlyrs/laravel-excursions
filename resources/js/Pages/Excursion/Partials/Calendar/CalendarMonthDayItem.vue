<template>
    <li class="day-item shadow" :class="{
        'bg-gray-300': !day.isCurrentMonth,
        'border-indigo-600 hover:bg-indigo-100': isAllowed,
        'bg-gray-100': !isAllowed
    }">
        <span>{{ label }}</span>
        <span v-if="isAllowed" class="sm:inline-block hidden">{{ day.dateFramePrace }}₽</span>
    </li>
</template>
  
<script>
import dayjs from "dayjs";

export default {
    name: "CalendarMonthDayItem",

    props: {
        day: {
            type: Object,
            required: true
        },

        isCurrentMonth: {
            type: Boolean,
            default: false
        },

        isAllowed: {
            type: Boolean,
            default: false
        },

        isToday: {
            type: Boolean,
            default: false
        }
    },

    computed: {
        label() {
            return dayjs(this.day.date).format("D");
        }
    }
};
</script>
  