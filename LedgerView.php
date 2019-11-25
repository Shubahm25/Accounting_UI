 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Ledger Data</title>  
		   <link rel="icon"  href="download.ico" />
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>  
           <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script> 
      </head> 


<style>
td.highlight {
    background-color: whitesmoke !important;
}
</style	  
      <body>  
           <br /><br />  
           <div class="container"> 

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




		
</br>							


<br>






<select class="form-control name_list"  name="ledgers"  id="state1"> <option value="" >Select Ledger</option></select>

<input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  

</form>
</div>





                <h1 align="center">Ledger Table</h3><br />  
                <h3 align="center">Get Ledger Data</h3><br />  
                <table id="data-table" class="table table-bordered">  
                     <thead>  
                          <tr>  
                               <th>ledgerid</th>  
                               <th>ledgertype</th>  
                               <th>transactionid</th>   
                               <th>transactiondate</th>  
                               <th>openingbalancedate</th>  
							   <th>narration</th>  
                               <th>particulars</th>  
                               <th>entrytype</th>  
							   <th>voucherno</th>  
                               <th>referencebillno</th>  
                               <th>debitopeningbalance</th>  
							   <th>creditopeningbalance</th>  
                               <th>debitamount</th>  
                               <th>creditamount</th>  
							   <th>debitclosingbalance</th>  
                               <th>creditclosingbalance</th>  
                                	
                          </tr>  
                     </thead>  
                </table>  
           </div>  
      </body>  
 </html>  
 <script>  

$(document).ready(function(){
$.ajax({
          url: 'http://localhost:7657/accounting/getAllMasters?active=1&codetype=AC_LEDGER',
          type: 'GET',
          dataType: 'json',
		  crossDomain:true,
		  CrossOrigin:true,
		  
		   headers: {
                    'Access-Control-Allow-Origin': '*',
					'tenantId':1,
					'userId':1

                },
          success: function(data) { 



var d=data["data"]["respList"];
console.log(data);
			
			 for(var i=0; i<d.length; i++) 
{

 $("select[name='ledgers']").append('<option value="' + d[i]["id"] + '">' +d[i]["name"] + '</option>');
console.log(d[i]["id"]);
}
 },
         error: function() { alert('failure!'); }
         
        });
      
});













 $('#submit').click(function(){ 
var ledgers=$("select[name='ledgers']  option:selected").val();


var fromdate =  $("#from").val();
var frompardate= Date.parse(fromdate);

var to=$("#to").val();
var topardate=Date.parse(to);
console.log(fromdate);
console.log("http://localhost:7657/accounting/findAll?masterid="+ledgers+"&fromdate="+frompardate+"&todate="+topardate); 
      $('#data-table').DataTable({  
           "ajax"     :     "http://localhost:7657/accounting/findAll?masterid="+ledgers, 
  destroy: true,
    searching: true, 
           "columns"     :     [  
                {     "data"     :     "ledgerid"     },  
                {     "data"     :     "ledgertype"},  
                {     "data"     :     "transactionid"} , 
                {     "data"     :     "transactiondate"},  
				 {     "data"     :     "openingbalancedate"},  
                {     "data"     :     "narration"},  
				 {     "data"     :     "particulars"},  
                {     "data"     :     "entrytype"},  
				 {     "data"     :     "voucherno"},  
                {     "data"     :     "referencebillno"},  
				 {     "data"     :     "debitopeningbalance"},  
                {     "data"     :     "creditopeningbalance"} , 
				 {     "data"     :     "debitamount"},  
                {     "data"     :     "creditamount"} , 
				 {     "data"     :     "debitclosingbalance"},  
                {     "data"     :     "creditclosingbalance"} ]
      });  
 });









  
 </script>  
