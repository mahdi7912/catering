<template>
  <Layout>
    <DynamicTemplate />
  </Layout>
</template>

<script>
import Layout from "@/layouts/CompanyDashboard";
import { DynamicTemplate } from "majra";

export default {
  components: { DynamicTemplate, Layout },

  created() {
    this.$majra.init({
      mainRoute: "/company/user",
      fields: [
        {
          title: "نام",
          field: "name",
          rel: false,
          type: "text",
          isHeader: true,
          rules: ["required"],
          col: { md: 6 },
        },
        {
          title: "نام کاربری",
          field: "user_name",
          rel: false,
          type: "text",
          rules: ["required"],
          isHeader: true,
          col: { md: 6 },
        },
        {
          title: "نوع کاربر",
          field: "type",
          rel: false,
          values: [
            { text: "ادمین", value: "admin" },
            { text: "مدیر شرکت", value: "company" },
            { text: "معمولی", value: "user" },
          ],
          default: "user",
          type: "select",
          rules: ["required"],
          showIn: [],
          col: { md: 6 },
        },
        {
          title: "شماره تلفن",
          field: "phone",
          type: "text",
          rules: ["required"],
          isHeader: true,
          col: { md: 6 },
        },
        {
          title: "رمز عبور",
          field: "password",
          type: "text",
          rules: ["required"],
          col: { md: 6 },
        },
      ],
    });
  },
};
</script>
