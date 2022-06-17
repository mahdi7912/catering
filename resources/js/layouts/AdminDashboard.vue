<template>
    <v-app id="style-4">
        <v-navigation-drawer elevation="1" v-model="rightDrawer" color="info" app right
            style="color: #f2f2f2 !important;">
            <v-img src="/images/logo.png" max-width="170" class="my-10 mx-auto" />
            <h3 class="text-center">پنل مدیریت</h3>
            <!-- list -->
            <v-list dark nav class="font-weight-bold mt-3 sidebar-menu">
                <inertia-link v-for="(m, index) in filteredMenu" :key="index" :href="m.link">
                    <v-list-item link>
                        <v-list-item-action>
                            <i :class="m.icon"></i>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>{{ m.title }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </inertia-link>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar dense color="#f5f5f5" fixed app flat>
            <v-btn icon @click.stop="rightDrawer = !rightDrawer">
                <v-icon>mdi-menu</v-icon>
            </v-btn>

            <v-spacer />

            <v-menu bottom min-width="150px" rounded offset-y>
                <template v-slot:activator="{ on }">
                    <v-btn icon v-on="on">
                        <v-avatar color="#f8f9fb" size="30">
                            <v-icon small>md-account</v-icon>
                        </v-avatar>
                    </v-btn>
                </template>
                <v-card>
                    <v-list-item-content class="justify-center">
                        <div class="mx-auto text-center">
                            <h3>{{ $page.props.$user.name }}</h3>
                            <p class="caption mt-1">
                                {{ $page.props.$user.phone }}
                            </p>
                            <v-divider></v-divider>
                            <inertia-link class="d-flex justify-center align-center" href="/logout">
                                <v-btn block text link>
                                    <v-icon>mdi-logout</v-icon>
                                    <span class="mr-2">خروج</span>
                                </v-btn>
                            </inertia-link>
                        </div>
                    </v-list-item-content>
                </v-card>
            </v-menu>
        </v-app-bar>

        <v-main>
            <div class="mx-3 my-3">
                <slot />
            </div>
        </v-main>

        <Alert />
        <Loading />
    </v-app>
</template>

<script>
import { Alert, Loading } from "majra";
import { Link } from "@inertiajs/inertia-vue";

export default {
    components: { Loading, Alert, "inertia-link": Link },

    name: "dashboard",

    created() {
        this.rightDrawer = !this.$vuetify.breakpoint.smAndDown;
    },

    data: () => ({
        rightDrawer: false,
        menu: [
            {
                title: "داشبرد",
                link: "/admin/dashboard",
                icon: "mdi mdi-view-dashboard",
            },
            {
                title: "دسته بندی ها",
                link: "/admin/categories",
                icon: "mdi mdi-menu",
            },
            {
                title: "غذا ها",
                link: "/admin/foods",
                icon: "mdi mdi-food",
            },
            {
                title: "شرکت ها",
                link: "/admin/companies",
                icon: "mdi mdi-factory",
            },
            {
                title: "وعده ها",
                link: "/admin/meals",
                icon: "mdi mdi-food-fork-drink",
            },
            {
                title: "کاربران",
                link: "/admin/users",
                icon: "mdi mdi-account-circle",
            },
            {
                title: "سفارش ها",
                link: "/admin/reserves",
                icon: "mdi mdi-food-turkey",
            },
        ]
    }),

    computed: {
        filteredMenu() {
            return this.menu
        }
    }
};
</script>

<style>
.v-main,
tr:nth-child(even) {
    background-color: #f5f5f5;
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

.theme--light.v-list-item:not(.v-list-item--active):not(.v-list-item--disabled),
.theme--light.v-application {
    color: rgba(0, 0, 0, 0.6);
}

* {
    letter-spacing: normal;
}

a,
a:active,
a:visited {
    text-decoration: none !important;
}
</style>
