<template>
  <v-app>
    <v-main>
      <v-container>
        <v-row>
          <v-col class="d-flex flex-row align-center justify-space-between">
            <div class="d-flex align-center caption">
              <v-icon right>mdi mdi-account-circle</v-icon>
              <div class="d-flex align-center">
                {{ $page.props.$user.name }} -
                {{ $page.props.$user.company.name }}
              </div>
            </div>
            <div class="d-flex flex-row">
              <div class="rounded white--text info py-1 px-2 caption">
                <span>اعتبار :</span>
                <span>{{ $page.props.$user.credit / 1000 }}</span>
                <span> هزار تومان </span>
              </div>
              <v-btn small elevation="0" class="success py-1 px-2 mr-2" dark>
                <v-icon small>mdi mdi-plus</v-icon>
              </v-btn>
            </div>
          </v-col>

          <v-col cols="12" class="pa-0">
            <v-divider></v-divider>
          </v-col>

          <v-col cols="12" class="pa-0">
            <div class="d-flex align-center justify-space-between">
              <Link :href="'?week=' + (+week - 1)">
                <v-btn icon>
                  <v-icon>mdi mdi-arrow-right</v-icon>
                </v-btn>
              </Link>
              <div class="d-flex">
                <span>{{ persianDate }}</span>
                <span v-if="isToday" class="mr-2"> (هفته جاری)</span>
                <span v-else="isToday" class="mr-2">
                  ({{ Math.abs(week) }} هفته {{ week > 0 ? "بعد" : "قبل" }})</span
                >
              </div>
              <Link :href="'?week=' + (+week + 1)">
                <v-btn icon>
                  <v-icon>mdi mdi-arrow-left</v-icon>
                </v-btn>
              </Link>
            </div>
          </v-col>

          <v-col cols="12" class="pa-0">
            <v-divider></v-divider>
          </v-col>

          <template v-for="day in company.business_days">
            <v-col cols="12" :key="day">
              {{ weekMap[day] }}
            </v-col>
            <v-col cols="12" class="pa-0" :key="'a' + day">
              <v-divider></v-divider>
            </v-col>
          </template>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";

export default {
  components: { Link },

  props: ["meals", "time", "foods", "company", "week", "startOfWeek"],

  data: () => ({
    weekMap: {
      shanbe: { name: "شنبه" },
      yekshanbe: { name: "یکشنبه" },
      doshanbe: { name: "دوشنبه" },
      seshanbe: { name: "سه شنبه" },
      charshanbe: { name: "چهار شنبه" },
      panjshanbe: { name: "پنج شنبه" },
      jome: { name: "جمعه" },
    },
  }),

  computed: {
    getPlan(){
        this.weekMap.shanbe.date = startOfWeek;
        for(const nameOfWeek in this.weekMap){

        }
    },
    persianDate() {
      return new Date(this.time).toLocaleDateString("fa-IR");
    },
    isToday() {
      let serverDate = new Date(this.time);
      let today = new Date();

      return (
        serverDate.getFullYear() === today.getFullYear() &&
        serverDate.getMonth() === today.getMonth() &&
        serverDate.getDate() === today.getDate()
      );
    },
  },
};
</script>

<style>
.v-application,
.v-application .caption,
.v-application .text-h3,
.v-application .text-h4,
.v-application .text-h2,
.v-application .text-h5,
.v-application .text-h6,
.v-application .text-caption,
.v-application .text-overline,
.v-application .text-body-2,
.v-application .text-button,
h1,
h2,
h3,
h4,
h5,
h6,
.headline {
  font-family: "iransans" !important;
}

a,
a:active,
a:visited {
  text-decoration: none !important;
}
</style>
