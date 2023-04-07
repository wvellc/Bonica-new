<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

    var options = {
        "key": "{{$response['razorpayId']}}",
        "amount":"{{$response['amount']}}", // 2000 paise = INR 20
        "currency":"{{$response['currency']}}",
        "name": "{{$response['name']}}",
        "description": "{{$response['description']}}",
        "order_id": "{{$response['orderId']}}",
        "handler": function (response){
            // After payment successfully made response will come here
            // send this response to Controller for update the payment response
            // Create a form for send this data
            // Set the data in form
            document.getElementById('rzp_paymentid').value = response.razorpay_payment_id;
            document.getElementById('rzp_orderid').value = response.razorpay_order_id;
            document.getElementById('rzp_signature').value = response.razorpay_signature;

            // // Let's submit the form automatically
            document.getElementById('rzp-paymentresponse').click();
        },
        "prefill": {
            "email": "{{$response['email']}}",
            "contact": "{{ $response['phone_number'] }}"
        },

        "theme": {
            "color": "#EEC9C2"
        }
    };
    var rzp1 = new Razorpay(options);
    window.onload = function(){
        rzp1.open();
        e.preventDefault();
    };
</script>



<form action="{{route('frontend.store-payment')}}" method="POST" hidden>
    <input type="hidden" value="{{csrf_token()}}" name="_token" />
    <input type="text" class="form-control" id="rzp_paymentid"  name="rzp_paymentid">
    <input type="text" class="form-control" id="rzp_orderid" name="rzp_orderid">
    <input type="text" class="form-control" id="rzp_signature" name="rzp_signature">
    <button type="submit" id="rzp-paymentresponse" class="btn btn-primary">Submit</button>
</form>
