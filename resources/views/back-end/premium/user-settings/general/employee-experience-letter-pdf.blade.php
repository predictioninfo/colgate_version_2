<style>
    html,
    body,
    div {
        font-family: nikosh;
        font-size: 16px;
        line-height: 200%;
    }
</style>
@if($user->experience_letter_id)
<div style="width: 90%; background-color: #fff; padding: 15px;">
    <h1 align="center">{{ $user->experienceLetter->title ?? '' }}</h1>
    {{-- <div style="text-align: right;">
        <img src="{{ public_path($user->experienceLetter->experienceHeader->logo ?? '') }}" alt="">

        <br />
    </div> --}}
    <div>
        <p> {{ now()->format('D-m-y') }}
        </p>
    </div>

    <p>{{ $user->experienceLetter->subject ?? '' }}</p>
    <!-- this can be removed -->
    This is to state that <b>{{ $user->first_name }} {{ $user->last_name }}</b> has been employed at
    {{ Auth::user()->first_name }} {{ Auth::user()->last_named }}
    from <b>{{ $user->joining_date }}</b> to <b>{{ now()->format('D-m-y') }}</b> as a
    <b>{{ $user->userdesignation->designation_name }}</b> with development as his area of expertise.<br />

    <br />
    @if ($user && $user->experienceLetter && $user->experienceLetter->description)
    {!! $user->experienceLetter->description !!}
    @endif
    <br />

    <div align="left">
        <!-- this can be changed to "left" if preferred-->
        Best Regards <br />
        <img src="{{ asset($user->experienceLetter->signature ?? '') }}" alt="" height="20px" width="" 150px>
        <br /><br />
        @if ($user && $user->experienceLetter && $user->experienceLetter->experienceSignatory &&
        $user->experienceLetter->experienceSignatory->first_name)
        {{ $user->experienceLetter->experienceSignatory->first_name }}
        @endif
        @if ($user && $user->experienceLetter && $user->experienceLetter->experienceSignatory &&
        $user->experienceLetter->experienceSignatory->last_name)
        {{ $user->experienceLetter->experienceSignatory->last_name }}
        @endif
        <br />
        <b>{{ $user->first_name }} {{ $user->last_name }}</b><br /> {{ $user->userdesignation->designation_name }}
        <br /> {{ Auth::user()->first_name }} {{ Auth::user()->last_named }}<br />


    </div>

</div>

@else
<style>
    .center-heading {
        text-align: center;
    }

    .center-heading h4 {
        text-decoration: underline;
    }
</style>

<div class="header-logo">
    <div>
        <img style="max-height: 50px;" src="{{ asset($user->company->company_logo ?? null) }}" />
    </div>
</div>
<?php
$date = date('j F, Y');

?>


Date: {{ $date }} <br><br>

<div class="center-heading">
    <h4>TO WHOM IT MAY CONCERN</h4>
</div> <br><br>
<p>This is to certify that <b>{{ $user->first_name . ' ' . $user->last_name }} ({{ $user->company_assigned_id }}) </b>served as
    <b>{{ $user->userdesignation->designation_name ?? null }}</b>
     from <b>{{  $user->joining_date }} to {{ $user->inactive_date }}</b> under <b>Prediction Learning Associates Ltd.</b> </p>

<p>During her service period, she was found very punctual, honest and sincere to her job. She
    was not involved with any activities which is against the Code of Conduct of the company. She
    has no liabilities with this company. We wish her a prosperous and successful career ahead.</p>



<br><br>


<div style="width:1200px;">
    <div style="float:left;width:50%;">
        <p>Yours Sincerely,<br>
            <span><img style="height:30px;width:70px;" src="{{asset('idcard/signature.png')}}"></span>
        </p>
        <p style="padding-top:-35px;">__________________ </P>
        <span>
            Md. Ariful Islam
            <br>
            Managing Director
            <br>
            Prediction Learning Associates Ltd.(PLA)<br>
        </span>
    </div>
</div>
@endif
