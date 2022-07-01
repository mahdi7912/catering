<template>
  <Layout>
    <v-container>
      <v-card>
        <v-card-text>
          <div class="align-center justify-center flex-column d-flex">
            <h4 class="text-center mb-3">به پنل مدیریت خوش آمدید</h4>
            <div class="d-flex flex-column flex-md-row">
              <Link href="/company/users" class="d-flex ma-2">
                <v-card class="align-center d-flex flex-column pa-3" min-width="100px">
                  <v-icon>mdi mdi-account</v-icon>
                  <v-divider />
                  <span>کاربران</span>
                </v-card>
              </Link>
              <Link href="/company/reserves" class="d-flex ma-2">
                <v-card class="align-center d-flex flex-column pa-3" min-width="100px">
                  <v-icon>mdi mdi-food-turkey</v-icon>
                  <v-divider />
                  <span>رزرو ها</span>
                </v-card>
              </Link>
              <Link href="/company/companies" class="d-flex ma-2">
                <v-card class="align-center d-flex flex-column pa-3" min-width="100px">
                  <v-icon>mdi mdi-cog</v-icon>
                  <v-divider />
                  <span>تنظیمات</span>
                </v-card>
              </Link>
            </div>
          </div>
        </v-card-text>
      </v-card>
    </v-container>
  </Layout>
</template>

<script>
import Layout from "@/layouts/CompanyDashboard";
import { Link } from "@inertiajs/inertia-vue";

export default {
  components: { Layout, Link },
};
</script>
