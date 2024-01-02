<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .appointment{
            background-color: #eed1d1;
            border: 2px solid  black;
            padding: 20px;
            width: 80%;
            height: 100%;
            margin: 0 auto;
            align-items: center;
        text-wrap: wrap;
        } */
    .table {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

<body id="example" style="font-size: 12px">
    <br> <br>
    <div class="container">
        <div class="appointment">
            <div class="top-section">

                <table style="width:100%">
                    <tr>
                        <th style="width: 50%;font-weight: bold;text-align: start">
                            {{ $appointment->appointmentLetter->ref ?? '' }} </th>
                        <th style="width: 50%; font-weight: bold">Date : {{ date('F j, Y') }} </th>
                    </tr>
                </table>


                <span style="font-size:15px;">
                    @if ($appointment->gender == 'Male')
                        MR. {{ $appointment->first_name . ' ' . $appointment->last_name }}
                    @elseif($appointment->gender == 'Female')
                        MS. {{ $appointment->first_name . ' ' . $appointment->last_name }}
                    @else
                        {{ $appointment->first_name . ' ' . $appointment->last_name }}
                    @endif
                </span> <br><br>
                {{-- <!--<span style=" font-size:15px; "> Father’s Name :{{ $appointment->emoloyeedetail->father_name ?? "" }}</span>--> --}}

                <span style=" font-size:15px; ">S/O: {{ $appointment->emoloyeedetail->father_name ?? '' }} &
                    {{ $appointment->emoloyeedetail->mother_name ?? '' }}</span>
                <br> <br>



                <div class="row">
                    <div class="col-md-12">
                        <table style="width:100%">
                            <tr>
                                <td style="width: 50%; font-weight: bold">Parmanent Address</td>
                                <td style="width: 50%; font-weight: bold">Present Address</td>
                            </tr>
                            <tr>

                                <td style="width: 50%;">
                                    {!! $appointment->appointmentLetter->parmanent_address ?? '' !!}

                                </td>
                                <td style="width: 50%; text-align: start;">
                                    {!! $appointment->appointmentLetter->present_address ?? '' !!}</td>


                            </tr>

                        </table>
                    </div>
                </div>


            </div>
            <div class="body-section">
                <p>Subject : <strong> {!! $appointment->appointmentLetter->appointment_template_subject ?? '' !!} </strong>
                </p>
                <p>Dear <strong>
                        @if ($appointment->gender == 'Male')
                            MR. {{ $appointment->first_name . ' ' . $appointment->last_name }}
                        @elseif($appointment->gender == 'Female')
                            MS. {{ $appointment->first_name . ' ' . $appointment->last_name }}
                        @else
                            {{ $appointment->first_name . ' ' . $appointment->last_name }}
                        @endif
                    </strong>
                </p>
                <p>
                    With reference to your application, interview and subsequent discussions with the management of
                    Prediction Learning Associates Ltd. (PLA), we are pleased to offer you an employment under our
                    Company. You will be assigned for our client Colgate-Palmolive ACI Bangladesh Private Limited. You
                    will be required to join on or before <strong>{{ $appointment->joining_date ?? null }}</strong> .
                    Your employment will be governed by the following terms and conditions:
                </p>
                <p>
                    {!! $appointment->appointmentLetter->appointment_template_general_terms ?? '' !!}
                </p>
                <p>
                    {!! $appointment->appointmentLetter->appointment_template_description ?? '' !!}
                </p>
            </div>

            <div class="company">
                <p>Yours sincerely,</p>
                <p>On behalf of Prediction Learning Associates Limited,

                </p>
                <span>Yours faithfully,</span><br>
                <img style="border-bottom: 1px solid black" src="{{ public_path('uploads/signature/signature.png') }}"
                    height="30px" width="50px"  alt=""><br>
                <span>Md. Ariful Islam </span><br>
                <span>Managing Director </span><br>
                <span>Prediction Lerning Associates Ltd. </span><br>

            </div>
            <br>

            <p>I _________________________________________________confirm that I accept the employment

                on the terms and conditions offered in this letter and I will join on ______________________.
            </p>
            <p>Signature: ________________________________</p>


    </div>



    </div>
</body>

</html>
