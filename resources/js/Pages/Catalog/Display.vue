<script setup>
import LayoutTemplate from '@/Layouts/LayoutTemplate.vue';
import StatusMessagesBar from '@/Components/StatusMessagesBar.vue';
import ExcursionCard from '@/Components/ExcursionCard.vue';
import DateInput from '@/Components/DateInput.vue';
import ListInput from '@/Components/ListInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import DefaultBlock from '@/Components/DefaultBlock.vue';
import Checkbox from '@/Components/Checkbox.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import dayjs from 'dayjs';

defineProps({
    excursions: {
        type: Object,
    },
    auth: {
        type: Object,
    }
});


const searchForm = useForm({
    city: 1,
    start_date: dayjs().format("YYYY-MM-DD"),
    end_date: '',
    sorting_type: 1,
    sorting_criteria: 1,
    first_price: 1000,
    last_price: 6000,
    type_group: false,
    show_favorites: false,
    type_individual: false
});


function submit() {
    searchForm.post(route('catalog.display'));
}

</script>

<template>
    <Head title="Каталог экскурсий" />

    <LayoutTemplate>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <DefaultBlock>
                    <h1 class="hd-1">
                        Экскурсии в городе <span
                            class="underline underline-offset-3 decoration-8 decoration-indigo-600">Волгоград</span></h1>
                    <p class="pr-gray">Мы нашли {{ excursions.length }}. Выбирайте
                        маршрут по городу и бронируйте билеты онлайн!</p>
                </DefaultBlock>
                <div class="grid gap-7 md:grid-cols-4">
                    <form action="" method="post" @submit.prevent="submit">
                        <div class="flex flex-col gap-4 col-start-1 col-end-2">
                            <DefaultBlock>
                                <button class="btn w-full">Поиск</button>
                            </DefaultBlock>
                            <DefaultBlock class="space-y-2">
                                <h6 class="hd-6 mb-2">Мои избранные</h6>
                                <label class="flex items-center">
                                    <Checkbox name="show_favorites" v-model="searchForm.show_favorites" />
                                    <span class="ml-2 text-sm text-gray-600">Показывать только мои избранные</span>
                                </label>
                            </DefaultBlock>
                            <DefaultBlock class="space-y-2">
                                <h6 class="hd-6 mb-2">Город</h6>
                                <div>
                                    <InputLabel for="sort_by" value="В каком городе ищем" />
                                    <ListInput id="city" name="city" v-model="searchForm.city" :options="{
                                        0: {
                                            id: 1,
                                            value: 'Волгоград'
                                        }
                                    }" />
                                </div>
                            </DefaultBlock>
                            <DefaultBlock class="space-y-2">
                                <h6 class="hd-6 mb-2">Даты</h6>
                                <div>
                                    <InputLabel for="sort_by" value="Начальная" />
                                    <DateInput v-model="searchForm.start_date" />
                                </div>
                                <div>
                                    <InputLabel for="sort_by" value="Конечная" />
                                    <DateInput v-model="searchForm.end_date" />
                                </div>
                            </DefaultBlock>
                            <DefaultBlock class="space-y-2">
                                <h6 class="hd-6 mb-2"> Порядок </h6>
                                <div>
                                    <InputLabel for="sort_by" value="Сортировать по" />
                                    <ListInput id="sort_by" name="sort_by" v-model="searchForm.sorting_criteria" :options="{
                                        0: {
                                            id: 1,
                                            value: 'Популярности'
                                        },
                                        1: {
                                            id: 2,
                                            value: 'Цене'
                                        },
                                        2: {
                                            id: 3,
                                            value: 'Рейтингу'
                                        }
                                    }" />
                                </div>
                                <div>
                                    <InputLabel for="sort_by" value="Тип" />
                                    <ListInput id="sort_type" name="sort_type" v-model="searchForm.sorting_type" :options="{
                                        0: {
                                            id: 1,
                                            value: 'На убывание'
                                        },
                                        1: {
                                            id: 2,
                                            value: 'На возрастание'
                                        }
                                    }" />
                                </div>
                            </DefaultBlock>
                            <DefaultBlock class="space-y-2">
                                <h6 class="hd-6 mb-2">Стоимость</h6>
                                <InputLabel for="first_price" value="От" />
                                <TextInput name="first_price" v-model="searchForm.first_price" />
                                <InputLabel for="last_price" value="До" />
                                <TextInput name="last_price" v-model="searchForm.last_price" />
                            </DefaultBlock>
                            <DefaultBlock class="space-y-2">
                                <h6 class="hd-6 mb-2">Тип экскурсии</h6>
                                <label class="flex items-center">
                                    <Checkbox name="type_individual" v-model="searchForm.type_individual" />
                                    <span class="ml-2 text-sm text-gray-600">Индивидуальная</span>
                                </label>
                                <label class="flex items-center">
                                    <Checkbox name="type_group" v-model="searchForm.type_group" />
                                    <span class="ml-2 text-sm text-gray-600">Групповая</span>
                                </label>
                            </DefaultBlock>
                        </div>
                    </form>
                    <div class="grid grid-cols-1 h-max md:grid-cols-2 gap-10 col-start-2 col-end-5 items-start">
                        <ExcursionCard v-if="!excursion" v-for="excursion in excursions" :auth="$page.props.auth" :excursion="excursion" />
                        <span v-else class="hd-1 text-indigo-200">
                            Похоже, по вашему запросу ничего не найдено...
                        </span>
                    </div>
                </div>

                <nav aria-label="Page navigation example" class="w-max my-0 ml-auto mr-0">
                    <ul class="inline-flex items-center -space-x-px">
                        <li>
                            <a href="#"
                                class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#"
                                class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page"
                                class="z-10 px-3 py-2 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                        </li>
                        <li>
                            <a href="#"
                                class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                        </li>
                        <li>
                            <a href="#"
                                class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </LayoutTemplate>
    <StatusMessagesBar />
</template>