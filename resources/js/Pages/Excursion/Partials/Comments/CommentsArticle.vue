<script setup>
import dayjs from "dayjs";
import "dayjs/locale/ru";

dayjs.locale('ru');

defineProps({
    comment: {
        type: Object
    }
});

</script>

<template>
    <article class="p-6 mb-6 text-base bg-white rounded-lg">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                    <img class="mr-2 w-6 h-6 rounded-full" :src="'/' + comment.user.avatar_image" alt="Michael Gough">
                    {{ comment.user.name }}
                    {{ comment.user.surname }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <time pubdate datetime="2022-02-08" title="February 8th, 2022">{{
                        dayjs(comment.created_at).format("MMM. D, YYYY") }}</time>
                </p>
            </div>
            <button id="dropdownComment1Button" v-if="$page.props.auth.user && $page.props.auth.user.id == comment.user.id" data-dropdown-toggle="dropdownComment1"
                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                type="button">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                    </path>
                </svg>
                <span class="sr-only">Настройки комментария</span>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownComment1"
                class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownMenuIconHorizontalButton">
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Редактировать</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Удалить</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Пожаловаться</a>
                    </li>
                </ul>
            </div>
        </footer>
        <p class="text-gray-500 mb-3">
            {{ comment.content }}
        </p>
        <vue3-star-ratings v-model="comment.excursion_rating" :showControl="false" :starSize="15" inactiveColor="#e5e7eb"
            :disableClick="true" />
    </article>
</template>