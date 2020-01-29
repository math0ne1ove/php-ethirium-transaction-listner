<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">
    <v-app>
        <v-navigation-drawer
            v-model="drawer"
            app
            clipped
        >
            <v-list dense>
                <v-list-item link
                             href="{{ route('wallet') }}"
                             :disabled="{{ route('wallet') === $currentUrl ? 'true' : 'false' }}"
                >
                    <v-list-item-action>
                        <v-icon>mdi-wallet</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Wallets</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link
                             href="{{ route('transaction.index') }}"
                             :disabled="{{ route('transaction.index') === $currentUrl ? 'true' : 'false' }}"
                >
                    <v-list-item-action>
                        <v-icon>mdi-coin</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Transactions</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            app
            clipped-left
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
            <v-toolbar-title>ETH</v-toolbar-title>
        </v-app-bar>

        <v-content>
            <v-container
                fluid
            >
                <v-snackbar
                    :top="true"
                    v-model="snackbar"
                    :timeout="5000"
                    :color="snackbarColor"
                >
                    @{{ snackbarText }}
                    <v-btn
                        color="white"
                        text
                        @click="snackbar = false"
                    >
                        Close
                    </v-btn>
                </v-snackbar>
                @yield('content')
            </v-container>
        </v-content>

        <v-footer app>
            <span>&copy; 2020</span>
        </v-footer>
    </v-app>
</div>

<script>

    window.config = {
        snackbar: {{ $showSnackbar ? 'true' : 'false' }},
        snackbarColor: "{{ $hasError ? $errorColor : $successColor }}",
        snackbarText: "{{ $snackbarText }}"
    }
</script>
<script src="{{ elixir('js/app.js') }}"></script>
@yield('scripts')
</body>
