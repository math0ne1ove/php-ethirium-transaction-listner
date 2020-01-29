const Web3 = require("web3");

let web3 = new Web3(
    // Replace YOUR-PROJECT-ID with a Project ID from your Infura Dashboard
    new Web3.providers.WebsocketProvider("wss://kovan.infura.io/ws/v3/b7fda4a62ced4110bf2158f70ea40856")
);

const instance = new web3.eth.Contract();

instance.getPastEvents(
    "SomeEvent",
    { fromBlock: "latest", toBlock: "latest" },
    (errors, events) => {
        if (!errors) {
            console.log(events);
        }
    }
);
