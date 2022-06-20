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
      mainRoute: "/admin/sundry",
      relations: ["/admin/food"],
      fields: [
        {
          title: "نام",
          field: "name",
          type: "text",
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
          rules: ["required"],
          isHeader: true,
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
          inList(value, instance) {
            return instance.food.name;
          },
        },
      ],
    });
  },
};
</script>
