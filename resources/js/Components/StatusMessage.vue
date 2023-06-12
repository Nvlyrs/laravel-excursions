<script setup>

</script>

<template>
    <div v-if="!close" class="bg-white shadow p-4 border-b-4 border-solid border-red-500 rounded">
        <div class="flex align-center justify-between gap-3 mb-3">
            <h4>Ошибка!</h4>
            <font-awesome-icon @click="onClose" class="cursor-pointer" icon="fa-solid fa-xmark" />
        </div>
        <div>
            <p>{{ text }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            close: false,
        }
    },
    props: {
        type: {
            type: Number,
            required: true
        },
        text: {
            type: String,
            required: true
        }
    },
    methods: {
        onClose() {
            this.close = true;
        }
    }
}
</script>