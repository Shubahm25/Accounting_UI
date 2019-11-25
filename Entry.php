<html>  
      <head>  
           <title>Accounting Testing UI</title>  
		   <link rel="icon"  href="download.ico" />
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<style>
a:link {
  color: green;
  background-color: transparent;
  text-decoration: none;
}
a:visited {
  color: pink;
  background-color: transparent;
  text-decoration: none;
}
a:hover {
  color: red;
  background-color: transparent;
  text-decoration: underline;
}
a:active {
  color: yellow;
  background-color: transparent;
  text-decoration: underline;
}
</style>

      </head>  
      <body>  
           <div class="container"> 


 
                <br />  
                <br />  
                <h2 align="center">TESTING UI  FOR ACCOUNTING  TEAM    FOR ENTRY DATA</h2> 

<h2> <p>Links</p></h2>

<div class ="row">


<div class="col-xs-2">
<a href="balancesheet.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Balance Sheet</a>


</div>
<div class="col-xs-2">
<a href="LedgerView.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">LedgerView</a>



</div>
<div class="col-xs-2">
<a href="trialbalance.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Trial Balance</a>


</div>
<div class="col-xs-2">

<a href="PL.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">P&L</a>


</div>
<div class="col-xs-2">
<a href="Entry.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Entry</a>


</div>
</div>



  <div class="form-group">  
				
		
<br>
<br>	




				
                <div class="form-group">  
				
				
				
                     <form name="add_name" id="add_name">  
					 
					 
					 
					 
                          <div class="table-responsive">  
						  
						  
						  
						  
						   <table class="table table-bordered"> 
<tr>  
									<td>
									<div class="input-group date" data-provide="datepicker">
 <input type="text" class="form-control date-withicon" name="date" placeholder="Select Date"/>
 <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>
</div>
									</td>
									
									
									 <td><input type="text" name="refbillno" placeholder="Enter bill no" class="form-control name_list" /></td> 
									 <td><input type="text" name="totalamount" placeholder="Enter total  amount" class="form-control name_list" /></td>
 <td><input type="text" name="narration" placeholder="Enter narration" class="form-control name_list" /></td>									 
									 
</tr>


</table>

<br/>




                               <table class="table table-bordered" id="dynamic_field"> 
							
                                    <tr>  
									

				   


                   <td><button type="button" name="add" id="add" class="btn btn-success">Add Details For ENTRY</button></td>  
                                    </tr>  
                               </table>  
                               <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  
                          </div>  
                     </form>  
					 
					 
					 <p id="result"></p>
                </div>
				<br>
				<h3><b><font color="orange">View Entry Data:-</font></b></h3>
				<br>
				
				
				<a href="LedgerView.php" target="_blank"><h3><b>Click here to View Ledgers</b></h3></a> 

           </div>  
      </body>  
 </html>  
 <script>  
 
 

$(function(){
   $('.date-withicon').datepicker({
      format: 'mm-dd-yyyy'
    });
});

 $(document).ready(function(){  
      var i=0;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><select class="form-control name_list"  name="ledgers[]"  id="state1"> <option value="" >Select Ledger</option></select></td><td><input type="text" name="amout[]" placeholder="Enter your amount" class="form-control name_list" /></td><td> <select class="form-control name_list"  name="drop[]"  id="state"><option value="" >Select type</option><option value="CR">CR</option> <option value="DR">DR</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
		   
		     console.log("jrjriri");
			 
 $.ajax({
          url: 'http://localhost:7657/accounting/getAllMasters?active=1&codetype=AC_LEDGER',
          type: 'GET',
          dataType: 'json',
		  crossDomain:true,
		  CrossOrigin:true,
		  
		   headers: {
                    'Access-Control-Allow-Origin': '*',
					'tenantId':9,
					'userId':1

                },
          success: function(data) {var d= data["data"]["respList"];
			
			 for(var i=0; i<d.length; i++) 
{

 $("select[name='ledgers[]']").append('<option value="' + d[i]["id"] + '">' +d[i]["name"] + '</option>');
console.log(d[i]["id"]);
}
 },
         error: function() { alert('failure!'); }
         
        });
      

      
      

     	 
			 
			 
		   
	
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){ 




var date=$("input[name='date']").val();
var d = Date.parse(date); 
var refbillno=$("input[name='refbillno']").val();
var total= parseFloat($("input[name='totalamount']").val());
var narration=$("input[name='narration']").val();
var voucherno="004"

var amount = $("input[name='amout[]']")
              .map(function(){return $(this).val();}).get();
			  
var type=$("select[name='drop[]']  option:selected").map(function(){return $(this).val();}).get();		
var ledgers=$("select[name='ledgers[]']  option:selected").map(function(){return $(this).val();}).get();



sitePersonel={};
var employees = [];

sitePersonel.entry = employees;
sitePersonel.entry_code="ENT_JOURNAL"
sitePersonel.entrydatetime=d;
sitePersonel.voucherNo=voucherno;
sitePersonel.referencebillno=refbillno;
sitePersonel.totalAmount=total
sitePersonel.narration=narration;
			  
			   for(var i=0; i<ledgers.length; i++) {
var entry = {
  "type": type[i],
  "amount":parseFloat(amount[i]),
  "configid":ledgers[i],
}
sitePersonel.entry.push(entry);
  }
			  
console.log(JSON.stringify(sitePersonel));		


  
	 $.ajax({
        type: "POST",
        contentType: "application/json",
        url: "http://localhost:7657/accounting/addNewEntry",
        data: JSON.stringify(sitePersonel),
        dataType: 'json',
        cache: false,
        timeout: 600000,
		crossDomain:true,
		  CrossOrigin:true,
		  
		   headers: {
                    'Access-Control-Allow-Origin': '*',
                     'tenantId':9,
'userId':1
					

                },
        success: function (data) {
			console.log(data)
			if(data["responseCode"]=="0")
			{
				$("#result").html("<h2><b>Entry successfully added</b></h2>");
			}
			
else
			{
				
				$("#result").html("<h2><b>"+data+"</b></h2>");
				
			}

           
        },
        error: function (e) {

            alert('failure');

        }
    });		  


	  
      });  
 });  
 </script>
