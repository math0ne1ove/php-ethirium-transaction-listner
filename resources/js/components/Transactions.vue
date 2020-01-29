<template>
    <div>
        <v-row no-gutters>
            <v-col
                :cols="4"
            >
                <v-card
                    class="pa-5"
                    tile
                    outlined
                >
                    Hash
                </v-card>
            </v-col>
            <v-col
                :cols="3"
            >
                <v-card
                    class="pa-5"
                    tile
                    outlined
                >
                    FROM
                </v-card>
            </v-col>
            <v-col
                :cols="3"
            >
                <v-card
                    class="pa-5"
                    tile
                    outlined
                >
                    To
                </v-card>
            </v-col>
            <v-col
                :cols="1"
            >
                <v-card
                    class="pa-5"
                    tile
                    outlined
                >
                    ETH
                </v-card>
            </v-col>
            <v-col
                :cols="1"
            >
                <v-card
                    class="pa-5"
                    tile
                    outlined
                >
                    Confirm count
                </v-card>
            </v-col>
        </v-row>
        <div>
            <v-row no-gutters v-for="transaction in transactions" :key="transaction.hash">
                <v-col
                    :cols="4"
                >
                    <v-card
                        class="pa-5"
                        tile
                        outlined
                    >
                        {{ transaction.hash }}
                    </v-card>
                </v-col>
                <v-col
                    :cols="3"
                >
                    <v-card
                        class="pa-5"
                        tile
                        outlined
                    >
                        {{ transaction.from }}
                    </v-card>
                </v-col>
                <v-col
                    :cols="3"
                >
                    <v-card
                        class="pa-5"
                        tile
                        outlined
                    >
                        {{ transaction.to }}
                    </v-card>
                </v-col>
                <v-col
                    :cols="1"
                >
                    <v-card
                        class="pa-5"
                        tile
                        outlined
                    >
                        {{ transaction.valueInEth }}
                    </v-card>
                </v-col>
                <v-col
                    :cols="1"
                >
                    <v-card
                        class="pa-5"
                        tile
                        outlined
                    >
                        {{ transaction.confirm_count }}
                    </v-card>
                </v-col>
            </v-row>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Transactions",

        data() {
            return {
                transactions: []
            }
        },
        methods: {
            loadTransactions() {
                axios.get("transactions/list")
                    .then((response) => {
                        this.transactions = response.data.transactions;
                    })
                    .catch((error) => {
                        //
                    })
            }
        },
        mounted() {
            setInterval(() => {
                this.loadTransactions();
            }, 3000);
        },
        created() {
            this.loadTransactions();
        }
    }
</script>
