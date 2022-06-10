<template>
    <Layout>

        <v-card>
            <v-card-text>
                <h2 class="text-center">به پنل مدیریت خوش امدید</h2>
                <v-row justify="center" class="my-5">
                    <v-col cols="12" lg="2">
                        <v-card dark color="warning">
                            <v-card-text class="white--text">
                                <v-icon size="18">fal fa-shopping-basket</v-icon>
                                <span v-text="'سفارش های امروز'"/>
                            </v-card-text>
                            <v-card-actions class="warning darken-2">
                                <v-spacer/>
                                <span v-text="ordersCount"/>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                    <v-col cols="12" lg="3">
                        <v-card dark color="success">
                            <v-card-text class="white--text">
                                <v-icon size="18">fal fa-sack-dollar</v-icon>
                                <span v-text="'مجموع سفارش های تایید شده'"/>
                            </v-card-text>
                            <v-card-actions class="success darken-2">
                                <v-spacer/>
                                <span v-text="acceptedOrderTotal"/>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                    <v-col cols="12" lg="2">
                        <v-card dark color="indigo">
                            <v-card-text class="white--text">
                                <v-icon size="18">fal fa-users</v-icon>
                                <span v-text="'اعضای شما'"/>
                            </v-card-text>
                            <v-card-actions class="indigo darken-2">
                                <v-spacer/>
                                <span v-text="membersCount"/>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>

    </Layout>
</template>

<script>
import Layout from '@/layouts/AdminDashboard'

export default {
    name: "Dashboard",

    props: {
        ordersCount: {default: 0},
        membersCount: {default: 0},
        acceptedOrderTotal: {default: 0},
    },

    components: {Layout},
}
</script>

