@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="search-form">
                        <form action="search" method="post" id="search_form">
                            {{ csrf_field() }}
                            <div class="row">
                                <p class="search-title">U.S.Business Database</p>       
                            </div>
                            <div class="row">
                                <p>Fill out one or more of the following criteria boxes, then click "View Results" button.</p>
                            </div>
                            <div class="row">
                                <!-- <div class="col-sm-4">
                                    <label>Company Name:</label>
                                    <input type="input" name="businessName" class="form-control">
                                </div>
                                <div class="col-sm-4">
                                    <label>Executive First Name:</label>
                                    <input type="input" name="firstName" class="form-control">
                                </div>
                                <div class="col-sm-4">
                                    <label>Executive Last Name:</label>
                                    <input type="input" name="lastName" class="form-control">
                                </div> -->
                                <div class="col-sm-4">
                                    <label>City:</label>
                                    <input type="input" name="city" class="form-control">
                                </div>
                                <div class="col-sm-4">
                                    <label>State:</label>
                                    <select id="stateProvince" name="stateProvince" class="form-control"><option value="" order="0">All</option><option value="AL" order="1">Alabama</option><option value="AK" order="2">Alaska</option><option value="AZ" order="3">Arizona</option><option value="AR" order="4">Arkansas</option><option value="CA" order="5">California</option><option value="CO" order="6">Colorado</option><option value="CT" order="7">Connecticut</option><option value="DE" order="8">Delaware</option><option value="DC" order="9">District of Columbia</option><option value="FL" order="10">Florida</option><option value="GA" order="11">Georgia</option><option value="GU" order="54">Guam</option><option value="HI" order="12">Hawaii</option><option value="ID" order="13">Idaho</option><option value="IL" order="14">Illinois</option><option value="IN" order="15">Indiana</option><option value="IA" order="16">Iowa</option><option value="KS" order="17">Kansas</option><option value="KY" order="18">Kentucky</option><option value="LA" order="19">Louisiana</option><option value="ME" order="20">Maine</option><option value="MH" order="56">Marshall Island</option><option value="MD" order="21">Maryland</option><option value="MA" order="22">Massachusetts</option><option value="MI" order="23">Michigan</option><option value="FM" order="58">Micronesia</option><option value="MN" order="24">Minnesota</option><option value="MS" order="25">Mississippi</option><option value="MO" order="26">Missouri</option><option value="MT" order="27">Montana</option><option value="NE" order="28">Nebraska</option><option value="NV" order="29">Nevada</option><option value="NH" order="30">New Hampshire</option><option value="NJ" order="31">New Jersey</option><option value="NM" order="32">New Mexico</option><option value="NY" order="33">New York</option><option value="NC" order="34">North Carolina</option><option value="ND" order="35">North Dakota</option><option value="MP" order="55">Northern Marianas</option><option value="OH" order="36">Ohio</option><option value="OK" order="37">Oklahoma</option><option value="OR" order="38">Oregon</option><option value="PW" order="57">Palau</option><option value="PA" order="39">Pennsylvania</option><option value="PR" order="40">Puerto Rico</option><option value="RI" order="41">Rhode Island</option><option value="SC" order="42">South Carolina</option><option value="SD" order="43">South Dakota</option><option value="TN" order="44">Tennessee</option><option value="TX" order="45">Texas</option><option value="UT" order="46">Utah</option><option value="VT" order="47">Vermont</option><option value="VI" order="48">Virgin Islands</option><option value="VA" order="49">Virginia</option><option value="WA" order="50">Washington</option><option value="WV" order="51">West Virginia</option><option value="WI" order="52">Wisconsin</option><option value="WY" order="53">Wyoming</option></select>
                                </div>
                                <!-- <div class="col-sm-4">
                                    <label>Phone:</label>
                                    <input type="input" name="phone" class="form-control">
                                </div> -->
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-3">
                                    <label><input type="checkbox" name="keyword_sic_naic_label" id="keyword_sic_naic_label" value="0">Keyword/SIC/NAICS :</label>
                                </div>
                                <div class="col-sm-9" id="keyword_sic_naic_form" style="display: none;">
                                    <div class="row">
                                        <div class="radio float-left myradio">
                                            <label><input type="radio" name="keyword_sic_naics"  value="1" checked>Search All SICs</label>
                                        </div>
                                        <div class="radio float-left myradio">
                                            <label><input type="radio" name="keyword_sic_naics"  value="2">Search All NAICS</label>
                                        </div>
                                        <div class="radio float-left myradio">
                                            <label><input type="radio" name="keyword_sic_naics"  value="3">Search Primary NAICS Only</label>
                                        </div>
                                        <div class="radio float-left myradio">
                                            <label><input type="radio" name="keyword_sic_naics"  value="4">Search Primary NAICS Only</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="input" name="keyword_sic_naics_allSics_input" id="keyword_sic_naics_allSics_input" class="form-control">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="button" onclick="onKeywordSearch();" name="keyword_sic_naics_allSics_search" value="Search" class="btn btn-default">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Results:</label>
                                            <div id="keyword_sic_naics_allSics_form_results">
                                            
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row"> 
                                <div class="col-sm-3">
                                    <label><input type="checkbox" name="major_industry_group_label" id="major_industry_group_label" value="0">Major Industry Group :</label>
                                </div>
                                <div class="col-sm-9" id="major_industry_group_form" style="display: none;">
                                    <label>Major Industry Group</label>
                                    <div id="major_industry_group_result">
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-3">
                                    <label><input type="checkbox" name="sales_volumn_label" id="sales_volumn_label" value="0">Sales Volumn :</label>
                                </div>
                                <div class="col-sm-9" id="sales_volumn_form" style="display: none;">
                                    <div class="row">
                                        <label>Reslults</label> 
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="sales_volumn_results" class="sales_volumn_form">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="row">
                                 <div class="col-sm-3">
                                    <label>Web Address:</label>
                                 </div>
                                 <div class="col-sm-9">
                                    <div class="radio float-left myradio">
                                            <label><input type="checkbox" name="web_address[]" value="1" checked>Only companies with a web address</label>
                                    </div>
                                    <div class="radio float-left myradio">
                                            <label><input type="checkbox" name="web_address[]" value="0">Companies without a web address</label>
                                    </div>
                                 </div>
                            </div>

                            <div class="row">
                                 <div class="col-sm-3">
                                    <label>Social Site Links:</label>
                                 </div>
                                 <div class="col-sm-8">
                                    <div class="radio float-left myradio">
                                            <label><input type="checkbox" name="social_site_links[]" value="04">Twitter</label>
                                    </div>
                                    <div class="radio float-left myradio">
                                            <label><input type="checkbox" name="social_site_links[]" value="05">LinkedIn</label>
                                    </div>
                                    <div class="radio float-left myradio">
                                            <label><input type="checkbox" name="social_site_links[]" value="06" checked>FaceBook</label>
                                    </div>
                                    <div class="radio float-left myradio">
                                            <label><input type="checkbox" name="social_site_links[]" value="10">Google Plus</label>
                                    </div>
                                 </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-4">
                                    <label>View Page</label>
                                    <div>
                                        From<input type="input" name="start_pageIndex" value="0" style="width: 30px;"> page To <input type="input" name="end_pageIndex" value="0" style="width: 30px;"> page
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-primary" onclick="onSearch();" style="margin-top: 20px;">VIEW RESULTS</button>
                                    </div>
                            </div>
                            <input type="hidden" name="keyword_sic_naic_entered" id="keyword_sic_naic_entered" value="N">
                            <input type="hidden" name="major_industry_group_entered" id="major_industry_group_entered" value="N">
                            <input type="hidden" name="sales_volumn_entered" id="sales_volumn_entered" value="N">
                        </form>
                        <div>
                            
                        <div id="loaderDiv" style="display: none;">
                            <div id="loader"></div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


function onSearch() {
    $("#loaderDiv").attr('style', 'display: block;');
    $("#search_form").submit();
}
$('#keyword_sic_naic_label').click(function() {
        if(this.checked){
            $('#keyword_sic_naic_form').attr('style', 'display: block;');
            $("#keyword_sic_naic_entered").val('Y');
        } else {
            $('#keyword_sic_naic_form').attr('style', 'display: none;');
            $("#keyword_sic_naic_entered").val('N');
        }
});

$('#major_industry_group_label').click(function() {
        if(this.checked){
            $('#major_industry_group_form').attr('style', 'display: block;');
            $("#major_industry_group_entered").val('Y');
            $("#major_industry_group_result").attr('style', 'background-color: #d7d8db;');
            $.ajax({
                url: 'MajorIndustryGroup',
                method: 'get',
                success: function(res) {
                    var data  = JSON.parse(res);
                    // console.log(res);
                        // var data = res;
                        var getMajorIndustryGroupHTML = '';
                        data.forEach(function(row) {
                          getMajorIndustryGroupHTML += '<div class="row"><label style="height:7px;"><input type="checkbox" name="MajorIndustryGroup[]" value="'+row.value+'">'+row.description+'</label></div>';
                        });
                        $("#major_industry_group_result").attr('style', 'background-color: white;');
                        $("#major_industry_group_result").html(getMajorIndustryGroupHTML);
                }
            });
        } else {
            $('#major_industry_group_form').attr('style', 'display: none;');
            $("#major_industry_group_entered").val('N');
        }
});

$('#sales_volumn_label').click(function() {
        if(this.checked){
            $('#sales_volumn_form').attr('style', 'display: block;');
            $("#sales_volumn_entered").val('Y');
            $("#sales_volumn_results").attr('style', 'background-color: #d7d8db;');
            $.ajax({
                url: 'getSalesVolumn',
                method: 'get',
                success: function(res) {
                    var response  = JSON.parse(res);
                    if(response.status == 'success') {
                        var data = response.data;
                        var getSalesVolumnHTML = '';
                        data.forEach(function(row) {
                          getSalesVolumnHTML += '<div class="row"><label style="height:7px;"><input type="checkbox" name="sales_volumn[]" value="'+row.value+'">'+row.label+'</label></div>';
                        });
                        $("#sales_volumn_results").attr('style', 'background-color: white;');
                        $("#sales_volumn_results").html(getSalesVolumnHTML);
                    }
                }
            });
        } else {
            $('#sales_volumn_form').attr('style', 'display: none;');
            $("#sales_volumn_entered").val('N');
        }
});


function onKeywordSearch() {
    var radios = document.getElementsByName('keyword_sic_naics');
    if($("#keyword_sic_naics_allSics_input").val() == '') return;
    for (var i = 0, length = radios.length; i < length; i++)
    {
     if (radios[i].checked)
     {
      var value = radios[i].value;
      if(value == 1 || value == 3){
            $("#keyword_sic_naics_allSics_form_results").attr('style', 'background-color: #d7d8db;');
            $.ajax({
                url: 'getKeywordSICs',
                method: 'post',
                dataType : 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    keyword: $("#keyword_sic_naics_allSics_input").val()
                },
                success: function(res) {
                    // var response  = JSON.parse(res);
                    if(res.status == 'success') {
                        var data = res.data.exact;
                        var getKeywordHTML = '';
                        data.forEach(function(row) {
                          getKeywordHTML += '<div class="row"><label style="height:7px;"><input type="checkbox" name="getKeywordSIC[]" value="'+row.value+'">'+row.label+'</label></div>';
                        });
                        $("#keyword_sic_naics_allSics_form_results").attr('style', 'background-color: white;');
                        $("#keyword_sic_naics_allSics_form_results").html(getKeywordHTML);
                    }
                }
            });
      }else {
            $("#keyword_sic_naics_allSics_form_results").attr('style', 'background-color: #d7d8db;');
            $.ajax({
                url: 'getKeywordNAICS',
                method: 'post',
                dataType : 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    keyword: $("#keyword_sic_naics_allSics_input").val()
                },
                success: function(res) {
                    // var response  = JSON.parse(res);
                    if(res.status == 'success') {
                        var data = res.data;
                        var getKeywordHTML = '';
                        data.forEach(function(row) {
                          getKeywordHTML += '<div class="row"><label style="height:7px;"><input type="checkbox" name="getKeywordNAICS[]" value="'+row.Code+'">'+row.Description+'</label></div>';
                        });
                        $("#keyword_sic_naics_allSics_form_results").attr('style', 'background-color: white;');
                        $("#keyword_sic_naics_allSics_form_results").html(getKeywordHTML);
                    }
                }
            });
      }
      break;
     }
    }
}
</script>
@endsection
