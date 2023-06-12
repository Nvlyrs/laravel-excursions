<script setup>
import Tooltip from './Tooltip.vue';
import axios from 'axios'
import { computed} from 'vue';

const props = defineProps({
    excursion: {
        type: Object,
    },
    auth:{
        type: Object,
    }
});

function addToFavorites() {
    axios.post(route('excursion.saveFavorites'), {
        excursion_id: props.excursion.id,
        user_id: props.auth.user.id
    });
}

let description = computed(
    () => {
        let description = JSON.parse(props.excursion.discription);
        return description;
    }
);

const excursionCoverImage = props.excursion.cover_image != '' ? props.excursion.cover_image : 'https://media.istockphoto.com/id/1453678597/vector/image-vector-symbol-modern-icon-for-website-or-mobile-app.jpg?s=612x612&w=0&k=20&c=k1QrrJ-tc-72xcRou9GAQTlIT4fiZFanp_5wkGXemU0=';

</script>

<template>
    <article
        class="mx-auto bg-white group w-full h-full shadow-md  max-w-md pb-8 rounded-2xl transform duration-500 hover:-translate-y-2 cursor-pointer">
        <section class="content bg-cover bg-center h-64 rounded-2xl"
            :style="{ 'background-image': 'url(' + excursionCoverImage + ')' }">
            <button data-tooltip-target="add-to-favorite-tooltip" @click="addToFavorites" v-if="$page.props.auth.user"
                class="absolute text-white top-3 right-5 hover:text-yellow-200 text-2xl transition-all">
                <font-awesome-icon :icon="['fas', 'heart']" />
            </button>
            <Tooltip id="add-to-favorite-tooltip" content="Добавить в избранное" />
            <div class="flex items-end w-full h-full bg-black bg-opacity-20 text-white text-sm font-bold p-4 rounded-2xl">
                <div class="w-1/2 flex items-center">
                    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    <span>{{ excursion.hits }}</span>
                </div>
                <div class="w-1/2 flex items-center flex-row-reverse">
                    <span data-tooltip-target="rating-tooltip" class="place-items-end">
                        {{ excursion.rating }}
                        <font-awesome-icon :icon="['fas', 'star']" />
                    </span>
                    <Tooltip id="rating-tooltip" content="Рейтинг экскурсии" />
                </div>
            </div>
        </section>
        <div class="my-3 px-4 flex space-x-4">
            <span>
                {{ excursion.type.title }}
            </span>
            <span data-tooltip-target="max-customers-count-tooltip">
                <font-awesome-icon :icon="['fas', 'users']" class="text-indigo-600" />
                {{ excursion.max_customers_count }}
            </span>
            <Tooltip id="max-customers-count-tooltip" content="Максимальное количество экскурсантов" />
            <span data-tooltip-target="duration-tooltip">
                <font-awesome-icon :icon="['fas', 'clock']" class="text-indigo-600" />
                {{ excursion.duration }}
            </span>
            <Tooltip id="duration-tooltip" content="Длительность экскурсии" />
        </div>
        <div class="my-4 px-4 flex w-full justify-between">
            <img class="w-10 h-10 rounded-full " :src="excursion.user.avatar_image" alt="">
            <div class="flex justify-end space-x-1">
                <span class="hd-4 font-normal bg-indigo-600 items-center rounded text-white py-1 px-3">
                    {{ excursion.price }} ₽
                </span>
            </div>
        </div>
        <a :href="route('excursion.display', { id: excursion.id })">
            <div class="px-4">
                <h2 class="mt-2 text-2xl text-gray-700">{{ excursion.title }}</h2>
                <p class="mt-4 text-base font-medium text-gray-500">
                    {{ description.brief_info }}
                </p>
            </div>
        </a>
    </article>
</template>