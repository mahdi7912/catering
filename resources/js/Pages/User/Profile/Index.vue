<template>
  <v-app>
    <v-main>
      <v-container>
        <v-row>
          <v-col class="d-flex flex-row align-center justify-space-between">
            <div class="d-flex align-center caption">
              <v-icon v-if="$vuetify.breakpoint.mdAndUp" right
                >mdi mdi-account-circle</v-icon
              >
              <div class="d-flex align-center">
                {{ $page.props.$user.name }}
              </div>
            </div>
            <div class="d-flex flex-row">
              <v-btn
                small
                elevation="0"
                class="primary py-1 px-2 ml-2"
                dark
                @click="[(fishDialog = true), createQr()]"
              >
                <v-icon small>mdi mdi-note-text</v-icon>
                <span>ژتون</span>
              </v-btn>
              <div class="rounded white--text info py-1 px-2 caption">
                <span>اعتبار :</span>
                <span>{{ $page.props.$user.credit / 1000 }}</span>
                <span> هزار تومان </span>
              </div>
              <v-btn
                small
                elevation="0"
                class="success py-1 px-2 mr-2"
                dark
                @click="creditDialog = true"
              >
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
                <span>{{ persianDate(time) }}</span>
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

          <v-col cols="12 pa-0" :key="day">
            <table class="col-12 pa-0">
              <thead>
                <tr>
                  <td>روز</td>
                  <td>ناهار</td>
                  <td>شام</td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="day in company.business_days">
                  <td>
                    <span
                      v-if="persianDate(weekMap[day].date) === persianDate(new Date())"
                    >
                      <v-icon>mdi mdi-arrow-left</v-icon>
                    </span>
                    <span>{{ weekMap[day].name }}</span>
                    <span class="caption">({{ persianDate(weekMap[day].date) }})</span>
                  </td>
                  <td>
                    <v-btn
                      small
                      color="primary"
                      :text="checkReserve({ day, meal: 'lunch' })"
                      @click="chooseMeal({ day, meal: 'lunch' })"
                    >
                      {{ checkReserve({ day, meal: "lunch" }) || "انتخاب" }}
                    </v-btn>
                  </td>
                  <td>
                    <v-btn
                      small
                      color="primary"
                      :text="checkReserve({ day, meal: 'dinner' })"
                      @click="chooseMeal({ day, meal: 'dinner' })"
                    >
                      {{ checkReserve({ day, meal: "dinner" }) || "انتخاب" }}
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </table>
          </v-col>
        </v-row>
      </v-container>
    </v-main>

    <v-dialog v-model="dialog" max-width="500px">
      <v-card>
        <v-card-title>
          <span>انتخاب غذا</span>
          <v-spacer></v-spacer>
          <v-btn icon color="error" @click="dialog = false">
            <v-icon>mdi mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
          <v-card outlined rounded>
            <v-card-title>
              <span>غذا ها</span>
              <span class="caption mx-2" v-if="isMealPast()"
                >(زمان رزرو غذا در این روز به پایان رسیده)</span
              >
            </v-card-title>
            <v-card-text>
              <div class="d-flex flex-column">
                <div
                  v-for="meal in selectedMeal"
                  class="d-flex align-center justify-space-between my-2"
                >
                  <span>{{ meal.food.name }}</span>
                  <span>{{ meal.price }}</span>
                  <v-btn
                    :disabled="meal.is_past || !(meal.is_reserved || !hasReserve())"
                    @click="reserve(meal)"
                    icon
                    :color="meal.is_reserved ? 'error' : 'green'"
                  >
                    <v-icon v-if="!meal.is_reserved">mdi mdi-check</v-icon>
                    <v-icon v-else>mdi mdi-close</v-icon>
                  </v-btn>
                </div>
              </div>
            </v-card-text>
          </v-card>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog v-model="creditDialog" max-width="500px">
      <v-card>
        <v-card-title>
          <span>افزایش اعتبار</span>
          <v-spacer></v-spacer>
          <v-btn icon color="error" @click="creditDialog = false">
            <v-icon>mdi mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
          <v-form v-model="validCredit">
            <v-text-field
              v-model="credit"
              outlined
              dense
              label="میزان افزایش (تومان)"
              type="number"
              required
              :rules="[(val) => val > 2000 || 'میزان افزایش باید بزرگتر از 2000 باشد']"
              class="mt-3"
            />
            <v-btn small color="success" class="px-6" @click="addCredit"
              >افزایش اعتبار</v-btn
            >
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog v-model="fishDialog" max-width="500px">
      <v-card>
        <v-card-title>
          <span>ژتون</span>
          <v-spacer></v-spacer>
          <v-btn icon color="error" @click="fishDialog = false">
            <v-icon>mdi mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
          <div
            class="d-flex flex-row justify-center align-center rounded"
            v-for="toDayReserve in toDayReserves"
          >
            <canvas :ref="'canvas' + toDayReserve.id"></canvas>
            <div class="d-flex flex-column">
              <span class="rounded py-1 px-4 info white--text">
                تاریخ : {{ new Date().toLocaleDateString("fa-IR") }}
              </span>
              <span class="rounded mt-1 py-1 px-4 info white--text">
                نام غذا : {{ getSafe(toDayReserve, "food.name") }}
              </span>
              <span class="mt-1 rounded py-1 px-4 info white--text">
                وعده : {{ mealMap[getSafe(toDayReserve, "meal")] }}
              </span>
              <span class="mt-1 rounded py-1 px-4 info white--text">
                نام کاربر : {{ getSafe($page, "props.$user.name") }}
              </span>
            </div>
          </div>
        </v-card-text>
      </v-card>
    </v-dialog>

    <Alert />
    <Loading />
  </v-app>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";
import { Alert } from "majra";
import { get as getSafe } from "lodash";
import { Inertia } from "@inertiajs/inertia";
import Loading from "@/components/utilities/Loading";
import QRCode from "qrcode";

export default {
  components: { Link, Alert, Loading },

  props: ["meals", "time", "foods", "company", "week", "startOfWeek", "toDayReserves"],

  data: () => ({
    dialog: false,
    fishDialog: false,
    creditDialog: false,
    credit: false,
    validCredit: false,
    selectedMeal: [],
    mealMap: {
      breakfast: "صبحانه",
      lunch: "نهار",
      dinner: "شام",
    },
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

  beforeCreate() {
    Date.prototype.addDays = function (days) {
      var date = new Date(this.valueOf());
      date.setDate(date.getDate() + days);
      return date;
    };
  },

  created() {
    this.makePlan();
  },

  computed: {
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

  methods: {
    getSafe,
    createQr() {
      setTimeout(() => {
        for (const toDayReserve of this.toDayReserves) {
          let canvas = this.$refs["canvas" + toDayReserve.id][0];
          console.log(canvas);
          QRCode.toCanvas(
            canvas,
            getSafe(this.$page, "props.$user.name") +
              " - " +
              this.mealMap[getSafe(toDayReserve, "meal")] +
              " - " +
              getSafe(toDayReserve, "food.name") +
              " - " +
              new Date().toLocaleDateString("fa-IR")
          );
        }
      }, 500);
    },
    persianDate(date) {
      return new Date(date).toLocaleDateString("fa-IR");
    },
    hasReserve() {
      return this.selectedMeal.findIndex((meal) => meal.is_reserved) > -1;
    },
    isMealPast() {
      return this.selectedMeal.findIndex((meal) => meal.is_past) > -1;
    },
    addCredit() {
      if (!this.validCredit) return;

      this._event("loading", true);
      axios
        .post("/credit", { credit: this.credit })
        .then((response) => {
          window.location = getSafe(response, "data.action");
        })
        .catch((error) => {
          this._event("alert", {
            text: getSafe(error, "response.data.message"),
            color: "error",
          });
        })
        .finally(() => {
          this._event("loading", false);
        });
    },
    reserve(meal) {
      this._event("loading", true);
      axios
        .post("/profile", { meal_id: meal.id })
        .then((response) => {
          this.dialog = false;
          this._event("alert", {
            text: getSafe(response, "data.message"),
            color: "success",
          });
          Inertia.reload();
        })
        .catch((error) => {
          this._event("alert", {
            text: getSafe(error, "response.data.message"),
            color: "error",
          });
        })
        .finally(() => {
          this._event("loading", false);
        });
    },
    checkReserve({ meal, day }) {
      const key = this.weekMap[day].standardDate;
      const selectedMeal = getSafe(this.meals, key + "." + meal, []);
      for (const meal of selectedMeal) {
        if (meal.is_reserved) {
          return meal.food.name;
        }
      }
      return false;
    },
    chooseMeal({ meal, day }) {
      const key = this.weekMap[day].standardDate;
      const selectedMeal = getSafe(this.meals, key + "." + meal);
      if (!selectedMeal) {
        return this._event("alert", {
          text: "وعده غذایی تعریف نشده است.",
          color: "error",
        });
      }
      this.selectedMeal = selectedMeal;
      this.dialog = true;
    },
    makePlan() {
      let i = 0;
      let startOfWeek = new Date(this.startOfWeek);
      for (const nameOfWeek in this.weekMap) {
        let date = startOfWeek.addDays(i++);
        this.weekMap[nameOfWeek].date = date;
        const month = +date.getMonth() + 1;
        const day = +date.getDate();
        const year = +date.getFullYear();

        this.weekMap[nameOfWeek].standardDate =
          year +
          "-" +
          ((month > 9 ? "" : "0") + month) +
          "-" +
          ((day > 9 ? "" : "0") + day);
      }
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

td {
  padding: 10px 5px;
}

table {
  border-collapse: collapse;
}

td {
  border-bottom: 1px solid rgba(0, 0, 0, 0.12);
}
</style>
