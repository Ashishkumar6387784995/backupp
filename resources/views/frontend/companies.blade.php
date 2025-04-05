@extends('frontend.layouts.default_layout')

@section('content')

<div class="page-content">



    <!-- INNER PAGE BANNER -->
    <section class="company-overview">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="search_section">
                        <div class="f_review">
                            <h1>Find great places to work</h1>
                            <p>Get access to millions of company reviews</p>
                            <span>Company name or job title</span>
                            <div class="search-bar">
                                <input type="text" placeholder="" id="search">
                                <a class="find_companies">Find Companies</a>
                            </div>
                            <p class="search_salaries">
                                <a href="#">Do you want to search for salaries?</a>
                            </p>
                        </div>
                        <section class="category-area companies ptb-100 ">

                            <div class="container">

                                <div class="section-title">

                                    <h2>Top companies hiring now</h2>

                                </div>

                                <div class="row justify-content-center" id="companyListShow">
                                    {{--<div class="col-lg-3">
                                        <div class="companiesname">
                                            <a href="#">MNCs <i class="icofont-simple-right"></i></a> <a class="sc" href="company-details.html">3.9 <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></a>
                                            <p>2K+ are Actively Hiring</p>
                                            <div class="complogo">
                                                <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>
                                                <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>
                                                <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>
                                                <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>
                                            </div>
                                        </div>
                                    </div>--}}
                                </div>

                            </div>

                        </section>
                    </div>
                </div>
            </div>
    </section>

    @endsection

@section('styleSheets')

<style>
    .fixed-top {

        position: static;

        margin-bottom: 10px;

    }

    .main-nav {

        position: static;

    }

    section.company-overview {
        padding-top: 150px;
    }

    .search_section span {
        font-size: 16px;
        font-weight: 600;
    }

    .company-overview h1 {
        font-size: 48px;
        font-weight: 600;
    }

    .search-bar {
        display: flex;
        justify-content: start;
        margin-bottom: 20px;
        width: 100%;
        margin-top: 20px;
    }

    .search-bar input {
        width: 50%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background-color: #1a4d9d;
        color: white;
        border: none;
        padding: 10px 20px;
        margin-left: 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .companies {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .company {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 10px;
        width: 200px;
        text-align: center;
    }

    .stars {
        color: #e67e22;
    }

    .reviews {
        color: #1a4d9d;
    }

    .search_section p {
        font-size: 22px;
        color: #595959;
    }

    input#search {
        margin: 0px;
    }

    .find_companies {
        background: linear-gradient(90deg, rgba(2, 33, 98, 1) 0%, rgba(2, 33, 98, 1) 35%, rgba(67, 150, 240, 1) 100%);
        padding: 10px;
        width: 30%;
        display: inline-block;
        margin-left: 10px;
        border-radius: 5px;
        text-align: center;
        font-size: 16px;
        color: #fff;
        font-weight: 600;
    }

    .search_salaries a {
        font-size: 16px;
        color: #2557a7;
        border-bottom: 1px solid;
        text-decoration: none;
    }

    .p_com h2 {
        font-size: 26px;
        font-weight: 600;
    }

    .company-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card_cimg .c_card {
        max-width: 57px;
    }

    .c_name h6 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
    }

    .stars .r_review {
        font-size: 15px;
        font-weight: 400;
        color: #2557a7;
    }

    .c_name {
        margin-left: 10px;
    }

    .search_section p {
        font-size: 22px;
        color: #9d2b6b;
        margin: 0px;
        line-height: 30px;
    }

    .s_comapany {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search_section .s_comapany span {
        font-size: 14px;
        color: grey;
        font-weight: 400;
    }

    .companies-card {
        padding-top: 30px;
    }

    .p_com {
        padding: 50px 0px;
    }

    .card_cimg .c_card {
        width: 75px;
    }

    .search_section .f_review p {
        font-size: 22px;
        color: #595959;
        margin: 0px;
        line-height: 30px;
        margin-bottom: 35px;
    }

    .c_list {
        max-width: 300px;
    }

    .find_companies:hover {
        color: #fff;
    }

    @media(max-width:767px) {
        section.company-overview {
            padding-top: 186px;
        }

        .p_com {
            padding: 20px 0px;
        }

        .c_list {
            max-width: 275px;
        }

        .c_name h6 {
            font-size: 14px;

        }

        .company-overview h1 {
            font-size: 25px;
        }

        .search_section .f_review p {
            font-size: 15px;
            margin-bottom: 35px;
        }

        .search_section .f_review p {
            text-align: center;
            margin-bottom: 30px;
        }

        a.find_companies {
            max-width: 100%;
            width: 100%;
            display: block;
            margin: 0px;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }
    }

    .companiesname p {
        font-size: 14px;
        color: #fff;
    }
</style>

@endsections

@section('script')
<script>
    jQuery(function($) {
        var baseUrl = window.location.origin;
        var showDiv = $('#companyListShow');
        showDiv.empty();
        
        $.ajax({
            url: baseUrl + '/companyListApi',
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success && Array.isArray(response.data)) {
                    console.log('Company fetched successfully!', response.data);

                    // Clear previous results
                    showDiv.empty();

                    // Loop through company data and append to the results container
                    response.data.forEach(company => {

                        let companyName = '';
                        if (company.user.first_name) {
                            companyName = company.user.first_name;
                        }

                        // Limit to first 12 characters
                        let first12Characters = companyName.slice(0, 12);
                        if (companyName.length > 12) {
                            first12Characters += '...';
                        }

                        // Handling company sponsors
                        let sponserHtml = '';
                        if (Array.isArray(company.get_all_company_sponsers) && company.get_all_company_sponsers.length > 0) {
                            company.get_all_company_sponsers.forEach(sponser => {
                                if (sponser.company_logo) {
                                    sponserHtml += `
                                        <a href="${baseUrl}/uploads/company/sponsor/${sponser.company_logo}" target="_blank">
                                            <img src="${baseUrl}/uploads/company/sponsor/${sponser.company_logo}" alt="Logo" style="height: 40px;">
                                        </a>
                                    `;
                                }
                            });
                        }

                        showDiv.append(`
                            <div class="col-lg-3">
                                <div class="companiesname">
                                    <a href="${baseUrl}/companies/${company.id}">${first12Characters} <i class="icofont-simple-right"></i></a>
                                    <a class="sc" href="company-details.html">
                                        3.9 
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </a>
                                    <p>2K+ are Actively Hiring</p>
                                    <div class="complogo">
                                        ${sponserHtml}
                                    </div>
                                </div>
                            </div>
                        `);
                    });

                } else {
                    // If no success or data is invalid
                    showDiv.html('<p style="color: red;">' + (response.message || 'Unknown error') + '</p>');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                // Handling error case
                showDiv.html('<p style="color: red;">Failed while fetching data. Please try again.</p>');
            }
        });
    });
</script>
@endsection