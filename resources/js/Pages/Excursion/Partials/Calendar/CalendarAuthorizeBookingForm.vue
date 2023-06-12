<script setup>
import TextInput from '@/Components/TextInput.vue';
import ListInput from '@/Components/ListInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Button from '@/Components/Button.vue';
import CalendarStore from './CalendarStore.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import dayjs from 'dayjs';

</script>

<template>
    <form @submit.prevent="submit">
        <div class="flex flex-col gap-2 max-w-xl my-0 mx-auto">
            <div>
                <InputLabel for="customers_count" value="Количество человек" />
                <ListInput id="customers_count" name="customers_count" v-model="customers_count" :options="customersCountList"
                    autofocus required />
            </div>
            <Button :disabled="form.processing">
                Забронировать
            </Button>
            <div>
                <p>Я соглашаюсь с <a href="#" class="text-gray-500"> Условиями использования сайта </a> и даю
                    согласие на обработку своих
                    персональных данных в
                    соотвестствии с <a href="#" class="text-gray-500"> Политикой обработки персональных данных </a>.
                </p>
            </div>
        </div>
    </form>
</template>

<script>

export default {
    props: {
        excursionMaxCustomersCount: {
            type: Number
        }
    },

    data() {
        return {
            selected_time: CalendarStore.selectedTimeItem,
            selected_date: CalendarStore.selectedDateItem,
            customers_count: CalendarStore.customersCount,
            form: useForm({
                selected_time: '',
                selected_date: '',
                customers_count: 1,
            }),
        }
    },
    computed:{
        customersCountList(){
            let customersCountList = {}; 
            for (let index = 1; index <= this.excursionMaxCustomersCount; index++){
                customersCountList[index-1] = {id: index, value: index};
            }
            return customersCountList;
        }
    },
    methods: {
        submit() {
            this.form.selected_date = this.selected_date;
            this.form.selected_time = this.selected_time
            this.form.customers_count = this.customers_count

            if (!this.selected_date) {
                alert('Пожалуйста, выберите желаймую дату.');
                return;
            }
            if (!this.selected_time) {
                alert('Пожалуйста, выберите желаймое время.');
                return;
            }

            this.form.post(route('excursion.booking'));
        },
        validate() {
            if (!this.selected_date) {
                throw 'Пожалуйста, выберите желаймую дату.';
            }
            if (!this.selected_time) {
                throw new 'Пожалуйста, выберите желаймое время.';
            }

        }
    }
}
</script>