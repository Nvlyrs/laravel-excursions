<template>
    <li class="btn-time" @click="setSelected">
        {{ value }}
    </li>
</template>

<script>
export default {

    props: {
        value: {
            type: String,
            required: true
        }
    },
};
</script>