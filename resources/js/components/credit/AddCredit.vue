<template>
  <div class="d-flex">
    <div class="rounded white--text info py-1 px-2 caption">
      <span>اعتبار :</span>
      <span>{{ userCredit }}</span>
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
  </div>
</template>

<script>
import { get as getSafe } from "lodash";

export default {
  props: {
    isCompany: { default: false, type: Boolean },
  },

  data: () => ({
    validCredit: false,
    creditDialog: false,
    credit: 0,
  }),

  computed: {
    userCredit() {
      let credit = this.isCompany
        ? this.$page.props.$user.company.credit
        : this.$page.props.$user.credit;

      return credit / 1000;
    },
  },

  methods: {
    addCredit() {
      if (!this.validCredit) return;

      this._event("loading", true);
      axios
        .post("/credit", { credit: this.credit, isCompany: this.isCompany })
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
  },
};
</script>
