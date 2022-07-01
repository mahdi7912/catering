<template>
  <Layout>
    <v-card>
      <v-card-text>
        <h2 class="text-center">به پنل مدیریت خوش امدید</h2>
        <v-row justify="center" class="my-5">
          <v-col>
            <v-card dark color="indigo">
              <v-card-text class="white--text">
                <v-icon size="18">fal fa-users</v-icon>
                <span v-text="'برنامه پخت غذا'" />
              </v-card-text>
              <v-card-text class="indigo justify-center darken-2 d-flex">
                <div
                  v-for="(mealsGroups, key) in meals"
                  style="border: 1px solid white"
                  class="ma-2 col-12 col-lg-3 rounded pa-3"
                >
                  <span>{{ new Date(key).toLocaleDateString("fa-IR") }}</span>
                  <v-divider class="my-2" />
                  <div
                    v-for="(mealsGroup, mealName) in mealsGroups"
                    class="d-block"
                  >
                    <span class="px-2 rounded white elevation-2 black--text">
                      {{ map[mealName] }}
                    </span>
                    <div
                      v-for="(meal, foodName) in mealsGroup"
                      class="d-block my-2"
                      style="border-bottom: 1px solid rgba(255, 255, 255, 0.2)"
                    >
                      <span class="rounded mx-2 pa-2 light">
                        نام غذا : {{ foodName }}
                      </span>
                      <span class="rounded mx-2 pa-2 light">
                        تعداد : {{ getSafe(meal[0], "reserves", []).length }}
                      </span>
                    </div>
                  </div>
                </div>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </Layout>
</template>

<script>
import Layout from "@/layouts/AdminDashboard";
import { get as getSafe } from "lodash";

export default {
  name: "Dashboard",

  props: {
    meals: { default: {} },
  },

  components: { Layout },

  data: () => ({
    map: {
      breakfast: "صبحانه",
      lunch: "ناهار",
      dinner: "شام",
    },
  }),

  methods: { getSafe },

  created() {
    console.log(this.meals);
  },
};
</script>
