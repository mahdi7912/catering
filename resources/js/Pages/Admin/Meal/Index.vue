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
      mainRoute: "/admin/meal",
      relations: ["/admin/user"],
      fields: [
        {
          title: "تاریخ نمایش",
          field: "show_date",
          type: "date",
          isHeader: true,
          rules: ["required"],
          col: { md: 6 },
        },
        {
          title: "غذا",
          field: "food_id",
          rel: {
            model: "Food",
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
