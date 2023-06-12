<script setup>
import CommentsFrom from './CommentsFrom.vue';
import CommentsArticle from './CommentsArticle.vue';

defineProps({
    excursionComments:{
        type: Object
    },
    excursionId:{
        type: Number
    }
});

</script>

<template>
    <div class="flex justify-between items-center mb-6">
        <h3 class="hd-3">Обсуждение ({{excursionComments.length}})</h3>
    </div>
    <CommentsFrom :excursionId="excursionId" />
    <CommentsArticle v-for="comment in excursionComments" :comment="comment" />
</template>