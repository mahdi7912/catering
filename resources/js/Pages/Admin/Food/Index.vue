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
      mainRoute: "/admin/food",
      relations: ["/admin/category"],
      fields: [
        {
          title: "نام غذا",
          field: "name",
          rel: false,
          type: "text",
          isHeader: true,
          rules: ["required"],
          col: { md: 6 },
        },
        {
          title: "قیمت",
          field: "price",
          rel: false,
          type: "text",
          props: {
            type: "number",
          },
          rules: ["required"],
          isHeader: true,
          col: { md: 6 },
        },
        {
          title: "دسته بندی",
          field: "category_id",
          rel: {
            model: "Category",
          },
          type: "select",
          isHeader: true,
          rules: ["required"],
          props: {
            'item-text': "name",
            'item-value': "id",
          },
          col: { md: 12 },
        },
      ],
    });
  },
};
</script>
