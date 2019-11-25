 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>P&L</title>  
		   <link rel="icon"  href="download.ico" />
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>  
           <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>  
      </head> 


<style>
#cat {
  font-size: 120%;
  font-weight: 900;
  
}
#cat1{
  font-size: 120%;
  font-weight: 900;
  padding-left:70px;
  
}

#cat2
{
	background-color:#f5f5f5  !important;
}


p{
	
text-align:center;
font-weight: 900;	
}

#li {
  border-left: 2px solid black;
  border-top: 4px solid black;
   border-right: 4px solid black;
   border-bottom: 4px solid black;
 width: 520px;
  height: 520px;
}

#li2 {
  border-left: 4px solid black;
  border-top: 4px solid black;
   border-right: 2px solid black;
   border-bottom: 4px solid black;
  width: 520px;
  height: 520px;
}

#opt {
 
  border-bottom: 3px solid black;
   
   
  width: 100px;
 
}


#cat4{
	border-top: 3px solid black;
   
   
  width: 100px;
  
  background-color:#f5f5f5  !important;
}

</style	>
      <body>  
           <br /><br />  
		   
		   
		   
		 <h2>  <p> Profit & Loss Account</p></h2>
		   
		   </br>
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

<a href="P&L.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">P&L</a>


</div>
<div class="col-xs-2">
<a href="Entry.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Entry</a>


</div>
</div>



  <div class="form-group">  
				
		
<br>
<br>	



<div class="row">
		
<div class="col-xs-6" id="li2">	
<div class="table-responsive" id="data">

</div>

</div>

<div class="col-xs-6" id="li">		
<div class="table-responsive" id ="data1">

</div>

</div>


</div>
</div>





                
      </body>  
 </html>  
 <script>  

$(document).ready(function(){
$.ajax({
          url: 'http://localhost/Accounting_ui/P&L.json',
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

var tbody='<table class="table table-striped"><thead><tr id="opt"> <th>Particulars</th><th >Amount</th></tr><tbody>'
var tbody1='<table class="table table-striped"><thead><tr id="opt"> <th >Particulars</th><th >Amount</th></tr><tbody>'

var debitUpper=data["debit"]["debitUpper"]["heads"];
var breakuplist=[];

if(debitUpper!=null)
{
for(var i=0;i< debitUpper.length;i++)
{
	tbody+='<tr><td id="cat">'
	tbody+=debitUpper[i]["name"];
	tbody+='</td><td id="cat1">'
	tbody+=debitUpper[i]["total"];
	tbody+='</td></tr>';
	breakuplist=data["debit"]["debitUpper"]["heads"][i]["breakup"];
	if (typeof data["debit"]["debitUpper"]["heads"][i]["breakup"] !== 'undefined') {
			
			
			
			console.log(breakuplist);
			for(var j=0;j<breakuplist.length;j++)
	{
		console.log(breakuplist[j]["name"]);
			tbody+='<tr><td>'
	tbody+=breakuplist[j]["name"];
	tbody+='</td><td>'
	tbody+=breakuplist[j]["amount"];
	tbody+='</td></tr>'
		
	}
		}
		
		
	
	
	
	
	
	
		
		
	
	
	}
	
	tbody+='<tr id="cat2"><td id="cat">'
	tbody+='Total';
	tbody+='</td><td id="cat1">'
	tbody+=data["debit"]["debitUpper"]["total"];
	tbody+='</td></tr>';
	}
	

	
	var debitlower=data["debit"]["debitLower"]["heads"];
	
	
	var breakuplist1=[];
	
if(debitlower!=null)
{
	
	for(var i=0;i< debitlower.length;i++)
{
	tbody+='<tr><td id="cat">'
	tbody+=debitlower[i]["name"];
	tbody+='</td><td id="cat1">'
	tbody+=debitlower[i]["total"];
	tbody+='</td></tr>';
	breakuplist1=data["debit"]["debitLower"]["heads"][i]["breakup"];
	if (typeof data["debit"]["debitLower"]["heads"][i]["breakup"] !== 'undefined') {
			
			
			
			
			for(var j=0;j<breakuplist1.length;j++)
	{
		console.log(breakuplist1[j]["name"]);
			tbody+='<tr><td>'
	tbody+=breakuplist1[j]["name"];
	tbody+='</td><td>'
	tbody+=breakuplist1[j]["amount"];
	tbody+='</td></tr>'
		
	}
		}
		
		
	
	
	
	
	
	
		
		
	
	
	}
	
	tbody+='<tr id="cat4"><td id="cat">'
	tbody+='Total';
	tbody+='</td><td id="cat1">'
	tbody+=data["debit"]["debitLower"]["total"];
	tbody+='</td></tr>';


}
var creditupper=data["credit"]["creditUpper"]["heads"];
	
	

	var breakuplist2=[];

if(creditupper!=null)
{
	
		for(var i=0;i< creditupper.length;i++)
{
	tbody1+='<tr><td id="cat">'
	tbody1+=creditupper[i]["name"];
	tbody1+='</td><td id="cat1">'
	tbody1+=creditupper[i]["total"];
	tbody1+='</td></tr>';
	breakuplist2=data["credit"]["creditUpper"]["heads"][i]["breakup"];
	if (typeof data["credit"]["creditUpper"]["heads"][i]["breakup"] !== 'undefined') {
			
	for(var k=0;k<breakuplist2.length;k++)
	{

tbody1+='<tr><td>'
tbody1+=breakuplist2[k]["name"];
tbody1+='</td><td>'
tbody1+=breakuplist2[k]["amount"];
tbody1+='</td></tr>';

	}		
			
			
			console.log(breakuplist2);
			
	
		}
		
		
	
	
	
	
	
	
		
		
	
	
	}
	
	tbody1+='<tr id="cat2"><td id="cat">'
	tbody1+='Total';
	tbody1+='</td><td id="cat1">'
	tbody1+=data["credit"]["creditUpper"]["total"];
	tbody1+='</td></tr>';
	
	
}	
	
	
	
	
	
	
	var creditlower=data["credit"]["creditLower"]["heads"];
	
	
	var breakuplist3=[];
if(creditlower!=null)
{
	
		for(var i=0;i< creditlower.length;i++)
{
	tbody1+='<tr><td id="cat">'
	tbody1+=creditlower[i]["name"];
	tbody1+='</td><td id="cat1">'
	tbody1+=creditlower[i]["total"];
	tbody1+='</td></tr>';
	breakuplist3=data["credit"]["creditLower"]["heads"][i]["breakup"];
	if (typeof data["credit"]["creditLower"]["heads"][i]["breakup"] !== 'undefined') {
			
	for(var k=0;k<breakuplist3.length;k++)
	{

tbody1+='<tr><td>'
tbody1+=breakuplist3[k]["name"];
tbody1+='</td><td>'
tbody1+=breakuplist3[k]["amount"];
tbody1+='</td></tr>';

	}		
			
			
			console.log(breakuplist3);
			
	
		}
		
		
	
	
	
	
	
	
		
		
	
	
	}
	
	tbody1+='<tr id="cat4"><td id="cat">'
	tbody1+='Total';
	tbody1+='</td><td id="cat1">'
	tbody1+=data["credit"]["creditLower"]["total"];
	tbody1+='</td></tr>';



}




tbody+='</tbody></table>';
$('#data').html(tbody);
tbody1+='</tbody></table>';
$('#data1').html(tbody1);
      


			
 },
         error: function() { alert('failure!'); }
         
        });
      
});













 









  
 </script>  
