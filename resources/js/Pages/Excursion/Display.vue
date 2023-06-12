<script setup>
import LayoutTemplate from '@/Layouts/LayoutTemplate.vue';
import Calendar from './Partials/Calendar/Calendar.vue';
import Comments from './Partials/Comments/Comments.vue';
import StatusMessagesBar from '@/Components/StatusMessagesBar.vue';
import DefaultCarousel from '@/Components/DefaultCarousel.vue';
import DefaultBlock from '@/Components/DefaultBlock.vue';
import { Head } from '@inertiajs/vue3';
import { computed, toRefs } from 'vue';

const props = defineProps({
    auth_user: {
        type: Boolean,
    },
    excursion: {
        type: Object,
    },
});

let gallery = computed(
    () => {
        let gallery = JSON.parse(props.excursion.gallery);
        gallery.unshift(props.excursion.cover_image);
        return gallery ? gallery : ['https://media.istockphoto.com/id/1453678597/vector/image-vector-symbol-modern-icon-for-website-or-mobile-app.jpg?s=612x612&w=0&k=20&c=k1QrrJ-tc-72xcRou9GAQTlIT4fiZFanp_5wkGXemU0='];
    }
);

let description = computed(
    () => {
        let description = JSON.parse(props.excursion.discription);
        return description;
    }
);

</script>

<template>
    <Head :title="excursion.title" />

    <LayoutTemplate>
        <DefaultCarousel :gallery="gallery" />
        <section class="py-5 bg-white">
            <div class="max-w-7xl mx-auto px-4  sm:px-6 lg:px-8">
                <div class="mt-2 mb-6 flex space-x-4 w-max mx-auto">
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
                <div class="mx-auto mt-0 mb-4 w-max">
                    <div class="flex flex-col items-center">
                        <img class="w-16  h-16 md:w-20 md:h-20 rounded-full" :src="'/' + excursion.user.avatar_image"
                            alt="Medium avatar" />
                        {{ excursion.user.name }}
                    </div>
                </div>
                <div class="prose-lead:md:prose-lg prose-lead:lg:prose-xl">
                    <div class="mb-5">
                        <h1 class="hd-2 text-center mb-3">{{ excursion.title }}</h1>
                        <div class="flex justify-center items-center space-x-3">
                            <div class="flex space-x-1 items-center bg-indigo-100 rounded py-1 px-3">
                                <span>{{ excursion.hits }}</span>
                                <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex bg-indigo-100 items-center rounded py-1 px-3 space-x-2">
                                <vue3-star-ratings v-model="excursion.rating" :showControl="false" :starSize="20"
                                    inactiveColor="#cfcfcf" :disableClick="true" />
                                <span class="block">{{ excursion.rating }}</span>
                            </div>
                        </div>
                    </div>
                    <p class="lead">
                        {{ description.main_info }}
                    </p>
                </div>
                <div class="text-center my-4 flex flex-col items-center">
                    <div class="md:prose-lg lg:prose-2xl prose- mb-3">
                        <span>{{ excursion.price }}₽</span>
                        <span v-if="excursion.type.id == 1" class="text-gray-500"> за экскурсию</span>
                        <span v-else class="text-gray-500"> за человека</span>
                    </div>
                    <a class="btn" href="#calendar">Оформить заказ</a>
                </div>
            </div>
        </section>

        <section class="pt-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <DefaultBlock>
                    <div>
                        <div class="px-4 sm:px-0">
                            <h2 class="hd-2">Информация об экскурсии</h2>
                        </div>
                        <div class="mt-6 border-t border-gray-100">
                            <dl class="divide-y divide-gray-100">
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="hd-6">Места</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                        <ul>
                                            <li v-for="place in description.places">{{ place }}</li>
                                        </ul>
                                    </dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="hd-6">Начальная и конечная точки</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                        <span>Место начала - {{ description.start_point }}</span> <br>
                                        <span>Место окончания - {{ description.end_point }}</span>
                                    </dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="hd-6">Доступные языки</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                        <ul>
                                            <li v-for="language in description.languages">{{ language }}</li>
                                        </ul>
                                    </dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="hd-6">Важная информация</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                        {{ description.important_info }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </DefaultBlock>
            </div>
        </section>

        <section id="calendar" class="pt-5 pb-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <DefaultBlock>
                    <h2 class="hd-2">Бронирование экскурсии</h2>
                    <Calendar :excursionPrice="excursion.price" :excurtionType="excursion.type.id"
                        :excursionDateFrames="excursion.date_frames"
                        :excursionMaxCustomersCount="excursion.max_customers_count" />
                </DefaultBlock>
            </div>
        </section>

        <section class="bg-white py-8 lg:py-16">
            <div class="max-w-2xl mx-auto px-4">
                <Comments :excursionComments="excursion.comments" :excursionId="excursion.id" />
            </div>
        </section>
    </LayoutTemplate>
    <StatusMessagesBar />
</template>
