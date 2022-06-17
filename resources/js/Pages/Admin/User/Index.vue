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
      mainRoute: "/admin/user",
      relations: ["/admin/company"],

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
          title: "شرکت",
          field: "company_id",
          rel: {
            model: "Company",
          },
          inList(value, instance) {
            return instance.company.name;
          },
          type: "select",
          isHeader: true,
          rules: ["required"],
          props: {
            "item-text": "name",
            "item-value": "id",
          },
          col: { md: 12 },
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
          type: "select",
          rules: ["required"],
          isHeader: true,
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
          title: "اعتبار",
          field: "credit",
          type: "text",
          props: {
            type: "number",
          },
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
