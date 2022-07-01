<template>
  <Layout>
    <DynamicTemplate />
  </Layout>
</template>

<script>
import Layout from "@/layouts/AdminDashboard";
import { DynamicTemplate } from "majra";
import { get as getSafe } from "lodash";

export default {
  components: { DynamicTemplate, Layout },

  created() {
    this.$majra.init({
      mainRoute: "/admin/reserve",
      relations: ["/admin/meal"],
      hiddenActions: ["create", "edit", "delete"],
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
          title: "کاربر",
          field: "user",
          type: "text",
          isHeader: true,
          inList(user) {
            return user.name + '  -  ' + user.user_name;
          },
          col: { md: 6 },
        },
        {
          title: "غذا",
          field: "food_date",
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
          inList(value, form) {
            return getSafe(form, "meal.food.name", "--");
          },
          col: { md: 6 },
        },
        {
          title: "وعده",
          field: "meal",
          rel: false,
          type: "select",
          isHeader: true,
          inList(value, form) {
            let map = {
              breakfast: "صبحانه",
              lunch: "نهار",
              dinner: "شام",
            };

            let meal = getSafe(form, "meal.meal", "--");

            return map[meal];
          },
          props: {
            "item-text": "meal",
          },
        },
      ],
    });
  },
};
</script>
