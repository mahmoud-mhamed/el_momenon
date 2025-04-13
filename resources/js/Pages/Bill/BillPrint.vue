<template>
    <main ref="ref_container_print" dir="rtl" class="hidden">
        <div class="flex justify-between">
            <div>
                <ElLabelValueText :value="el_bill.created_at" :label="$t('message.date')"/>
                <ElLabelValueText :value="el_bill.client?.name" :label="$t('column.client_id')"/>

            </div>
            <div>
                <p>
                    المؤمنون لإستيراد السيارات
                </p>
                <ElLabelValueText :value="el_bill.id" :label="$t('column.#')"/>
            </div>
        </div>
    </main>
</template>
<script setup>

import {printContent} from "@/Helpers/Functions";
import {ref} from "vue";
import ElLabelValueText from "@/Components/Text/ElLabelValueText.vue";

const ref_container_print = ref();
const el_bill = ref([]);

const print = (temp_data) => {
    el_bill.value = temp_data;
    setTimeout(function () {
        printContent(ref_container_print.value.innerHTML);
    }, 100)
}
defineExpose({print});
</script>
