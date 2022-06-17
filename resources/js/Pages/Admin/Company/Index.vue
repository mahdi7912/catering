<template>
  <Layout>
    <DynamicTemplate />
  </Layout>
</template>

<script>
import Layout from "@/layouts/AdminDashboard";
import { DynamicTemplate } from "majra";

export default {
  components: { DynamicTemplate, Layout },

  created() {
    this.$majra.init({
      mainRoute: "/admin/company",
      relations: ["/admin/user"],
      fields: [
        {
          title: "نام شرکت",
          field: "name",
          type: "text",
          isHeader: true,
          rules: ["required"],
          col: { md: 6 },
        },
        {
          title: "میزان سوبسید",
          field: "subsidy",
          type: "text",
          props: {
            type: "number",
          },
          rules: ["required"],
          isHeader: true,
          col: { md: 6 },
        },
        {
          title: "اعتبار",
          field: "credit",
          type: "text",
          props: {
            type: "number",
          },
          isHeader: true,
          col: { md: 6 },
        },
        {
          title: "افزایش قیمت غذا (درصد)",
          field: "increase_percent",
          type: "text",
          props: {
            type: "number",
          },
          isHeader: true,
          col: { md: 6 },
        },
        {
          title: "افزایش قیمت غذا (مبلغ)",
          field: "increase_rate",
          type: "text",
          props: {
            type: "number",
          },
          isHeader: true,
          col: { md: 6 },
        },
        {
          title: "مدیر ها",
          field: "admins",
          type: "text",
          isHeader: true,
          props: {
            readonly: true,
          },
          inList(value) {
            return value.map(v => v.name).join(' - ')
          },
          col: { md: 6 },
        },
        {
          title: "روز های کاری",
          field: "business_days",
          rel: false,
          type: "select",
          isHeader: true,
          props: {
            multiple: true,
          },
          values: [
            { text: "شنبه", value: "shanbe" },
            { text: "یکشنبه", value: "yekshanbe" },
            { text: "دوشنبه", value: "doshanbe" },
            { text: "سه شنبه", value: "seshanbe" },
            { text: "چهار شنبه", value: "charshanbe" },
            { text: "پنج شنبه", value: "panjshanbe" },
            { text: "جمعه", value: "jome" },
          ],
        },
      ],
    });
  },
};
</script>
