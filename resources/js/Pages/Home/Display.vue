<script setup>
import LayoutTemplate from '@/Layouts/LayoutTemplate.vue';
import DefaultBlock from '@/Components/DefaultBlock.vue';
import ListInput from '@/Components/ListInput.vue';
import DateInput from '@/Components/DateInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import ExcursionCard from '@/Components/ExcursionCard.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import Polocies from '@/Components/Policies.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Navigation } from 'swiper';
import { Swiper, SwiperSlide } from 'swiper/vue';
import Button from '@/Components/Button.vue';

import 'swiper/css';
import 'swiper/css/navigation';

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
    type: 1,
    start_date: '',
    end_date: '',
});

const contactsForm = useForm({
    name: '',
    email: '',
    message: ''
});

function submit() {
    searchForm.post(route('catalog.search'));
}

function submitContacts() {
    searchForm.post(route('contacts.send'));
}

</script>

<template>
    <Head title="Главная" />

    <LayoutTemplate>
        <section>
            <div class="relative 
                bg-indigo-500 
               
                bg-gradient-to-b from-indigo-500 to-indigo-700
                md:py-32 ">
                <div class="absolute inset-x-0 bottom-0">
                    <svg viewBox="0 0 224 12" fill="currentColor" class="w-full -mb-1 text-white"
                        preserveAspectRatio="none">
                        <path
                            d="M0,0 C48.8902582,6.27314026 86.2235915,9.40971039 112,9.40971039 C137.776408,9.40971039 175.109742,6.27314026 224,0 L224,12.0441132 L0,12.0441132 L0,0 Z">
                        </path>
                    </svg>
                </div>
                <div class="py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl lg:py-20">
                    <div class="relative max-w-2xl sm:mx-auto sm:max-w-xl md:max-w-2xl sm:text-center">
                        <h1 class="hd-1 text-white mb-10 p-5 w-max my-0 mx-auto">
                            Поиск экскурсий
                        </h1>
                        <form :action="route('catalog.display')" @submit.prevent="submit"
                            class="flex flex-col md:flex-nowrap flex-wrap items-center w-full mb-4 md:flex-row justify-center"
                            method="POST">

                            <DefaultBlock class="flex items-center space-x-4">
                                <div>
                                    <InputLabel for="city" value="Город" />
                                    <ListInput id="city" name="city" v-model="searchForm.city" :options="{
                                        0: {
                                            id: 1,
                                            value: 'Волгоград'
                                        }
                                    }" />
                                </div>
                                <div>
                                    <InputLabel for="type" value="Тип" />
                                    <ListInput id="type" name="type" v-model="searchForm.type" :options="{
                                        0: {
                                            id: 1,
                                            value: 'Индивидуальная'
                                        },
                                        1: {
                                            id: 2,
                                            value: 'Групповая'
                                        }
                                    }" />
                                </div>
                                <div>
                                    <InputLabel value="Временные рамки" />
                                    <DateInput v-model="searchForm.start_date" />
                                    <DateInput v-model="searchForm.end_date" />
                                </div>
                                <Button :disabled="searchForm.processing">Найти</Button>
                            </DefaultBlock>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white">
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <div class="max-w-screen-md mb-8 lg:mb-16">
                    <h2 class="hd-2 mb-2">Создано путешественниками для путешественников</h2>
                    <p class="subtitle">Первосходство, которое вы ищите</p>
                </div>
                <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                    <div class="flex flex-col items-center md:block">
                        <div
                            class="flex text-3xl justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 ">
                            <font-awesome-icon :icon="['fas', 'users']" />
                        </div>
                        <h5 class="hd-5 mb-2">Опытные гиды</h5>
                        <p class="text-gray-500 dark:text-gray-400">Опытные гиды могут провести экскурсии по историческим
                            местам, показать красивые природные достопримечательности, рассказать о местных традициях и
                            культуре, а также помочь с выбором мест для отдыха и развлечений.</p>
                    </div>
                    <div class="flex flex-col items-center md:block">
                        <div
                            class="flex text-3xl justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 ">
                            <font-awesome-icon :icon="['fas', 'lock']" />
                        </div>
                        <h5 class="hd-5 mb-2">Безопасность</h5>
                        <p class="text-gray-500 dark:text-gray-400">Мы обеспечивает безопасность сделок для клиентов,
                            сотрудничая только с проверенными партнерами.</p>
                    </div>
                    <div class="flex flex-col items-center md:block">
                        <div
                            class="flex text-3xl justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12">
                            <font-awesome-icon :icon="['fas', 'headset']" />
                        </div>
                        <h5 class="hd-5 mb-2">Заботливая поддержка 24/7</h5>
                        <p class="text-gray-500 dark:text-gray-400">
                            Мы стремимся к тому, чтобы каждый клиент получал не только высококачественные услуги, но и
                            профессиональную помощь в их сопровождении.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white">
            <div class="pt-8 px-4 mx-auto max-w-screen-xl sm:pt-16 lg:px-6">
                <div class="max-w-screen-md mb-8 lg:mb-16">
                    <h2 class="hd-2 mb-2">Популярные экскурсии в вашем регионе</h2>
                    <p class="subtitle">Для корректной работы необходимо разрелить доступ к текущей геопозиции</p>
                </div>
            </div>
            <swiper
                :breakpoints="{ 600: { slidesPerView: 1, navigation: { enabled: false } }, 900: { slidesPerView: 2 }, 1100: { slidesPerView: 3, } }"
                :space-between="50" :navigation="{
                    prevEl: prev,
                    nextEl: next,
                }" class="
                        [&>.swiper-wrapper]:py-6 
                        [&>.swiper-button-prev]:btn
                        [&>.swiper-button-prev]:px-6 
                        [&>.swiper-button-prev]:py-8 
                        [&>.swiper-button-next]:btn
                        [&>.swiper-button-next]:px-6 
                        [&>.swiper-button-next]:py-8 ">
                <swiper-slide v-for="excursion in excursions">
                    <ExcursionCard :excursion="excursion" :auth="$page.props.auth" />
                </swiper-slide>
            </swiper>
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6 flex flex-col justify-center items-center">
                <p class="pr-gray-md mb-3">Вы можете найти еще больше экскурсий в каталоге!</p>
                <button type="button" class="btn">
                    <a :href="route('catalog.display')">Перейти в каталог</a>
                </button>
            </div>
        </section>
        <section class="backdrop-blur bg-indigo-500 relative overflow-hidden">
            <div
                class="bg-fixed bg-[url('https://static.tildacdn.com/tild3433-6439-4161-b664-343539636266/62560186_l.jpg')] scale-105  -z-10 blur bg-no-repeat bg-cover bg-center absolute h-full w-full">

            </div>
            <div
                class="container flex md:flex-row flex-col items-center py-8 px-4 md:space-x-14  mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <div class="lg:max-w-xs lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
                    <img class="object-cover object-center rounded" alt="hero" src="/images/data/mobile.png">
                </div>
                <div
                    class="bg-white rounded-lg py-8 md:px-12 px-5 lg:flex-grow md:w-1/2 flex flex-col md:items-start md:text-left items-center text-center">
                    <h2 class="hd-2 mb-3">Мобильное приложение</h2>
                    <p class="pr-gray-md">
                        Наше приложение позволяет быстро и удобно выбрать экскурсию, забронировать ее и оплатить онлайн. Вы
                        можете выбрать удобный для вас способ оплаты и получить подтверждение бронирования на свой телефон.
                    </p>
                    <img src="/images/data/mobile-qr.png" class="mx-auto my-0" alt="http://127.0.0.1:8000/">
                    <div class="flex lg:flex-row md:flex-col mx-auto my-0">
                        <button
                            class="bg-gray-100 inline-flex py-3 px-5 rounded-lg items-center hover:bg-gray-200 focus:outline-none transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                                viewBox="0 0 512 512">
                                <path
                                    d="M99.617 8.057a50.191 50.191 0 00-38.815-6.713l230.932 230.933 74.846-74.846L99.617 8.057zM32.139 20.116c-6.441 8.563-10.148 19.077-10.148 30.199v411.358c0 11.123 3.708 21.636 10.148 30.199l235.877-235.877L32.139 20.116zM464.261 212.087l-67.266-37.637-81.544 81.544 81.548 81.548 67.273-37.64c16.117-9.03 25.738-25.442 25.738-43.908s-9.621-34.877-25.749-43.907zM291.733 279.711L60.815 510.629c3.786.891 7.639 1.371 11.492 1.371a50.275 50.275 0 0027.31-8.07l266.965-149.372-74.849-74.847z">
                                </path>
                            </svg>
                            <span class="ml-4 flex items-start flex-col leading-none">
                                <span class="text-xs text-gray-600 mb-1">Скачать с</span>
                                <span class="title-font font-medium">Google Play</span>
                            </span>
                        </button>
                        <button
                            class="bg-gray-100 inline-flex py-3 px-5 rounded-lg items-center lg:ml-4 md:ml-0 ml-4 md:mt-4 mt-0 lg:mt-0 hover:bg-gray-200 focus:outline-none transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                                viewBox="0 0 305 305">
                                <path
                                    d="M40.74 112.12c-25.79 44.74-9.4 112.65 19.12 153.82C74.09 286.52 88.5 305 108.24 305c.37 0 .74 0 1.13-.02 9.27-.37 15.97-3.23 22.45-5.99 7.27-3.1 14.8-6.3 26.6-6.3 11.22 0 18.39 3.1 25.31 6.1 6.83 2.95 13.87 6 24.26 5.81 22.23-.41 35.88-20.35 47.92-37.94a168.18 168.18 0 0021-43l.09-.28a2.5 2.5 0 00-1.33-3.06l-.18-.08c-3.92-1.6-38.26-16.84-38.62-58.36-.34-33.74 25.76-51.6 31-54.84l.24-.15a2.5 2.5 0 00.7-3.51c-18-26.37-45.62-30.34-56.73-30.82a50.04 50.04 0 00-4.95-.24c-13.06 0-25.56 4.93-35.61 8.9-6.94 2.73-12.93 5.09-17.06 5.09-4.64 0-10.67-2.4-17.65-5.16-9.33-3.7-19.9-7.9-31.1-7.9l-.79.01c-26.03.38-50.62 15.27-64.18 38.86z">
                                </path>
                                <path
                                    d="M212.1 0c-15.76.64-34.67 10.35-45.97 23.58-9.6 11.13-19 29.68-16.52 48.38a2.5 2.5 0 002.29 2.17c1.06.08 2.15.12 3.23.12 15.41 0 32.04-8.52 43.4-22.25 11.94-14.5 17.99-33.1 16.16-49.77A2.52 2.52 0 00212.1 0z">
                                </path>
                            </svg>
                            <span class="ml-4 flex items-start flex-col leading-none">
                                <span class="text-xs text-gray-600 mb-1">Скачать с</span>
                                <span class="title-font font-medium">App Store</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white" id="contacts">
            <div
                class="container flex sm:flex-nowrap flex-wrap md:flex-row flex-col py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <div
                    class="lg:w-2/3 md:w-1/2 bg-gray-300 rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">
                    <iframe class="absolute inset-0" title="map" marginheight="0" marginwidth="0" scrolling="no"
                        src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=%C4%B0zmir+(My%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed"
                        width="100%" height="100%" frameborder="0"></iframe>
                    <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md">
                        <div class="lg:w-1/2 px-6">
                            <h6 class="hd-6">Адрес</h6>
                            <p class="mt-1">пр. имени В.И. Ленина, 28, Волгоград, Волгоградская обл., 400005</p>
                        </div>
                        <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                            <h6 class="hd-6">Email</h6>
                            <a class="text-indigo-500 leading-relaxed">example@email.com</a>
                            <h6 class="hd-6">Телефон</h6>
                            <p class="leading-relaxed">123-456-7890</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
                    <h2 class="hd-2 mb-2">Контакты</h2>
                    <p class="subtitle mb-4">Здесь вы можете оставить комментарий о работе сервиса</p>
                    <form action="" method="post" @submit.prevent="submitContacts">
                        <div class="relative mb-4">
                            <InputLabel for="name" value="Имя" />
                            <TextInput id="name" type="text" v-model="contactsForm.name" class="mt-1 block w-full" required
                                autofocus autocomplete="email" />
                        </div>
                        <div class="relative mb-4">
                            <InputLabel for="email" value="Email" />
                            <TextInput id="email" type="email" v-model="contactsForm.email" class="mt-1 block w-full"
                                required autofocus autocomplete="email" />
                        </div>
                        <div class="relative mb-4">
                            <InputLabel for="email" value="Сообщение" />
                            <TextareaInput v-model="contactsForm.message" class="w-full h-52"
                                placeholder="Ваши вопросы и предложения..." />
                        </div>
                        <button class="btn">Отправить</button>
                        <Polocies class="mt-3" />
                    </form>
                </div>
            </div>
        </section>
    </LayoutTemplate>
</template>