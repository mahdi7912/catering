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
      fields: [
        {
          title: "نام غذا",
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
      ],
    });
  },
};
</script>
