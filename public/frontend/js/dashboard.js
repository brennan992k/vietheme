// "use strict";



$(document).ready(function() {
  var currencySys = $('.currencyIn').val();
  
  
   var url = $('.url').val(); 
   var geturl = url+'/author/chart';
   var Years = new Array();
   var Labels = new Array();
   var Prices = new Array();
   var val=2;
   $.get(geturl, function(response){
    console.log(response);
      var total = 0;      
      var item = 0;      
      response.forEach(function(data){
     var arr = data.split("#");
     total=parseFloat(total) + parseFloat(arr[1]);
     item=parseFloat(item) + parseFloat(arr[2]);
          Years.push(arr[0]);
          Prices.push(  parseFloat(arr[1]));
          if (arr[1] != 0) {  

            $("#DateP").append(`<tr class="white_bg" id="">
             <th colspan="3"> ${arr[0]}</th>
            <th colspan="3" >${arr[2]}
            </th>
            <td colspan="3" id="PriceP">${currencySys} ${arr[1]}</td>
            </tr>`);
         }
      });

      $("#DateP").append(`<tr class="black_bg">
      <th colspan="3">total</th>
      <th colspan="3">${item}</th>
      <td colspan="3">${currencySys} ${total}</td>
  </tr>`);
     // console.log(Prices);
  
     
   var ctx = document.getElementById('myChart').getContext('2d');
   var myChart = new Chart(ctx, {
       type: 'line',
       data: {
           labels: Years,
           datasets: [{
               label: 'Total Price',
               data:Prices,
               backgroundColor: [
                   'rgba(143, 52, 245, 0.3)'
               ],
               borderColor: [
                   '#8f34f5'
               ],
               borderWidth: 1
           }]
       },
       options: {
           scales: {
               yAxes: [{
                   ticks: {
                     //   beginAtZero: true
                     callback: function(value, index, values) {
                        return currencySys + value.toFixed(val);
                    }
                   }
               }]
           },
           legend: {
               display: true
           },
       }
     });
   });

   $.get(url+'/author/country-data', function(response){     
      //console.log(response);
      var map = response.reduce(function(map, invoice) {
         var name = invoice.countryname
         var price = +invoice.subtotal
         map[name] = (map[name] || 0) + price
         return map
       }, {})       
       
       var array = Object.keys(map).map(function(name) {
         return {
           country: name,
           total: map[name]
         }
       })
     //  console.log(array);       
        array.forEach(function(data){
         $("#_country").append(` <li class="d-flex justify-content-between">
         <span>${data.country}</span>
         <span class="prise">${currencySys} ${data.total}</span>
     </li>`);  
       
      })
   });

  $('#back').click(function () { 
    console.log('clicked'); 
    var Years = new Array();
    var Labels = new Array();
    var Prices = new Array();    
       var date = $('#get_month_year').val();       
       var d=date.split("-")
       if (d[0] == 1 ) {          
         var m = parseInt(d[0])+11;       
         var y =parseInt(d[1])-1;
        //  console.log('if'+m);
       }else{
        //  console.log('else');
         var m = parseInt(d[0])-1;       
         var y = d[1];         
       }  

       console.log('month'+m);
       var url = $('.url').val(); 
       $.get(url+'/author/chart?month='+m+'&year='+y, function(response){ 
         console.log(response);
          var da=month_name(new Date(""+m+""))   
          $("#forwordEarn").css("display","inline-block")       
          $("#dateEarn").text(da+' '+y);          
          $('#get_month_year').val(m+'-'+y);
         $("#DateP").empty() 
         var total = 0;      
         var item = 0;      
         response.forEach(function(data){
        var arr = data.split("#");
        total=parseFloat(total) + parseFloat(arr[1]);
        item=parseFloat(item) + parseFloat(arr[2]);
             Years.push(arr[0]);
             Prices.push(  parseFloat(arr[1]));
             if (arr[1] != 0) {  
   
               $("#DateP").append(`<tr class="white_bg" id="">
                <th colspan="3"> ${arr[0]}</th>
               <th colspan="3" >${arr[2]}
               </th>
               <td colspan="3" id="PriceP">${currencySys} ${arr[1]}</td>
               </tr>`);
            }else{
            //  $("#DateP").empty() 
             // Prices.push(0);
            }
         });
   
         $("#DateP").append(`<tr class="black_bg">
         <th colspan="3">total</th>
         <th colspan="3">${item}</th>
         <td colspan="3">${currencySys} ${total}</td>
     </tr>`);
     function checkAdult(str) {
      return str > 0;
    }
    var p= Prices.find(checkAdult);    
    if (p == undefined) {
      $("#DateP").empty() 
      $("#DateP").append(`<tr class="black_bg">
      <th colspan="3"></th>
      <th colspan="3"> No Data</th>
      <td colspan="3"></td>
  </tr>`);
        }

    
      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: Years,
              datasets: [{
                  label: 'Total Price',
                  data:Prices,
                  backgroundColor: [
                      'rgba(143, 52, 245, 0.3)'
                  ],
                  borderColor: [
                      '#8f34f5'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                        //   beginAtZero: true
                        callback: function(value, index, values) {
                           return currencySys + value.toFixed(val);
                       }
                      }
                  }]
              },
              legend: {
                  display: true
              },
          }
        });
         
        })
       
  })
  
  $('#forwordEarn').click(function () {  
     var currentdate = $('#get_current_month_').val();
    var Years = new Array();
    var Labels = new Array();
    var Prices = new Array();    
       var date = $('#get_month_year').val();   
      if (currentdate == date) {
        $("#forwordEarn").css("display","none")
      } else {    
       var d=date.split("-")
       if (d[0] == 1 ) {          
         var m =   parseInt(d[0])+1;       
         var y =parseInt(d[1]);
        //  console.log('if'+m);
         
       }else{
         if (parseInt(d[0])!=12) {
           var m = parseInt(d[0])+1; 
           var y = d[1];    
         } else {
          var m = parseInt(d[0])-11;
          var y =parseInt(d[1])+1;
         }
        //  var y = d[1];   
        //  console.log('else'+m);      
       } 
      
       $.get(url+'/author/chart?month='+m+'&year='+y, function(response){ 
         console.log(response);
          var da=month_name(new Date(""+m+""))          
          $("#dateEarn").text(da+' '+y);          
          $('#get_month_year').val(m+'-'+y);
          if (currentdate == m+'-'+y) {          
            $("#forwordEarn").css("display","none")
          }else{  
            $("#forwordEarn").css("display","inline-block")
          }
         $("#DateP").empty() 
         var total = 0;      
         var item = 0;      
         response.forEach(function(data){
        var arr = data.split("#");
        total=parseFloat(total) + parseFloat(arr[1]);
        item=parseFloat(item) + parseFloat(arr[2]);
             Years.push(arr[0]);
             Prices.push(  parseFloat(arr[1]));
             if (arr[1] != 0) {  
   
               $("#DateP").append(`<tr class="white_bg" id="">
                <th colspan="3"> ${arr[0]}</th>
               <th colspan="3" >${arr[2]}
               </th>
               <td colspan="3" id="PriceP">${currencySys} ${arr[1]}</td>
               </tr>`);
            }else{
            //  $("#DateP").empty() 
             // Prices.push(0);
            }
         });
   
         $("#DateP").append(`<tr class="black_bg">
         <th colspan="3">total</th>
         <th colspan="3">${item}</th>
         <td colspan="3">$ ${total}</td>
     </tr>`);
     function checkAdult(str) {
      return str > 0;
    }
    var p= Prices.find(checkAdult);    
    if (p == undefined) {
      $("#DateP").empty() 
      $("#DateP").append(`<tr class="black_bg">
      <th colspan="3"></th>
      <th colspan="3"> No Data</th>
      <td colspan="3"></td>
  </tr>`);
        }

    
      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: Years,
              datasets: [{
                  label: 'Total Price',
                  data:Prices,
                  backgroundColor: [
                      'rgba(143, 52, 245, 0.3)'
                  ],
                  borderColor: [
                      '#8f34f5'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                        //   beginAtZero: true
                        callback: function(value, index, values) {
                           return currencySys + value.toFixed(val);
                       }
                      }
                  }]
              },
              legend: {
                  display: true
              },
          }
        });
         
        })
      }
       
  })

  var month_name = function(dt){
    mlist = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
      return mlist[dt.getMonth()];
    };

$("#statementBack").click(function() {
      var date = $('#get_month_').val();
      var price=0;
      var fees=0;
     console.log(date);
      var d=date.split("-");
      if (d[0] == 1 ) {          
        var m =  12;       
        // var m =  d[0];       
        var y =parseInt(d[1])-1;
        // console.log('if'+m);
      }else{
        var m = parseInt(d[0])-1;       
        var y = d[1];  
        console.log('el'+y);       
      }
      
      
      // var url = $('.url').val(); 
      // var base_url=url;
      // var ajax_url=base_url+'/author/statement-data?month='+m+'&year='+y;
      // console.log(ajax_url);
      
      // $.get(ajax_url, function(response){ 
        $.get(url+'/author/statement-data?month='+m+'&year='+y, function(response){     
        //  console.log('Response '+response['statement']);
          var da=month_name(new Date(""+m+""))
          $("#Last30").css("display","none")
          $("#dateShow").text(da+' '+y);          
          $('#get_month_').val(m+'-'+y);

          $("#StatementForword").css("display","inline-block")
          if (response['statement'].length == 0 ) {
            $("#statement").empty();
            $("#statement").append(`<tr>
            <td data-label="Account"> No Data</td>
            </tr>`);  
            $("#funds").text(currencySys+ 0);
            $("#earning").text(currencySys+ 0);
            $("#TaxW").text(currencySys+ 0 );
            $("#feeI").text(currencySys+ 0);
          }else{
            $("#statement").empty();
            response['statement'].forEach(function(data){
              
              
              if (data.type == 'e') {                                                                     
                price = price - data.price;  
                fees = fees + data.price;  
            }else {
                price = price + data.price; 
            }
              // $("#statement").empty();
              $("#statement").append(`<tr>
              <td data-label="Account">${data.created_at }</td>
              <td data-label="Due Date">8296${data.order_id }</td>
                  <td data-label="Due Date"><a href="#"
                          class="free">${ data.title }</a></td>
                  <td colspan="2" data-label="Period2">${ data.details} </td>
                  <td class="prise-counting"
                  data-label="Period">${currencySys} ${ data.price}</td>
                  <td class="prise-counting red"
                  data-label="Period red">${currencySys} ${ data.type? data.type == 'e' ? '-':'+':'' } ${ data.price} </td>
              </tr>`);
                
              });
              console.log(response['monthly_earn1']);
              console.log('earn');
              
             var AuthorTax = response['AuthorTax'];             
             $("#funds").text(currencySys+ (response['monthly_earn2']).toFixed(2));
             $("#earning").text(currencySys+ (response['monthly_earn1'].toFixed(2)) );
            //  $("#TaxW").text(currencySys+( price*(AuthorTax.tax/100)).toFixed(2) );
             $("#feeI").text(currencySys+ (response['monthly_earn3'].toFixed(2)) );
            //  $("#funds").text(currencySys+ (price - price*(AuthorTax.tax/100)).toFixed(2));
            //  $("#earning").text(currencySys+ (price.toFixed(2)) );
            //  $("#TaxW").text(currencySys+( price*(AuthorTax.tax/100)).toFixed(2) );
            //  $("#feeI").text(currencySys+ (fees.toFixed(2)) );
            }
            
      })
 });

$("#StatementForword").click(function() {
  var date = $('#get_month_').val();
  var currentdate = $('#get_current_month_').val();
  var price=0;
  var fees=0;
  if (currentdate == date) {
    $("#StatementForword").css("display","none")
  } else {
    var d=date.split("-");
    if (d[0] == 1 ) {          
      var m =  parseInt(d[0])+1;       
      var y =parseInt(d[1]);
      console.log('f_if'+m+'-'+y);
      
      
    }else if (d[0]==12) {
      var m = 1;       
      var y = parseInt(d[1])+1;  
      console.log('f_el_if'+m+'-'+y);
    }else{
     
      var m = parseInt(d[0])+1;       
      var y = d[1];  
      console.log('f_el'+m+'-'+y);       
    }
      $.get(url+'/author/statement-data?month='+m+'&year='+y, function(response){     
        //console.log(response);
        var da=month_name(new Date(""+m+""))
        $("#Last30").css("display","none")
        $("#dateShow").text(da+' '+y);          
        $('#get_month_').val(m+'-'+y);
        if (currentdate == m+'-'+y) {          
          $("#StatementForword").css("display","none")
          $("#Last30").css("display","inline-block")
        }else{

          $("#StatementForword").css("display","inline-block")
        }
      
        if (response['statement'].length == 0 ) {
          $("#statement").empty();
          $("#statement").append(`<tr>
          <td data-label="Account"> No Data</td>
          </tr>`); 
          $("#funds").text(currencySys+ 0);
          $("#earning").text(currencySys+ 0);
          $("#TaxW").text(currencySys+ 0 );
          $("#feeI").text(currencySys+ 0); 
        }else{
          $("#statement").empty();
          response['statement'].forEach(function(data){
           // console.log(data);
           if (data.type == 'e') {                                                                     
            price = price - data.price;  
            fees = fees + data.price;  
            }else {
                price = price + data.price; 
            }
            $("#statement").append(`<tr>
            <td data-label="Account">${data.created_at }</td>
            <td data-label="Due Date">8296${data.order_id }</td>
                <td data-label="Due Date"><a href="#"
                        class="free">${ data.title }</a></td>
                <td colspan="2" data-label="Period2">${ data.details} </td>
                <td class="prise-counting"
                data-label="Period">${currencySys} ${ data.price}</td>
                <td class="prise-counting red"
                    data-label="Period red">${currencySys} ${ data.type? data.type == 'e' ? '-':'+':'' } ${ data.price} </td>
            </tr>`);
              
            });
            var AuthorTax = response['AuthorTax'];             
            $("#funds").text(currencySys+ (response['monthly_earn2']).toFixed(2));
            $("#earning").text(currencySys+ (response['monthly_earn1'].toFixed(2)) );
           //  $("#TaxW").text(currencySys+( price*(AuthorTax.tax/100)).toFixed(2) );
            $("#feeI").text(currencySys+ (response['monthly_earn3'].toFixed(2)) );
           //  $("#funds").text(currencySys+ (price - price*(AuthorTax.tax/100)).toFixed(2));
           //  $("#earning").text(currencySys+ (price.toFixed(2)) );
           //  $("#TaxW").text(currencySys+( price*(AuthorTax.tax/100)).toFixed(2) );
           //  $("#feeI").text(currencySys+ (fees.toFixed(2)) );
          }
          
    })
  }
});
function isValidDate(dateString)
{
    // First check for the pattern
    var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

    if(!regex_date.test(dateString))
    {
        return false;
    }else{
      return true;
    }
}

function dat(val){
  var a =  val.split('/');
   return (a[2]+'-'+a[0]+'-'+a[1]);
}
$("#SearhStat").click(() => {
    var from = $("#from").val();
    var to = $("#to").val();  
// console.log(typeof(from));
    var price=0;
    var fees=0;
    var url = $('.url').val(); 
    var base_url=url;
    if (from > to) {
      toastr.error('From date will be grater than to date');
    }else
    var f = dat(from);       
    var t = dat(to);    
    var fromV= isValidDate(f);
    var toV= isValidDate(t);
    if (fromV == true && toV == true ) {
      var url = $('.url').val(); 
      var base_url=url;
      var ajax_url=base_url+'/author/statement-search?from='+f+'&to='+t;
      console.log(ajax_url);
      
      $.get(ajax_url, function(response){    
      //  console.log(response);


        if (response['statement'].length == 0 ) {
          $("#statement").empty();
          $("#statement").append(`<tr>
          <td data-label="Account"> No Data</td>
          </tr>`);                         
          $("#funds").text(currencySys+ 0);
          $("#earning").text(currencySys+ 0);
          $("#TaxW").text(currencySys+ 0 );
          $("#feeI").text(currencySys+ 0);
        }else{
          $("#statement").empty();
          response['statement'].forEach(function(data){
           // console.log(data);
           if (data.type == 'e') {                                                                     
            price = price - data.price;  
            fees = fees + data.price;  
            }else {
                price = price + data.price; 
            }
            $("#statement").append(`<tr>
            <td data-label="Account">${data.created_at }</td>
            <td data-label="Due Date">8296${data.order_id }</td>
                <td data-label="Due Date"><a href="#"
                        class="free">${ data.title }</a></td>
                <td colspan="2" data-label="Period2">${ data.details} </td>
                <td class="prise-counting"
                data-label="Period">${currencySys} ${ data.price}</td>
                <td class="prise-counting red"
                    data-label="Period red">${currencySys} ${ data.type? data.type == 'e' ? '-':'+':'' } ${ data.price} </td>
            </tr>`);
              
            });
            var AuthorTax = response['AuthorTax'];             
            $("#funds").text(currencySys+ (price - price*(AuthorTax.tax/100).toFixed(2)));
            $("#earning").text(currencySys+ (price.toFixed(2)) );
            $("#TaxW").text(currencySys+( price*(AuthorTax.tax/100)).toFixed(2) );
            $("#feeI").text(currencySys+ (fees.toFixed(2)) );
          }
        
       });
    }else{
      toastr.error('Please enter valid date');

    }
  })
})

    $('#from').datepicker({
      iconsLibrary: 'fontawesome',
      icons: {
      rightIcon: '<span class="fa fa-caret-down"></span>'
      }
    });
    $('#to').datepicker({
      iconsLibrary: 'fontawesome',
      icons: {
      rightIcon: '<span class="fa fa-caret-down"></span>'
      }

    });

$("#item_update_notify").on("click",function () {
       var status = $(this).val();
       console.log();
       
})

NotifyUpdate = (id) => {
  console.log(id);
  
    $.ajax({
      type: "GET",
      dataType: 'json',
      url: url + '/' + 'user-update-item-email/'+id,
      success: function (data) {
          if (data.success) {
            toastr.success(data.success)
          } 
          if (data.error) {
            toastr.error(data.error)
          } 
       },
      error: function (data) {
        //  console.log('Error:', data);
      }
  });
}

  function apiTextCopy(api_element,message) {
    
    var copyText = document.getElementById(api_element);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    console.log(message);
    
    var tooltip = document.getElementById(message);
    tooltip.innerHTML = "Copied";
    }

    function outFunc() {
    var tooltip = document.getElementById(message);
    tooltip.innerHTML = "";
    }