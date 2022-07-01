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
      mainRoute: "/company/company",
      hiddenActions: ["create", "delete"],
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
          title: "میزان سوبسید روی هر غذا",
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
          title: "روز های کاری",
          field: "business_days",
          rel: false,
          type: "select",
          isHeader: true,
          props: {
            multiple: true,
          },
          inList(value) {
            let map = {
              shanbe: "شنبه",
              yekshanbe: "یکشنبه",
              doshanbe: "دوشنبه",
              seshanbe: "سه شنبه",
              charshanbe: "چهار شنبه",
              panjshanbe: "پنج شنبه",
              jome: "جمعه",
            };
            return value.map((v) => map[v]).join(" - ");
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
