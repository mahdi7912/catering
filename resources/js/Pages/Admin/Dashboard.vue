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
              <v-card-actions class="indigo darken-2">
                <div
                  v-for="(mealsGroup, key) in meals"
                  :key="key"
                  style="border: 1px solid white"
                  class="mx-2 rounded pa-3"
                >
                  <span>{{ new Date(key).toLocaleDateString("fa-IR") }}</span>
                  <v-divider class="my-2" />
                  <div
                    v-for="(meal, key) in mealsGroup"
                    :key="meal.id"
                    class="d-block"
                    style="border-bottom:1px solid rgba(255,255,255,0.2)"
                  >
                    <span class="rounded mx-2 pa-2 light">نام غذا : {{ meal.food.name }}</span>
                    <span class="rounded mx-2 pa-2 light">تعداد : {{ meal.reserve.length }}</span>
                  </div>
                </div>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </Layout>
</template>

<script>
import Layout from "@/layouts/AdminDashboard";

export default {
  name: "Dashboard",

  props: {
    meals: { default: {} },
  },

  components: { Layout },

  created() {
    console.log(this.meals);
  },
};
</script>
