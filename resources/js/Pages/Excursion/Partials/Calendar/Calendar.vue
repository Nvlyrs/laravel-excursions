<script setup>
import CalendarUnauthorizeBookingForm from './CalendarUnauthorizeBookingForm.vue';
import CalendarAuthorizeBookingForm from './CalendarAuthorizeBookingForm.vue';
import CalendarStore from './CalendarStore.vue';

</script>

<template>
    <div class="p-2 rounded-lg  ">
        <div class="flex flex-col sm:flex-row justify-between align-center gap-2 p-5 rounded-md">
            <CalendarDateIndicator :selected-date="selectedDate" />

            <CalendarDateSelector :current-date="today" :selected-date="selectedDate" @dateSelected="selectDate" />
        </div>
        <div class="mb-2">
            <CalendarWeekdays />
        </div>
        <ol class="grid grid-cols-7 gap-2">
            <CalendarMonthDayItem v-for="day in days" @click="setSelectedDateItem(day)" :class="{
                'bg-indigo-600 border-indigo-600 text-white hover:bg-indigo-600': dayjs(day.date).format('DD-MM-YYYY') === selectedDateItem,
                '': dayjs(day.date).format('DD-MM-YYYY') !== selectedDateItem
            }" :key="day.date" :day="day" :is-allowed="day.isAllowed" :is-today="day.date === today" />
        </ol>
        <hr class="my-5">
        <div class="my-5">
            <h3 class="mb-2">Выберите время:</h3>
            <ul class="flex flex-wrap justify-stretch gap-2">
                <CalendarTimeItem v-for="time in timesArray" @click="selectedTimeItem = time.value"
                    :class="{ 'selected': time.value === selectedTimeItem, }" :value="time.value" />
            </ul>
        </div>

        <hr class="my-5">

        <div class="text-center">
            <h2 class="inline-block"> Итого:</h2> <span>{{ finalPrice }}₽</span>
        </div>

        <hr class="my-5">

        <div v-if="!$page.props.auth.user">
            <CalendarUnauthorizeBookingForm :selectedDateItem="selectedDateItem" :selectedTimeItem="selectedTimeItem" :excursionMaxCustomersCount="excursionMaxCustomersCount" />
        </div>
        <div v-else>
            <CalendarAuthorizeBookingForm :selectedDateItem="selectedDateItem" :selectedTimeItem="selectedTimeItem" :excursionMaxCustomersCount="excursionMaxCustomersCount" />
        </div>
    </div>
    {{ datess }}
</template>
  
<script>
import dayjs from "dayjs";
import axios from "axios";
import "dayjs/locale/ru";
import weekday from "dayjs/plugin/weekday";
import weekOfYear from "dayjs/plugin/weekOfYear";
import CalendarMonthDayItem from "./CalendarMonthDayItem.vue";
import CalendarDateIndicator from "./CalendarDateIndicator.vue";
import CalendarDateSelector from "./CalendarDateSelector.vue";
import CalendarWeekdays from "./CalendarWeekdays.vue";
import CalendarTimeItem from "./CalendarTimeItem.vue";

dayjs.locale('ru');
dayjs.extend(weekday);
dayjs.extend(weekOfYear);

// let dates = {
//     0: {
//         times_array: ['11:00', '12:00', '12:20', '12:30', '13:00', '14:00'],
//         dates: ['01-04-2023', '02-04-2023', '03-04-2023', '04-04-2023'],
//         price: 1500,
//     },
//     1: {
//         times_array: ['11:00'],
//         dates: ['06-04-2023', '07-04-2023', '08-04-2023'],
//         price: 2500
//     },
//     2: {
//         times_array: ['11:00', '12:00', '12:30'],
//         dates: ['15-04-2023', '16-04-2023', '17-04-2023', '18-04-2023', '19-04-2023'],
//         price: 1500
//     },
//     3: {
//         times_array: ['11:00', '12:00', '12:30'],
//         dates: ['01-05-2023', '02-05-2023', '03-05-2023'],
//         price: 3000
//     },
//     4: {
//         times_array: ['11:00', '12:00', '12:30', '13:30'],
//         dates: ['20-04-2023', '21-04-2023', '22-04-2023', '23-04-2023', '24-04-2023'],
//         price: 3000
//     }

// };


export default {
    name: "Calendar",

    components: {
        CalendarMonthDayItem,
        CalendarDateIndicator,
        CalendarDateSelector,
        CalendarWeekdays,
        CalendarTimeItem,
    },

    // created() {
    //     axios.get('/api/user').then((response) => {
    //         console.log(response);
    //     });
    // },

    props: {
        excursionPrice: {
            type: Number
        },
        excurtionType: {
            type: Number,
            required: true,
        },
        excursionDateFrames: {
            type: Object
        },
        excursionMaxCustomersCount: {
            type: Number
        }
    },

    data() {
        return {
            selectedDate: dayjs(),
            selectedDateItem: CalendarStore.selectedDateItem,
            selectedTimeItem: CalendarStore.selectedTimeItem,
            selectedDateFrameIndex: CalendarStore.selectedDateFrameIndex,
            customers_count: CalendarStore.customersCount,
            isUserAuth: true,
            finalPrice: CalendarStore.finalPrice,
        };
    },

    computed: {
        dates() {
            return this.excursionDateFrames.map((frame) => {
                const startDate = new Date(dayjs(frame.start_date).format("YYYY-MM-DD"));
                const endDate = new Date(dayjs(frame.end_date).format("YYYY-MM-DD"));

                return {
                    times_array: Array.from(JSON.parse(frame.times_array)),
                    dates: this.getDates(startDate, endDate),
                    price: frame.price ? frame.price : this.excursionPrice
                }
            });
        },

        finalPrice() {
            if (this.excurtionType == 1) {
                return this.finalPrice;
            } else {
                return this.finalPrice * this.customers_count;
            }
        },

        timesArray() {
            return this.dates[this.selectedDateFrameIndex].times_array.map((time, index) => {
                return {
                    value: time,
                    isSelected: false,
                }
            });
        },

        days() {
            return [
                ...this.previousMonthDays,
                ...this.currentMonthDays,
                ...this.nextMonthDays
            ];
        },

        today() {
            return dayjs().format("YYYY-MM-DD");
        },

        month() {
            return Number(this.selectedDate.format("M"));
        },

        year() {
            return Number(this.selectedDate.format("YYYY"));
        },

        numberOfDaysInMonth() {
            return dayjs(this.selectedDate).daysInMonth();
        },

        currentMonthDays() {
            return [...Array(this.numberOfDaysInMonth)].map((day, index) => {
                let currentDate = dayjs(`${this.year}-${this.month}-${index + 1}`).format("DD-MM-YYYY");
                const today = dayjs();
                let isAllowed = false;
                let dateFrameIndex = null;
                let dateFramePrace = null;

                for (let dateFrame in this.dates) {
                    if ((this.dates[dateFrame].dates.includes(currentDate)) && !dayjs(`${this.year}-${this.month}-${index + 1}`).isBefore(today, 'date')) {
                        isAllowed = true;
                        dateFrameIndex = dateFrame;
                        dateFramePrace = this.dates[dateFrame].price;
                    }
                }

                return {
                    date: dayjs(`${this.year}-${this.month}-${index + 1}`).format("YYYY-MM-DD"),
                    isAllowed: isAllowed,
                    dateFrameIndex: dateFrameIndex,
                    dateFramePrace: dateFramePrace,
                    isCurrentMonth: true
                };
            });
        },

        previousMonthDays() {
            const firstDayOfTheMonthWeekday = this.getWeekday(
                this.currentMonthDays[0].date
            );
            const previousMonth = dayjs(`${this.year}-${this.month}-01`).subtract(
                1,
                "month"
            );

            // Cover first day of the month being sunday (firstDayOfTheMonthWeekday === 0)
            const visibleNumberOfDaysFromPreviousMonth = firstDayOfTheMonthWeekday
                ? firstDayOfTheMonthWeekday - 1
                : 6;

            const previousMonthLastMondayDayOfMonth = dayjs(
                this.currentMonthDays[0].date
            )
                .subtract(visibleNumberOfDaysFromPreviousMonth, "day")
                .date();

            return [...Array(visibleNumberOfDaysFromPreviousMonth)].map(
                (day, index) => {
                    return {
                        date: dayjs(
                            `${previousMonth.year()}-${previousMonth.month() +
                            1}-${previousMonthLastMondayDayOfMonth + index}`
                        ).format("YYYY-MM-DD"),
                        isCurrentMonth: false
                    };
                }
            );
        },

        nextMonthDays() {
            const lastDayOfTheMonthWeekday = this.getWeekday(
                `${this.year}-${this.month}-${this.currentMonthDays.length}`
            );

            const nextMonth = dayjs(`${this.year}-${this.month}-01`).add(1, "month");

            const visibleNumberOfDaysFromNextMonth = lastDayOfTheMonthWeekday
                ? 7 - lastDayOfTheMonthWeekday
                : lastDayOfTheMonthWeekday;

            return [...Array(visibleNumberOfDaysFromNextMonth)].map((day, index) => {
                return {
                    date: dayjs(
                        `${nextMonth.year()}-${nextMonth.month() + 1}-${index + 1}`
                    ).format("YYYY-MM-DD"),
                    isCurrentMonth: false
                };
            });
        }
    },

    methods: {
        setSelectedDateItem(day) {
            if (!day.isAllowed) {
                return;
            }
            this.selectedDateItem = dayjs(day.date).format("DD-MM-YYYY");
            this.selectedTimeItem = '';
            this.selectedDateFrameIndex = day.dateFrameIndex;
            this.finalPrice = day.dateFramePrace;
        },

        getWeekday(date) {
            return dayjs(date).weekday();
        },

        selectDate(newSelectedDate) {
            this.selectedDate = newSelectedDate;
        },

        getDates(startDate, endDate) {
            const dates = []
            let currentDate = new Date(
                startDate.getFullYear(),
                startDate.getMonth(),
                startDate.getDate()
            );

            while (currentDate <= endDate) {
                dates.push(dayjs(currentDate).format("DD-MM-YYYY"));

                currentDate = new Date(
                    currentDate.getFullYear(),
                    currentDate.getMonth(),
                    currentDate.getDate() + 1, // Will increase month if over range
                );
            }
            return dates
        }
    }
};
</script>
  
  