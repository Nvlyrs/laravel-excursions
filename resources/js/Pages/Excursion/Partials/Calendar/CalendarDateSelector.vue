<script setup>
import dayjs from "dayjs";
</script>

<template>
    <div class="flex h-max align-center">
        <div v-if="!dayjs(selectedDate).isBefore(dayjs())" class="h-max">
            <font-awesome-icon class="transition cursor-pointer active:text-indigo-500 hover:-translate-x-1    "
                @click="selectPrevious" icon="fa-solid fa-arrow-left" />
        </div>
        <div @click="selectCurrent" class="cursor-pointer transition-colors mx-2 active:text-indigo-500">Сегодня</div>
        <div class="h-max">
            <font-awesome-icon class="transition cursor-pointer active:text-indigo-500 hover:translate-x-1"
                @click="selectNext" icon="fa-solid fa-arrow-right" />
        </div>
    </div>
</template>
  
<script>

export default {
    name: "CalendarModeSelector",

    props: {
        currentDate: {
            type: String,
            required: true
        },

        selectedDate: {
            type: Object,
            required: true
        }
    },

    methods: {
        selectPrevious() {
            let newSelectedDate = dayjs(this.selectedDate).subtract(1, "month");
            this.$emit("dateSelected", newSelectedDate);
        },

        selectCurrent() {
            let newSelectedDate = dayjs(this.currentDate);
            this.$emit("dateSelected", newSelectedDate);
        },

        selectNext() {
            let newSelectedDate = dayjs(this.selectedDate).add(1, "month");
            this.$emit("dateSelected", newSelectedDate);
        }
    }
};
</script>
  