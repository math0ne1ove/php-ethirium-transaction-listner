<v-row no-gutters>
    <v-col
        :cols="1"
    >
        <v-card
            class="pa-2"
            tile
            outlined
        >
            {{ $id }}
        </v-card>
    </v-col>
    <v-col
        :cols="6"
    >
        <v-card
            class="pa-2"
            tile
            outlined
        >
            {{ $address }}
        </v-card>
    </v-col>
    <v-col
        :cols="4"
    >
        <v-card
            class="pa-2"
            tile
            outlined
        >
            {{ $balance }}
        </v-card>
    </v-col>
    <v-col
        :cols="1"
    >
        <v-card
            class="pa-2"
            tile
            outlined
        >
            <a class="{{ $header ? 'green--text' : 'red--text' }}" href="{{ $header ? route('wallet.create') : route('wallet.delete', ['wallet' => $id]) }}">
                {{ $header ? 'create' : 'delete' }}
            </a>
        </v-card>
    </v-col>
</v-row>
