<body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script
    src="https://www.paypal.com/sdk/js?locale=es_MX&currency=MXN&client-id=AXaKjbCnOPQrKwgDgiShyp0krjWymPBs7Rso0Yi2KI6I5crN9cKtVzR0CSkF9tsNl0O5TpMTEu7h_Yf5"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>

<input id="cantidad" type="number" value="1" min="1">
<br>
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
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            $.post("testing2.php?id=1",{
                oId:data["orderID"]
            });
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                alert('Muchas Gracias ' + details.payer.name.given_name);
            });
        }
    }).render('#paypal-button-container');
    //This function displays Smart Payment Buttons on your web page.
</script>
</body>