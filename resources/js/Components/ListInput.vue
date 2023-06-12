<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    options: {
        type: Object,
        required: true,
    },
    modelValue: {
        type: Number,
        required: true,
    },
});

defineEmits(['update:modelValue']);

</script>

<template>
    <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="selected"
        @change="$emit('update:modelValue', selected)">
        <option v-for="option in options" :value="option.id">{{ option.value }}</option>
    </select>
</template>

<script>
export default {
    data() {
        return {
            selected: 1,
        }
    }
}
</script>