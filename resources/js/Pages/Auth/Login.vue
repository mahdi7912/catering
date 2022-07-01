<template>
  <auth-template>
    <register-form></register-form>
  </auth-template>
</template>

<script>
import RegisterForm from "@/components/auth/RegisterForm";
import AuthTemplate from "@/components/auth/AuthTemplate";

export default {
  components: { AuthTemplate, RegisterForm },

  middleware: "guest",

  head: {
    title: "ورود / ثبت نام",
  },
};
</script>
