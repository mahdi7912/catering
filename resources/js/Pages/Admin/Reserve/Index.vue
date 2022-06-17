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
      mainRoute: "/admin/reserve",
      relations: ["/admin/meal"],
      fields: [
        {
          title: "تعداد",
          field: "number",
          type: "text",
          props: {
            type: "number",
          },
          isHeader: true,
          rules: ["required"],
          col: { md: 6 },
        },
        {
          title: "قیمت",
          field: "price",
          type: "text",
          props: {
            type: "number",
          },
          isHeader: true,
          rules: ["required"],
          col: { md: 6 },
        },
        {
          title: "غذا",
          sendKey: "food_date_id",
          field: "meal",
          rel: {
            model: "Meal",
          },
          type: "select",
          isHeader: true,
          rules: ["required"],
          props: {
            "item-text": "name",
            "item-value": "id",
          },
          col: { md: 6 },
        },
        {
          title: "وعده",
          field: "meal",
          rel: false,
          type: "select",
          isHeader: true,
          values: [
            { text: "صبحانه", value: "breakfast" },
            { text: "نهار", value: "lunch" },
            { text: "شام", value: "dinner" },
          ],
        },
      ],
    });
  },
};
</script>
