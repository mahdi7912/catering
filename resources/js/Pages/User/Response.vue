<template>
  <v-app>
    <v-main>
      <v-container>
        <v-alert type="info">
          {{ message }}
        </v-alert>
        <Link href="/profile" v-if="!isCompany">
          <v-btn outlined color="info">
            <span>بازگشت به پنل رزرو غذا</span>
            <v-icon right>mdi mdi-arrow-left</v-icon>
          </v-btn>
        </Link>
        <Link href="/company/dashboard" v-else>
          <v-btn outlined color="info">
            <span>بازگشت به داشبرد</span>
            <v-icon right>mdi mdi-arrow-left</v-icon>
          </v-btn>
        </Link>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";

export default {
  props: {
    message: {
      type: String,
    },
    isCompany: {
      default: false,
      type: Boolean,
    },
  },

  components: { Link },
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
</style>
