<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextareaInput from '@/Components/TextareaInput.vue';

const props = defineProps({
    excursionId: {
        type: Number
    }
});


const form = useForm({
    message: '',
    rating: 0.0,
    excursionId: props.excursionId,
});


function submit() {
    form.post(route('excursion.saveComment'));
}

</script>



<template>
    <form class="mb-6 relative" @submit.prevent="submit">
        <div class="absolute bg-gray-100 bg-opacity-70 inset-0 z-30 rounded-md flex justify-center items-center" v-if="!$page.props.auth.user">
            <span class="text-center w-72">Чтобы оставлять комментарии и ставить оценки необходимо зарегистрироваться на сайте, или войти в уже существующий профиль.</span>
        </div>
        <div class="mb-4 bg-white rounded-lg rounded-t-lg">
            <TextareaInput v-model="form.message" class="w-full h-52"
                placeholder="Поделитесь вашими впечатлениями об экскурии..." />
        </div>
        <div class="flex justify-between items-center">
            <button type="submit" class="btn" >
                Отправить
            </button>
            <div>
                <vue3-star-ratings v-model="form.rating" :showControl="false" :starSize="22" inactiveColor="#e5e7eb" />
            </div>
        </div>
    </form>
</template>