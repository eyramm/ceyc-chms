<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CEYC Airport City | Online Giving</title>


    @include('panels/styles')

    <style>
        html body {
            height: 0% !important;
        }

        .button {
            display: block !important;
            width: 100% !important;
            border: 1px solid transparent !important;
            text-align: center !important;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            line-height: 1.6;
            border-radius: 0.25rem;
            user-select: none;
            font-weight: 400;
            background-color: #0a2740 !important;
            color: white;
        }

        .card-text:after {
            content: "";
            /* This is necessary for the pseudo element to work. */
            display: block;
            /* This will put the pseudo element on its own line. */
            width: 30%;
            /* Change this to whatever width you want. */
            padding-top: 10px;
            /* This creates some space between the element and the border. */
            border-bottom: 3px solid #0a2740;
        }
    </style>

</head>

<body>
<div class="container">
    <div class="container justify-content-center mt-5">
        @if (Session::has('success'))
            <div class="card">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ Session::get('success') }}</strong>
                </div>
            </div>
        @endif
    </div>



    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title font-weight-bold">
                        KINDLY CONFIRM THE PAYMENT DETAILS
                    </h4>
                    <p class="card-text mt-2">
                        Payment Details
                    </p>
                    <div class="row mt-3 mb-2">
                        <div class="col">
                            <p>
                                Full Name
                            </p>
                        </div>
                        <div class="col">
                                <span>
                                    {{ $payment->full_name }}
                                </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <p>
                                Contact
                            </p>
                        </div>
                        <div class="col">
                                <span>
                                    {{ $payment->contact }}
                                </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <p>
                                Amount
                            </p>
                        </div>
                        <div class="col">
                                <span>
                                    GHS {{ $payment->amount }}
                                </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <p>
                                Reference
                            </p>
                        </div>
                        <div class="col">
                                <span>
                                    {{ $payment->giving_option }}
                                </span>
                        </div>
                    </div>
                    <a class="ttlr_inline"
                       data-APIKey="ZGFkZGRiYWNkMzUzY2JhZTdjYTRhY2NkOTM2MTNiNjM="
                       data-transid="{{ $payment->transaction_id }}"
                       data-amount="{{ $payment->amount }}"
                       data-customer_email="{{ $payment->email }}"
                       data-currency="GHS"
                       data-redirect_url="{{ route('giving.completion') }}/"
                       data-pay_button_text="PAY"
                       data-custom_description="CEYC Airport City" data-payment_method="both">
                    </a>
                    <div class="row">
                        <div class="col">
                            <button class="button" data-toggle="modal"
                                    data-target="#momoModal">
                                PAY WITH MoMo
                            </button>
                        </div>
                        <div class="col">
                            <button class="button" data-toggle="modal"
                                    data-target="#visaModal">
                                PAY WITH CARD
                            </button>
                        </div>
                    </div>

                    <!-- Pay with MobileMoney Modal -->
                    <div class="modal fade" id="momoModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">MOBILE MONEY PAYMENT</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('payment.momo') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">MOBILE NETWORK</label>
                                            <select name="mobile_network" id="seeAnotherField" class="form-control
                                            custom-select" required>
                                                <option value="MTN">MTN</option>
                                                <option value="VDF">Vodafone</option>
                                                <option value="ATL">Airtel</option>
                                                <option value="TGO">Tigo</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">MOBILE NUMBER (Eg:0241123245)</label>
                                            <input type="text" name="contact" value="{{$payment->contact}}"
                                                   class="form-control" required>
                                        </div>

                                        <div class="form-group" id="otherFieldDiv">
                                            <label for="vf_voucher_field">VODAFONE VOUCHER CODE</label>
                                            <label for="vf_voucher_field">Dial *110# -> Option 4 (Makes Sense) -> Option 4 (Generate Voucher)</label>
                                            <input type="number" name="voucher_code" class="form-control"
                                                   id=otherField
                                                   placeholder="Vodafone Users Only">
                                        </div>

                                        <input type="text" name="transaction_id" value="{{ $payment->transaction_id
                                        }}" hidden>
                                        <input type="text" name="amount" value="{{ $payment->amount }}" hidden>
                                        <div class="alert alert-warning mt-2 mb-2">
                                            <span class="font-weight-bold">
                                            Kindly Approve Payment When Prompted.
                                            </span>
                                        </div>
                                        <button class="button">PAY</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Pay with Card Modal-->
                    <div class="modal fade" id="visaModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">CARD PAYMENT</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('payment.card') }}" method="post">
                                        @csrf
                                        <input type="text" name="transaction_id" value="{{ $payment->transaction_id
                                        }}" hidden>
                                        <input type="text" name="amount" value="{{ $payment->amount }}" hidden>
                                        <input type="text" name="customer_email" value="{{ $payment->email }}" hidden>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="">CARD TYPE</label>
                                                <select name="r_switch" id="" class="form-control" required>
                                                    <option value="" selected disabled>
                                                        Select Card Type - VISA/MasterCard
                                                    </option>
                                                    <option value="VIS">VISA</option>
                                                    <option value="MAS">MasterCard</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">CARD NUMBER</label>
                                                <input type="text" name="pan" class="form-control" minlength="16"
                                                       maxlength="20" placeholder="Eg: 4545454545454545">
                                            </div>
                                            <div class="form-group">
                                                <label for="">CARD HOLDER NAME</label>
                                                <input type="text" name="card_holder"
                                                       class="form-control" placeholder="Eg: Abena Abrefa">
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label for="">Expiry Date</label>
                                                    <div class="row">
                                                        <div class="col">
                                                            <select name="exp_month" class="form-control">
                                                                <option value="" selected disabled>MM</option>
                                                                <option value="01">January</option>
                                                                <option value="02">February</option>
                                                                <option value="03">March</option>
                                                                <option value="04">April</option>
                                                                <option value="05">May</option>
                                                                <option value="06">June</option>
                                                                <option value="07">July</option>
                                                                <option value="08">August</option>
                                                                <option value="09">September</option>
                                                                <option value="10">October</option>
                                                                <option value="11">November</option>
                                                                <option value="12">December</option>
                                                            </select>
                                                        </div>
                                                        /
                                                        <div class="col">
                                                            <select name="exp_year" class="form-control">
                                                                <option value="" selected disabled>YY</option>
                                                                <option value="20"> 2020</option>
                                                                <option value="21"> 2021</option>
                                                                <option value="22"> 2022</option>
                                                                <option value="23"> 2023</option>
                                                                <option value="24"> 2024</option>
                                                                <option value="25"> 2025</option>
                                                                <option value="26"> 2026</option>
                                                                <option value="27"> 2027</option>
                                                                <option value="28"> 2028</option>
                                                                <option value="29"> 2029</option>
                                                                <option value="30"> 2030</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label for="">CVV</label>
                                                    <input type="text" name="cvv" class="form-control" minlength="3"
                                                           maxlength="5">
                                                </div>
                                            </div>
                                            <button class="button">PAY</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="https://prod.theteller.net/checkout/resource/api/inline/theteller_inline.js">
</script>
<script src="{{ asset('/js/app.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Access-Control-Allow-Origin': 'https://prod.theteller.net',
            'Access-Control-Allow-Credentials': true,
            'Access-Control-Allow-Headers': '*',
        },
        xhrFields: {
            withCredentials: true
        }
    });
</script>

<script>
    $("#seeAnotherField").change(function () {
        if ($(this).val() == "VDF") {
            $('#otherFieldDiv').show();
            $('#otherField').attr('required', '');
            $('#otherField').attr('data-error', 'This field is required.');
        } else {
            $('#otherFieldDiv').hide();
            $('#otherField').removeAttr('required');
            $('#otherField').removeAttr('data-error');
        }
    });
    $("#seeAnotherField").trigger("change");

    $("#seeAnotherFieldGroup").change(function () {
        if ($(this).val() == "yes") {
            $('#otherFieldGroupDiv').show();
            $('#otherField1').attr('required', '');
            $('#otherField1').attr('data-error', 'This field is required.');
            $('#otherField2').attr('required', '');
            $('#otherField2').attr('data-error', 'This field is required.');
        } else {
            $('#otherFieldGroupDiv').hide();
            $('#otherField1').removeAttr('required');
            $('#otherField1').removeAttr('data-error');
            $('#otherField2').removeAttr('required');
            $('#otherField2').removeAttr('data-error');
        }
    });
    $("#seeAnotherFieldGroup").trigger("change");
</script>

</html>
