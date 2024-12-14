@extends('main')

@section('content')
    <style>
        /* .card {
                                    font-family: 'Magistral-Medium';
                                } */
        li {
            margin-bottom: 5px;
        }
    </style>
    <div class="container mt-3">
        <span class="breadcrumbCustom"><a href="/home">HOME</a> <i class="fa fa-chevron-right ml-2 mr-2"></i> <span
                style="color:#ee2f21">MECHANICS</span></span>
    </div>

    <section class="container mt-3 mb-3">
        <div class="card">
            <div class="row py-5">
                <div class="col-md-12">
                    <div class="px-5">
                        <h2 class="text-center ">SIGLA VALUES AWARDS 2024 </h2>
                        <h4 class="pt-4">Mechanics: </h4>
                        <ol class="pt-4" type="1">
                            <li>The Sigla Values Awards 2024 is open to regular/full-time employees of Megawide Corporate
                                Office. Employees can nominate and be nominated, while Chiefs can only nominate.
                                Self-nominations are not allowed. </li>

                            <li>Take time to observe and identify employee/s and department/s which you believe exhibit/s
                                the
                                Megawide core values. </li>

                            <li>Nominate your selected employee/s, project members or department/s on MegaNet. Fill out the digital
                                nomination
                                form according to category (individual or team), core values and desirable behaviors. You
                                can
                                nominate the same employee/s and department/s as frequently as you can to help them qualify
                                for
                                the annual awards. </li>

                            <li>All nominations will be reviewed and assessed by committee members from Learning and
                                Organizational Effectiveness, Total Rewards, HR Business Partners, the Chief Human Resources
                                Officer, and one representative per department, to determine the deserving awardees. </li>

                            <li>The awardees will be determined based on the following criteria: </li>

                            <div class="px-5 py-4">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Criteria</th>
                                            <th>Details</th>
                                            <th>Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Impact to the team, organization and business </td>
                                            <td>Clear benefit such as increased productivity, cost-savings and customer
                                                satisfaction </td>
                                            <td>45% </td>
                                        </tr>
                                        <tr>
                                            <td>Consistency </td>
                                            <td>Desirable behavior is embedded in the employee&apos;s day-to-day behavior,
                                                not
                                                just one-offs</td>
                                            <td>40%</td>
                                        </tr>
                                        <tr>
                                            <td>Congruence with personal values </td>
                                            <td>Alignment with the employee&apos;s personal values and innate behavior
                                                inside
                                                and outside the organization </td>
                                            <td>15% </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><strong>Total</strong></td>
                                            <td><strong>100%</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <li>There will be awardees for each value on a quarterly basis. Then, at the end of the year, the
                                employee who has earned the highest number of nominations for the same core values will also
                                be awarded. </li>
                            <li>Awardees will receive the following: </li>

                            <div class="px-5 py-4">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Schedule</th>
                                            <th>Details </th>
                                            <th>Reward </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <td>Monthly </td>
                                            <td>Maximum of 6 awardees; individual/team </td>
                                            <td>Each awardee will receive a cash prize or a GC worth P 500.00, and a
                                                certificate. </td>
                                        </tr> --}}
                                        <tr>
                                            <td>Quarterly </td>
                                            <td>2 per quarter;
                                                <br>
                                                1 individual, 1 team
                                            </td>
                                            <td>Each awardee will receive a cash prize or a GC worth P 5,000.00, and a
                                                certificate. </td>
                                        </tr>
                                        <tr>
                                            <td>Annually </td>
                                            <td>1 awardee </td>
                                            <td>The awardee will receive P 30,000.00 in cash, a trophy, certificate, and an
                                                experiential reward based
                                                on the core values the employee has exhibited and awarded on. </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <li>Those who nominated the top 3 awardees will also receive a prize at the end of the year.</li>
                        </ol>

                        <div class="text-center">
                            <a href="{{ url('/nomination') }}">
                                <button class="btn btn-primary mt-3">Nominate</button>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('pageScripts')
    <script src="{{ asset('js/nomination.js') }}"></script>
@endsection
