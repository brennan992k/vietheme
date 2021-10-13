// "use strict";

var url = $(".url").val();
var token = $("input[name=_token]").val();
var currency_symbol = $("#currency_symbol").val();

function GetOutPutString(data) {
    //  alert('I ama here');
    data.forEach(function(e, index) {
        console.log(e);

        if (e.C_total!=null) {
            $(".databox").append(` <div class="col-xl-3 col-md-6 grid-item cat1 cat1">
                       <div class="single-goods">
                           <div class="goods-thumb">
                               <a href="${
                                 url +
                                 "/item/" +
                                 e.title.split(" ").join("-").toLowerCase() +
                                 "/" +
                                 e.id
                               }">
                                   <img height="200" src="${
                                     e.thumbnail
                                   }" alt="">
                               </a>
                           </div>
                           <div class="good-info">
                               <div class="good-title">
                                   <h3><a href="${
                                     url +
                                     "/item/" +
                                     e.title
                                       .split(" ")
                                       .join("-")
                                       .toLowerCase() +
                                     "/" +
                                     e.id
                                   }">${e.title.substring(0, 20)} ....</a></h3>
                                   <p>By <a href="${
                                     url + "/user/profile/" + e.username
                                   }">${e.username}</a> in <a href="${url+'/category/sub/'+e.category+'/'+e.sub_category}">${e.sub_category}</a></p>
                               </div>
                               <div class="goods-prise">
                               ${currency_symbol}${e.Reg_total}
                                    <br> <a href="#test-form${
                                      e.id
                                    }" data-toggle="modal" data-target="#myModal${e.id}"  id="AddToCart" > <i class="ti-shopping-cart"></i> </a>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div id="myModal${
                     e.id
                   }" class="modal fade dm-item-modal" role="dialog">
                        <div class="modal-dialog modal-lg">
                            
                            <!-- Modal content-->
                            <div class="modal-content">
                            <div class="modal-header align-items-center">
                            <h2 class="modal-title">Customize Your Selection</h2>
                                <button type="button" class="close" data-dismiss="modal"> <i class="ti-close"></i> </button>
                                
                            </div>

                        

                            <div class="modal-body">
                        <form action="${
                          url + "/item/cart/quick"
                        }" method="post">

                                <input type="hidden"  name="_token" value="${token}">
                                <input type="number" hidden id="id" name="id" value="${
                                  e.id
                                }">
                                <input type="text" hidden  name="item_name" value="${
                                  e.title
                                }">
                                <input type="text" hidden  name="item_name" value="${
                                  e.title
                                }">
                                <input type="text" hidden  name="user_id" value="${
                                  e.user_id
                                }">
                                <input type="text" hidden  name="username" value="${
                                  e.username
                                }">
                                <input type="hidden"  id="item_price${
                                  e.id
                                }" name="item_price" value="${e.Reg_total}">
                                <input type="text" hidden id="" name="BuyerFee" value="0">
                                <input type="text" hidden id="" name="Extd_percent" value="0">
                                
                                <input type="hidden"  id="license_input${
                                  e.id
                                }" name="license_type" value="1">
                                <input type="hidden"  id="support_input${
                                  e.id
                                }" name="support_time" value="1">
                                    <div class="row ">
                                        <div class="col-xl-6">
                                            <div class="single_select ">
                                                <h4>Select License</h4>
                                                <div class="select_box">
                                                        <select class="wide SelectLicense form-control" onChange="calculateHomeItem(${
                                                          e.id
                                                        })" id="SelectLicense${e.id}" >
                                                            <option id="reg_val" value="${
                                                              e.Reg_total
                                                            }" selected data-display="Regular">Regular</option>
                                                            <option id="Ex_val" value="${
                                                              e.Ex_total
                                                            }">Extended</option>
                                                            <option id="Co_val" value="${
                                                              e.C_total
                                                            }">Commercial</option>
                                                        </select>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                                <div class="single_select">
                                                    <h4>Select Support Duration</h4>
                                                    <div class="select_box">
                                                            <select class="wide Selectsupport form-control" onChange="calculateHomeItem(${
                                                              e.id
                                                            })" id="Selectsupport${e.id}" >
                                                                    <option value="0" id="six" selected data-display="6 months support">6 Months Support</option>
                                                                    <option value="${
                                                                      e.support_fee
                                                                    }" id="twelve">12 Months Support</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                 <div class="main_content mt-20">

                                    <div class="row gray-bg-2 no-gutters">
                                        <div class="col-xl-6 col-md-6">
                                            <div class="content_left">
                                                <a  class="profile_mini_thumb">
                                                    <img src="${
                                                      url + "/" + e.thumbnail
                                                    }" width="200px" alt="">
                                                </a>
                                                <div class="content_title">
                                                    <p>${e.title}
                                                    <br>
                                                    <span class="user_author"> 
                                                     <p>By <a href="${
                                                       url +
                                                       "/user/profile/" +
                                                       e.username
                                                     }">${e.username}</a> in <a href="${url+'/category/sub/'+e.category+'/'+e.sub_category}">${e.sub_category}</a></p>
                                                    </span>
                                                    <input type="number" id="totalCartItem" value="0" hidden>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <div class="content_left">
                                                <h3> ${currency_symbol}<span id="total_price${e.id}">${e.Reg_total}</span></h3>
                                                <div class="content_title">
                                                    <p class="support_text${
                                                      e.id
                                                    }">
                                                            <span>License:</span>
                                                            <a href="#" id="license_text${
                                                              e.id
                                                            }">Regular</a>
                                                    </p>
                                                    <p class="support_text">
                                                            <span>Support :</span> 
                                                            <small id="support_tym${
                                                              e.id
                                                            }">6 Months Support</small>
                                                </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                  

                                    <div class=" container col-md-4 center-block">
                                         <button id="AddCart" class="boxed-btn boxed-btn float-right" type="submit">Add To Cart</button>
                                    </div>
                                </div>
                            </div>


                               
                            </form>
                            </div>

                        </div>
                    </div>
                   
                   `);
        } else {
            $(".databox").append(` <div class="col-xl-3 col-md-6 grid-item cat1 cat1">
                       <div class="single-goods">
                           <div class="goods-thumb">
                               <a href="${
                                 url +
                                 "/item/" +
                                 e.title.split(" ").join("-").toLowerCase() +
                                 "/" +
                                 e.id
                               }">
                                   <img height="200" src="${
                                     e.thumbnail
                                   }" alt="">
                               </a>
                           </div>
                           <div class="good-info">
                               <div class="good-title">
                                   <h3><a href="${
                                     url +
                                     "/item/" +
                                     e.title
                                       .split(" ")
                                       .join("-")
                                       .toLowerCase() +
                                     "/" +
                                     e.id
                                   }">${e.title.substring(0, 20)} ....</a></h3>
                                   <p>By <a href="${
                                     url + "/user/profile/" + e.username
                                   }">${e.username}</a> in <a href="${url+'/category/sub/'+e.category+'/'+e.sub_category}">${e.sub_category}</a></p>
                               </div>
                               <div class="goods-prise">
                               ${currency_symbol}${e.Reg_total}
                                    <br> <a href="#test-form${
                                      e.id
                                    }" data-toggle="modal" data-target="#myModal${e.id}"  id="AddToCart" > <i class="ti-shopping-cart"></i> </a>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div id="myModal${
                     e.id
                   }" class="modal fade dm-item-modal" role="dialog">
                        <div class="modal-dialog modal-lg">
                            
                            <!-- Modal content-->
                            <div class="modal-content">
                            <div class="modal-header align-items-center">
                            <h2 class="modal-title">Customize Your Selection</h2>
                                <button type="button" class="close" data-dismiss="modal"> <i class="ti-close"></i> </button>
                                
                            </div>

                        

                            <div class="modal-body">
                        <form action="${
                          url + "/item/cart/quick"
                        }" method="post">

                                <input type="hidden"  name="_token" value="${token}">
                                <input type="number" hidden id="id" name="id" value="${
                                  e.id
                                }">
                                <input type="text" hidden  name="item_name" value="${
                                  e.title
                                }">
                                <input type="text" hidden  name="item_name" value="${
                                  e.title
                                }">
                                <input type="text" hidden  name="user_id" value="${
                                  e.user_id
                                }">
                                <input type="text" hidden  name="username" value="${
                                  e.username
                                }">
                                <input type="hidden"  id="item_price${
                                  e.id
                                }" name="item_price" value="${e.Reg_total}">
                                <input type="text" hidden id="" name="BuyerFee" value="0">
                                <input type="text" hidden id="" name="Extd_percent" value="0">
                                
                                <input type="hidden"  id="license_input${
                                  e.id
                                }" name="license_type" value="1">
                                <input type="hidden"  id="support_input${
                                  e.id
                                }" name="support_time" value="1">
                                    <div class="row ">
                                        <div class="col-xl-6">
                                            <div class="single_select ">
                                                <h4>Select License</h4>
                                                <div class="select_box">
                                                        <select class="wide SelectLicense form-control" onChange="calculateHomeItem(${
                                                          e.id
                                                        })" id="SelectLicense${e.id}" >
                                                            <option id="reg_val" value="${
                                                              e.Reg_total
                                                            }" selected data-display="Regular">Regular</option>
                                                            <option id="Ex_val" value="${
                                                              e.Ex_total
                                                            }">Extended</option>
                                                        </select>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                                <div class="single_select">
                                                    <h4>Select Support Duration</h4>
                                                    <div class="select_box">
                                                            <select class="wide Selectsupport form-control" onChange="calculateHomeItem(${
                                                              e.id
                                                            })" id="Selectsupport${e.id}" >
                                                                    <option value="0" id="six" selected data-display="6 months support">6 Months Support</option>
                                                                    <option value="${
                                                                      e.support_fee
                                                                    }" id="twelve">12 Months Support</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                 <div class="main_content mt-20">

                                    <div class="row gray-bg-2 no-gutters">
                                        <div class="col-xl-6 col-md-6">
                                            <div class="content_left">
                                                <a  class="profile_mini_thumb">
                                                    <img src="${
                                                      url + "/" + e.thumbnail
                                                    }" width="200px" alt="">
                                                </a>
                                                <div class="content_title">
                                                    <p>${e.title}
                                                    <br>
                                                    <span class="user_author"> 
                                                     <p>By <a href="${
                                                       url +
                                                       "/user/profile/" +
                                                       e.username
                                                     }">${e.username}</a> in <a href="${url+'/category/sub/'+e.category+'/'+e.sub_category}">${e.sub_category}</a></p>
                                                    </span>
                                                    <input type="number" id="totalCartItem" value="0" hidden>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <div class="content_left">
                                                <h3> ${currency_symbol}<span id="total_price${e.id}">${e.Reg_total}</span></h3>
                                                <div class="content_title">
                                                    <p class="support_text${
                                                      e.id
                                                    }">
                                                            <span>License:</span>
                                                            <a href="#" id="license_text${
                                                              e.id
                                                            }">Regular</a>
                                                    </p>
                                                    <p class="support_text">
                                                            <span>Support :</span> 
                                                            <small id="support_tym${
                                                              e.id
                                                            }">6 Months Support</small>
                                                </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                  

                                    <div class=" container col-md-4 center-block">
                                         <button id="AddCart" class="boxed-btn boxed-btn float-right" type="submit">Add To Cart</button>
                                    </div>
                                </div>
                            </div>


                               
                            </form>
                            </div>

                        </div>
                    </div>
                   
                   `);
        }
        
    });
}

ZoomIn = (id) => {
    $(".features_item_modal").empty();
    $.ajax({
        url: url + "/featureitem/image/" + id,
        method: "GET",
        success: function(data) {
            //console.log(data);

            var html = `<div class="features_item_show" onmouseout="ZoomOut()">
            <div class="feature_thumb">
            <img src="${url}/${data.thumbnail}" width="100%" onmouseout="ZoomOut()" alt="">
            </div>
            <div class="product_name_details d-flex justify-content-between align-items-center">
                <div class="product_name">
                    <h3>${data.title}</h3>
                    <p>by <span>${data.username}</span> </p>
                </div>
                <div class="product_prise">
                ${currency_symbol}${data.total}
                </div>
            </div>
            </div>`;
            $(".features_item_modal").append(html);
        },
    });
};
ZoomOut = () => {
    $(".features_item_modal").empty();
};

$.ajax({
    url: url + "/featureitem",
    method: "GET",
    success: function(data) {
        //console.log(data);
        data = data.data;
        data.forEach(function(e, index) {
            $("#FeatureItem").append(`
            <div class="single-features">
                <a href="${
                  url +
                  "/item/" +
                  e.title.split(" ").join("-").toLowerCase() +
                  "/" +
                  e.id
                }">
                <img src="${
                  e.icon
                }" onmouseover="ZoomIn(${e.id})" onmouseout="ZoomOut()" alt="">
                </a>
            </div>                    
            `);
        });
    },
});

$.ajax({
    url: url + "/free-item",
    method: "GET",
    success: function(data) {
        //console.log(data);
        data = data.data;
        if (data.length <= 18) {
            $("#free_All_Item").remove();
        }
        data.forEach(function(e, index) {
            $("#FreeItem").append(`
            <div class="single-features">
                <a href="${
                  url +
                  "/item/" +
                  e.title.split(" ").join("-").toLowerCase() +
                  "/" +
                  e.id
                }">
                <img src="${
                  e.icon
                }" onmouseover="ZoomIn(${e.id})" onmouseout="ZoomOut()" alt="">
                </a>
            </div>                    
            `);
        });
    },
});

$(document).ready(function() {
    var all = "";
    var bestsell = "";
    var newest = "";
    var bestrated = "";
    var trending = "";
    var high = "";
    var low = "";
    var page = 1;
    var lastpg = 1;
    $.ajax({
        url: url +
            "/homesearch?newest=" +
            newest +
            "&all=" +
            all +
            "&bestrated=" +
            bestrated +
            "&bestsell=" +
            bestsell +
            "&trending=" +
            trending +
            "&high=" +
            high +
            "&low=" +
            low +
            "&page=" +
            page,
        method: "GET",
        success: function(data) {
            console.log(data.data);

            page = 1;
            lastpg = data.last_page;

            data = data.data;
            // alert('before call');
            GetOutPutString(data);
            if (page < lastpg) {
                $(".bt")
                    .append(`<div class="col-xl-12 col-lg-12" style='display: block;margin:auto;'>
                    <div class="load-more text-center mt-10">
                        <button  id="loadMore" class="load-btn" > <i class="ti-reload"></i> Load More</button>
                    </div>
                </div>`);
            }
        },
    });

    //pagination controller
    $(document).on("click", "#loadMore", function() {
        //$(this).fadeOut();
        page = page + 1;
        console.log(page);

        AllDataPaginate(newest, bestsell, all, bestrated, trending, high, low);
    });

    $("#all").click(function() {
        page = 1;
        all = $(this).val();
        bestsell = "";
        newest = "";
        bestrated = "";
        trending = "";
        high = "";
        low = "";
        AllData(all, bestsell, newest, bestrated, trending, high, low);
    });
    $("#bestsell").click(function() {
        page = 1;
        bestsell = $(this).val();
        all = "";
        newest = "";
        bestrated = "";
        trending = "";
        high = "";
        low = "";
        AllData(all, bestsell, newest, bestrated, trending, high, low);
    });
    $("#newest").click(function() {
        page = 1;
        newest = $(this).val();
        all = "";
        bestsell = "";
        bestrated = "";
        trending = "";
        high = "";
        low = "";
        AllData(all, bestsell, newest, bestrated, trending, high, low);
    });
    $("#bestrated").click(function() {
        page = 1;
        bestrated = $(this).val();
        all = "";
        bestsell = "";
        newest = "";
        trending = "";
        high = "";
        low = "";
        AllData(all, bestsell, newest, bestrated, trending, high, low);
    });
    $("#trending").click(function() {
        page = 1;
        trending = $(this).val();
        all = "";
        bestsell = "";
        newest = "";
        bestrated = "";
        high = "";
        low = "";
        AllData(all, bestsell, newest, bestrated, trending, high, low);
    });
    $("#high").click(function() {
        page = 1;
        high = $(this).val();
        all = "";
        bestsell = "";
        newest = "";
        bestrated = "";
        trending = "";
        low = "";
        AllData(all, bestsell, newest, bestrated, trending, high, low);
    });
    $("#low").click(function() {
        page = 1;
        low = $(this).val();
        all = "";
        bestsell = "";
        newest = "";
        bestrated = "";
        trending = "";
        high = "";
        AllData(all, bestsell, newest, bestrated, trending, high, low);
    });

    function AllData(
        all = "",
        bestsell = "",
        newest = "",
        bestrated = "",
        trending = "",
        high = "",
        low = ""
    ) {
        $("#databox").empty();
        $.ajax({
            url: url +
                "/homesearch?newest=" +
                newest +
                "&all=" +
                all +
                "&bestrated=" +
                bestrated +
                "&bestsell=" +
                bestsell +
                "&trending=" +
                trending +
                "&high=" +
                high +
                "&low=" +
                low +
                "&page=" +
                page,
            method: "GET",
            success: function(data) {
                // console.log(data);

                all = "";
                bestsell = "";
                newest = "";
                bestrated = "";
                trending = "";
                high = "";
                low = "";
                lastpg = data.last_page;
                data = data.data;
                $(".bt").empty();
                // $('#loadMore').hide()
                GetOutPutString(data);
                if (page < lastpg) {
                    $(".bt")
                        .append(`<div class="col-xl-12 col-lg-12" style='display: block;margin:auto;'>
                        <div class="load-more text-center mt-10">
                            <button  id="loadMore" class="load-btn" > <i class="ti-reload"></i> Load More</button>
                        </div>
                    </div>`);
                }
            },
        });
    }

    function AllDataPaginate(
        all = "",
        bestsell = "",
        newest = "",
        bestrated = "",
        trending = "",
        high = "",
        low = ""
    ) {
        $.ajax({
            url: url +
                "/homesearch?newest=" +
                newest +
                "&all=" +
                all +
                "&bestrated=" +
                bestrated +
                "&bestsell=" +
                bestsell +
                "&trending=" +
                trending +
                "&high=" +
                high +
                "&low=" +
                low +
                "&page=" +
                page,
            method: "GET",
            success: function(data) {
                lastpg = data.last_page;
                data = data.data;
                // $(".databox").empty();
                $(".bt").empty();
                GetOutPutString(data);
                if (page < lastpg) {
                    $(".bt")
                        .append(`<div class="col-xl-12 col-lg-12" style='display: block;margin:auto;'>
                        <div class="load-more text-center mt-10">
                            <button  id="loadMore" class="load-btn" > <i class="ti-reload"></i> Load More</button>
                        </div>
                    </div>`);
                }
            },
        });
    }
});

function SearchItem(str) {
    if (str.length == 0) {
        document.getElementById("livesearch").innerHTML = "";
        $("#livesearch").hide();
        return;
    }
    $.ajax({
        method: "GET",
        url: url + "/" + "itemsearch?data=" + str,
        success: function(data) {
            console.log(data);

            const val = [...new Set(data.map((x) => x.category))];
            $("#livesearch").show();
            if (data.length != 0) {
                document.getElementById("livesearch").innerHTML = "";
                val.forEach((value) => {
                    $("#livesearch").append(
                        `<a href="${url}/by_search/${value
              .toLowerCase()
              .replace(
                /\s/g,
                "_"
              )}=${str}" class="list-group-item list-group-item-action">${str} in ${value}</a>`
                    );
                });
            } else {
                document.getElementById("livesearch").innerHTML = "";
                $("#livesearch").append(
                    `<a href="${url}/by_search/${str}" class="list-group-item list-group-item-action">${str}</a>`
                );
            }
        },
        error: function(data) {
            console.log("Error:", data);
        },
    });
}

function calculateHomeItem(id, price) {
    var license = document.getElementById("SelectLicense" + id);
    var license_value = parseFloat(
        license.options[license.selectedIndex].value
    ).toFixed(2);
    console.log(license_value);
    var support = document.getElementById("Selectsupport" + id);
    var support_value = parseFloat(
        support.options[support.selectedIndex].value
    ).toFixed(2);
    var ext_price = (ext_price = (license_value * support_value) / 100);
    var show_price = parseInt(license_value) + ext_price;
    console.log(ext_price);
    document.getElementById("total_price" + id).innerHTML = show_price;
    document.getElementById("item_price" + id).value = show_price;
    document.getElementById("license_text" + id).innerHTML =
        license.options[license.selectedIndex].text;
    document.getElementById("support_tym" + id).innerHTML =
        support.options[support.selectedIndex].text;

        if ($("#SelectLicense"+id).prop('selectedIndex')==0) {
            
          $('#license_input'+id).val(1);
      }else if ($("#SelectLicense"+id).prop('selectedIndex')==1) {
          
          $('#license_input'+id).val(2);
      } else {
           $('#license_input'+id).val(3);
      }

    if ($("#Selectsupport" + id).prop("selectedIndex") == 0) {
        $("#support_input" + id).val(1);
    } else {
        $("#support_input" + id).val(2);
    }
    // alert($("#SelectLicense"+id).prop('selectedIndex'));
}