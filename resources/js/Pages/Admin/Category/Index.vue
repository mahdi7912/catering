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
      mainRoute: "/admin/category",
      fields: [
        {
          title: "نام دسته بندی",
          field: "name",
          type: "text",
          isHeader: true,
          rules: ["required"],
        },
      ],
    });

  },
};
</script>
