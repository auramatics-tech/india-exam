@extends('frontend.layouts.master')
@section('content')
<section class="pt-2">
    <div class="marq1">
        <div class="content col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex si_announce_style">
            <div class="si_width_announce">
            <div class="textmarq">Announcements</div>
            <div class="textmarqmob">Announcements</div>
            </div>
         <marquee direction="left" onmouseover="this.stop()" onmouseout="this.start()">
                <h5 class="si_marq_style">
                    <font class=""><a href="https://earnmoneyjobs.com/kendriya-vidyalaya-patiala-rectuitment-2022/">Kendriya Vidyalaya Patiala Recruitment 2022</a> | <a href="https://earnmoneyjobs.com/district-session-court-faridkot-recruitment-2022-peon-process-server/">District Court Faridkot Recruitment</a> | <a href="https://earnmoneyjobs.com/rbi-assistant-recruitment-2022-rbi-950-assistant-vacancies-feb-march-2022/">RBI 950 Assistant Vacancies</a> </font>
                </h5>
            </marquee>
        </div>
    </div>
    <div class="marq1">
        <div class="content col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex si_announce_style">
            <div class="si_width_announce">
            <div class="textmarq">Announcements</div>
            <div class="textmarqmob">Announcements</div>
            </div>
         <marquee direction="left" onmouseover="this.stop()" onmouseout="this.start()">
                <h5 class="si_marq_style">
                    <font class=""><a href="https://earnmoneyjobs.com/kendriya-vidyalaya-patiala-rectuitment-2022/">Kendriya Vidyalaya Patiala Recruitment 2022</a> | <a href="https://earnmoneyjobs.com/district-session-court-faridkot-recruitment-2022-peon-process-server/">District Court Faridkot Recruitment</a> | <a href="https://earnmoneyjobs.com/rbi-assistant-recruitment-2022-rbi-950-assistant-vacancies-feb-march-2022/">RBI 950 Assistant Vacancies</a> </font>
                </h5>
            </marquee>
        </div>
    </div>
</section>
<section class="si_sec_text su_height">
    <div class="container-fluid px-4">
        <div class="py-0 py-lg-3 py-md-3">
            <div class="shadow rounded">
                <div class="row px-2 bg-white">
                    <div class="py-3 si_heading1">
                        <h1 style="display: none">&nbsp;</h1>
                        <h5 class="su_clr_heading">Welcome to IndiaExamJunction.com !</h5>
                        <p class="text-dark">Here, you can practice Multiple Choice Questions for Competitive Exams.
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 py-1 pb-4">
                        @if (count($categories))

                        <div id="accordion" class="">
                            @foreach ($categories as $k => $category)
                            @if (count($category->get_subcategory))
                            <div class="si_heading" id="heading{{$k}}">
                                <h5 class="si_border1 shadow mb-4 mx-auto"> <button class="d-flex align-items-left justify-content-between w-100 btn text-white collapsed" data-toggle="collapse" data-target="#collapse{{$k}}" aria-expanded="false" aria-controls="collapse{{$k}}"><a href="{{ route('topics', ['id' => $category->id]) }}"></a>{{ $category->name }} <span>
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </span></button>
                                </h5>
                            </div>
                            <div class="si_background si_list collapse" id="collapse{{$k}}" aria-labelledby="heading{{$k}}" data-parent="#accordion">
                                <div class="d-flex">
                                    <img src="{{ asset('frontend/images/question.png') }}" class="su_img_question" alt="question">
                                    <ul class="list-unstyled su_circle">
                                        @foreach ($category->get_subcategory as $key => $val)
                                        @if ($key < 3) <li><i class="fas fa-angle-right"></i><a id="link1" href="{{ next_url($val) }}">{{ $val->name }}</a>
                                            </li>
                                            @endif
                                            @endforeach
                                            <li>
                                                @if ($key > 2)
                                                <i class="fas fa-angle-right"></i><a class="text-decoration-underline" id="link1" href="{{ next_url($category) }}">Read
                                                    more</a>
                                            </li>
                                            @endif
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @endforeach

                        </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 py-1">
                        <div class="si_heading pb-4">
                            <h5 class="si_border shadow mb-2 mx-auto text-center">GOVERNMENT JOBS</h5>
                            <h5 class="py-2 mx-auto text-center border-bottom text-dark">LATEST</h5>
                            <div class="row pt-3">
                                <div class="col-lg-4 col-md-4 col-sm-12 si_center_style">
                                    <a href=""> <img src="{{ asset('frontend/images/psssb_logo.png') }}" alt=""> </a>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 si_center_style">
                                    <a href="">
                                        <h5>PSSSB RECRUITMENT JULY 2022 | GROUP-C VACANCIES IN VARIOUS DEPARTMENTS</h5>
                                    </a>
                                    <span class="text-muted"><a href="" class="text-primary">EarnMoneyJobs.com</a> | July 2, 2022</span>
                                    <p class="mt-2 text-dark">PSSSB Recruitment 2022 PSSSB vacancies 2022 | Punjab Subordinate Service Selection Board (PSSSB) recruitment for various Group C vacancies. All eligible candidates can apply online before the given</p>
                                </div>
                                <div> <a href="">
                                        <p class="text-primary si_floating">Read More</p>
                                    </a></div>
                            </div>
                            <hr class="si_hr_div">
                            <div class="row pt-3">
                                <div class="col-lg-4 col-md-4 col-sm-12 si_center_style">
                                    <a href=""> <img src="{{ asset('frontend/images/psssb_logo.png') }}" alt=""> </a>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 si_center_style">
                                    <a href="">
                                        <h5>IBPS CLERK RECRUITMENT 2022 | NOTIFICATION OUT FOR 7000+ VACANCIES</h5>
                                    </a>
                                    <span class="text-muted"><a href="" class="text-primary">EarnMoneyJobs.com</a> | July 2, 2022</span>
                                    <p class="mt-2 text-dark">IBPS Clerk Recruitment 2022 IBPS Clerk vacancies 2022 | Institute of Banking Personnel Selection (IBPS) recruitment notification released for the post of CWE Clerk-XII to fill 7000+ vacancies. All</p>
                                </div>
                                <div> <a href="">
                                        <p class="text-primary si_floating">Read More</p>
                                    </a></div>
                            </div>
                            <hr class="si_hr_div">
                            <div class="row pt-3">
                                <div class="col-lg-4 col-md-4 col-sm-12 si_center_style">
                                    <a href=""> <img src="{{ asset('frontend/images/psssb_logo.png') }}" alt=""> </a>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 si_center_style">
                                    <a href="">
                                        <h5>PSSSB CLERK RECRUITMENT 2022 | PSSSB 735 CLERK, CLERK IT, CLERK ACCOUNTS VACANCIES</h5>
                                    </a>
                                    <span class="text-muted"><a href="" class="text-primary">EarnMoneyJobs.com</a> | July 2, 2022</span>
                                    <p class="mt-2 text-dark">PSSSB Clerk Recruitment 2022 PSSSB Clerk IT, Clerk Accounts vacancies 2022 | Punjab Subordinate Service Selection Board (PSSSB) recruitment for 704 Clerk, 10 Clerk (IT), 21 Clerk (Accounts)</p>
                                </div>
                                <div> <a href="">
                                        <p class="text-primary si_floating">Read More</p>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 py-1 ">
                        <div class="si_heading pb-4">
                            <h5 class="si_border shadow mb-2 mx-auto text-center">SEARCH GOVT JOBS HERE</h5>
                        </div>
                        <div class="si_left_styling">
                            <h5 class="pt-3">RECENT POSTS</h5>
                            <div class="d-flex">
                                <div class="input-icon">
                                    <input type="text" class="form-control search_radius" value="" name="" placeholder="Search..." id="" />
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                                <div>
                                    <button type="submit" class="btn si_btn_btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <ul class="list-unstyled">
                                <a href="">
                                    <li class="py-2">PSSSB Recruitment July 2022 | Group-C Vacancies in Various Departments</li>
                                </a>
                                <a href="">
                                    <li class="py-2">IBPS Clerk Recruitment 2022 | Notification out for 7000+ Vacancies</li>
                                </a>
                                <a href="">
                                    <li class="py-2">PSSSB Clerk Recruitment 2022 | PSSSB 735 Clerk, Clerk IT, Clerk Accounts Vacancies</li>
                                </a>
                                <a href="">
                                    <li class="py-2">PPSC Senior Assistant Recruitment 2022 |198 Senior Assistant Vacancies</li>
                                </a>
                                <a href="">
                                    <li class="py-2">PPSC Building Inspector Recruitment 2022 | Apply for 157 vacancies</li>
                                </a>
                                <a href="">
                                    <li class="py-2">Army Agnipath Agniveer Recruitment Notification Released 2022</li>
                                </a>
                                <a href="">
                                    <li class="py-2">PPSC Draftsman Recruitment 2022 | PPSC 119 Draftsman</li>
                                </a>
                                <a href="">
                                    <li class="py-2">PPSC Draftsman Recruitment 2022 | PPSC 119 Draftsman</li>
                                </a>
                                <a href="">
                                    <li class="py-2">PPSC Draftsman Recruitment 2022 | PPSC 119 Draftsman</li>
                                </a>
                                <a href="">
                                    <li class="py-2">PPSC Draftsman Recruitment 2022 | PPSC 119 Draftsman</li>
                                </a>
                                <a href="">
                                    <li class="py-2">PPSC Draftsman Recruitment 2022 | PPSC 119 Draftsman</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
@section('script')
<script>
    $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
        $(e.target)
            .prev()
            .find("i:last-child")
            .toggleClass("fa-minus fa-plus");
    });
</script>
@endsection