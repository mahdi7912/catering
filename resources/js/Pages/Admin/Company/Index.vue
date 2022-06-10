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
      relations: [
        "/admin/user",
      ],
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
          title: "مدیر",
          field: "user_id",
          rel: {
            model: "User",
          },
          type: "select",
          isHeader: true,
          rules: ["required"],
          props: {
            'item-text': "name",
            'item-value': "id",
          },
          col: { md: 6 },
        },
      ],
    });
  },
};
</script>
