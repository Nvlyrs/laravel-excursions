<script setup>
import LayoutTemplate from '@/Layouts/LayoutTemplate.vue';
import DefaultBlock from '@/Components/DefaultBlock.vue';
import StatusMessagesBar from '@/Components/StatusMessagesBar.vue';
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
        return gallery ? gallery : [];
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
    <Head title="База знаний" />

    <LayoutTemplate>
        <section class="bg-gradient-to-b from-indigo-500 to-indigo-700">
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <h1 class="hd-1 text-white">База знаний</h1>
                <p class="subtitle text-white">Здесь Вы можете узнать ответы на часто задаваемые вопросы</p>
            </div>
        </section>
        <section>
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">

                <div id="accordion-open" data-accordion="open">
                    <h2 id="accordion-open-heading-1" class="hd-4">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200"
                            data-accordion-target="#accordion-open-body-1" aria-expanded="true"
                            aria-controls="accordion-open-body-1">
                            <span class="flex items-center"><svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd"></path>
                                </svg>Какие экскурсии у вас есть? </span>
                            <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">
                        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <p class="pr-gray">На нашей платформе представлены лучшие экскурсии гидов. Поиск экскурсии
                                необходимо начать с города, в котором вы хотите ее посетить. Для более точного поиска наши
                                экскурсии разделены на категории.</p>

                        </div>
                    </div>
                    <h2 id="accordion-open-heading-2" class="hd-4">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200"
                            data-accordion-target="#accordion-open-body-2" aria-expanded="false"
                            aria-controls="accordion-open-body-2">
                            <span class="flex items-center"><svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd"></path>
                                </svg>У меня остались вопросы по экскурсии. Как я могу связаться с гидом, чтобы обсудить
                                детали?</span>
                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-open-body-2" class="hidden" aria-labelledby="accordion-open-heading-2">
                        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                            <p class="pr-gray">
                                Для того, чтобы начать общение с гидом, оформите заявку на экскурсию. Это можно сделать
                                прямо со страницы экскурсии в разделе бронирования. Укажите свои контактные данные и
                                напишите вопрос в графе: "Задать дополнительный вопрос"/"Ваши вопросы организатору", после
                                чего нажмите кнопку "Начать бронирование". Ваш вопрос будет отправлен организатору. Как
                                только организатор ответит вам, вы получите уведомление. Оформляя заявку, вы не обязаны
                                завершать бронирование путем внесения предоплаты. Сначала получите ответы на интересующие
                                вопросы и подтверждение организатора о том, что экскурсия состоится. Ваша заявка будет
                                сохранена в системе, вы в любой момент сможете обратиться к менеджеру клиентского сервиса по
                                номеру заявки, чтобы уточнить ее статус.
                            </p>
                        </div>
                    </div>
                    <h2 id="accordion-open-heading-3" class="hd-4">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200"
                            data-accordion-target="#accordion-open-body-3" aria-expanded="false"
                            aria-controls="accordion-open-body-3">
                            <span class="flex items-center"><svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd"></path>
                                </svg>Что значит «забронировать» экскурсию?</span>
                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-open-body-3" class="hidden" aria-labelledby="accordion-open-heading-3">
                        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                            <p class="pr-gray">
                                Бронирование - подтверждение вашего участия. На нашей платформе подтвердить свое участие в
                                экскурсии в большинстве случаев означает внести предоплату (полностью или частично, в
                                зависимости от конкретной экскурсии). В случае, если для экскурсии доступен способ оплаты
                                наличными (в описании экскурсии стоит зеленая галочка с пометкой "Можно оплатить
                                наличными"), вам необходимо выбрать данный способ оплаты в предложенном списке и получить
                                подтверждение бронирования от организатора.
                            </p>
                        </div>
                    </div>
                    <h2 id="accordion-open-heading-4" class="hd-4">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200"
                            data-accordion-target="#accordion-open-body-4" aria-expanded="false"
                            aria-controls="accordion-open-body-4">
                            <span class="flex items-center"><svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd"></path>
                                </svg>Что произойдет после оплаты?</span>
                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-open-body-4" class="hidden" aria-labelledby="accordion-open-heading-4">
                        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                            <p class="pr-gray">
                                Сразу после оплаты заказа вы получите смс и письмо с уведомлением об оплате, организатор
                                также получит уведомление. После подтверждения заказа организатором в следующем письме вам
                                будет отправлен электронный билет/ваучер, который понадобится вам в день экскурсии. В нем
                                содержится инструкция и информация о заказе: дата, время и место встречи, подробности о том,
                                как узнать гида, номер телефона организатора.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutTemplate>
    <StatusMessagesBar />
</template>
