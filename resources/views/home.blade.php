@extends('layouts.modern-layout.master')

@section('title')
    {{ auth()->user()->last_name }}'s Dashboard
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chartist.css') }}">
@endpush
@section('content')
    @yield('breadcrumb-list')
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-xl-12 box-col-12 des-xl-100">
                <div class="row">
                    <div class="col-xl-12 col-md-12 box-col-12 des-xl-50">
                        <div class="card profile-greeting">
                            <div class="card-header">
                                <div class="header-top">
                                    <div class="setting-list bg-primary position-unset">
                                        <ul class="list-unstyled setting-option">
                                            <li>
                                                <div class="setting-white"><i class="icon-settings"></i></div>
                                            </li>
                                            <li><i class="view-html fa fa-code font-white"></i></li>
                                            <li><i class="icofont icofont-maximize full-card font-white"></i></li>
                                            <li><i class="icofont icofont-minus minimize-card font-white"></i></li>
                                            <li><i class="icofont icofont-refresh reload-card font-white"></i></li>
                                            <li><i class="icofont icofont-error close-card font-white"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center p-t-0">
                                <h3 class="font-light bg-primary">Welcome Back,
                                    {{ auth()->user()->last_name . ' ' . auth()->user()->first_name }}</h3>
                                <p>Welcome to FEMCAS online.</p>
                                <a href="{{ auth()->user()->member_status ? route('self-update.create') : route('member-register')}}"
                                    class="btn btn-light">{{ auth()->user()->member_status ? 'Update your profile' : 'Complete your Registration' }}</a>
                            </div>
                            <div class="confetti">
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6 box-col-3 des-xl-25 rate-sec">
                        <div class="card income-card card-primary">
                            <div class="card-body text-center">
                                <div class="round-box">
                                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 115.09 122.88">
                                        <title>nigeria-naira</title>
                                        <path
                                            d="M13.42,0H32.1a1.25,1.25,0,0,1,1,.6L58,42.26H83.17v-41A1.23,1.23,0,0,1,84.39,0h17.28a1.23,1.23,0,0,1,1.23,1.23v41h11a1.23,1.23,0,0,1,1.23,1.23V54.55a1.23,1.23,0,0,1-1.23,1.23h-11v9.41h11a1.23,1.23,0,0,1,1.23,1.22V77.48a1.23,1.23,0,0,1-1.23,1.22h-11v43a1.23,1.23,0,0,1-1.23,1.23H84.39a1.25,1.25,0,0,1-1-.6L58,78.7H33.26v43A1.23,1.23,0,0,1,32,122.88H13.42a1.23,1.23,0,0,1-1.23-1.23V78.7h-11A1.23,1.23,0,0,1,0,77.48V66.41a1.23,1.23,0,0,1,1.23-1.22h11V55.78h-11A1.23,1.23,0,0,1,0,54.55V43.49a1.23,1.23,0,0,1,1.23-1.23h11v-41A1.23,1.23,0,0,1,13.42,0ZM33.26,55.78v9.41h17l-4.4-9.41ZM70,65.19H83.17V55.78H65.68L70,65.19ZM83.17,78.7H77.88l5.29,11v-11ZM33.26,32.76v9.5h4.57l-4.57-9.5Z" />
                                    </svg>
                                </div>
                                <h5>Total Savings</h5>
                                <div class="center">
                                     <h4 id="contributions" class="">{!! showAmount(auth()->user()->total_contribution)!!}</h4>
                                     <button id="my-button" class="btn btn-sm"><i class="fa fa-eye-slash f-18" id=thrifting></i></button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6 box-col-3 des-xl-25 rate-sec">
                        <div class="card income-card card-secondary">
                            <div class="card-body text-center">
                                <div class="round-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" >
                                        <path fill-rule="evenodd" d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25zm7.5 0v.09a49.488 49.488 0 00-6 0v-.09a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5zm-3 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                        <path d="M3 18.4v-2.796a4.3 4.3 0 00.713.31A26.226 26.226 0 0012 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 01-6.477-.427C4.047 21.128 3 19.852 3 18.4z" />
                                      </svg>

                                </div>
                                <h5> Loan Profile</h5>
                                @if (auth()->user()->loan_status)
                                    <p>You have active loan</p>
                                    <a href="{{route('self-loan.all', auth()->user()->id)}}" class="btn btn-lg btn-outline-secondary">view loan details</a>

                                @else
                                    <p>You have no active Loan</p>
                                    <a href="{{route('self-loan.apply')}}" class="btn btn-lg btn-outline-secondary"> Apply for loan</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card shadow border-2 b-secondary b-r-3">
                    <div class="card-header d-flex justify-content-around">
                        <h5 class="text-secondary">Latest Contributions Details <br>

                            </h5>

                        <a href="{{route('self-deposit.all',auth()->user()->id )}}" class="btn btn-sm btn-success">View all Contributions</a>

                    </div>
                    <div class="cardbody m-4">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Contribution Period</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (auth()->user()->deposits()->take(5)->get() as $item)
                                        <tr>
                                            <td>{{$item->description}}</td>
                                            <td>{{ showAmountPer($item->amount)}}</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-info w-100">Info <i data-feather="eye"></i></a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No Record Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card shadow border-2 b-info b-r-3">
                    <div class="card-header d-flex justify-content-around">
                        <h5 class="text-secondary">Latest Loan Details</h5>
                        <a href="{{route('self-loan.all', auth()->user()->id)}}" class="btn btn-sm btn-success">View all</a>
                    </div>
                    <div class="cardbody m-4">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Loan Period</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (auth()->user()->loans()->take(5)->get() as $item)
                                        <tr>
                                            <td>{!!loan_status($item->status)!!}</td>
                                            <td>{{ showAmountPer($item->amount)}}</td>
                                            <td><a href="{{route('self-loan.view', $item->id)}}" class="btn btn-sm btn-outline-info w-100">Info <i data-feather="eye"></i></a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center"><p>No Record Found</p></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-2">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title"></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h1>Welcome to FEMCAS ONLINE</h1>
                    <p>The system notices that you are yet to update your records, kindly update your record through the link below</p>
                </div>
                <a class="btn btn-info w-100"  href="{{route('member-register')}}">Proceed to Registration Form</a>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                let member = {{ auth()->user()->member_status }}

                if (member == 0) {
                    $('#exampleModalCenter').modal('show');
                }
                 // Get the element that we want to toggle the class on



                // Create a function to toggle the class
                function toggleClass() {
                    // Get the current class list of the element
                    let cover = $('#contributions');
                    let classes = cover.attr("class");
                    // If the class "active" is not present, add it
                    if (!classes.includes("active")) {
                        cover.addClass("active");
                        cover.text('XXXX');
                        $('#thrifting').attr('class', 'fa fa-eye f-18');
                    } else {
                        // Otherwise, remove it
                        cover.removeClass("active");
                        cover.text('{{ showAmountPer(auth()->user()->totl_contribution)}}');
                        $('#thrifting').attr('class', 'fa fa-eye-slash f-18');
                    }
                }

                // Bind the toggleClass function to the click event of the button
                $("#my-button").click(toggleClass);
            });
        </script>
    @endpush
@endsection
