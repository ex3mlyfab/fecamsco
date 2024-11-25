@extends('layouts.modern-layout.master')

@section('title')
    {{ $user->fullname }} Profile
@endsection
@push('css')
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Users</h3>
        @endslot
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">{{ $user->fullname }} Profile</li>
    @endcomponent

    <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-body px-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="rounded-circle shadow border-2 b-light" width="200" alt="{{$user->last_name}}"
                                            src="{{ ($user->member()->exists()) ? asset(user_avatar($user->member->avatar)) : asset('femcas-logo.png') }}" />

                                            <h3 class="mb-1 f-20 txt-primary">{{ $user->fullname }}</h3>
                                    <p class="f-12">
                                        <x-badge :user="$user"></x-badge>
                                    </p>
                                </div>
                                <div class="col-md-8">
                                    @isset($user->member)
                                    <div class="row border-2 b-r-4 b-primary pt-4 my-5">
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icon-mobile f-16 p-t-1"></i> Telephone</div>
                                            <div>
                                                <h5>{{ $user->member->telephone ?? '' }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icon-email f-16 p-t-1"></i>Email</div>
                                            <div>
                                                <h5>{{ $user->email }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-throne f-16 p-t-1"></i>Department/Division</div>
                                            <div>
                                                <h5>{{ $user->member->department ?? " "}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-clip f-16 p-t-1"></i>File Number</div>
                                            <div>
                                                <h5>{{ $user->member->file_no ?? " " }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-list f-16 p-t-1"></i>IPPIS No</div>
                                            <div>
                                                <h5>{{ $user->member->ippis_no?? " " }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-throne f-16 p-t-1"></i>Location</div>
                                            <div>
                                                <h5>{{ $user->member->location ?? " " }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="icon bg-primary text-light"><i class="icofont icofont-bill-alt f-16 p-t-1"></i>Total Contribution</div>
                                            <div>
                                                <h5 class="text-center">{!! showAmount($user->total_contribution) !!}</h5>
                                            </div>
                                        </div>


                                    </div>

                                    @endisset
                                    @if (!isset($user->member))
                                            <h1>member has not completed registration</h1>
                                    @endif
                                    @if ($user->member_status == 2)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{route('membership.approve', $user->id)}}" class="btn btn-outline-primary">Approve Membership</a>
                                            </div>
                                            @can('deny-membership')
                                            <div class="col-md-6">
                                                <a href="{{route('membership.decline', $user->id)}}" class="btn btn-outline-danger">Deny Membership</a>
                                            </div>
                                            @endcan

                                        </div>

                                    @endif
                                </div>



                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6 xl-100">
                        <div class="card shadow border-2 b-info">
                          <div class="card-header pb-0">
                            <h5>Financial Info</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="icon bg-primary text-light text-center"><i class="fa fa-money f-16 p-t-1"></i>Total Contribution</div>
                                    <h5 class="text-center">{!! showAmount($user->total_contribution)!!}</h5>
                                </div>

                            </div>

                          </div>
                          <div class="card-body">
                            <ul class="nav nav-tabs border-tab nav-secondary nav-left" id="danger-tab" role="tablist">
                              <li class="nav-item"><a class="nav-link active" id="danger-home-tab" data-bs-toggle="tab" href="#danger-home" role="tab" aria-controls="danger-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>Monthly Contribution</a></li>
                              <li class="nav-item"><a class="nav-link" id="profile-danger-tab" data-bs-toggle="tab" href="#danger-profile" role="tab" aria-controls="danger-profile" aria-selected="false"><i class="icofont icofont-read-book"></i>Loan Profile</a></li>
                              <li class="nav-item"><a class="nav-link" id="contact-danger-tab" data-bs-toggle="tab" href="#danger-contact" role="tab" aria-controls="danger-contact" aria-selected="false"><i class="icofont icofont-contacts"></i>Documents</a></li>
                              <li class="nav-item"><a class="nav-link" id="guarantor-danger-tab" data-bs-toggle="tab" href="#guarantor-contact" role="tab" aria-controls="danger-guarantor" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Guarantors</a></li>
                              <li class="nav-item"><a class="nav-link" id="contributions-danger-tab" data-bs-toggle="tab" href="#deduction-contact" role="tab" aria-controls="danger-deduction" aria-selected="false"><i class="icofont icofont-deal"></i>Deductions</a></li>
                            </ul>
                            <div class="tab-content" id="danger-tabContent">
                              <div class="tab-pane fade show active" id="danger-home" role="tabpanel" aria-labelledby="danger-home-tab">
                                <div class="card shadow border-2 b-secondary b-r-3">
                                    <div class="card-header d-flex justify-content-around">
                                        <h5 class="text-secondary">Latest Contributions Details</h5>
                                        <a href="{{ route('userContribution.get', $user->id) }}" class="btn btn-sm btn-success">View all Contributions</a>
                                    </div>
                                    <div class="cardbody m-4">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Contribution Period</th>
                                                        <th>Amount</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($user->deposits()->take(5)->get() as $item)
                                                        <tr>
                                                            <td>{{ date('M-Y', strtotime($item->description)) }}</td>
                                                            <td>{!! showAmount($item->amount)!!}</td>

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
                              <div class="tab-pane fade" id="danger-profile" role="tabpanel" aria-labelledby="profile-danger-tab">
                                <div class="card shadow border-2 b-info b-r-3">
                                    <div class="card-header d-flex justify-content-around">
                                        <h5 class="text-secondary">Latest Loan Details</h5>
                                        <a href="{{route('self-loan.all', $user->id)}}" class="btn btn-sm btn-success">View all</a>
                                    </div>
                                    <div class="cardbody m-4">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                
                                                        <th>Amount</th>
                                                        <th>Status</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($user->loans()->take(5)->get() as $item)
                                                        <tr>

                                                            <td>{!!showAmount($item->amount)!!}</td>
                                                            <td>{!! loan_status($item->status)!!}</td>

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
                              <div class="tab-pane fade" id="danger-contact" role="tabpanel" aria-labelledby="contact-danger-tab">
                                <h5 class="text-center m-b-4">List of Documents</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="icon bg-primary text-light text-center m-b-2"><i class="icofont icofont-education f-16 p-t-1"></i></div>
                                        @if ($user->guarantors()->exists())
                                            <h5>Download Guarantors' Form <a href="{{ route('guarantor-form', $user->id)}}" class="btn btn-small"> Here</a></h5>
                                        @else
                                            <h5>complete Member registration here <a href="{{route('member-update.create', $user->id)}}" class="btn btn-lg btn-primary">Update Profile</a></h5>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-center">upload guarantor form</h5>
                                        @livewire('upload-user-guarantor', ['user_id' => $user->id])
                                    </div>
                                    <div class="col-12">
                                        @if (isset($user->member->membership_id))
                                        <img src="{{asset('/backend/images/guarantors/'.$user->member->membership_id)}}" width="200" alt="" class="img">
                                        @endif
                                    </div>
                                </div>

                              </div>
                              <div class="tab-pane fade" id="guarantor-contact" role="tabpanel" aria-labelledby="guarantor-danger-tab">
                                <h5 class="text-center">List of Guarantors</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Name</th>
                                            <th>Department </th>
                                            <th>Phone</th>
                                        </thead>
                                        <tbody>
                                            @forelse ($user->guarantors as $item)
                                            <tr>
                                                <td>{{ $item->name}}</td>
                                                <td>{{ $item->department}}</td>
                                                <td>{{ $item->phone }}</td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3"><p class="text-center">No Guarantor details Kindly update Member info</p></td>
                                                </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="deduction-contact" role="tabpanel" aria-labelledby="contributions-danger-tab">
                                @livewire('update-contribution', ['user_id' => $user->id])
                                <div class="card bg-info-light p-5">
                                    @livewire('list-contribution-history', ['user_id' => $user->id])
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
            </div>


    </div>
        @push('scripts')
        @endpush
    @endsection
