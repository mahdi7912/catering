<template>
  <v-overlay z-index="500" :value="loading">
    <v-icon class="mx-auto">mdi mdi-loading mdi-spin</v-icon>
  </v-overlay>
</template>

<script>
export default {
  data() {
    return {
      loading: false
    };
  },
  created() {
    this._listen("loading", (loading = true) => {
      this.loading = loading;
    }, true);
  }
};
</script>
