"use strict";

var currencySys = $('.currencyIn').val();
var url = $('.url').val();
console.log(url);

/* 
    $(document).ready(function(){ */
        var _categor_id =$("#_categor_id").val();
        var _subcategor_id =$("#_subcategor_id").val();          
        var key = $("#_key").val(); 
        var _tag = $("#_tag").val(); 
        var _attribute =$("#_attribute").val();      
        var _feature_item =$("#_feature_item").val();   
        if (_feature_item) {
            var page = 2;
        } else{
            var page = 1;
        }  
        var all ='';
        var bestsell = '';
        var newest ='';
        var bestrated = '';
        var trending = '';
        var high ='';
        var low = '';
        var min_price = '';
        var max_price = '';
       
        var lastpg = 1;
        var LowSell = '';
        var NoSell ='';
        var MediumSell ='';
        var HighSell ='';
        var TopSell ='';
        var star ='';
       
        
        $.ajax({
            url: url+'/search/free-item?newest='+newest+'&all='+all+'&star='+star+'&_tag='+_tag+'&_attribute='+_attribute+'&NoSell='+NoSell+'&LowSell='+LowSell+'&MediumSell='+MediumSell+'&HighSell='+HighSell+'&TopSell='+TopSell+'&bestrated='+bestrated+'&bestsell='+bestsell+'&trending='+trending+'&high='+high+'&low='+low+'&_categor_id='+_categor_id+'&_subcategor_id='+_subcategor_id+'&key='+key+'&page='+page,
            method: 'GET',
            success:function(data){
                //console.log(data);
                
                page = 1;
                lastpg = data.last_page;                
                data=data.data;   
            
                       
                if (Object.keys(data).length > 0) {   
                data.forEach(function(e,index){                    
                    
                       $(".databox").append(` <div class="col-xl-3 col-md-6 grid-item cat1 cat1">
                       <div class="single-goods">
                           <div class="goods-thumb">
                               <a href="${url+'/item/'+e.title.split(" ").join("-").toLowerCase()+'/'+e.id}">
                               
                                   <img src="${url}/${e.thumbnail}" alt="">
                               </a>
                           </div>
                           <div class="good-info">
                               <div class="good-title">
                                   <h3><a href="${url+'/item/'+e.title.split(" ").join("-").toLowerCase()+'/'+e.id}">${ e.title.substring(0, 20)} ....</a></h3>
                                   <p>By <a href="${url+'/user/profile/'+e.username}">${ e.username}</a> in <a href="${url+'/category/sub/'+e.category+'/'+e.sub_category}">${e.sub_category}</a></p>
                               </div>
                               <div class="goods-prise">
                               ${currencySys} ${e.Reg_total}
                               </div>
                           </div>
                       </div>
                   </div>`)
                   
                });
                    
              }
              else{
                $(".databox").append(`<div class="col-xl-12 col-md-12 grid-item no_item">
                   <h2 class="text-center"> No Item </h2>
                </div>`)
              } 
                if(page < lastpg){
                    $(".bt").append(`<div class="col-xl-12 col-lg-12" style='display: block;margin:auto;'>
                    <div class="load-more text-center mt-10">
                        <button  id="loadMore" class="load-btn" > <i class="ti-reload"></i> Load More</button>
                    </div>
                </div>`);
                }
            }
        
        });
       

        //pagination controller
        $(document).on("click","#loadMore",function() {
            //$(this).fadeOut();
            page = page +1 ;            
            AllDataPaginate(newest,bestsell,all,bestrated,trending,high,low,NoSell,LowSell,MediumSell,HighSell,TopSell);
        });

        $("#NoSell").click(function(){
            page = 1;
            NoSell = 'NoSell';   
            LowSell ='';
            MediumSell ='';
            HighSell ='';
            TopSell ='';         
            bestsell = '';
            newest ='';
            bestrated = '';
            trending = '';
            high ='';
            low = '';
            key='';
            star ='';
            min_price = '';
            max_price = '';
            $(".filter_cat_sale").empty();
            $(".filter_cat_sale").append(`<button class="active">${NoSell}</button>`)
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star); 
        });
        $("#LowSell").click(function(){
            page = 1;
            LowSell = 'LowSell';
            NoSell ='';
            MediumSell ='';
            HighSell ='';
            TopSell ='';
            bestsell = '';
            newest ='';
            bestrated = '';
            trending = '';
            high ='';
            low = '';
            key='';
            star ='';
            min_price = '';
            max_price = '';
            $(".filter_cat_sale").empty();
            $(".filter_cat_sale").append(`<button class="active">${LowSell}</button>`)
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star); 
        });
        $("#MediumSell").click(function(){
            page = 1;
            MediumSell = 'MediumSell';
            NoSell ='';
            LowSell ='';
            HighSell ='';
            TopSell ='';
            bestsell = '';
            newest ='';
            bestrated = '';
            trending = '';
            high ='';
            low = '';
            key='';
            star ='';
            min_price = '';
            max_price = '';
            $(".filter_cat_sale").empty();
            $(".filter_cat_sale").append(`<button class="active">${MediumSell}</button>`)
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star); 
        });
        $("#HighSell").click(function(){
            page = 1;
            HighSell = 'HighSell';
            NoSell ='';
            LowSell ='';
            MediumSell ='';
            TopSell ='';
            bestsell = '';
            newest ='';
            bestrated = '';
            trending = '';
            high ='';
            low = '';
            key='';
            star ='';
            min_price = '';
            max_price = '';
            $(".filter_cat_sale").empty();
            $(".filter_cat_sale").append(`<button class="active">${HighSell}</button>`)
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star); 
        });
        $("#TopSell").click(function(){
            page = 1;
            TopSell = 'TopSell';
            NoSell ='';
            LowSell ='';
            MediumSell ='';
            HighSell ='';
            bestsell = '';
            newest ='';
            bestrated = '';
            trending = '';
            high ='';
            low = '';
            key='';
            star ='';
            min_price = '';
            max_price = '';
            $(".filter_cat_sale").empty();
            $(".filter_cat_sale").append(`<button class="active">${TopSell}</button>`)
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star); 
        });
        $("#all").click(function(){
            page = 1;
            all = $(this).val();
            bestsell = '';
            newest ='';
            bestrated = '';
            trending = '';
            high ='';
            low = '';
            key='';
            star ='';
            min_price = '';
            max_price = '';
            NoSell ='';
            LowSell ='';
            MediumSell ='';
            HighSell ='';
            TopSell ='';
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star); 
        });
        $("#bestsell").click(function(){
            page = 1;
            bestsell = $(this).val();
            all ='';
            newest ='';
            bestrated = '';
            trending = '';
            high ='';
            low = '';
            key='';
            star ='';
            min_price = '';
            max_price = '';
            NoSell ='';
            LowSell ='';
            MediumSell ='';
            HighSell ='';
            TopSell ='';
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star); 
        });
        $("#newest").click(function(){
            
            page = 1;
            newest = $(this).val();
            all ='';
            bestsell = '';
            bestrated = '';
            trending = '';
            high ='';
            low = '';
            key='';
            star ='';
            min_price = '';
            max_price = '';
            NoSell ='';
            LowSell ='';
            MediumSell ='';
            HighSell ='';
            TopSell ='';

            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star); 
        });
        $("#bestrated").click(function(){
            page = 1;
            bestrated = $(this).val();
            all ='';
            bestsell = '';
            newest ='';
            trending = '';
            high ='';
            low = '';
            key='';
            star ='';
            min_price = '';
            max_price = '';
            NoSell ='';
            LowSell ='';
            MediumSell ='';
            HighSell ='';
            TopSell ='';
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star); 
        });
        $("#trending").click(function(){
            page = 1;
            trending = $(this).val();
            all ='';
            bestsell = '';
            newest ='';
            bestrated = '';
            high ='';
            low = '';
            key='';
            star ='';
            min_price = '';
            max_price = '';
            NoSell ='';
            LowSell ='';
            MediumSell ='';
            HighSell ='';
            TopSell ='';
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star); 
        });
        $("#high").click(function(){
            page = 1;
            high = $(this).val();
            all ='';
            bestsell = '';
            newest ='';
            bestrated = '';
            trending = '';
            low = '';
            key='';
            min_price = '';
            max_price = '';
            NoSell ='';
            LowSell ='';
            MediumSell ='';
            HighSell ='';
            TopSell ='';
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star); 
        });
        $("#low").click(function(){
            page = 1;
            low = $(this).val();
            all ='';
            bestsell = '';
            newest ='';
            bestrated = '';
            trending = '';
            high ='';
            key='';
            star ='';
            min_price = '';
            max_price = '';
            NoSell ='';
            LowSell ='';
            MediumSell ='';
            HighSell ='';
            TopSell ='';
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star);           
            
        });

        function showResult(params) {        
            page = 1;
            low = ''
            all ='';
            bestsell = '';
            newest ='';
            bestrated = '';
            trending = '';
            high ='';
            min_price = '';
            max_price = '';
            NoSell ='';
            LowSell ='';
            MediumSell ='';
            HighSell ='';
            star ='';
            TopSell ='';
            if (params.length > 0) {
            key=params    
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star); 
            }           
            
        }
        function Star(params) {

            page = 1;
            star = params;            
            low ='';
            all ='';
            bestsell = '';
            newest ='';
            bestrated = '';
            trending = '';
            high ='';
            key='';
            min_price = '';
            max_price = '';
            NoSell ='';
            LowSell ='';
            MediumSell ='';
            HighSell ='';
            TopSell ='';
            $(".filter_cat_rate").empty();
            $(".filter_cat_rate").append(`<button class="active">${star} Star </button>`)
            AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star);  
               
           }
       $("#price_submit").click((e)=>{
            e.preventDefault();
            var _min =$("#min_price").val()
            var _max =$("#max_price").val()
            page = 1;
            low = ''
            all ='';
            bestsell = '';
            newest ='';
            bestrated = '';
            trending = '';
            high ='';
            star ='';
            NoSell ='';
            LowSell ='';
            MediumSell ='';
            HighSell ='';
            TopSell ='';
                    // key=''
            
             if (parseInt(_max) >= parseInt(_min)) {                
                $(".filter_cat_price").empty();
               $(".filter_cat_price").append(`<button class="active">${_min}  -  ${_max} </button>`)
                min_price =_min                        
                max_price =_max                        
                AllData(all,bestsell,newest,bestrated,trending,high,low,key,min_price,max_price,NoSell,LowSell,MediumSell,HighSell,TopSell,star);                      
                
            } else
            $('#price_filter_msg').html('Max price will be greater than min price');
            // alert('Max price will be greater than min price')
           
       })

        function AllData(all='', bestsell = '' , newest = '', bestrated='',trending='',high ='',low=''){
            $("#databox").empty();      
           // $(".databox").empty();   
        //    console.log(key);
              
            $.ajax({
                 url: url+'/search/free-item?newest='+newest+'&all='+all+'&_tag='+_tag+'&star='+star+'&_attribute='+_attribute+'&NoSell='+NoSell+'&LowSell='+LowSell+'&MediumSell='+MediumSell+'&HighSell='+HighSell+'&TopSell='+TopSell+'&bestrated='+bestrated+'&bestsell='+bestsell+'&trending='+trending+'&high='+high+'&low='+low+'&_categor_id='+_categor_id+'&_subcategor_id='+_subcategor_id+'&key='+key+'&min_price='+min_price+'&max_price='+max_price+'&page='+page,
                method: 'GET',
                success:function(data){
                     console.log(data);

                    all ='';
                    bestsell = '';
                    newest ='';
                    bestrated = '';
                    trending = '';
                    high ='';
                    low = '';
                    lastpg = data.last_page;
                    data=data.data                    
                
                    $("#databox").empty();   
                    $(".bt").empty() 
                    $(".no_item").remove() 
                   // $('#loadMore').hide()  
                   if (Object.keys(data).length > 0) { 
                    data.forEach(function(e,index){                    
                        
                           $(".databox").append(` <div class="col-xl-3 col-md-6 grid-item cat1 cat1">
                           <div class="single-goods">
                               <div class="goods-thumb">
                                   <a href="${url+'/item/'+e.title.split(" ").join("-").toLowerCase()+'/'+e.id}">
                                   <img src="${url}/${e.thumbnail}" alt="">
                                   </a>
                               </div>
                               <div class="good-info">
                                   <div class="good-title">
                                       <h3><a href="${url+'/item/'+e.title.split(" ").join("-").toLowerCase()+'/'+e.id}">${ e.title.substring(0, 20)} ....</a></h3>
                                       <p>By <a href="${url+'/user/profile/'+e.username}">${ e.username}</a> in <a href="${url+'/category/sub/'+e.category+'/'+e.sub_category}">${e.sub_category}</a></p>
                                   </div>
                                   <div class="goods-prise">
                                   ${currencySys} ${e.Reg_total}
                                   </div>
                               </div>
                           </div>
                       </div>`)
                       
                    });
                        
                  }
                  else{    
                    $(".databox").append(`<div class="col-xl-12 col-md-12 grid-item no_item">
                       <h2 class="text-center"> No Item </h2>
                    </div>`)
                  } 
                           if(page < lastpg){
                        $(".bt").append(`<div class="col-xl-12 col-lg-12" style='display: block;margin:auto;'>
                        <div class="load-more text-center mt-10">
                            <button  id="loadMore" class="load-btn" > <i class="ti-reload"></i> Load More</button>
                        </div>
                    </div>`);
                    }
                }

            });
        }

         

        function AllDataPaginate(all='', bestsell = '' , newest = '', bestrated='',trending='',high ='',low=''){
            $.ajax({
                 url: url+'/search/free-item?newest='+newest+'&all='+all+'&_tag='+_tag+'&star='+star+'&_attribute='+_attribute+'&NoSell='+NoSell+'&LowSell='+LowSell+'&MediumSell='+MediumSell+'&HighSell='+HighSell+'&TopSell='+TopSell+'&bestrated='+bestrated+'&bestsell='+bestsell+'&trending='+trending+'&high='+high+'&low='+low+'&_categor_id='+_categor_id+'&_subcategor_id='+_subcategor_id+'&key='+key+'&min_price='+min_price+'&max_price='+max_price+'&page='+page,
                method: 'GET',
                success:function(data){
                    lastpg = data.last_page;
                    data=data.data
                 
                  
                   // $(".databox").empty();
                   $(".bt").empty() 
                   $(".no_item").remove() 
                   if (Object.keys(data).length > 0) {  
                    data.forEach(function(e,index){                    
                        
                           $(".databox").append(` <div class="col-xl-3 col-md-6 grid-item cat1 cat1">
                           <div class="single-goods">
                               <div class="goods-thumb">
                                   <a href="${url+'/item/'+e.title.split(" ").join("-").toLowerCase()+'/'+e.id}">
                                   <img src="${url}/${e.thumbnail}" alt="">
                                   </a>
                               </div>
                               <div class="good-info">
                                   <div class="good-title">
                                       <h3><a href="${url+'/item/'+e.title.split(" ").join("-").toLowerCase()+'/'+e.id}">${ e.title.substring(0, 20)} ....</a></h3>
                                       <p>By <a href="${url+'/user/profile/'+e.username}">${ e.username}</a> in <a href="${url+'/category/sub/'+e.category+'/'+e.sub_category}">${e.sub_category}</a></p>
                                   </div>
                                   <div class="goods-prise">
                                   ${currencySys} ${e.Reg_total}
                                   </div>
                               </div>
                           </div>
                       </div>`)
                       
                    });
                        
                  }
                  else{
                    $(".databox").append(`<div class="col-xl-12 col-md-12 grid-item no_item">
                       <h2 class="text-center"> No Item </h2>
                    </div>`)
                  } 
                    if(page < lastpg){
                        $(".bt").append(`<div class="col-xl-12 col-lg-12" style='display: block;margin:auto;'>
                        <div class="load-more text-center mt-10">
                            <button  id="loadMore" class="load-btn" > <i class="ti-reload"></i> Load More</button>
                        </div>
                    </div>`);
                    }
                    
                }

            });
        }
      

  /*   }); */

   