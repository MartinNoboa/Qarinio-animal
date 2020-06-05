
<body>
<script
    src="https://www.paypal.com/sdk/js?locale=es_MX&currency=MXN&client-id=AXaKjbCnOPQrKwgDgiShyp0krjWymPBs7Rso0Yi2KI6I5crN9cKtVzR0CSkF9tsNl0O5TpMTEu7h_Yf5"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>

<input id="cantidad" type="number" value="1" min="1">

<div id="paypal-button-container"></div>

<script>
    cantidad=0;
    paypal.Buttons({
        createOrder: function(data, actions) {
            cantidad=document.getElementById("cantidad").value;
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: cantidad.toString(),
                        currency: 'MXN',
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            console.log(data);
            console.log(data["orderID"]);
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                alert('Transaction completed by ' + details.payer.name.given_name);
            });
        }
    }).render('#paypal-button-container');
    //This function displays Smart Payment Buttons on your web page.
</script>
</body>