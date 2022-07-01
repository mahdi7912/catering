<template>
  <v-container fluid>
    <h3 class="text-center primary--text">ورود</h3>
    <v-form v-model="isValid" class="mt-5 d-flex flex-column">
      <v-text-field
        solo
        dense
        rounded
        append-icon="fal fa-account"
        label="نام کاربری"
        v-model="form.user_name"
        :rules="phoneRules"
      />
      <v-text-field
        solo
        dense
        rounded
        append-icon="fal fa-eye"
        label="رمز عبور"
        v-model="form.password"
        :rules="phoneRules"
        @keypress.enter.prevent="login"
      />

      <v-btn
        :loading="loading"
        class="my-3"
        @click.prevent="login"
        color="primary px-10"
        rounded
      >
        ورود
      </v-btn>
    </v-form>
  </v-container>
</template>

<script>
import validations from "@/helpers/validations";

export default {
  name: "registerForm",

  data() {
    return {
      form: {},
      isValid: false,
      phoneRules: [validations.required()],
      loading: false,
    };
  },

  methods: {
    login() {
      this.loading = true;
      axios
        .post("/login", this.form)
        .then((response) => {
          this._event("alert", {
            text: "ورود با موفقیت انجام شد",
            color: "success",
          });
          window.location.reload();
        })
        .catch((error) => {
          this._event("alert", {
            text: "اطلاعات شما یافت نشد",
            color: "error",
          });
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>
