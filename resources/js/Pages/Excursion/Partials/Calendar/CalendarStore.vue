<script>
import { ref } from 'vue';

const customersCount = ref(1);
const selectedDateFrameIndex = ref(0);
const selectedDateItem = ref('');
const selectedTimeItem = ref('');
const finalPrice = ref(0);

export default {
    customersCount,
    selectedDateItem,
    selectedTimeItem,
    finalPrice,
    selectedDateFrameIndex
}
</script>