<template>
    <main ref="ref_container_print" dir="rtl" class="hidden">
        <div>
            <!-- Header -->
            <div style="text-align: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
                <h1 style="color: #B41718; margin: 0;">المؤمنون لإستيراد السيارات</h1>
                <p style="margin: 5px 0; color: #777;">123 شارع عمر المختار القاهرة</p>
                <p style="margin: 5px 0; color: #777;">Phone: (123) 456-7890 | Email: contact@company.com</p>
            </div>

            <!-- Invoice Info -->
            <div style="display: flex; justify-content: space-between; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
                <div>
                    <h2 style="color: #333; margin: 0 0 10px 0;">الفاتورة</h2>
                    <p style="margin: 5px 0; color: #777;">رقم الفاتورة #: {{ el_bill.id }}</p>
                    <p style="margin: 5px 0; color: #777;">التاريخ: {{el_bill.created_at_text2}}</p>
                </div>
                <div style="text-align: right;">
                    <p style="margin: 5px 0; color: #777;"><strong>العميل:</strong> CUST-{{ el_bill.name }}</p>
                </div>
            </div>

            <div style="margin-bottom: 20px; padding: 15px; background-color: #f9f9f9; border-left: 4px solid #4CAF50;">
                <p style="margin: 5px 0;"><strong>{{ $t('column.purchase_type') }}:</strong> {{el_bill.purchase_type_text}}</p>
                <p style="margin: 5px 0;"><strong>{{$t('column.car_type')}}:</strong> {{el_bill.car_type}}</p>
                <p style="margin: 5px 0;"><strong>{{$t('column.chassis_number')}}:</strong> {{el_bill.chassis_number}}</p>
                <p style="margin: 5px 0;"><strong>{{$t('message.price')}}:</strong> {{el_bill.selling_price}} {{el_bill?.currency?.name}}</p>
            </div>

            <!-- Footer -->
            <div style="text-align: center; border-top: 2px solid #eee; padding-top: 20px; color: #777;">
                <p style="margin: 5px 0;">سعداء بخدمتك</p>
                <p style="margin: 5px 0; font-size: 12px;">نسعي لنكون الأفضل .</p>
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
