<template>
    <main ref="ref_container_print" dir="rtl" class="hidden">
        <div>
            <!-- Header -->
            <div style="text-align: right;display: flex;align-items: center">
                <img alt="Logo" style="width: 100px; height: 100px;"
                     :src="asset('images/logo.png')"/>
            </div>
            <div style="text-align: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
                <h1 style="color: #B41718; margin: 0;"> الفاتورة</h1>
<!--                <p style="margin: 5px 0; color: #777;">123 شارع عمر المختار القاهرة</p>-->
<!--                <p style="margin: 5px 0; color: #777;">Phone: (123) 456-7890 | Email: contact@company.com</p>-->
            </div>

            <!-- Invoice Info -->
            <div style="display: flex; justify-content: space-between; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
                <div>
                    <p style="margin: 5px 0; color: #777;">رقم الفاتورة : {{ el_bill.id }}</p>
                    <p style="margin: 5px 0; color: #777;">التاريخ: {{el_bill.created_at_text2}}</p>
                    <p style="margin: 5px 0; color: #777;">
                        مطلوب من السيد /
                        <span style="padding-right: 5px">
                            {{ el_bill.name }}
                        </span>
                    </p>
                </div>
                <div style="text-align: right;">
<!--                    <p style="margin: 5px 0; color: #777;"><strong>العميل:</strong> CUST-{{ el_bill.name }}</p>-->
                </div>
            </div>


            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                <thead>
                <tr style="background-color: #f9f9f9;">
                    <th style="text-align: left; padding: 12px; border: 1px solid #ddd;">م</th>
                    <th style="text-align: right; padding: 12px; border: 1px solid #ddd;">إسم السيارة</th>
                    <th style="text-align: right; padding: 12px; border: 1px solid #ddd;">الثمن</th>
                    <th style="text-align: right; padding: 12px; border: 1px solid #ddd;">المدفوع</th>
                    <th style="text-align: right; padding: 12px; border: 1px solid #ddd;">المتبقي</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="text-align: right; padding: 12px; border: 1px solid #ddd;">1</td>
                    <td style="text-align: right; padding: 12px; border: 1px solid #ddd;">{{el_bill.name}}</td>
                    <td style="text-align: right; padding: 12px; border: 1px solid #ddd;">
                        {{el_bill.selling_price}} {{el_bill?.currency?.name}}
                    </td>
                    <td style="text-align: right; padding: 12px; border: 1px solid #ddd;">
                        {{el_bill.client_paid_amount}} {{el_bill?.currency?.name}}
                    </td>
                    <td style="text-align: right; padding: 12px; border: 1px solid #ddd;">
                        {{el_bill.client_rent_amount}} {{el_bill?.currency?.name}}
                    </td>
                </tr>

                </tbody>
            </table>

            <div>
                التوقيع
            </div>
        </div>
    </main>
</template>
<script setup>

import {asset, printContent} from "@/Helpers/Functions";
import {ref} from "vue";

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
