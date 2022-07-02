<template>
  <div class="d-flex">
    <v-btn small elevation="0" class="success py-1 px-2 ml-2" dark @click="dialog = true">
      <v-icon small>mdi mdi-camera</v-icon>
    </v-btn>

    <v-dialog v-model="dialog" max-width="500px">
      <v-card>
        <v-card-title>
          <span>بررسی ژتون</span>
          <v-spacer></v-spacer>
          <v-btn icon color="error" @click="dialog = false">
            <v-icon>mdi mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
          <StreamBarcodeReader @decode="onDecode" @loaded="onLoaded" />
          <v-divider />
          <div v-if="reserve">
            <span
              class="d-block rounded py-1 px-4 white--text"
              :class="getSafe(reserve, 'received', true) ? 'error' : 'success'"
            >
              {{ getSafe(reserve, "received", true) ? "تحویل داده شده" : "تحویل نشده" }}
            </span>
            <span class="d-block rounded mt-1 py-1 px-4 info white--text">
              تاریخ :
              {{
                new Date(getSafe(reserve, "meal.show_date")).toLocaleDateString("fa-IR")
              }}
            </span>
            <span class="d-block rounded mt-1 py-1 px-4 info white--text">
              نام غذا : {{ getSafe(reserve, "meal.food.name") }}
            </span>
            <span class="d-block mt-1 rounded py-1 px-4 info white--text">
              وعده : {{ mealMap[getSafe(reserve, "meal.meal")] }}
            </span>
            <span class="d-block mt-1 rounded py-1 px-4 info white--text">
              نام کاربر : {{ getSafe(reserve, "user.name") }}
            </span>
          </div>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import axios from "axios";
import { StreamBarcodeReader } from "vue-barcode-reader";
import { get as getSafe } from "lodash";

export default {
  components: { StreamBarcodeReader },

  data: () => ({
    dialog: false,
    reserve: false,
    mealMap: {
      breakfast: "صبحانه",
      lunch: "نهار",
      dinner: "شام",
    },
  }),

  methods: {
    getSafe,
    onDecode(a, b, c) {
      if (this.reserve.id == a) return;

      this.makeReq(a);
    },
    onLoaded() {
      console.log("load");
    },
    makeReq(id) {
      this._event("loading", true);
      axios
        .post("/company/fish/" + id)
        .then((res) => {
          this.reserve = getSafe(res, "data");
        })
        .catch((err) => {
          this._event("alert", {
            text: getSafe(err, "response.data.message"),
            color: "error",
          });
        })
        .finally(() => {
          this._event("loading", false);
        });
    },
  },
};
</script>

<style>
.laser {
  left: 0px !important;
}
</style>
