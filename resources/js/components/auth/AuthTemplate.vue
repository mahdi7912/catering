<template>
  <v-app>
    <div class="back"></div>
    <v-container fluid style="height: 100%">
      <div
        class="d-flex flex-column align-center justify-center"
        style="margin-top: 70px"
      >
        <v-img src="/images/logo.png" class="mx-auto" max-width="100" />
        <v-card
          outlined
          elevation="1"
          class="col-12 col-lg-3 pa-0 d-flex align-center flex-column justify-center rounded-lg"
          style="overflow: hidden; background-color: #e2e2e2; z-index: 2"
        >
          <div>
            <v-img src="/images/test.png">
              <div
                class="pa-5 text-center fill-height d-flex align-center flex-column justify-center"
              >
                <h2>کترینگ</h2>
                <slot></slot>
              </div>
            </v-img>
          </div>
        </v-card>
      </div>
    </v-container>
    <alert />
  </v-app>
</template>

<script>
import { Alert } from "majra";

export default {
  name: "authTemplate",
  components: { Alert },
};
</script>

<style>
.back {
  background: #f5f5f5;
  height: 100%;
  width: 100%;
  left: 0;
  top: 0;
  position: absolute;
}

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
.v-application .text-button {
  font-family: "iransans" !important;
}
</style>
