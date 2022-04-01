@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12">
        <!-- DIRECT CHAT -->
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Direct Chat</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <b> klik disini</b> <i class="fas fa-plus ml-2"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                        <form action="#" method="post">
                            <div class="form-group">
                              <label for="">nama</label>
                              <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                              <small id="helpId" class="text-muted">Help text</small>
                            </div>
                        </form>
                    </div>
                    <!-- /.direct-chat-msg -->
                </div>
                <!--/.direct-chat-messages-->

                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="{{ asset('assets') }}/dist/img/user1-128x128.jpg"
                                    alt="User Avatar">

                                <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                        Count Dracula
                                        <small class="contacts-list-date float-right">2/28/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">How have you been? I was...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="{{ asset('assets') }}/dist/img/user7-128x128.jpg"
                                    alt="User Avatar">

                                <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                        Sarah Doe
                                        <small class="contacts-list-date float-right">2/23/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">I will be waiting for...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="{{ asset('assets') }}/dist/img/user3-128x128.jpg"
                                    alt="User Avatar">

                                <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                        Nadia Jolie
                                        <small class="contacts-list-date float-right">2/20/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">I'll call you back at...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="{{ asset('assets') }}/dist/img/user5-128x128.jpg"
                                    alt="User Avatar">

                                <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                        Nora S. Vans
                                        <small class="contacts-list-date float-right">2/10/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">Where is your new...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="{{ asset('assets') }}/dist/img/user6-128x128.jpg"
                                    alt="User Avatar">

                                <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                        John K.
                                        <small class="contacts-list-date float-right">1/27/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">Can I take a look at...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="{{ asset('assets') }}/dist/img/user8-128x128.jpg"
                                    alt="User Avatar">

                                <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                        Kenneth M.
                                        <small class="contacts-list-date float-right">1/4/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">Never mind I found...</span>
                                </div>
                                <!-- /.contacts-list-info -->
                            </a>
                        </li>
                        <!-- End Contact Item -->
                    </ul>
                    <!-- /.contacts-list -->
                </div>
                <!-- /.direct-chat-pane -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                //
            </div>
            <!-- /.card-footer-->
        </div>
        <!--/.direct-chat -->
    </section>
    <!-- /.Left col -->
</div>
<!-- /.row (main row) -->

@endsection

@section('script')

@endsection
