<template>
    <div class="z-50 fixed bottom-0 right-0 mx-6 my-6 sm:w-96 flex flex-col gap-3 transition-all">
        <StatusMessage v-for="message in messages" :text="message.text" :type="message.type" />
    </div>
</template>

<script>
import StatusMessage from './StatusMessage.vue';

export default {
    components: {
        StatusMessage
    },
    data() {
        return {
            messages: [
            ]
        }
    }
}
</script>